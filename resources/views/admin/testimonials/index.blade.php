@extends('layouts.admin')

@section('title', 'Devotee Testimonials & Reviews')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-heading font-bold text-amber-300">
                Devotee Testimonials & Reviews
            </h1>
            <p class="text-xs text-neutral-400 mt-1">
                Manage the inspiring client reviews and Vedic miracle testimonials featured on the homepage.
            </p>
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold text-xs rounded-lg transition-colors flex items-center gap-2">
            <i class="fa fa-plus"></i> Add New Review
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($testimonials as $testi)
        <div class="admin-card p-6 flex flex-col justify-between space-y-4 border border-[#222233]">
            <div>
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center gap-1 text-amber-400 text-xs">
                        @for($i = 0; $i < $testi->rating; $i++)
                        <i class="fa fa-star"></i>
                        @endfor
                    </div>
                    @if($testi->is_verified)
                    <span class="px-2 py-0.5 rounded-full text-[10px] bg-emerald-500/10 text-emerald-300 border border-emerald-500/20 font-semibold">
                        ✓ Verified Devotee
                    </span>
                    @endif
                </div>

                <h3 class="font-heading text-base font-bold text-white">{{ $testi->client_name }}</h3>
                <div class="text-xs text-neutral-400 mb-2">
                    {{ $testi->client_title }} • {{ $testi->location }}
                </div>

                @if($testi->service_taken)
                <div class="inline-block text-[11px] font-semibold text-amber-300 bg-amber-500/10 px-2 py-0.5 rounded mb-3">
                    Ritual: {{ $testi->service_taken }}
                </div>
                @endif

                <p class="text-xs text-neutral-300 italic leading-relaxed">
                    "{{ $testi->review_text }}"
                </p>
            </div>

            <div class="pt-4 border-t border-[#1e1e2d] flex items-center justify-between">
                <span class="text-xs text-neutral-500">Order: {{ $testi->order_index }}</span>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.testimonials.edit', $testi->id) }}" class="px-3 py-1 bg-neutral-800 hover:bg-neutral-700 text-amber-300 rounded text-xs transition-colors">
                        Edit
                    </a>
                    <form action="{{ route('admin.testimonials.destroy', $testi->id) }}" method="POST" onsubmit="return confirm('Delete this testimonial?')">
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
        <div class="col-span-2 text-center py-12 text-neutral-500">
            No testimonials recorded yet.
        </div>
        @endforelse
    </div>
</div>
@endsection
