@extends('layouts.admin')

@section('title', ($testimonial->exists ? 'Edit' : 'Add') . ' Testimonial')

@section('content')
<div class="max-w-2xl space-y-6">
    <div class="flex items-center justify-between pb-4 border-b border-[#212130]">
        <div>
            <h1 class="text-2xl font-heading font-bold text-amber-300">
                {{ $testimonial->exists ? 'Edit Devotee Review' : 'Add New Devotee Review' }}
            </h1>
            <p class="text-xs text-neutral-400 mt-1">Configure client experience, star rating, and location.</p>
        </div>
        <a href="{{ route('admin.testimonials.index') }}" class="text-xs text-neutral-400 hover:text-amber-300">
            ← Back to Reviews
        </a>
    </div>

    <form action="{{ $testimonial->exists ? route('admin.testimonials.update', $testimonial->id) : route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="admin-card p-6 space-y-5">
        @csrf
        @if($testimonial->exists)
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Devotee / Client Name *</label>
                <input type="text" name="client_name" value="{{ old('client_name', $testimonial->client_name) }}" required class="form-input-admin" placeholder="e.g. Dr. Rajesh & Sunita Malhotra">
            </div>
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Designation / Profession</label>
                <input type="text" name="client_title" value="{{ old('client_title', $testimonial->client_title) }}" class="form-input-admin" placeholder="e.g. Chief Cardiologist">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">City / Country</label>
                <input type="text" name="location" value="{{ old('location', $testimonial->location) }}" class="form-input-admin" placeholder="e.g. San Jose, California, USA">
            </div>
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Service / Ritual Taken</label>
                <input type="text" name="service_taken" value="{{ old('service_taken', $testimonial->service_taken) }}" class="form-input-admin" placeholder="e.g. Maha Mrityunjaya Yagya">
            </div>
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Rating Stars (1 to 5)</label>
                <select name="rating" class="form-input-admin">
                    <option value="5" {{ old('rating', $testimonial->rating ?? 5) == 5 ? 'selected' : '' }}>★★★★★ (5 Stars)</option>
                    <option value="4" {{ old('rating', $testimonial->rating) == 4 ? 'selected' : '' }}>★★★★☆ (4 Stars)</option>
                    <option value="3" {{ old('rating', $testimonial->rating) == 3 ? 'selected' : '' }}>★★★☆☆ (3 Stars)</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-neutral-300 mb-1 flex items-center justify-between">
                <span>Review Story / Transformation Account * (Rich Text Editor)</span>
                <span class="text-[10px] text-amber-400 font-normal"><i class="fa fa-magic"></i> Bold, Text Colors, Headings & Lists supported</span>
            </label>
            <textarea name="review_text" rows="5" class="form-input-admin rich-editor" data-height="200" placeholder="Write devotee's authentic feedback... You can bold key phrases or change colors.">{{ old('review_text', $testimonial->review_text) }}</textarea>
        </div>

        <!-- Devotee Avatar Upload & Preview -->
        <div class="p-4 rounded-xl bg-black/40 border border-amber-500/20 space-y-3">
            <label class="block text-xs font-bold text-amber-400 uppercase tracking-wider">
                <i class="fa fa-user-circle mr-1"></i> Devotee Avatar / Photograph
            </label>
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                <div class="w-20 h-20 rounded-full overflow-hidden border-2 border-amber-500/40 bg-neutral-900 shrink-0 relative group">
                    <img id="testiPreviewImg" src="{{ $testimonial->avatar_url }}" alt="Devotee Avatar" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/50 text-[10px] text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        Current
                    </div>
                </div>
                <div class="space-y-2 flex-1">
                    <label class="block text-xs text-neutral-300 font-semibold">Upload Photo File (JPG, PNG, WebP)</label>
                    <input type="file" name="avatar_file" id="testiAvatarFile" accept="image/*" class="text-xs text-neutral-300 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-amber-500 file:text-black hover:file:bg-amber-400 cursor-pointer">
                    <div class="pt-1">
                        <label class="block text-[11px] text-neutral-400">Or Avatar Filename (if in public/images/)</label>
                        <input type="text" name="avatar" value="{{ old('avatar', $testimonial->avatar) }}" class="form-input-admin text-xs py-1" placeholder="e.g. t1.png">
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Sort Order</label>
                <input type="number" name="order_index" value="{{ old('order_index', $testimonial->order_index ?? 0) }}" class="form-input-admin">
            </div>
        </div>

        <div class="flex items-center gap-6 pt-2">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_verified" value="1" {{ old('is_verified', $testimonial->is_verified ?? true) ? 'checked' : '' }} class="rounded border-neutral-700 bg-neutral-900 text-amber-500">
                <span class="text-xs text-neutral-200">Verified Devotee Badge</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $testimonial->is_featured ?? true) ? 'checked' : '' }} class="rounded border-neutral-700 bg-neutral-900 text-amber-500">
                <span class="text-xs text-amber-300 font-semibold">Featured on Homepage</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }} class="rounded border-neutral-700 bg-neutral-900 text-amber-500">
                <span class="text-xs text-neutral-200">Active</span>
            </label>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-[#222233]">
            <a href="{{ route('admin.testimonials.index') }}" class="px-4 py-2 bg-neutral-800 text-neutral-300 rounded text-xs">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold rounded text-xs uppercase tracking-wider">
                {{ $testimonial->exists ? 'Update Review' : 'Save Review' }}
            </button>
        </div>
    </form>
</div>

<script>
    const testiFileInput = document.getElementById('testiAvatarFile');
    const testiPreviewImg = document.getElementById('testiPreviewImg');
    if (testiFileInput && testiPreviewImg) {
        testiFileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    testiPreviewImg.src = evt.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endsection
