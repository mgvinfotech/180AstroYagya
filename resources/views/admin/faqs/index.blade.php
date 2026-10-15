@extends('layouts.admin')

@section('title', 'Vedic FAQs')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-heading font-bold text-amber-300">
                Frequently Asked Sacred Inquiries (FAQs)
            </h1>
            <p class="text-xs text-neutral-400 mt-1">
                Manage the accordion answers for devotees explaining Yagya science, live video Sankalp, and Gotra vidhi.
            </p>
        </div>
        <button onclick="document.getElementById('addFaqModal').classList.remove('hidden')" class="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold text-xs rounded-lg transition-colors flex items-center gap-2">
            <i class="fa fa-plus"></i> Add New FAQ
        </button>
    </div>

    <!-- FAQs List -->
    <div class="space-y-4">
        @foreach($faqs as $faq)
        <div class="admin-card p-6 border border-[#222233] space-y-3">
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-[10px] uppercase font-mono px-2 py-0.5 rounded bg-amber-500/10 text-amber-300 border border-amber-500/20">
                        {{ $faq->category }}
                    </span>
                    <h3 class="font-heading text-base font-bold text-white mt-1.5">{{ $faq->question }}</h3>
                </div>
                <div class="flex items-center gap-1.5">
                    <button type="button" 
                        class="edit-faq-btn p-1.5 text-neutral-400 hover:text-amber-300 transition-colors cursor-pointer"
                        data-id="{{ $faq->id }}"
                        data-question="{{ $faq->question }}"
                        data-category="{{ $faq->category }}"
                        data-answer="{{ $faq->answer }}"
                        data-order="{{ $faq->order_index }}"
                        data-active="{{ $faq->is_active ? '1' : '0' }}"
                        title="Edit FAQ">
                        <i class="fa fa-edit text-xs"></i>
                    </button>
                    <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Delete this FAQ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-1.5 text-neutral-400 hover:text-red-400" title="Delete">
                            <i class="fa fa-trash text-xs"></i>
                        </button>
                    </form>
                </div>
            </div>

            <p class="text-xs text-neutral-300 leading-relaxed border-t border-[#1e1e2d] pt-3">
                {{ $faq->answer }}
            </p>
        </div>
        @endforeach
    </div>

    <!-- Add FAQ Modal -->
    <div id="addFaqModal" class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4 hidden">
        <div class="bg-[#14141d] border border-amber-500/30 rounded-2xl max-w-lg w-full p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-neutral-800 mb-5">
                <h3 class="font-heading text-lg font-bold text-amber-300">Add New FAQ</h3>
                <button onclick="document.getElementById('addFaqModal').classList.add('hidden')" class="text-neutral-400 hover:text-white">&times;</button>
            </div>

            <form action="{{ route('admin.faqs.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Question *</label>
                    <input type="text" name="question" required class="form-input-admin" placeholder="e.g. Can I attend live if I am in USA?">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Category</label>
                    <select name="category" class="form-input-admin">
                        <option value="general">General Vedic</option>
                        <option value="yagya">Yagya Specific</option>
                        <option value="jyotish">Horoscope & Jyotish</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Answer *</label>
                    <textarea name="answer" rows="4" required class="form-input-admin"></textarea>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="faqActive" value="1" checked class="rounded border-neutral-700 bg-neutral-900 text-amber-500">
                    <label for="faqActive" class="text-xs text-neutral-300 cursor-pointer">Active</label>
                </div>
                <div class="flex justify-end gap-3 pt-3 border-t border-neutral-800">
                    <button type="button" onclick="document.getElementById('addFaqModal').classList.add('hidden')" class="px-4 py-2 bg-neutral-800 text-neutral-300 rounded text-xs">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold rounded text-xs">
                        Save FAQ
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit FAQ Modal -->
    <div id="editFaqModal" class="fixed inset-0 z-50 bg-black/80 flex items-center justify-center p-4 hidden">
        <div class="bg-[#14141d] border border-amber-500/30 rounded-2xl max-w-lg w-full p-6 shadow-2xl relative">
            <div class="flex items-center justify-between pb-4 border-b border-neutral-800 mb-5">
                <h3 class="font-heading text-lg font-bold text-amber-300">Edit FAQ</h3>
                <button type="button" onclick="document.getElementById('editFaqModal').classList.add('hidden')" class="text-neutral-400 hover:text-white">&times;</button>
            </div>

            <form id="editFaqForm" action="" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Question *</label>
                    <input type="text" name="question" id="editFaqQuestion" required class="form-input-admin">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-neutral-300 mb-1">Category</label>
                        <select name="category" id="editFaqCategory" class="form-input-admin">
                            <option value="general">General Vedic</option>
                            <option value="yagya">Yagya Specific</option>
                            <option value="jyotish">Horoscope & Jyotish</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-neutral-300 mb-1">Sort Order</label>
                        <input type="number" name="order_index" id="editFaqOrder" value="0" class="form-input-admin">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Answer *</label>
                    <textarea name="answer" id="editFaqAnswer" rows="4" required class="form-input-admin"></textarea>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="editFaqActive" value="1" class="rounded border-neutral-700 bg-neutral-900 text-amber-500">
                    <label for="editFaqActive" class="text-xs text-neutral-300 cursor-pointer">Active</label>
                </div>
                <div class="flex justify-end gap-3 pt-3 border-t border-neutral-800">
                    <button type="button" onclick="document.getElementById('editFaqModal').classList.add('hidden')" class="px-4 py-2 bg-neutral-800 text-neutral-300 rounded text-xs">
                        Cancel
                    </button>
                    <button type="submit" class="px-5 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold rounded text-xs">
                        Update FAQ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.edit-faq-btn');
        if (!btn) return;
        e.preventDefault();
        const form = document.getElementById('editFaqForm');
        form.action = '/admin/faqs/' + btn.dataset.id;
        document.getElementById('editFaqQuestion').value = btn.dataset.question || '';
        document.getElementById('editFaqCategory').value = btn.dataset.category || 'general';
        document.getElementById('editFaqAnswer').value = btn.dataset.answer || '';
        document.getElementById('editFaqOrder').value = btn.dataset.order || '0';
        document.getElementById('editFaqActive').checked = (btn.dataset.active === '1');
        document.getElementById('editFaqModal').classList.remove('hidden');
    });

    const editFModal = document.getElementById('editFaqModal');
    if (editFModal) {
        editFModal.addEventListener('click', function(e) {
            if (e.target === this) editFModal.classList.add('hidden');
        });
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (editFModal) editFModal.classList.add('hidden');
            const addFModal = document.getElementById('addFaqModal');
            if (addFModal) addFModal.classList.add('hidden');
        }
    });
</script>
@endsection
