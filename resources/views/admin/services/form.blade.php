@extends('layouts.admin')

@section('title', ($service->exists ? 'Edit' : 'Create') . ' Vedic Service / Yagya')

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between pb-4 border-b border-[#212130]">
        <div>
            <h1 class="text-2xl font-heading font-bold text-amber-300">
                {{ $service->exists ? 'Edit Vedic Yagya / Puja' : 'Add New Vedic Yagya / Puja' }}
            </h1>
            <p class="text-xs text-neutral-400 mt-1">Configure Vedic descriptions, mantras, samagri, benefits, and dakshina.</p>
        </div>
        <a href="{{ route('admin.services.index') }}" class="text-xs text-neutral-400 hover:text-amber-300">
            ← Back to Services
        </a>
    </div>

    <form action="{{ $service->exists ? route('admin.services.update', $service->id) : route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="admin-card p-6 space-y-6">
        @csrf
        @if($service->exists)
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Ritual Title *</label>
                <input type="text" name="title" value="{{ old('title', $service->title) }}" required class="form-input-admin" placeholder="e.g. Maha Mrityunjaya Maha Yagya">
            </div>
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Slug (URL)</label>
                <input type="text" name="slug" value="{{ old('slug', $service->slug) }}" class="form-input-admin" placeholder="leave blank to auto-generate">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Category *</label>
                <select name="category_id" id="categorySelect" required class="form-input-admin">
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" data-type="{{ $cat->type }}" {{ old('category_id', $service->category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }} [{{ strtoupper($cat->type) }}]
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Subcategory (Optional)</label>
                <select name="subcategory_id" id="subcategorySelect" class="form-input-admin">
                    <option value="">-- None --</option>
                    @foreach($subcategories as $sub)
                    <option value="{{ $sub->id }}" data-category-id="{{ $sub->category_id }}" {{ old('subcategory_id', $service->subcategory_id) == $sub->id ? 'selected' : '' }}>
                        {{ $sub->name }}
                    </option>
                    @endforeach
                </select>
                <p id="subcatHint" class="text-[10px] text-neutral-400 mt-1">Subcategories automatically filtered by selected Category.</p>
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-neutral-300 mb-1">Subtitle / Punchline</label>
            <input type="text" name="subtitle" value="{{ old('subtitle', $service->subtitle) }}" class="form-input-admin" placeholder="e.g. Supreme Ritual for Longevity, Critical Health Recovery & Moksha">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 rounded-xl bg-black/40 border border-amber-500/20">
            <div>
                <label class="block text-xs font-semibold text-amber-400 mb-1">Dakshina (INR ₹)</label>
                <input type="number" step="0.01" name="dakshina_inr" value="{{ old('dakshina_inr', $service->dakshina_inr ?? 21000) }}" class="form-input-admin">
            </div>
            <div>
                <label class="block text-xs font-semibold text-amber-400 mb-1">Dakshina (USD $)</label>
                <input type="number" step="0.01" name="dakshina_usd" value="{{ old('dakshina_usd', $service->dakshina_usd ?? 280) }}" class="form-input-admin">
            </div>
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Duration</label>
                <input type="text" name="duration" value="{{ old('duration', $service->duration ?? '3 Days (4 Hours Daily)') }}" class="form-input-admin">
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-neutral-300 mb-1">Consecrated Mantra Chanted</label>
            <textarea name="mantra_chanted" rows="2" class="form-input-admin" placeholder="e.g. ॐ त्र्यम्बकं यजामहे... (125,000 Japa)">{{ old('mantra_chanted', $service->mantra_chanted) }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-semibold text-neutral-300 mb-1">Short Summary (Shows on Homepage Cards)</label>
            <textarea name="short_desc" rows="2" class="form-input-admin">{{ old('short_desc', $service->short_desc) }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-semibold text-neutral-300 mb-1 flex items-center justify-between">
                <span>Detailed Shastric Description (Rich Text Editor)</span>
                <span class="text-[10px] text-amber-400 font-normal"><i class="fa fa-magic"></i> Bold, Text Colors, Headings & Lists supported</span>
            </label>
            <textarea name="detailed_desc" rows="8" class="form-input-admin rich-editor" data-height="280" placeholder="Write full description here... You can bold important terms, change text colors, and make lists easily.">{{ old('detailed_desc', $service->detailed_desc) }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-semibold text-neutral-300 mb-1">Spiritual Benefits & Merits (One point per line)</label>
            @php
                $benefitsText = is_array($service->benefits) ? implode("\n", $service->benefits) : '';
            @endphp
            <textarea name="benefits_text" rows="4" class="form-input-admin" placeholder="Dispel critical chronic health disorders&#10;Neutralize malefic Dasha&#10;Direct HD live telecast...">{{ old('benefits_text', $benefitsText) }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-semibold text-neutral-300 mb-1">Pure Samagri Included</label>
            <textarea name="samagri_details" rows="2" class="form-input-admin" placeholder="Pure Gir Cow Ghee, 108 Forest Herbs, Kashi Gangajal...">{{ old('samagri_details', $service->samagri_details) }}</textarea>
        </div>

        <!-- Service Thumbnail Upload & Preview -->
        <div class="p-4 rounded-xl bg-black/40 border border-amber-500/20 space-y-3">
            <label class="block text-xs font-bold text-amber-400 uppercase tracking-wider">
                <i class="fa fa-image mr-1"></i> Puja / Yagya Banner Image
            </label>
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                <div class="w-32 h-24 rounded-lg overflow-hidden border border-amber-500/30 bg-neutral-900 shrink-0 relative group">
                    <img id="servicePreviewImg" src="{{ $service->image_url }}" alt="Service Preview" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/50 text-[10px] text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        Current Image
                    </div>
                </div>
                <div class="space-y-2 flex-1">
                    <label class="block text-xs text-neutral-300 font-semibold">Upload Image File (JPG, PNG, WebP)</label>
                    <input type="file" name="image_file" id="serviceImageFile" accept="image/*" class="text-xs text-neutral-300 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-amber-500 file:text-black hover:file:bg-amber-400 cursor-pointer">
                    <div class="pt-1">
                        <label class="block text-[11px] text-neutral-400">Or Image Filename (if in public/images/)</label>
                        <input type="text" name="image" value="{{ old('image', $service->image) }}" class="form-input-admin text-xs py-1" placeholder="e.g. service-maha-mrityunjaya.jpg">
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Sort Order</label>
                <input type="number" name="order_index" value="{{ old('order_index', $service->order_index ?? 0) }}" class="form-input-admin">
            </div>
            <div class="flex items-center gap-4 pt-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $service->is_featured) ? 'checked' : '' }} class="rounded border-neutral-700 bg-neutral-900 text-amber-500">
                    <span class="text-xs text-amber-300 font-semibold">Featured</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }} class="rounded border-neutral-700 bg-neutral-900 text-amber-500">
                    <span class="text-xs text-neutral-200">Active</span>
                </label>
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-[#222233]">
            <a href="{{ route('admin.services.index') }}" class="px-4 py-2 bg-neutral-800 text-neutral-300 rounded text-xs">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold rounded text-xs uppercase tracking-wider">
                {{ $service->exists ? 'Update Vedic Service' : 'Create Vedic Service' }}
            </button>
        </div>
    </form>
</div>

<script>
    // Subcategory Dynamic Filtering based on Selected Category
    function filterSubcategories() {
        const catSelect = document.getElementById('categorySelect');
        const subSelect = document.getElementById('subcategorySelect');
        if (!catSelect || !subSelect) return;

        const selectedCatId = String(catSelect.value);
        let validMatchCount = 0;
        let selectedOptionStillValid = false;

        Array.from(subSelect.options).forEach((opt) => {
            if (!opt.value) {
                // Keep the '-- None --' placeholder option
                opt.style.display = '';
                opt.disabled = false;
                return;
            }

            const optCatId = String(opt.getAttribute('data-category-id') || '');
            if (optCatId === selectedCatId) {
                opt.style.display = '';
                opt.disabled = false;
                validMatchCount++;
                if (opt.selected) {
                    selectedOptionStillValid = true;
                }
            } else {
                opt.style.display = 'none';
                opt.disabled = true;
                if (opt.selected) {
                    opt.selected = false;
                }
            }
        });

        // If previously selected subcategory does not belong to this category, reset to empty
        if (!selectedOptionStillValid && subSelect.value && subSelect.selectedOptions[0]?.disabled) {
            subSelect.value = '';
        }

        const hint = document.getElementById('subcatHint');
        if (hint) {
            hint.textContent = validMatchCount > 0 
                ? `${validMatchCount} subcategor${validMatchCount > 1 ? 'ies' : 'y'} available for selected category.` 
                : 'No subcategories created for this category yet.';
        }
    }

    const catSelect = document.getElementById('categorySelect');
    if (catSelect) {
        catSelect.addEventListener('change', filterSubcategories);
        document.addEventListener('DOMContentLoaded', filterSubcategories);
        // Also call immediately
        filterSubcategories();
    }

    // Image Upload Preview
    const serviceFileInput = document.getElementById('serviceImageFile');
    const servicePreviewImg = document.getElementById('servicePreviewImg');
    if (serviceFileInput && servicePreviewImg) {
        serviceFileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    servicePreviewImg.src = evt.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endsection
