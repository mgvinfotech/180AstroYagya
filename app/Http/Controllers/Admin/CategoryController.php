<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('subcategories')->orderBy('order_index')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'slug' => 'nullable|string|max:120|unique:categories,slug',
            'type' => 'required|string|in:yagya,jyotish,meditation,remedy',
            'icon' => 'nullable|string|max:60',
            'short_desc' => 'nullable|string',
            'order_index' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');
        $validated['order_index'] = $validated['order_index'] ?? 0;

        Category::create($validated);

        return back()->with('success', 'Category created successfully.');
    }

    public function update(Request $request, $id)
    {
        $category = $id instanceof Category ? $id : Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'slug' => 'nullable|string|max:120|unique:categories,slug,' . $category->id,
            'type' => 'required|string|in:yagya,jyotish,meditation,remedy',
            'icon' => 'nullable|string|max:60',
            'short_desc' => 'nullable|string',
            'order_index' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');
        $validated['order_index'] = $validated['order_index'] ?? 0;

        $category->update($validated);

        return back()->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = $id instanceof Category ? $id : Category::findOrFail($id);
        $category->delete();
        return back()->with('success', 'Category deleted successfully.');
    }

    // Subcategory methods
    public function storeSubcategory(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:120',
            'slug' => 'nullable|string|max:120|unique:subcategories,slug',
            'short_desc' => 'nullable|string',
            'order_index' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');
        $validated['order_index'] = $validated['order_index'] ?? 0;

        Subcategory::create($validated);

        return back()->with('success', 'Subcategory created successfully.');
    }

    public function destroySubcategory(Subcategory $subcategory)
    {
        $subcategory->delete();
        return back()->with('success', 'Subcategory deleted successfully.');
    }
}
