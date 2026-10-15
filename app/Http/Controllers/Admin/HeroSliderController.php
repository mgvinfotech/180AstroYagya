<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HeroSliderController extends Controller
{
    public function index()
    {
        $sliders = HeroSlider::orderBy('order_index')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.form', ['slider' => new HeroSlider()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'badge' => 'nullable|string|max:150',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'btn_primary_text' => 'nullable|string|max:60',
            'btn_primary_url' => 'nullable|string|max:255',
            'btn_secondary_text' => 'nullable|string|max:60',
            'btn_secondary_url' => 'nullable|string|max:255',
            'order_index' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'slider_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/sliders'), $filename);
            $validated['image'] = $filename;
        } elseif (empty($validated['image'])) {
            $validated['image'] = 'slider-vedic-havan.jpg';
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order_index'] = $validated['order_index'] ?? 0;

        HeroSlider::create($validated);

        return redirect()->route('admin.sliders.index')->with('success', 'Hero slide created successfully with background image.');
    }

    public function edit(HeroSlider $slider)
    {
        return view('admin.sliders.form', compact('slider'));
    }

    public function update(Request $request, HeroSlider $slider)
    {
        $validated = $request->validate([
            'badge' => 'nullable|string|max:150',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'btn_primary_text' => 'nullable|string|max:60',
            'btn_primary_url' => 'nullable|string|max:255',
            'btn_secondary_text' => 'nullable|string|max:60',
            'btn_secondary_url' => 'nullable|string|max:255',
            'order_index' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = 'slider_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/sliders'), $filename);
            $validated['image'] = $filename;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order_index'] = $validated['order_index'] ?? 0;

        $slider->update($validated);

        return redirect()->route('admin.sliders.index')->with('success', 'Hero slide updated successfully.');
    }

    public function destroy(HeroSlider $slider)
    {
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Hero slide deleted successfully.');
    }
}
