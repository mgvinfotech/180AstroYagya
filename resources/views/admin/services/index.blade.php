@extends('layouts.admin')

@section('title', 'Vedic Services & Yagyas')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-heading font-bold text-amber-300">
                Vedic Yagyas, Pujas & Consultations
            </h1>
            <p class="text-xs text-neutral-400 mt-1">
                Manage the complete catalog of sacred fire ceremonies, dosh nivaran rituals, and astrological services.
            </p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold text-xs rounded-lg transition-colors flex items-center gap-2">
            <i class="fa fa-plus"></i> Add New Ritual / Yagya
        </a>
    </div>

    <!-- Services Table -->
    <div class="admin-card p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-[#242436] text-neutral-400 uppercase tracking-wider text-[11px]">
                        <th class="py-3 px-4">Title & Slug</th>
                        <th class="py-3 px-4">Category</th>
                        <th class="py-3 px-4">Duration & Priests</th>
                        <th class="py-3 px-4">Dakshina</th>
                        <th class="py-3 px-4">Featured</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#1e1e2d]">
                    @forelse($services as $serv)
                    <tr class="hover:bg-[#181824] transition-colors">
                        <td class="py-3.5 px-4">
                            <div class="font-bold text-white text-sm">
                                <a href="{{ route('service.detail', $serv->slug) }}" target="_blank" class="hover:text-amber-300">
                                    {{ $serv->title }}
                                </a>
                            </div>
                            <div class="text-[11px] font-mono text-neutral-400">/service/{{ $serv->slug }}</div>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="px-2 py-0.5 rounded text-[10px] bg-amber-500/10 text-amber-300 border border-amber-500/20 font-semibold">
                                {{ $serv->category->name ?? 'Uncategorized' }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-neutral-300">
                            <div>{{ $serv->duration ?? '1 Day' }}</div>
                            <div class="text-[11px] text-neutral-400">{{ $serv->priests_count ?? 'Vedic Pandits' }}</div>
                        </td>
                        <td class="py-3.5 px-4 font-heading font-bold text-amber-300 text-sm">
                            ₹{{ number_format($serv->dakshina_inr) }}
                            <span class="text-[11px] text-neutral-400 font-sans font-normal">/ ${{ number_format($serv->dakshina_usd) }}</span>
                        </td>
                        <td class="py-3.5 px-4">
                            @if($serv->is_featured)
                            <span class="px-2 py-0.5 rounded-full text-[10px] bg-amber-500/20 text-amber-300 font-bold">★ Featured</span>
                            @else
                            <span class="text-neutral-600">—</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="px-2 py-0.5 rounded-full text-[10px] {{ $serv->is_active ? 'bg-emerald-500/20 text-emerald-300' : 'bg-red-500/20 text-red-300' }}">
                                {{ $serv->is_active ? 'Active' : 'Draft' }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-right space-x-2">
                            <a href="{{ route('admin.services.edit', $serv->id) }}" class="px-2.5 py-1 bg-neutral-800 hover:bg-neutral-700 text-amber-300 rounded text-xs transition-colors">
                                Edit
                            </a>
                            <form action="{{ route('admin.services.destroy', $serv->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this Vedic service?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1 text-neutral-400 hover:text-red-400">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-neutral-500">No services created yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
