@extends('layouts.admin')

@section('title', 'Dynamic Navigation Menus')

@section('content')
<div class="space-y-8">
    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-heading font-bold text-amber-300">
                Header & Footer Navigation Menus
            </h1>
            <p class="text-xs text-neutral-400 mt-1">
                Dynamically manage top-level navigation, nested dropdown menus, footer quick links, and badges.
            </p>
        </div>
        <button type="button" onclick="document.getElementById('addMenuModal').classList.remove('hidden')" class="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold text-xs rounded-lg transition-colors flex items-center gap-2 shadow-md">
            <i class="fa fa-plus"></i> Add New Menu Item
        </button>
    </div>

    <!-- Menus Table -->
    <div class="admin-card p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-[#242436] text-neutral-400 uppercase tracking-wider text-[11px]">
                        <th class="py-3 px-4">Menu Title</th>
                        <th class="py-3 px-4">Destination Link</th>
                        <th class="py-3 px-4">Location</th>
                        <th class="py-3 px-4">Badge</th>
                        <th class="py-3 px-4">Submenu Items</th>
                        <th class="py-3 px-4">Order</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#1e1e2d]">
                    @forelse($menus as $menu)
                    <tr class="hover:bg-[#181824] transition-colors">
                        <td class="py-3.5 px-4 font-bold text-white flex items-center gap-2">
                            <span class="text-amber-400">❖</span>
                            <span>{{ $menu->title }}</span>
                        </td>
                        @php
                            $isVedicPage = str_starts_with($menu->url, '/vedic/') || str_starts_with($menu->url, '/page/');
                            $menuSlug = $isVedicPage ? str_replace(['/vedic/', '/page/'], '', $menu->url) : null;
                            $menuPageMissing = $isVedicPage && !$availablePages->contains('slug', $menuSlug);
                        @endphp
                        <td class="py-3.5 px-4 font-mono text-[11px] text-neutral-300">
                            <span>{{ $menu->url }}</span>
                            @if($menuPageMissing)
                            <span class="ml-1.5 px-1.5 py-0.5 rounded text-[9px] bg-red-500/20 text-red-300 border border-red-500/30 font-sans font-semibold" title="The page for this URL was deleted in CMS Pages!">
                                ⚠️ Page Deleted
                            </span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 uppercase text-[10px] font-semibold text-neutral-400">
                            {{ $menu->location }}
                        </td>
                        <td class="py-3.5 px-4">
                            @if($menu->badge)
                            <span class="px-2 py-0.5 rounded text-[10px] bg-amber-500/20 text-amber-300 border border-amber-500/30 font-semibold">{{ $menu->badge }}</span>
                            @else
                            <span class="text-neutral-600">—</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4">
                            @if($menu->children->count() > 0)
                            <span class="px-2 py-0.5 rounded-full bg-blue-500/10 text-blue-300 border border-blue-500/20 text-[10px] font-bold">
                                {{ $menu->children->count() }} Sub-items
                            </span>
                            @else
                            <span class="text-neutral-600">None</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 font-mono text-neutral-400">
                            {{ $menu->order_index }}
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $menu->is_active ? 'bg-emerald-500/20 text-emerald-300' : 'bg-red-500/20 text-red-300' }}">
                                {{ $menu->is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-right space-x-2">
                            <button type="button" 
                                class="edit-menu-btn p-1.5 text-neutral-400 hover:text-amber-300 transition-colors cursor-pointer"
                                data-id="{{ $menu->id }}"
                                data-title="{{ $menu->title }}"
                                data-url="{{ $menu->url }}"
                                data-parent-id="{{ $menu->parent_id ?? '' }}"
                                data-location="{{ $menu->location }}"
                                data-badge="{{ $menu->badge ?? '' }}"
                                data-target="{{ $menu->target }}"
                                data-order="{{ $menu->order_index }}"
                                data-active="{{ $menu->is_active ? '1' : '0' }}"
                                title="Edit Menu Item">
                                <i class="fa fa-edit text-sm"></i>
                            </button>
                            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this menu item?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-neutral-400 hover:text-red-400 transition-colors" title="Delete">
                                    <i class="fa fa-trash text-sm"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Render Sub-items indented -->
                    @foreach($menu->children as $child)
                    @php
                        $isChildVedic = str_starts_with($child->url, '/vedic/') || str_starts_with($child->url, '/page/');
                        $childSlug = $isChildVedic ? str_replace(['/vedic/', '/page/'], '', $child->url) : null;
                        $childPageMissing = $isChildVedic && !$availablePages->contains('slug', $childSlug);
                    @endphp
                    <tr class="bg-[#101018] text-neutral-400 hover:bg-[#141420]">
                        <td class="py-2.5 px-4 pl-10 text-[11px] text-amber-200/90 font-medium">
                            ↳ {{ $child->title }}
                        </td>
                        <td class="py-2.5 px-4 font-mono text-[10px] text-neutral-400">
                            <span>{{ $child->url }}</span>
                            @if($childPageMissing)
                            <span class="ml-1.5 px-1.5 py-0.5 rounded text-[9px] bg-red-500/20 text-red-300 border border-red-500/30 font-sans font-semibold" title="The page for this URL was deleted in CMS Pages!">
                                ⚠️ Page Deleted
                            </span>
                            @endif
                        </td>
                        <td class="py-2.5 px-4 text-[10px] uppercase text-neutral-500">
                            Submenu
                        </td>
                        <td class="py-2.5 px-4">
                            @if($child->badge)
                            <span class="px-1.5 py-0.2 rounded text-[9px] bg-neutral-800 text-amber-300">{{ $child->badge }}</span>
                            @else
                            <span class="text-neutral-600">—</span>
                            @endif
                        </td>
                        <td class="py-2.5 px-4 text-neutral-600">—</td>
                        <td class="py-2.5 px-4 font-mono text-[10px]">{{ $child->order_index }}</td>
                        <td class="py-2.5 px-4">
                            <span class="text-[10px] {{ $child->is_active ? 'text-emerald-400' : 'text-neutral-500' }}">
                                {{ $child->is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="py-2.5 px-4 text-right space-x-2">
                            <button type="button" 
                                class="edit-menu-btn p-1 text-neutral-400 hover:text-amber-300 transition-colors cursor-pointer"
                                data-id="{{ $child->id }}"
                                data-title="{{ $child->title }}"
                                data-url="{{ $child->url }}"
                                data-parent-id="{{ $child->parent_id ?? '' }}"
                                data-location="{{ $child->location }}"
                                data-badge="{{ $child->badge ?? '' }}"
                                data-target="{{ $child->target }}"
                                data-order="{{ $child->order_index }}"
                                data-active="{{ $child->is_active ? '1' : '0' }}"
                                title="Edit Submenu">
                                <i class="fa fa-edit text-xs"></i>
                            </button>
                            <form action="{{ route('admin.menus.destroy', $child->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete submenu item?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1 text-neutral-500 hover:text-red-400 transition-colors" title="Delete">
                                    <i class="fa fa-trash text-xs"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @empty
                    <tr>
                        <td colspan="8" class="py-8 text-center text-neutral-500">No navigation menu items defined.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Menu Modal -->
    <div id="addMenuModal" class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4 hidden">
        <div class="bg-[#14141d] border border-amber-500/30 rounded-2xl max-w-lg w-full p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-neutral-800 mb-5">
                <h3 class="font-heading text-lg font-bold text-amber-300">Add Navigation Menu Item</h3>
                <button type="button" onclick="document.getElementById('addMenuModal').classList.add('hidden')" class="text-neutral-400 hover:text-white text-xl">&times;</button>
            </div>

            <form action="{{ route('admin.menus.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Quick CMS Page / Service Picker -->
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">
                        Quick Select Existing CMS Page (Optional)
                    </label>
                    <select onchange="if(this.value){ const opt=this.options[this.selectedIndex]; document.getElementById('addMenuUrlInput').value=this.value; if(!document.getElementById('addMenuTitleInput').value || this.value){ document.getElementById('addMenuTitleInput').value=opt.dataset.title; } }" class="form-input-admin text-xs text-amber-300">
                        <option value="">-- Choose from CMS Pages to auto-fill --</option>
                        @foreach($availablePages as $ap)
                        <option value="/vedic/{{ $ap->slug }}" data-title="{{ $ap->title }}">
                            📄 {{ $ap->title }} (/vedic/{{ $ap->slug }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Menu Title *</label>
                    <input type="text" name="title" id="addMenuTitleInput" required class="form-input-admin" placeholder="e.g. Jyotish">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Destination URL / Anchor *</label>
                    <input type="text" name="url" id="addMenuUrlInput" required class="form-input-admin" placeholder="e.g. /vedic/what-is-vedic-yagya or /jyotish">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-neutral-300 mb-1">Parent Menu (For Dropdowns)</label>
                        <select name="parent_id" class="form-input-admin">
                            <option value="">-- None (Top Level) --</option>
                            @foreach($parentOptions as $p)
                            <option value="{{ $p->id }}">{{ $p->title }} ({{ $p->location }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-neutral-300 mb-1">Placement Location</label>
                        <select name="location" class="form-input-admin">
                            <option value="header">Header Main Nav</option>
                            <option value="footer_quick">Footer Quick Links</option>
                            <option value="footer_yagyas">Footer Yagyas</option>
                            <option value="footer_jyotish">Footer Jyotish</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-neutral-300 mb-1">Badge (Optional)</label>
                        <input type="text" name="badge" class="form-input-admin" placeholder="e.g. Popular">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-neutral-300 mb-1">Target Window</label>
                        <select name="target" class="form-input-admin">
                            <option value="_self">Same Tab (_self)</option>
                            <option value="_blank">New Tab (_blank)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-neutral-300 mb-1">Sort Order</label>
                        <input type="number" name="order_index" value="0" class="form-input-admin">
                    </div>
                </div>

                <div class="flex items-center gap-2 pt-2">
                    <input type="checkbox" name="is_active" id="menuActiveAdd" value="1" checked class="rounded border-neutral-700 bg-neutral-900 text-amber-500">
                    <label for="menuActiveAdd" class="text-xs text-neutral-300 cursor-pointer">Visible to Public Devotees</label>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-neutral-800">
                    <button type="button" onclick="document.getElementById('addMenuModal').classList.add('hidden')" class="px-4 py-2 bg-neutral-800 text-neutral-300 rounded text-xs hover:bg-neutral-700">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold rounded text-xs">
                        Save Menu Item
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Menu Modal -->
    <div id="editMenuModal" class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4 hidden">
        <div class="bg-[#14141d] border border-amber-500/30 rounded-2xl max-w-lg w-full p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-neutral-800 mb-5">
                <h3 class="font-heading text-lg font-bold text-amber-300">Edit Navigation Menu Item</h3>
                <button type="button" onclick="closeEditMenuModal()" class="text-neutral-400 hover:text-white text-xl">&times;</button>
            </div>

            <form id="editMenuForm" action="" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Quick CMS Page Picker for Edit -->
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">
                        Quick Change to Existing CMS Page (Optional)
                    </label>
                    <select onchange="if(this.value){ const opt=this.options[this.selectedIndex]; document.getElementById('editMenuUrl').value=this.value; document.getElementById('editMenuTitle').value=opt.dataset.title; }" class="form-input-admin text-xs text-amber-300">
                        <option value="">-- Choose from CMS Pages to replace URL/Title --</option>
                        @foreach($availablePages as $ap)
                        <option value="/vedic/{{ $ap->slug }}" data-title="{{ $ap->title }}">
                            📄 {{ $ap->title }} (/vedic/{{ $ap->slug }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Menu Title *</label>
                    <input type="text" name="title" id="editMenuTitle" required class="form-input-admin" placeholder="e.g. Jyotish">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Destination URL / Anchor *</label>
                    <input type="text" name="url" id="editMenuUrl" required class="form-input-admin" placeholder="e.g. /jyotish or /yagyas">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-neutral-300 mb-1">Parent Menu (For Dropdowns)</label>
                        <select name="parent_id" id="editMenuParentId" class="form-input-admin">
                            <option value="">-- None (Top Level) --</option>
                            @foreach($parentOptions as $p)
                            <option value="{{ $p->id }}">{{ $p->title }} ({{ $p->location }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-neutral-300 mb-1">Placement Location</label>
                        <select name="location" id="editMenuLocation" class="form-input-admin">
                            <option value="header">Header Main Nav</option>
                            <option value="footer_quick">Footer Quick Links</option>
                            <option value="footer_yagyas">Footer Yagyas</option>
                            <option value="footer_jyotish">Footer Jyotish</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-neutral-300 mb-1">Badge (Optional)</label>
                        <input type="text" name="badge" id="editMenuBadge" class="form-input-admin" placeholder="e.g. New">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-neutral-300 mb-1">Target Window</label>
                        <select name="target" id="editMenuTarget" class="form-input-admin">
                            <option value="_self">Same Tab (_self)</option>
                            <option value="_blank">New Tab (_blank)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-neutral-300 mb-1">Sort Order</label>
                        <input type="number" name="order_index" id="editMenuOrderIndex" value="0" class="form-input-admin">
                    </div>
                </div>

                <div class="flex items-center gap-2 pt-2">
                    <input type="checkbox" name="is_active" id="editMenuActive" value="1" class="rounded border-neutral-700 bg-neutral-900 text-amber-500">
                    <label for="editMenuActive" class="text-xs text-neutral-300 cursor-pointer">Visible to Public Devotees</label>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-neutral-800">
                    <button type="button" onclick="closeEditMenuModal()" class="px-4 py-2 bg-neutral-800 text-neutral-300 rounded text-xs hover:bg-neutral-700">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold rounded text-xs">
                        Update Menu Item
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    function openEditMenuModalWithData(data) {
        if (!data || !data.id) return;
        const form = document.getElementById('editMenuForm');
        // Use relative path so port and host match current environment
        form.action = '/admin/menus/' + data.id;

        document.getElementById('editMenuTitle').value = data.title || '';
        document.getElementById('editMenuUrl').value = data.url || '';
        document.getElementById('editMenuLocation').value = data.location || 'header';
        document.getElementById('editMenuBadge').value = data.badge || '';
        document.getElementById('editMenuTarget').value = data.target || '_self';
        document.getElementById('editMenuOrderIndex').value = (data.order !== undefined && data.order !== null) ? data.order : 0;
        document.getElementById('editMenuActive').checked = (data.active === '1' || data.active === 1 || data.active === true);

        // Hide own ID in parent options to prevent self-parenting loop
        const parentSelect = document.getElementById('editMenuParentId');
        if (parentSelect) {
            Array.from(parentSelect.options).forEach(opt => {
                if (opt.value && opt.value == data.id) {
                    opt.disabled = true;
                    opt.style.display = 'none';
                } else {
                    opt.disabled = false;
                    opt.style.display = '';
                }
            });
            parentSelect.value = data.parentId || '';
        }

        document.getElementById('editMenuModal').classList.remove('hidden');
    }

    // Delegated click listener for edit-menu-btn
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.edit-menu-btn');
        if (!btn) return;
        e.preventDefault();
        openEditMenuModalWithData({
            id: btn.dataset.id,
            title: btn.dataset.title,
            url: btn.dataset.url,
            parentId: btn.dataset.parentId,
            location: btn.dataset.location,
            badge: btn.dataset.badge,
            target: btn.dataset.target,
            order: btn.dataset.order,
            active: btn.dataset.active
        });
    });

    // Fallback if editMenu is called directly
    function editMenu(menu) {
        if (!menu) return;
        openEditMenuModalWithData({
            id: menu.id,
            title: menu.title,
            url: menu.url,
            parentId: menu.parent_id,
            location: menu.location,
            badge: menu.badge,
            target: menu.target,
            order: menu.order_index,
            active: menu.is_active ? 1 : 0
        });
    }

    function closeEditMenuModal() {
        document.getElementById('editMenuModal').classList.add('hidden');
    }

    // Close on modal backdrop click
    const editModal = document.getElementById('editMenuModal');
    if (editModal) {
        editModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditMenuModal();
            }
        });
    }

    const addModal = document.getElementById('addMenuModal');
    if (addModal) {
        addModal.addEventListener('click', function(e) {
            if (e.target === this) {
                addModal.classList.add('hidden');
            }
        });
    }

    // Close modal on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeEditMenuModal();
            if (addModal) addModal.classList.add('hidden');
        }
    });
</script>
@endsection
