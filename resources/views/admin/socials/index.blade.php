@extends('layouts.admin')

@section('title', 'Social Media Channels')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-heading font-bold text-amber-300">
                Social Media Links
            </h1>
            <p class="text-xs text-neutral-400 mt-1">
                Manage official social platforms shown in the header, footer, and contact buttons.
            </p>
        </div>
        <button onclick="document.getElementById('addSocialModal').classList.remove('hidden')" class="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold text-xs rounded-lg transition-colors flex items-center gap-2">
            <i class="fa fa-plus"></i> Add New Channel
        </button>
    </div>

    <!-- Social Links Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($socials as $soc)
        <div class="admin-card p-6 flex items-center justify-between border border-[#222233]">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-neutral-900 border border-amber-500/30 flex items-center justify-center text-amber-400 text-lg">
                    <i class="{{ $soc->icon ?? 'fa fa-link' }}"></i>
                </div>
                <div>
                    <h3 class="font-heading text-sm font-bold text-white uppercase">{{ $soc->platform }}</h3>
                    <a href="{{ $soc->url }}" target="_blank" class="text-[11px] text-neutral-400 hover:text-amber-300 truncate max-w-[180px] block">
                        {{ $soc->url }}
                    </a>
                </div>
            </div>

            <div class="flex items-center gap-1.5">
                <button type="button" 
                    class="edit-social-btn p-1.5 text-neutral-400 hover:text-amber-300 transition-colors cursor-pointer"
                    data-id="{{ $soc->id }}"
                    data-platform="{{ $soc->platform }}"
                    data-url="{{ $soc->url }}"
                    data-icon="{{ $soc->icon ?? '' }}"
                    data-title="{{ $soc->title ?? '' }}"
                    data-order="{{ $soc->order_index }}"
                    data-active="{{ $soc->is_active ? '1' : '0' }}"
                    title="Edit Social Channel">
                    <i class="fa fa-edit text-xs"></i>
                </button>
                <form action="{{ route('admin.socials.destroy', $soc->id) }}" method="POST" onsubmit="return confirm('Delete this social link?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-1.5 text-neutral-400 hover:text-red-400" title="Delete">
                        <i class="fa fa-trash text-xs"></i>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Add Social Modal -->
    <div id="addSocialModal" class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4 hidden">
        <div class="bg-[#14141d] border border-amber-500/30 rounded-2xl max-w-md w-full p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-neutral-800 mb-5">
                <h3 class="font-heading text-lg font-bold text-amber-300">Add Social Media Channel</h3>
                <button type="button" onclick="document.getElementById('addSocialModal').classList.add('hidden')" class="text-neutral-400 hover:text-white">&times;</button>
            </div>

            <form action="{{ route('admin.socials.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Platform *</label>
                    <select name="platform" class="form-input-admin">
                        <option value="youtube">YouTube</option>
                        <option value="facebook">Facebook</option>
                        <option value="instagram">Instagram</option>
                        <option value="whatsapp">WhatsApp</option>
                        <option value="twitter">X / Twitter</option>
                        <option value="telegram">Telegram</option>
                        <option value="linkedin">LinkedIn</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Destination URL *</label>
                    <input type="url" name="url" required class="form-input-admin" placeholder="https://...">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Icon Class (FontAwesome)</label>
                    <input type="text" name="icon" class="form-input-admin" placeholder="e.g. fab fa-youtube">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Display Title (Optional)</label>
                    <input type="text" name="title" class="form-input-admin" placeholder="e.g. Subscribe to YouTube">
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="socActive" value="1" checked class="rounded border-neutral-700 bg-neutral-900 text-amber-500">
                    <label for="socActive" class="text-xs text-neutral-300 cursor-pointer">Active</label>
                </div>
                <div class="flex justify-end gap-3 pt-3 border-t border-neutral-800">
                    <button type="button" onclick="document.getElementById('addSocialModal').classList.add('hidden')" class="px-4 py-2 bg-neutral-800 text-neutral-300 rounded text-xs">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold rounded text-xs">
                        Save Channel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Social Modal -->
    <div id="editSocialModal" class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4 hidden">
        <div class="bg-[#14141d] border border-amber-500/30 rounded-2xl max-w-md w-full p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-neutral-800 mb-5">
                <h3 class="font-heading text-lg font-bold text-amber-300">Edit Social Channel</h3>
                <button type="button" onclick="document.getElementById('editSocialModal').classList.add('hidden')" class="text-neutral-400 hover:text-white">&times;</button>
            </div>

            <form id="editSocialForm" action="" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Platform *</label>
                    <select name="platform" id="editSocPlatform" class="form-input-admin">
                        <option value="youtube">YouTube</option>
                        <option value="facebook">Facebook</option>
                        <option value="instagram">Instagram</option>
                        <option value="whatsapp">WhatsApp</option>
                        <option value="twitter">X / Twitter</option>
                        <option value="telegram">Telegram</option>
                        <option value="linkedin">LinkedIn</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Destination URL *</label>
                    <input type="url" name="url" id="editSocUrl" required class="form-input-admin" placeholder="https://...">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Icon Class (FontAwesome)</label>
                    <input type="text" name="icon" id="editSocIcon" class="form-input-admin" placeholder="e.g. fab fa-youtube">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Display Title (Optional)</label>
                    <input type="text" name="title" id="editSocTitle" class="form-input-admin" placeholder="e.g. Subscribe to YouTube">
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="editSocActive" value="1" class="rounded border-neutral-700 bg-neutral-900 text-amber-500">
                    <label for="editSocActive" class="text-xs text-neutral-300 cursor-pointer">Active</label>
                </div>
                <div class="flex justify-end gap-3 pt-3 border-t border-neutral-800">
                    <button type="button" onclick="document.getElementById('editSocialModal').classList.add('hidden')" class="px-4 py-2 bg-neutral-800 text-neutral-300 rounded text-xs">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold rounded text-xs">
                        Update Channel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.edit-social-btn');
        if (!btn) return;
        e.preventDefault();
        const form = document.getElementById('editSocialForm');
        form.action = '/admin/socials/' + btn.dataset.id;
        document.getElementById('editSocPlatform').value = btn.dataset.platform || 'youtube';
        document.getElementById('editSocUrl').value = btn.dataset.url || '';
        document.getElementById('editSocIcon').value = btn.dataset.icon || '';
        document.getElementById('editSocTitle').value = btn.dataset.title || '';
        document.getElementById('editSocActive').checked = (btn.dataset.active === '1');
        document.getElementById('editSocialModal').classList.remove('hidden');
    });

    const editSocModal = document.getElementById('editSocialModal');
    if (editSocModal) {
        editSocModal.addEventListener('click', function(e) {
            if (e.target === this) editSocModal.classList.add('hidden');
        });
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (editSocModal) editSocModal.classList.add('hidden');
            const addSocModal = document.getElementById('addSocialModal');
            if (addSocModal) addSocModal.classList.add('hidden');
        }
    });
</script>
@endsection
