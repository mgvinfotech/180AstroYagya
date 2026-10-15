@extends('layouts.admin')

@section('title', ($astrologer->exists ? 'Edit' : 'Add') . ' Astrologer / Acharya')

@section('content')
<div class="max-w-3xl space-y-6">
    <div class="flex items-center justify-between pb-4 border-b border-[#212130]">
        <div>
            <h1 class="text-2xl font-heading font-bold text-amber-300">
                {{ $astrologer->exists ? 'Edit Astrologer Profile' : 'Add New Astrologer Profile' }}
            </h1>
            <p class="text-xs text-neutral-400 mt-1">Configure credentials, consultation fee, biography, and ratings.</p>
        </div>
        <a href="{{ route('admin.astrologers.index') }}" class="text-xs text-neutral-400 hover:text-amber-300">
            ← Back to Astrologers
        </a>
    </div>

    <form action="{{ $astrologer->exists ? route('admin.astrologers.update', $astrologer->id) : route('admin.astrologers.store') }}" method="POST" enctype="multipart/form-data" class="admin-card p-6 space-y-5">
        @csrf
        @if($astrologer->exists)
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Full Name with Title *</label>
                <input type="text" name="name" value="{{ old('name', $astrologer->name) }}" required class="form-input-admin" placeholder="e.g. Acharya Tarkeshwar Dwivedi">
            </div>
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Slug (URL)</label>
                <input type="text" name="slug" value="{{ old('slug', $astrologer->slug) }}" class="form-input-admin" placeholder="leave blank to auto-generate">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Title / Designation</label>
                <input type="text" name="title" value="{{ old('title', $astrologer->title) }}" class="form-input-admin" placeholder="e.g. Chief Vedic Astrologer & Yagya Acharya">
            </div>
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Academic & Vedic Qualification</label>
                <input type="text" name="qualification" value="{{ old('qualification', $astrologer->qualification) }}" class="form-input-admin" placeholder="e.g. Acharya (Sampurnanand Sanskrit University)">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Experience (Years) *</label>
                <input type="number" name="experience_years" value="{{ old('experience_years', $astrologer->experience_years ?? 15) }}" required class="form-input-admin">
            </div>
            <div>
                <label class="block text-xs font-semibold text-amber-400 mb-1">Consultation Dakshina (INR ₹)</label>
                <input type="number" step="0.01" name="consultation_fee" value="{{ old('consultation_fee', $astrologer->consultation_fee ?? 2100) }}" class="form-input-admin">
            </div>
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Star Rating (1.0 to 5.0)</label>
                <input type="number" step="0.01" min="1" max="5" name="rating" value="{{ old('rating', $astrologer->rating ?? 4.95) }}" class="form-input-admin">
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold text-neutral-300 mb-1">Astrological Specialties</label>
            <input type="text" name="specialties" value="{{ old('specialties', $astrologer->specialties) }}" class="form-input-admin" placeholder="e.g. Parashari Kundli, Muhurta, Kaal Sarp Shanti, Matchmaking">
        </div>

        <div>
            <label class="block text-xs font-semibold text-neutral-300 mb-1">Languages Fluent</label>
            <input type="text" name="languages" value="{{ old('languages', $astrologer->languages ?? 'Hindi, Sanskrit, English') }}" class="form-input-admin">
        </div>

        <div>
            <label class="block text-xs font-semibold text-neutral-300 mb-1 flex items-center justify-between">
                <span>Full Biography & Vedic Philosophy (Rich Text Editor)</span>
                <span class="text-[10px] text-amber-400 font-normal"><i class="fa fa-magic"></i> Bold, Text Colors, Headings & Lists supported</span>
            </label>
            <textarea name="bio" rows="6" class="form-input-admin rich-editor" data-height="220" placeholder="Write full biography and Vedic lineage... You can bold degrees, change colors, and highlight achievements.">{{ old('bio', $astrologer->bio) }}</textarea>
        </div>

        <!-- Avatar Image Upload & Preview -->
        <div class="p-4 rounded-xl bg-black/40 border border-amber-500/20 space-y-3">
            <label class="block text-xs font-bold text-amber-400 uppercase tracking-wider">
                <i class="fa fa-user-circle mr-1"></i> Acharya Photo / Avatar
            </label>
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                <div class="w-24 h-24 rounded-full overflow-hidden border-2 border-amber-500/40 bg-neutral-900 shrink-0 relative group">
                    <img id="astroPreviewImg" src="{{ $astrologer->avatar_url }}" alt="Acharya Avatar" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/50 text-[10px] text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        Current
                    </div>
                </div>
                <div class="space-y-2 flex-1">
                    <label class="block text-xs text-neutral-300 font-semibold">Upload Photo File (JPG, PNG, WebP)</label>
                    <input type="file" name="avatar_file" id="astroAvatarFile" accept="image/*" class="text-xs text-neutral-300 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-amber-500 file:text-black hover:file:bg-amber-400 cursor-pointer">
                    <div class="pt-1">
                        <label class="block text-[11px] text-neutral-400">Or Avatar Filename (if in public/images/)</label>
                        <input type="text" name="avatar" value="{{ old('avatar', $astrologer->avatar) }}" class="form-input-admin text-xs py-1" placeholder="e.g. panditji.jpg">
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Sort Order</label>
                <input type="number" name="order_index" value="{{ old('order_index', $astrologer->order_index ?? 0) }}" class="form-input-admin">
            </div>
        </div>

        <div class="flex items-center gap-6 pt-2">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_available_online" value="1" {{ old('is_available_online', $astrologer->is_available_online ?? true) ? 'checked' : '' }} class="rounded border-neutral-700 bg-neutral-900 text-amber-500">
                <span class="text-xs text-neutral-200">Available Online for Video/Audio Calls</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $astrologer->is_featured ?? true) ? 'checked' : '' }} class="rounded border-neutral-700 bg-neutral-900 text-amber-500">
                <span class="text-xs text-amber-300 font-semibold">Featured Acharya</span>
            </label>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $astrologer->is_active ?? true) ? 'checked' : '' }} class="rounded border-neutral-700 bg-neutral-900 text-amber-500">
                <span class="text-xs text-neutral-200">Active</span>
            </label>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-[#222233]">
            <a href="{{ route('admin.astrologers.index') }}" class="px-4 py-2 bg-neutral-800 text-neutral-300 rounded text-xs">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold rounded text-xs uppercase tracking-wider">
                {{ $astrologer->exists ? 'Update Profile' : 'Save Astrologer' }}
            </button>
        </div>
    </form>
</div>

<script>
    const astroFileInput = document.getElementById('astroAvatarFile');
    const astroPreviewImg = document.getElementById('astroPreviewImg');
    if (astroFileInput && astroPreviewImg) {
        astroFileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    astroPreviewImg.src = evt.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endsection
