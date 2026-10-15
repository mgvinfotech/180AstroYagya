@extends('layouts.admin')

@section('title', 'Manage CMS Pages')

@section('content')
<div class="space-y-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-heading font-bold text-amber-300">
                CMS Informational Pages
            </h1>
            <p class="text-xs text-neutral-400 mt-1">
                Create, write, and manage full-content pages for your Sub-menus (e.g. What is Vedic Yagya, TM, Rules, Articles).
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.menus.index') }}" class="px-3.5 py-2 bg-[#1c1c28] hover:bg-[#252536] text-amber-300 text-xs rounded-lg transition-colors border border-amber-500/20 flex items-center gap-2">
                <i class="fa fa-bars"></i> Manage Menus
            </a>
            <a href="{{ route('admin.pages.create') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold text-xs rounded-lg transition-colors flex items-center gap-2 shadow-md">
                <i class="fa fa-plus"></i> Create New Page
            </a>
        </div>
    </div>

    <!-- Quick Tip Banner -->
    <div class="p-4 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-start gap-3">
        <i class="fa fa-lightbulb text-amber-400 text-base mt-0.5 shrink-0"></i>
        <div class="text-xs text-neutral-300 space-y-1">
            <p class="font-semibold text-amber-300">How to link a Page to a Sub-menu:</p>
            <p>1. Copy the <span class="text-amber-200 font-mono">Page URL</span> from the table below (e.g., <span class="font-mono text-amber-300">/page/what-is-vedic-yagya</span> or <span class="font-mono text-amber-300">/vedic/what-is-vedic-yagya</span>).</p>
            <p>2. Go to <strong>Dynamic Menus</strong> &rarr; Click <strong>Add New Menu Item</strong> &rarr; Paste URL &rarr; Select <strong>Parent Menu</strong> (e.g. <em>Home</em>, <em>Yagyas</em>, or <em>Jyotish</em>)!</p>
        </div>
    </div>

    <!-- Search & Filter Bar -->
    <div class="flex items-center justify-between gap-4">
        <form method="GET" action="{{ route('admin.pages.index') }}" class="flex items-center gap-2 w-full max-w-md">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search pages by title or slug..." class="form-input-admin py-2 text-xs">
            <button type="submit" class="px-4 py-2 bg-neutral-800 hover:bg-neutral-700 text-neutral-200 text-xs rounded-lg">
                <i class="fa fa-search"></i>
            </button>
            @if(request('search'))
            <a href="{{ route('admin.pages.index') }}" class="px-3 py-2 text-neutral-400 hover:text-white text-xs">
                Clear
            </a>
            @endif
        </form>

        <span class="text-xs text-neutral-400">
            Total Pages: <strong class="text-amber-300">{{ $pages->total() }}</strong>
        </span>
    </div>

    <!-- Pages Table -->
    <div class="admin-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-[#212130] text-neutral-400 uppercase tracking-wider text-[11px] bg-[#14141e]">
                        <th class="py-3 px-4">Page Title</th>
                        <th class="py-3 px-4">Public URL (Path)</th>
                        <th class="py-3 px-4">Excerpt / Subtitle</th>
                        <th class="py-3 px-4">Order</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#1b1b26]">
                    @forelse($pages as $page)
                    <tr class="hover:bg-[#161622] transition-colors">
                        <td class="py-3.5 px-4">
                            <div class="font-bold text-white flex items-center gap-2">
                                <span class="text-amber-400">📄</span>
                                <span>{{ $page->title }}</span>
                            </div>
                            @if($page->subtitle)
                            <div class="text-[11px] text-neutral-400 mt-0.5 truncate max-w-xs">
                                {{ $page->subtitle }}
                            </div>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 font-mono text-[11px]">
                            <div class="flex items-center gap-2">
                                <span class="text-amber-300 bg-amber-500/10 px-2 py-0.5 rounded border border-amber-500/20">
                                    /vedic/{{ $page->slug }}
                                </span>
                                <a href="{{ url('/vedic/' . $page->slug) }}" target="_blank" class="text-neutral-500 hover:text-amber-300" title="Open live page in new tab">
                                    <i class="fa fa-external-link-alt text-[10px]"></i>
                                </a>
                            </div>
                        </td>
                        <td class="py-3.5 px-4 text-neutral-400 text-[11px] max-w-xs truncate">
                            {{ $page->excerpt ?: Str::limit(strip_tags($page->content), 60) ?: '—' }}
                        </td>
                        <td class="py-3.5 px-4 font-mono text-neutral-400">
                            {{ $page->order_index }}
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $page->is_active ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-red-500/20 text-red-300 border border-red-500/30' }}">
                                {{ $page->is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-right space-x-2">
                            <a href="{{ url('/vedic/' . $page->slug) }}" target="_blank" class="p-1.5 text-neutral-400 hover:text-blue-300 transition-colors inline-block" title="View Page">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.pages.edit', $page->id) }}" class="p-1.5 text-neutral-400 hover:text-amber-300 transition-colors inline-block" title="Edit Page Content">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this page?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-neutral-400 hover:text-red-400 transition-colors" title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-neutral-500">
                            <i class="fa fa-file-alt text-3xl mb-3 block text-neutral-600"></i>
                            No custom pages created yet. Click <a href="{{ route('admin.pages.create') }}" class="text-amber-400 hover:underline">Create New Page</a> to add your first article or informational page.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pages->hasPages())
        <div class="p-4 border-t border-[#212130]">
            {{ $pages->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
