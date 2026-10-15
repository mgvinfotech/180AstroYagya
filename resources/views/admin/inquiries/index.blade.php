@extends('layouts.admin')

@section('title', 'Sankalp Inquiries & Leads')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-heading font-bold text-amber-300">
                Sankalp Inquiries & Booking Leads
            </h1>
            <p class="text-xs text-neutral-400 mt-1">
                Manage devotee consultation requests, Gotra/Rashi coordinates, and lead statuses.
            </p>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="admin-card p-4">
        <form action="{{ route('admin.inquiries.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, phone, gotra, email..." class="form-input-admin text-xs sm:col-span-2">
            
            <select name="status" class="form-input-admin text-xs">
                <option value="">-- All Statuses --</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>Contacted</option>
                <option value="scheduled" {{ request('status') === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>

            <div class="flex gap-2">
                <button type="submit" class="w-full bg-amber-500 hover:bg-amber-400 text-black font-bold text-xs rounded-lg transition-colors py-2">
                    Filter
                </button>
                <a href="{{ route('admin.inquiries.index') }}" class="px-3 py-2 bg-neutral-800 text-neutral-400 rounded-lg hover:text-white text-xs flex items-center justify-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Inquiries Table -->
    <div class="admin-card p-6">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-[#242436] text-neutral-400 uppercase tracking-wider text-[11px]">
                        <th class="py-3 px-4">Seeker</th>
                        <th class="py-3 px-4">Inquiry Type</th>
                        <th class="py-3 px-4">Requested Service / Yagya</th>
                        <th class="py-3 px-4">Birth / Gotra</th>
                        <th class="py-3 px-4">Date Submitted</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#1e1e2d]">
                    @forelse($inquiries as $inq)
                    <tr class="hover:bg-[#181824] transition-colors">
                        <td class="py-3.5 px-4">
                            <div class="font-bold text-white text-sm">{{ $inq->full_name }}</div>
                            <div class="text-[11px] text-neutral-400">{{ $inq->phone }} @if($inq->whatsapp) • WA: {{ $inq->whatsapp }} @endif</div>
                            <div class="text-[11px] text-neutral-400">{{ $inq->email }}</div>
                        </td>
                        <td class="py-3.5 px-4 uppercase text-[11px] font-semibold text-neutral-300">
                            {{ str_replace('_', ' ', $inq->inquiry_type) }}
                        </td>
                        <td class="py-3.5 px-4 text-amber-300 font-medium">
                            {{ $inq->service->title ?? 'General Ashram Inquiry' }}
                        </td>
                        <td class="py-3.5 px-4 text-neutral-400">
                            <div><strong>Gotra:</strong> {{ $inq->gotra ?? 'N/A' }}</div>
                            <div><strong>Rashi:</strong> {{ $inq->rashi_nakshatra ?? 'N/A' }}</div>
                            @if($inq->date_of_birth)
                            <div class="text-[10px] text-neutral-500">DOB: {{ $inq->date_of_birth->format('d/m/Y') }}</div>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-neutral-400 font-mono text-[11px]">
                            {{ $inq->created_at->format('d M Y, h:i A') }}
                        </td>
                        <td class="py-3.5 px-4">
                            @if($inq->status === 'pending')
                            <span class="px-2 py-0.5 rounded-full text-[10px] bg-amber-500/20 text-amber-300 border border-amber-500/30 font-bold uppercase">Pending</span>
                            @elseif($inq->status === 'contacted')
                            <span class="px-2 py-0.5 rounded-full text-[10px] bg-blue-500/20 text-blue-300 border border-blue-500/30 font-bold uppercase">Contacted</span>
                            @elseif($inq->status === 'scheduled')
                            <span class="px-2 py-0.5 rounded-full text-[10px] bg-purple-500/20 text-purple-300 border border-purple-500/30 font-bold uppercase">Scheduled</span>
                            @else
                            <span class="px-2 py-0.5 rounded-full text-[10px] bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 font-bold uppercase">{{ $inq->status }}</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right space-x-2">
                            <a href="{{ route('admin.inquiries.show', $inq->id) }}" class="px-2.5 py-1 bg-neutral-800 hover:bg-neutral-700 text-amber-300 rounded text-xs transition-colors">
                                Review
                            </a>
                            <form action="{{ route('admin.inquiries.destroy', $inq->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this inquiry record?')">
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
                        <td colspan="7" class="py-8 text-center text-neutral-500">
                            No inquiries match the given parameters.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pt-4 border-t border-[#1e1e2d]">
            {{ $inquiries->links() }}
        </div>
    </div>
</div>
@endsection
