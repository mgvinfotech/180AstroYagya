<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('order_index')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category' => 'required|string|max:50',
            'order_index' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order_index'] = $validated['order_index'] ?? 0;

        Faq::create($validated);

        return back()->with('success', 'FAQ added successfully.');
    }

    public function update(Request $request, $id)
    {
        $faq = $id instanceof Faq ? $id : Faq::findOrFail($id);

        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'category' => 'required|string|max:50',
            'order_index' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order_index'] = $validated['order_index'] ?? 0;

        $faq->update($validated);

        return back()->with('success', 'FAQ updated successfully.');
    }

    public function destroy($id)
    {
        $faq = $id instanceof Faq ? $id : Faq::findOrFail($id);
        $faq->delete();
        return back()->with('success', 'FAQ deleted successfully.');
    }
}
