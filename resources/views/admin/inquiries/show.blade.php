@extends('layouts.admin')

@section('title', 'Inquiry Details: ' . $inquiry->full_name)

@section('content')
<div class="max-w-4xl space-y-6">
    <div class="flex items-center justify-between pb-4 border-b border-[#212130]">
        <div>
            <h1 class="text-2xl font-heading font-bold text-amber-300">
                Sankalp Lead #{{ $inquiry->id }}: {{ $inquiry->full_name }}
            </h1>
            <p class="text-xs text-neutral-400 mt-1">
                Submitted on {{ $inquiry->created_at->format('d M Y, h:i A') }}
            </p>
        </div>
        <a href="{{ route('admin.inquiries.index') }}" class="text-xs text-neutral-400 hover:text-amber-300">
            ← Back to Inquiries
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Main Lead Info (2 Cols) -->
        <div class="md:col-span-2 space-y-6">
            
            <!-- Contact Card -->
            <div class="admin-card p-6 space-y-4">
                <h3 class="font-heading text-sm font-bold text-amber-400 uppercase tracking-wider pb-2 border-b border-[#222233]">
                    Devotee Coordinates
                </h3>
                <div class="grid grid-cols-2 gap-4 text-xs">
                    <div>
                        <span class="text-neutral-500 block mb-0.5">Seeker Name:</span>
                        <span class="text-sm font-bold text-white">{{ $inquiry->full_name }}</span>
                    </div>
                    <div>
                        <span class="text-neutral-500 block mb-0.5">Inquiry Type:</span>
                        <span class="text-sm font-bold text-amber-300 uppercase">{{ str_replace('_', ' ', $inquiry->inquiry_type) }}</span>
                    </div>
                    <div>
                        <span class="text-neutral-500 block mb-0.5">Phone Number:</span>
                        <a href="tel:{{ $inquiry->phone }}" class="text-white hover:text-amber-300">{{ $inquiry->phone }}</a>
                    </div>
                    <div>
                        <span class="text-neutral-500 block mb-0.5">WhatsApp:</span>
                        <span class="text-white">{{ $inquiry->whatsapp ?? $inquiry->phone }}</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-neutral-500 block mb-0.5">Email Address:</span>
                        <a href="mailto:{{ $inquiry->email }}" class="text-white hover:text-amber-300">{{ $inquiry->email }}</a>
                    </div>
                </div>

                @php
                    $waNumber = preg_replace('/[^0-9]/', '', $inquiry->whatsapp ?: $inquiry->phone);
                @endphp
                @if($waNumber)
                <div class="pt-3">
                    <a href="https://wa.me/{{ $waNumber }}?text=Hari%20Om%20{{ urlencode($inquiry->full_name) }}%20Ji,%20this%20is%20from%20108%20Astro%20Yagya%20Sanctuary%20regarding%20your%20Sankalp%20booking." target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-500 text-white rounded-lg text-xs font-bold transition-colors">
                        <i class="fab fa-whatsapp"></i> Initiate WhatsApp Chat with Seeker
                    </a>
                </div>
                @endif
            </div>

            <!-- Vedic Birth Details -->
            <div class="admin-card p-6 space-y-4">
                <h3 class="font-heading text-sm font-bold text-amber-400 uppercase tracking-wider pb-2 border-b border-[#222233]">
                    Vedic Astrological Coordinates
                </h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-xs">
                    <div>
                        <span class="text-neutral-500 block mb-0.5">Date of Birth:</span>
                        <span class="text-white font-semibold">{{ $inquiry->date_of_birth ? $inquiry->date_of_birth->format('d F Y') : 'Not Provided' }}</span>
                    </div>
                    <div>
                        <span class="text-neutral-500 block mb-0.5">Time of Birth:</span>
                        <span class="text-white font-semibold">{{ $inquiry->time_of_birth ?? 'Not Provided' }}</span>
                    </div>
                    <div>
                        <span class="text-neutral-500 block mb-0.5">Place of Birth:</span>
                        <span class="text-white font-semibold">{{ $inquiry->place_of_birth ?? 'Not Provided' }}</span>
                    </div>
                    <div>
                        <span class="text-neutral-500 block mb-0.5">Gotra:</span>
                        <span class="text-amber-300 font-semibold">{{ $inquiry->gotra ?? 'Not Provided' }}</span>
                    </div>
                    <div>
                        <span class="text-neutral-500 block mb-0.5">Rashi / Nakshatra:</span>
                        <span class="text-amber-300 font-semibold">{{ $inquiry->rashi_nakshatra ?? 'Not Provided' }}</span>
                    </div>
                    <div>
                        <span class="text-neutral-500 block mb-0.5">Preferred Language:</span>
                        <span class="text-white font-semibold">{{ $inquiry->preferred_language ?? 'Hindi' }}</span>
                    </div>
                </div>
            </div>

            <!-- Prayer / Problem Message -->
            @if($inquiry->problem_description)
            <div class="admin-card p-6 space-y-2">
                <h3 class="font-heading text-sm font-bold text-amber-400 uppercase tracking-wider pb-2 border-b border-[#222233]">
                    Devotee Prayer / Problem Description
                </h3>
                <p class="text-xs text-neutral-300 leading-relaxed italic p-3 rounded bg-black/40 border border-amber-500/10">
                    "{{ $inquiry->problem_description }}"
                </p>
            </div>
            @endif

        </div>

        <!-- Right Action Sidebar -->
        <div class="space-y-6">
            <!-- Status Update Form -->
            <div class="admin-card p-6 space-y-4">
                <h3 class="font-heading text-sm font-bold text-white uppercase tracking-wider pb-2 border-b border-[#222233]">
                    Lead Status & Notes
                </h3>

                <form action="{{ route('admin.inquiries.status', $inquiry->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label class="block text-xs font-semibold text-neutral-300 mb-1">Current Status</label>
                        <select name="status" class="form-input-admin text-xs">
                            <option value="pending" {{ $inquiry->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="contacted" {{ $inquiry->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                            <option value="scheduled" {{ $inquiry->status === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                            <option value="completed" {{ $inquiry->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $inquiry->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-neutral-300 mb-1">Internal Acharya Notes</label>
                        <textarea name="admin_notes" rows="4" class="form-input-admin text-xs" placeholder="e.g. Called devotee on 10 Oct, scheduled live video Sankalp for Maha Mrityunjaya on 15 Oct 07:00 AM...">{{ old('admin_notes', $inquiry->admin_notes) }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold rounded text-xs">
                        Update Status
                    </button>
                </form>
            </div>

            <!-- Service Details Box -->
            @if($inquiry->service)
            <div class="admin-card p-6 space-y-2">
                <span class="text-[10px] text-neutral-500 uppercase tracking-wider block">Requested Yagya</span>
                <div class="text-sm font-bold text-white">{{ $inquiry->service->title }}</div>
                <div class="text-xs text-amber-400 font-semibold">Dakshina: ₹{{ number_format($inquiry->service->dakshina_inr) }}</div>
                <div class="text-[11px] text-neutral-400 pt-1">Priests: {{ $inquiry->service->priests_count }} • {{ $inquiry->service->duration }}</div>
            </div>
            @endif

            <!-- Astrologer Details Box -->
            @if($inquiry->astrologer)
            <div class="admin-card p-6 space-y-2">
                <span class="text-[10px] text-neutral-500 uppercase tracking-wider block">Requested Astrologer</span>
                <div class="text-sm font-bold text-white">{{ $inquiry->astrologer->name }}</div>
                <div class="text-xs text-amber-400 font-semibold">{{ $inquiry->astrologer->title }}</div>
                <div class="text-[11px] text-neutral-400 pt-1">Fee: ₹{{ number_format($inquiry->astrologer->consultation_fee) }}</div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
