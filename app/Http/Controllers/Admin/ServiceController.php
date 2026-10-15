<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['category', 'subcategory'])
            ->orderBy('category_id')
            ->orderBy('order_index')
            ->get();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $service = new Service();
        return view('admin.services.form', compact('service', 'categories', 'subcategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'title' => 'required|string|max:200',
            'slug' => 'nullable|string|max:200|unique:services,slug',
            'subtitle' => 'nullable|string|max:255',
            'short_desc' => 'nullable|string',
            'detailed_desc' => 'nullable|string',
            'mantra_chanted' => 'nullable|string',
            'duration' => 'nullable|string|max:100',
            'priests_count' => 'nullable|string|max:100',
            'dakshina_inr' => 'nullable|numeric|min:0',
            'dakshina_usd' => 'nullable|numeric|min:0',
            'benefits_text' => 'nullable|string', // newline separated
            'samagri_details' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'order_index' => 'nullable|integer',
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'service_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/services'), $filename);
            $validated['image'] = $filename;
        } elseif (empty($validated['image'])) {
            $validated['image'] = 'service-maha-mrityunjaya.jpg';
        }

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['order_index'] = $validated['order_index'] ?? 0;
        $validated['dakshina_inr'] = $validated['dakshina_inr'] ?? 0;
        $validated['dakshina_usd'] = $validated['dakshina_usd'] ?? 0;

        // Process benefits
        if (!empty($request->benefits_text)) {
            $validated['benefits'] = array_values(array_filter(array_map('trim', explode("\n", $request->benefits_text))));
        } else {
            $validated['benefits'] = [];
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Vedic Service/Yagya created successfully.');
    }

    public function edit(Service $service)
    {
        $categories = Category::all();
        $subcategories = Subcategory::where('category_id', $service->category_id)->get();
        return view('admin.services.form', compact('service', 'categories', 'subcategories'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:subcategories,id',
            'title' => 'required|string|max:200',
            'slug' => 'nullable|string|max:200|unique:services,slug,' . $service->id,
            'subtitle' => 'nullable|string|max:255',
            'short_desc' => 'nullable|string',
            'detailed_desc' => 'nullable|string',
            'mantra_chanted' => 'nullable|string',
            'duration' => 'nullable|string|max:100',
            'priests_count' => 'nullable|string|max:100',
            'dakshina_inr' => 'nullable|numeric|min:0',
            'dakshina_usd' => 'nullable|numeric|min:0',
            'benefits_text' => 'nullable|string',
            'samagri_details' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'order_index' => 'nullable|integer',
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'service_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/services'), $filename);
            $validated['image'] = $filename;
        }

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['order_index'] = $validated['order_index'] ?? 0;
        $validated['dakshina_inr'] = $validated['dakshina_inr'] ?? 0;
        $validated['dakshina_usd'] = $validated['dakshina_usd'] ?? 0;

        if (!empty($request->benefits_text)) {
            $validated['benefits'] = array_values(array_filter(array_map('trim', explode("\n", $request->benefits_text))));
        } else {
            $validated['benefits'] = $service->benefits;
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Vedic Service/Yagya updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Vedic Service/Yagya deleted successfully.');
    }
}
