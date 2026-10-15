<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\NavigationMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $query = Page::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('subtitle', 'like', "%{$search}%");
            });
        }

        $pages = $query->orderBy('order_index')->orderBy('title')->paginate(20);

        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        $page = new Page();
        return view('admin.pages.form', compact('page'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'slug' => 'nullable|string|max:200|unique:pages,slug',
            'subtitle' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'banner_image' => 'nullable|string|max:255',
            'banner_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'is_active' => 'nullable',
            'order_index' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        // Ensure unique slug
        $baseSlug = $validated['slug'];
        $count = 1;
        while (Page::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = "{$baseSlug}-{$count}";
            $count++;
        }

        if ($request->hasFile('banner_file')) {
            $file = $request->file('banner_file');
            $filename = 'page_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pages'), $filename);
            $validated['banner_image'] = $filename;
        }

        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['order_index'] = (int)($validated['order_index'] ?? 0);

        Page::create($validated);

        return redirect()->route('admin.pages.index')->with('success', 'CMS Page created successfully!');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.form', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'slug' => 'required|string|max:200|unique:pages,slug,' . $page->id,
            'subtitle' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'banner_image' => 'nullable|string|max:255',
            'banner_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'is_active' => 'nullable',
            'order_index' => 'nullable|integer',
        ]);

        $oldSlug = $page->slug;
        $newSlug = Str::slug($validated['slug']);
        $validated['slug'] = $newSlug;

        if ($request->hasFile('banner_file')) {
            $file = $request->file('banner_file');
            $filename = 'page_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/pages'), $filename);
            $validated['banner_image'] = $filename;
        }

        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['order_index'] = (int)($validated['order_index'] ?? 0);

        $page->update($validated);

        // Keep navigation menus URL synced if slug changes
        if ($oldSlug !== $newSlug) {
            NavigationMenu::where('url', '/vedic/' . $oldSlug)->update(['url' => '/vedic/' . $newSlug]);
            NavigationMenu::where('url', '/page/' . $oldSlug)->update(['url' => '/page/' . $newSlug]);
        }

        return redirect()->route('admin.pages.index')->with('success', 'CMS Page updated successfully!');
    }

    public function destroy(Page $page)
    {
        $slug = $page->slug;
        $title = $page->title;

        // Find any navigation menus linked to this page URL
        $linkedMenus = NavigationMenu::whereIn('url', [
            '/vedic/' . $slug,
            '/page/' . $slug,
            'vedic/' . $slug,
            'page/' . $slug,
        ])->get();

        $menuCount = $linkedMenus->count();
        if ($menuCount > 0) {
            foreach ($linkedMenus as $menu) {
                $menu->delete();
            }
        }

        $page->delete();

        $message = "Page '{$title}' deleted successfully.";
        if ($menuCount > 0) {
            $message .= " Also removed {$menuCount} linked submenu item(s) from the navigation bar.";
        }

        return redirect()->route('admin.pages.index')->with('success', $message);
    }
}
