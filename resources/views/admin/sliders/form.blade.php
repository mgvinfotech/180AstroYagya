@extends('layouts.admin')

@section('title', ($slider->exists ? 'Edit' : 'Create') . ' Hero Slide')

@section('content')
<div class="max-w-3xl space-y-6">
    <div class="flex items-center justify-between pb-4 border-b border-[#212130]">
        <div>
            <h1 class="text-2xl font-heading font-bold text-amber-300">
                {{ $slider->exists ? 'Edit Hero Banner Slide' : 'Create New Hero Slide' }}
            </h1>
            <p class="text-xs text-neutral-400 mt-1">Configure slide headline, subtitle, buttons, and ordering.</p>
        </div>
        <a href="{{ route('admin.sliders.index') }}" class="text-xs text-neutral-400 hover:text-amber-300">
            ← Back to Sliders
        </a>
    </div>

    <form action="{{ $slider->exists ? route('admin.sliders.update', $slider->id) : route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data" class="admin-card p-6 space-y-5">
        @csrf
        @if($slider->exists)
            @method('PUT')
        @endif

        <div>
            <label class="block text-xs font-semibold text-neutral-300 mb-1">Golden Header Badge</label>
            <input type="text" name="badge" value="{{ old('badge', $slider->badge) }}" class="form-input-admin" placeholder="e.g. ✦ SACRED VEDIC RITUALS • LIVE SANKALP FROM KASHI ✦">
        </div>

        <div>
            <label class="block text-xs font-semibold text-neutral-300 mb-1">Main Headline *</label>
            <input type="text" name="title" value="{{ old('title', $slider->title) }}" required class="form-input-admin" placeholder="e.g. Divine Vedic Yagyas & Planetary Remedies">
        </div>

        <div>
            <label class="block text-xs font-semibold text-neutral-300 mb-1">Subtitle</label>
            <input type="text" name="subtitle" value="{{ old('subtitle', $slider->subtitle) }}" class="form-input-admin" placeholder="e.g. Awaken Divine Blessings for Health, Prosperity & Moksha">
        </div>

        <div>
            <label class="block text-xs font-semibold text-neutral-300 mb-1 flex items-center justify-between">
                <span>Detailed Description Paragraph (Rich Text Editor)</span>
                <span class="text-[10px] text-amber-400 font-normal"><i class="fa fa-magic"></i> Bold, Text Colors supported</span>
            </label>
            <textarea name="description" rows="3" class="form-input-admin rich-editor" data-height="160" placeholder="Brief summary of rituals, pandits, and sankalp vidhi...">{{ old('description', $slider->description) }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4 rounded-xl bg-black/30 border border-amber-500/20">
            <div>
                <label class="block text-xs font-semibold text-amber-400 mb-1">Primary CTA Button Label</label>
                <input type="text" name="btn_primary_text" value="{{ old('btn_primary_text', $slider->btn_primary_text ?? 'Book Sacred Yagya') }}" class="form-input-admin">
            </div>
            <div>
                <label class="block text-xs font-semibold text-amber-400 mb-1">Primary Button Destination Link</label>
                <input type="text" name="btn_primary_url" value="{{ old('btn_primary_url', $slider->btn_primary_url ?? '#booking-section') }}" class="form-input-admin">
            </div>
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Secondary Button Label</label>
                <input type="text" name="btn_secondary_text" value="{{ old('btn_secondary_text', $slider->btn_secondary_text ?? 'Explore 108 Yagyas') }}" class="form-input-admin">
            </div>
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Secondary Button Destination Link</label>
                <input type="text" name="btn_secondary_url" value="{{ old('btn_secondary_url', $slider->btn_secondary_url ?? '#services-section') }}" class="form-input-admin">
            </div>
        </div>

        <!-- Background Image Upload & Preview -->
        <div class="p-4 rounded-xl bg-black/40 border border-amber-500/20 space-y-3">
            <label class="block text-xs font-bold text-amber-400 uppercase tracking-wider">
                <i class="fa fa-image mr-1"></i> Slide Background Image
            </label>
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                <div class="w-40 h-24 rounded-lg overflow-hidden border border-amber-500/30 bg-neutral-900 shrink-0 relative group">
                    <img id="sliderPreviewImg" src="{{ $slider->image_url }}" alt="Slide Preview" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/50 text-[10px] text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        Current Image
                    </div>
                </div>
                <div class="space-y-2 flex-1">
                    <label class="block text-xs text-neutral-300 font-semibold">Upload New Image File (JPG, PNG, WebP)</label>
                    <input type="file" name="image_file" id="sliderImageFile" accept="image/*" class="text-xs text-neutral-300 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-amber-500 file:text-black hover:file:bg-amber-400 cursor-pointer">
                    <p class="text-[11px] text-neutral-500">Recommended dimensions: 1920x800 or 1600x700 for high resolution banner.</p>
                    <div class="pt-1">
                        <label class="block text-[11px] text-neutral-400">Or Image Filename (if in public/images/)</label>
                        <input type="text" name="image" value="{{ old('image', $slider->image) }}" class="form-input-admin text-xs py-1" placeholder="e.g. 1.jpg or slider-vedic-havan.jpg">
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Sort Order</label>
                <input type="number" name="order_index" value="{{ old('order_index', $slider->order_index ?? 0) }}" class="form-input-admin">
            </div>
        </div>

        <div class="flex items-center gap-2 pt-2">
            <input type="checkbox" name="is_active" id="sliderActive" value="1" {{ old('is_active', $slider->is_active ?? true) ? 'checked' : '' }} class="rounded border-neutral-700 bg-neutral-900 text-amber-500">
            <label for="sliderActive" class="text-xs text-neutral-300 cursor-pointer">Active & Visible in Rotating Hero</label>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-[#222233]">
            <a href="{{ route('admin.sliders.index') }}" class="px-4 py-2 bg-neutral-800 text-neutral-300 rounded text-xs">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold rounded text-xs uppercase tracking-wider">
                {{ $slider->exists ? 'Update Slide' : 'Create Slide' }}
            </button>
        </div>
    </form>
</div>

<script>
    const sliderFileInput = document.getElementById('sliderImageFile');
    const sliderPreviewImg = document.getElementById('sliderPreviewImg');
    if (sliderFileInput && sliderPreviewImg) {
        sliderFileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    sliderPreviewImg.src = evt.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endsection
