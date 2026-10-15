<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('order_index')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.form', ['testimonial' => new Testimonial()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:150',
            'client_title' => 'nullable|string|max:150',
            'location' => 'nullable|string|max:150',
            'service_taken' => 'nullable|string|max:150',
            'rating' => 'required|integer|between:1,5',
            'review_text' => 'required|string',
            'avatar' => 'nullable|string|max:255',
            'avatar_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'video_url' => 'nullable|string|max:255',
            'is_verified' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'order_index' => 'nullable|integer',
        ]);

        if ($request->hasFile('avatar_file')) {
            $file = $request->file('avatar_file');
            $filename = 'devotee_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/testimonials'), $filename);
            $validated['avatar'] = $filename;
        } elseif (empty($validated['avatar'])) {
            $validated['avatar'] = 't1.png';
        }

        $validated['is_verified'] = $request->has('is_verified');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['order_index'] = $validated['order_index'] ?? 0;

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Devotee testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:150',
            'client_title' => 'nullable|string|max:150',
            'location' => 'nullable|string|max:150',
            'service_taken' => 'nullable|string|max:150',
            'rating' => 'required|integer|between:1,5',
            'review_text' => 'required|string',
            'avatar' => 'nullable|string|max:255',
            'avatar_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'video_url' => 'nullable|string|max:255',
            'is_verified' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'order_index' => 'nullable|integer',
        ]);

        if ($request->hasFile('avatar_file')) {
            $file = $request->file('avatar_file');
            $filename = 'devotee_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/testimonials'), $filename);
            $validated['avatar'] = $filename;
        }

        $validated['is_verified'] = $request->has('is_verified');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['order_index'] = $validated['order_index'] ?? 0;

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')->with('success', 'Devotee testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Devotee testimonial deleted successfully.');
    }
}
