@extends('layouts.admin')

@section('title', 'Astrologers & Acharyas')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-heading font-bold text-amber-300">
                Vedic Astrologers & Acharyas
            </h1>
            <p class="text-xs text-neutral-400 mt-1">
                Manage profiles of initiated Kashi Brahmins, Vedic astrologers, and spiritual advisors.
            </p>
        </div>
        <a href="{{ route('admin.astrologers.create') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold text-xs rounded-lg transition-colors flex items-center gap-2">
            <i class="fa fa-user-plus"></i> Add New Astrologer
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($astrologers as $astro)
        <div class="admin-card p-6 flex flex-col justify-between space-y-4 border border-[#222233]">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-[10px] px-2 py-0.5 rounded-full font-bold uppercase tracking-wider {{ $astro->is_available_online ? 'bg-emerald-500/10 text-emerald-300 border border-emerald-500/20' : 'bg-neutral-800 text-neutral-400' }}">
                        {{ $astro->is_available_online ? '● Available Online' : '○ Offline' }}
                    </span>
                    <span class="text-xs font-semibold text-amber-400">★ {{ number_format($astro->rating, 2) }}</span>
                </div>

                <h3 class="font-heading text-lg font-bold text-white mb-1">
                    {{ $astro->name }}
                </h3>
                <div class="text-xs text-amber-400 mb-2 font-medium">
                    {{ $astro->title }}
                </div>
                <div class="text-[11px] text-neutral-400 mb-3">
                    {{ $astro->qualification }}
                </div>

                <div class="p-3 rounded-lg bg-[#0b0b12] text-xs text-neutral-300 space-y-1 mb-4">
                    <div><strong>Experience:</strong> {{ $astro->experience_years }} Years</div>
                    <div><strong>Dakshina:</strong> ₹{{ number_format($astro->consultation_fee) }}</div>
                    <div><strong>Specialties:</strong> {{ $astro->specialties }}</div>
                </div>

                <p class="text-xs text-neutral-400 line-clamp-3">
                    {{ $astro->bio }}
                </p>
            </div>

            <div class="pt-4 border-t border-[#1e1e2d] flex items-center justify-between">
                <span class="text-xs text-neutral-500">Order: {{ $astro->order_index }}</span>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.astrologers.edit', $astro->id) }}" class="px-3 py-1 bg-neutral-800 hover:bg-neutral-700 text-amber-300 rounded text-xs transition-colors">
                        Edit
                    </a>
                    <form action="{{ route('admin.astrologers.destroy', $astro->id) }}" method="POST" onsubmit="return confirm('Delete this astrologer profile?')">
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
            No astrologers registered yet.
        </div>
        @endforelse
    </div>
</div>
@endsection
