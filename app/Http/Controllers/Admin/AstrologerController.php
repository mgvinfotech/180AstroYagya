<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Astrologer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AstrologerController extends Controller
{
    public function index()
    {
        $astrologers = Astrologer::orderBy('order_index')->get();
        return view('admin.astrologers.index', compact('astrologers'));
    }

    public function create()
    {
        return view('admin.astrologers.form', ['astrologer' => new Astrologer()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'slug' => 'nullable|string|max:150|unique:astrologers,slug',
            'title' => 'nullable|string|max:150',
            'qualification' => 'nullable|string|max:200',
            'experience_years' => 'required|integer|min:1',
            'specialties' => 'nullable|string|max:255',
            'languages' => 'nullable|string|max:150',
            'bio' => 'nullable|string',
            'avatar' => 'nullable|string|max:255',
            'avatar_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'rating' => 'nullable|numeric|between:1,5',
            'reviews_count' => 'nullable|integer|min:0',
            'consultation_fee' => 'nullable|numeric|min:0',
            'is_available_online' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'order_index' => 'nullable|integer',
        ]);

        if ($request->hasFile('avatar_file')) {
            $file = $request->file('avatar_file');
            $filename = 'acharya_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/astrologers'), $filename);
            $validated['avatar'] = $filename;
        } elseif (empty($validated['avatar'])) {
            $validated['avatar'] = 'panditji.jpg';
        }

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        $validated['is_available_online'] = $request->has('is_available_online');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['order_index'] = $validated['order_index'] ?? 0;
        $validated['rating'] = $validated['rating'] ?? 5.0;
        $validated['reviews_count'] = $validated['reviews_count'] ?? 108;
        $validated['consultation_fee'] = $validated['consultation_fee'] ?? 2100;

        Astrologer::create($validated);

        return redirect()->route('admin.astrologers.index')->with('success', 'Astrologer / Acharya profile created successfully.');
    }

    public function edit(Astrologer $astrologer)
    {
        return view('admin.astrologers.form', compact('astrologer'));
    }

    public function update(Request $request, Astrologer $astrologer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'slug' => 'nullable|string|max:150|unique:astrologers,slug,' . $astrologer->id,
            'title' => 'nullable|string|max:150',
            'qualification' => 'nullable|string|max:200',
            'experience_years' => 'required|integer|min:1',
            'specialties' => 'nullable|string|max:255',
            'languages' => 'nullable|string|max:150',
            'bio' => 'nullable|string',
            'avatar' => 'nullable|string|max:255',
            'avatar_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'rating' => 'nullable|numeric|between:1,5',
            'reviews_count' => 'nullable|integer|min:0',
            'consultation_fee' => 'nullable|numeric|min:0',
            'is_available_online' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'order_index' => 'nullable|integer',
        ]);

        if ($request->hasFile('avatar_file')) {
            $file = $request->file('avatar_file');
            $filename = 'acharya_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/astrologers'), $filename);
            $validated['avatar'] = $filename;
        }

        $validated['slug'] = $validated['slug'] ? Str::slug($validated['slug']) : Str::slug($validated['name']);
        $validated['is_available_online'] = $request->has('is_available_online');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');
        $validated['order_index'] = $validated['order_index'] ?? 0;

        $astrologer->update($validated);

        return redirect()->route('admin.astrologers.index')->with('success', 'Astrologer profile updated successfully.');
    }

    public function destroy(Astrologer $astrologer)
    {
        $astrologer->delete();
        return redirect()->route('admin.astrologers.index')->with('success', 'Astrologer profile deleted successfully.');
    }
}
