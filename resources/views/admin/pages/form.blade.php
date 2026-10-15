@extends('layouts.admin')

@section('title', ($page->exists ? 'Edit' : 'Create') . ' CMS Page')

@section('content')
<div class="max-w-4xl space-y-6">

    <div class="flex items-center justify-between pb-4 border-b border-[#212130]">
        <div>
            <h1 class="text-2xl font-heading font-bold text-amber-300">
                {{ $page->exists ? 'Edit Informational Page' : 'Create New Informational Page' }}
            </h1>
            <p class="text-xs text-neutral-400 mt-1">
                Write rich Vedic articles, upload banner images, and configure page details.
            </p>
        </div>
        <div class="flex items-center gap-3">
            @if($page->exists)
            <a href="{{ url('/vedic/' . $page->slug) }}" target="_blank" class="text-xs px-3 py-1.5 rounded-lg bg-neutral-800 text-amber-300 hover:bg-neutral-700 flex items-center gap-1.5">
                <i class="fa fa-external-link-alt text-[10px]"></i> View Live
            </a>
            @endif
            <a href="{{ route('admin.pages.index') }}" class="text-xs text-neutral-400 hover:text-amber-300">
                ← Back to Pages
            </a>
        </div>
    </div>

    @if($errors->any())
    <div class="p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-300 text-xs space-y-1">
        <strong>Please check the form errors:</strong>
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ $page->exists ? route('admin.pages.update', $page->id) : route('admin.pages.store') }}" 
          method="POST" 
          enctype="multipart/form-data" 
          class="admin-card p-6 space-y-6">
        @csrf
        @if($page->exists)
            @method('PUT')
        @endif

        <!-- Title & Slug -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Page Title *</label>
                <input type="text" name="title" id="pageTitleInput" value="{{ old('title', $page->title) }}" required 
                       class="form-input-admin" placeholder="e.g. What is Vedic Yagya">
            </div>
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">
                    Slug (URL Key) <span class="text-neutral-500 font-normal">(Leave blank to auto-generate)</span>
                </label>
                <div class="flex items-center">
                    <span class="text-neutral-500 text-xs px-3 py-2 bg-[#090910] border border-r-0 border-[#2c2c3e] rounded-l-lg font-mono">
                        /vedic/
                    </span>
                    <input type="text" name="slug" id="pageSlugInput" value="{{ old('slug', $page->slug) }}" 
                           class="form-input-admin rounded-l-none font-mono text-xs" placeholder="what-is-vedic-yagya">
                </div>
            </div>
        </div>

        <!-- Subtitle & Order -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="md:col-span-2">
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Subtitle / Sanskrit Tagline (Optional)</label>
                <input type="text" name="subtitle" value="{{ old('subtitle', $page->subtitle) }}" 
                       class="form-input-admin" placeholder="e.g. Sacred Fire Rituals for Karmic Cleansing & Divine Grace">
            </div>
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Sort Order</label>
                <input type="number" name="order_index" value="{{ old('order_index', $page->order_index ?? 0) }}" 
                       class="form-input-admin">
            </div>
        </div>

        <!-- Excerpt / Short Summary -->
        <div>
            <label class="block text-xs font-semibold text-neutral-300 mb-1">Short Excerpt / Summary</label>
            <textarea name="excerpt" rows="2" class="form-input-admin" placeholder="Brief introduction shown in previews or header cards...">{{ old('excerpt', $page->excerpt) }}</textarea>
        </div>

        <!-- Rich Content Editor -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <label class="block text-xs font-semibold text-neutral-300">
                    Full Article Content * <span class="text-amber-400 font-normal">(Rich Text Editor with formatting, headings & colors)</span>
                </label>
            </div>
            <textarea name="content" class="rich-editor" data-height="380" placeholder="Write your full Vedic page article here...">{{ old('content', $page->content) }}</textarea>
        </div>

        <!-- Banner Image Upload -->
        <div class="border-t border-[#222233] pt-5">
            <label class="block text-xs font-semibold text-neutral-300 mb-2">Banner Image (Optional)</label>
            <div class="flex flex-col sm:flex-row items-start gap-4">
                <div class="w-32 h-20 rounded-lg bg-[#0d0d15] border border-[#2a2a3c] overflow-hidden flex items-center justify-center shrink-0">
                    <img id="bannerPreview" src="{{ $page->banner_url ?? asset('images/vedic-pattern-bg.jpg') }}" alt="Banner Preview" class="w-full h-full object-cover">
                </div>
                <div class="flex-1 space-y-2">
                    <input type="file" name="banner_file" id="bannerFileInput" accept="image/*" class="text-xs text-neutral-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-amber-500/20 file:text-amber-300 hover:file:bg-amber-500/30 cursor-pointer">
                    <p class="text-[11px] text-neutral-500">Recommended size: 1200x500px (JPG, PNG, or WebP). Max 5MB.</p>
                </div>
            </div>
        </div>

        <!-- SEO Metadata Section -->
        <div class="border-t border-[#222233] pt-5 space-y-4">
            <h3 class="text-xs font-bold uppercase tracking-wider text-amber-400">
                <i class="fa fa-search text-[10px]"></i> SEO Metadata (Search Engine Optimization)
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" 
                           class="form-input-admin" placeholder="Page Title - 108 Astro Yagya">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Meta Keywords</label>
                    <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}" 
                           class="form-input-admin" placeholder="vedic yagya, havan, kashi pandit, graha shanti">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Meta Description</label>
                <textarea name="meta_description" rows="2" class="form-input-admin" placeholder="Concise summary for Google search results...">{{ old('meta_description', $page->meta_description) }}</textarea>
            </div>
        </div>

        <!-- Visibility Toggle -->
        <div class="border-t border-[#222233] pt-5">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $page->exists ? $page->is_active : true) ? 'checked' : '' }}
                       class="rounded border-neutral-700 bg-neutral-900 text-amber-500 w-4 h-4">
                <span class="text-xs text-neutral-200 font-semibold">Publish & Make Visible to Public Devotees</span>
            </label>
        </div>

        <!-- Actions -->
        <div class="flex justify-end gap-3 pt-5 border-t border-[#222233]">
            <a href="{{ route('admin.pages.index') }}" class="px-4 py-2 bg-neutral-800 text-neutral-300 rounded text-xs hover:bg-neutral-700">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold rounded text-xs uppercase tracking-wider flex items-center gap-2 shadow-md">
                <i class="fa fa-save"></i>
                {{ $page->exists ? 'Update Page' : 'Publish Page' }}
            </button>
        </div>
    </form>
</div>

<script>
    // Auto-generate slug from title if slug input is empty
    const titleInput = document.getElementById('pageTitleInput');
    const slugInput = document.getElementById('pageSlugInput');
    if (titleInput && slugInput) {
        titleInput.addEventListener('input', function() {
            if (!slugInput.dataset.manual) {
                slugInput.value = this.value
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
            }
        });
        slugInput.addEventListener('input', function() {
            slugInput.dataset.manual = 'true';
        });
    }

    // Image preview
    const fileInput = document.getElementById('bannerFileInput');
    const previewImg = document.getElementById('bannerPreview');
    if (fileInput && previewImg) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    previewImg.src = evt.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endsection
