<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socials = SocialLink::orderBy('order_index')->get();
        return view('admin.socials.index', compact('socials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:50',
            'title' => 'nullable|string|max:100',
            'url' => 'required|string|max:255',
            'icon' => 'nullable|string|max:60',
            'order_index' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order_index'] = $validated['order_index'] ?? 0;

        SocialLink::create($validated);

        return back()->with('success', 'Social media channel added successfully.');
    }

    public function update(Request $request, $id)
    {
        $social = $id instanceof SocialLink ? $id : SocialLink::findOrFail($id);

        $validated = $request->validate([
            'platform' => 'required|string|max:50',
            'title' => 'nullable|string|max:100',
            'url' => 'required|string|max:255',
            'icon' => 'nullable|string|max:60',
            'order_index' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order_index'] = $validated['order_index'] ?? 0;

        $social->update($validated);

        return back()->with('success', 'Social media channel updated successfully.');
    }

    public function destroy($id)
    {
        $social = $id instanceof SocialLink ? $id : SocialLink::findOrFail($id);
        $social->delete();
        return back()->with('success', 'Social media channel deleted.');
    }
}
