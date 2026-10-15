@extends('layouts.admin')

@section('title', 'Hero Sliders')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-heading font-bold text-amber-300">
                Hero Section Sliders & Banners
            </h1>
            <p class="text-xs text-neutral-400 mt-1">
                Manage the high-impact rotating banners in the homepage sanctuary hero section.
            </p>
        </div>
        <a href="{{ route('admin.sliders.create') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold text-xs rounded-lg transition-colors flex items-center gap-2">
            <i class="fa fa-plus"></i> Add New Slide
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($sliders as $slider)
        <div class="admin-card overflow-hidden flex flex-col justify-between border {{ $slider->is_active ? 'border-[#28283c]' : 'border-red-900/40 opacity-70' }}">
            <div class="p-5 space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-[10px] px-2 py-0.5 rounded-full font-bold uppercase tracking-wider {{ $slider->is_active ? 'bg-emerald-500/10 text-emerald-300 border border-emerald-500/20' : 'bg-red-500/10 text-red-300' }}">
                        {{ $slider->is_active ? 'Active' : 'Disabled' }}
                    </span>
                    <span class="text-xs font-mono text-neutral-500">Order: {{ $slider->order_index }}</span>
                </div>

                @if($slider->badge)
                <div class="text-[11px] font-semibold text-amber-400">
                    {{ $slider->badge }}
                </div>
                @endif

                <h3 class="font-heading text-base font-bold text-white line-clamp-2">
                    {{ $slider->title }}
                </h3>

                @if($slider->subtitle)
                <p class="text-xs text-neutral-300 line-clamp-2">
                    {{ $slider->subtitle }}
                </p>
                @endif

                <div class="pt-2 flex flex-wrap gap-2 text-[10px] text-neutral-400">
                    @if($slider->btn_primary_text)
                    <span class="px-2 py-0.5 rounded bg-amber-500/10 border border-amber-500/20 text-amber-300">Btn 1: {{ $slider->btn_primary_text }}</span>
                    @endif
                    @if($slider->btn_secondary_text)
                    <span class="px-2 py-0.5 rounded bg-neutral-800 text-neutral-300">Btn 2: {{ $slider->btn_secondary_text }}</span>
                    @endif
                </div>
            </div>

            <div class="p-4 bg-[#0d0d15] border-t border-[#1e1e2d] flex items-center justify-between">
                <span class="text-[11px] text-neutral-500">Slide ID: #{{ $slider->id }}</span>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="px-3 py-1 bg-neutral-800 hover:bg-neutral-700 text-amber-300 rounded text-xs transition-colors">
                        Edit
                    </a>
                    <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('Delete this hero slide?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-2 py-1 text-red-400 hover:text-red-300 text-xs">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12 text-neutral-500">
            No hero slides created yet.
        </div>
        @endforelse
    </div>
</div>
@endsection
