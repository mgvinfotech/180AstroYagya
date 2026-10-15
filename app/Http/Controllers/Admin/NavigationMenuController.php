<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavigationMenu;
use App\Models\Page;
use App\Models\Service;
use Illuminate\Http\Request;

class NavigationMenuController extends Controller
{
    public function index()
    {
        $menus = NavigationMenu::whereNull('parent_id')
            ->with(['children' => function ($q) {
                $q->orderBy('order_index');
            }])
            ->orderBy('location')
            ->orderBy('order_index')
            ->get();

        $parentOptions = NavigationMenu::whereNull('parent_id')->get();
        $availablePages = Page::orderBy('title')->get(['id', 'title', 'slug', 'is_active']);
        $availableServices = Service::orderBy('title')->get(['id', 'title', 'slug']);

        return view('admin.menus.index', compact('menus', 'parentOptions', 'availablePages', 'availableServices'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'parent_id' => 'nullable',
            'location' => 'required|string|in:header,footer_quick,footer_yagyas,footer_jyotish',
            'target' => 'required|string|in:_self,_blank',
            'badge' => 'nullable|string|max:30',
            'order_index' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        $validated['parent_id'] = !empty($request->parent_id) ? (int)$request->parent_id : null;
        $validated['target'] = $validated['target'] ?? '_self';
        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['order_index'] = (int)($validated['order_index'] ?? 0);

        NavigationMenu::create($validated);

        return back()->with('success', 'Navigation menu item created successfully.');
    }

    public function update(Request $request, $id)
    {
        $menu = $id instanceof NavigationMenu ? $id : NavigationMenu::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:100',
            'url' => 'required|string|max:255',
            'parent_id' => 'nullable',
            'location' => 'required|string|in:header,footer_quick,footer_yagyas,footer_jyotish',
            'target' => 'nullable|string|in:_self,_blank',
            'badge' => 'nullable|string|max:30',
            'order_index' => 'nullable|integer',
            'is_active' => 'nullable',
        ]);

        $parentId = !empty($request->parent_id) ? (int)$request->parent_id : null;
        if ($parentId === $menu->id) {
            $parentId = null;
        }
        $validated['parent_id'] = $parentId;
        $validated['target'] = $validated['target'] ?? '_self';
        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['order_index'] = (int)($validated['order_index'] ?? 0);

        $menu->update($validated);

        return back()->with('success', 'Navigation menu item updated successfully.');
    }

    public function destroy($id)
    {
        $menu = $id instanceof NavigationMenu ? $id : NavigationMenu::findOrFail($id);
        $menu->delete();
        return back()->with('success', 'Navigation menu item deleted.');
    }
}
