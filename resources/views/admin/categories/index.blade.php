@extends('layouts.admin')

@section('title', 'Categories & Subcategories')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-heading font-bold text-amber-300">
                Categories & Subcategories
            </h1>
            <p class="text-xs text-neutral-400 mt-1">
                Manage the Vedic taxonomy for Yagyas, Jyotish services, Graha Shanti pujas, and Meditation.
            </p>
        </div>
        <div class="flex gap-2">
            <button onclick="document.getElementById('addSubcategoryModal').classList.remove('hidden')" class="px-3.5 py-2 bg-neutral-800 hover:bg-neutral-700 text-amber-300 font-semibold text-xs rounded-lg transition-colors border border-amber-500/20">
                <i class="fa fa-plus"></i> Add Subcategory
            </button>
            <button onclick="document.getElementById('addCategoryModal').classList.remove('hidden')" class="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold text-xs rounded-lg transition-colors flex items-center gap-2">
                <i class="fa fa-plus"></i> Add Category
            </button>
        </div>
    </div>

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($categories as $category)
        <div class="admin-card p-6 space-y-4 border border-[#222233]">
            <div class="flex items-start justify-between">
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs px-2 py-0.5 rounded font-mono uppercase bg-amber-500/10 text-amber-300 border border-amber-500/20">
                            {{ $category->type }}
                        </span>
                        <h3 class="font-heading text-lg font-bold text-white">{{ $category->name }}</h3>
                    </div>
                    <span class="text-[11px] font-mono text-neutral-500">/category/{{ $category->slug }}</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <button type="button" 
                        class="edit-category-btn p-1.5 text-neutral-400 hover:text-amber-300 transition-colors cursor-pointer"
                        data-id="{{ $category->id }}"
                        data-name="{{ $category->name }}"
                        data-slug="{{ $category->slug }}"
                        data-type="{{ $category->type }}"
                        data-desc="{{ $category->short_desc ?? '' }}"
                        data-order="{{ $category->order_index }}"
                        data-active="{{ $category->is_active ? '1' : '0' }}"
                        title="Edit Category">
                        <i class="fa fa-edit text-xs"></i>
                    </button>
                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category and its subcategories?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-1.5 text-neutral-400 hover:text-red-400" title="Delete">
                            <i class="fa fa-trash text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>

            <p class="text-xs text-neutral-300">
                {{ $category->short_desc }}
            </p>

            <!-- Subcategories List -->
            <div class="pt-3 border-t border-[#1e1e2d]">
                <div class="text-[11px] font-semibold text-neutral-400 uppercase tracking-wider mb-2">
                    Subcategories ({{ $category->subcategories->count() }})
                </div>
                <div class="space-y-1.5">
                    @forelse($category->subcategories as $sub)
                    <div class="flex items-center justify-between p-2 rounded bg-[#0b0b12] text-xs">
                        <span class="text-neutral-200">✦ {{ $sub->name }}</span>
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] text-neutral-500 font-mono">{{ $sub->slug }}</span>
                            <form action="{{ route('admin.subcategories.destroy', $sub->id) }}" method="POST" onsubmit="return confirm('Delete subcategory?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-neutral-500 hover:text-red-400">
                                    <i class="fa fa-times text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="text-[11px] text-neutral-500 italic">No subcategories defined yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Add Category Modal -->
    <div id="addCategoryModal" class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4 hidden">
        <div class="bg-[#14141d] border border-amber-500/30 rounded-2xl max-w-md w-full p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-neutral-800 mb-5">
                <h3 class="font-heading text-lg font-bold text-amber-300">Add New Category</h3>
                <button onclick="document.getElementById('addCategoryModal').classList.add('hidden')" class="text-neutral-400 hover:text-white">&times;</button>
            </div>

            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Category Name *</label>
                    <input type="text" name="name" required class="form-input-admin" placeholder="e.g. Navagraha Pujas">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Slug (URL identifier)</label>
                    <input type="text" name="slug" class="form-input-admin" placeholder="leave blank to auto-generate">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-neutral-300 mb-1">Type</label>
                        <select name="type" class="form-input-admin">
                            <option value="yagya">Vedic Yagya</option>
                            <option value="jyotish">Vedic Jyotish</option>
                            <option value="meditation">Meditation</option>
                            <option value="remedy">Remedy</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-neutral-300 mb-1">Icon Name</label>
                        <input type="text" name="icon" class="form-input-admin" placeholder="e.g. fire, sun">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Short Description</label>
                    <textarea name="short_desc" rows="2" class="form-input-admin"></textarea>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="catActive" value="1" checked class="rounded border-neutral-700 bg-neutral-900 text-amber-500">
                    <label for="catActive" class="text-xs text-neutral-300 cursor-pointer">Active</label>
                </div>
                <div class="flex justify-end gap-3 pt-3 border-t border-neutral-800">
                    <button type="button" onclick="document.getElementById('addCategoryModal').classList.add('hidden')" class="px-4 py-2 bg-neutral-800 text-neutral-300 rounded text-xs">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold rounded text-xs">
                        Save Category
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Subcategory Modal -->
    <div id="addSubcategoryModal" class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4 hidden">
        <div class="bg-[#14141d] border border-amber-500/30 rounded-2xl max-w-md w-full p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-neutral-800 mb-5">
                <h3 class="font-heading text-lg font-bold text-amber-300">Add New Subcategory</h3>
                <button onclick="document.getElementById('addSubcategoryModal').classList.add('hidden')" class="text-neutral-400 hover:text-white">&times;</button>
            </div>

            <form action="{{ route('admin.subcategories.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Parent Category *</label>
                    <select name="category_id" required class="form-input-admin">
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Subcategory Name *</label>
                    <input type="text" name="name" required class="form-input-admin" placeholder="e.g. Life Event Yagyas">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Short Description</label>
                    <textarea name="short_desc" rows="2" class="form-input-admin"></textarea>
                </div>
                <div class="flex justify-end gap-3 pt-3 border-t border-neutral-800">
                    <button type="button" onclick="document.getElementById('addSubcategoryModal').classList.add('hidden')" class="px-4 py-2 bg-neutral-800 text-neutral-300 rounded text-xs">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold rounded text-xs">
                        Save Subcategory
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div id="editCategoryModal" class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4 hidden">
        <div class="bg-[#14141d] border border-amber-500/30 rounded-2xl max-w-md w-full p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-neutral-800 mb-5">
                <h3 class="font-heading text-lg font-bold text-amber-300">Edit Category</h3>
                <button type="button" onclick="document.getElementById('editCategoryModal').classList.add('hidden')" class="text-neutral-400 hover:text-white">&times;</button>
            </div>

            <form id="editCategoryForm" action="" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Category Name *</label>
                    <input type="text" name="name" id="editCatName" required class="form-input-admin" placeholder="e.g. Navagraha Pujas">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Slug (URL identifier)</label>
                    <input type="text" name="slug" id="editCatSlug" class="form-input-admin" placeholder="leave blank to auto-generate">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-neutral-300 mb-1">Taxonomy Type</label>
                        <select name="type" id="editCatType" class="form-input-admin">
                            <option value="yagya">Yagya</option>
                            <option value="jyotish">Jyotish</option>
                            <option value="meditation">Meditation</option>
                            <option value="remedy">Remedy</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-neutral-300 mb-1">Sort Order</label>
                        <input type="number" name="order_index" id="editCatOrder" value="0" class="form-input-admin">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Short Description</label>
                    <textarea name="short_desc" id="editCatDesc" rows="2" class="form-input-admin"></textarea>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="editCatActive" value="1" class="rounded border-neutral-700 bg-neutral-900 text-amber-500">
                    <label for="editCatActive" class="text-xs text-neutral-300 cursor-pointer">Active</label>
                </div>
                <div class="flex justify-end gap-3 pt-3 border-t border-neutral-800">
                    <button type="button" onclick="document.getElementById('editCategoryModal').classList.add('hidden')" class="px-4 py-2 bg-neutral-800 text-neutral-300 rounded text-xs">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold rounded text-xs">
                        Update Category
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.edit-category-btn');
        if (!btn) return;
        e.preventDefault();
        const form = document.getElementById('editCategoryForm');
        form.action = '/admin/categories/' + btn.dataset.id;
        document.getElementById('editCatName').value = btn.dataset.name || '';
        document.getElementById('editCatSlug').value = btn.dataset.slug || '';
        document.getElementById('editCatType').value = btn.dataset.type || 'yagya';
        document.getElementById('editCatOrder').value = btn.dataset.order || '0';
        document.getElementById('editCatDesc').value = btn.dataset.desc || '';
        document.getElementById('editCatActive').checked = (btn.dataset.active === '1');
        document.getElementById('editCategoryModal').classList.remove('hidden');
    });

    const editCatModal = document.getElementById('editCategoryModal');
    if (editCatModal) {
        editCatModal.addEventListener('click', function(e) {
            if (e.target === this) editCatModal.classList.add('hidden');
        });
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (editCatModal) editCatModal.classList.add('hidden');
            const addCatModal = document.getElementById('addCategoryModal');
            if (addCatModal) addCatModal.classList.add('hidden');
            const addSubModal = document.getElementById('addSubcategoryModal');
            if (addSubModal) addSubModal.classList.add('hidden');
        }
    });
</script>
@endsection
