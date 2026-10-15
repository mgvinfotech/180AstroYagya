@extends('layouts.admin')

@section('title', 'Sanctuary Dashboard')

@section('content')
<div class="space-y-8">
    
    <!-- Top Greeting -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-[#212130]">
        <div>
            <h1 class="text-2xl font-heading font-bold text-amber-300">
                Hari Om, {{ auth()->user()->name ?? 'Acharya' }} 🙏
            </h1>
            <p class="text-xs text-neutral-400 mt-1">
                Welcome to the 108 Astro Yagya Sanctuary Administration. Manage your portal and incoming Sankalp inquiries.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.inquiries.index') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-black font-bold text-xs rounded-lg transition-colors flex items-center gap-2">
                <i class="fa fa-envelope-open-text"></i> View Inquiries ({{ $stats['pending_inquiries'] }} Pending)
            </a>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Inquiries -->
        <div class="admin-card p-6">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs text-neutral-400 uppercase tracking-wider font-semibold">Total Inquiries</span>
                <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400">
                    <i class="fa fa-envelope-open-text"></i>
                </div>
            </div>
            <div class="text-3xl font-heading font-bold text-white">{{ $stats['total_inquiries'] }}</div>
            <div class="text-xs text-amber-400 mt-2 font-medium">
                {{ $stats['pending_inquiries'] }} awaiting acharya response
            </div>
        </div>

        <!-- Services -->
        <div class="admin-card p-6">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs text-neutral-400 uppercase tracking-wider font-semibold">Vedic Yagyas & Services</span>
                <div class="w-10 h-10 rounded-xl bg-red-500/10 border border-red-500/20 flex items-center justify-center text-red-400">
                    <i class="fa fa-fire"></i>
                </div>
            </div>
            <div class="text-3xl font-heading font-bold text-white">{{ $stats['total_services'] }}</div>
            <div class="text-xs text-neutral-400 mt-2">
                Active in public catalogue
            </div>
        </div>

        <!-- CMS Informational Pages -->
        <a href="{{ route('admin.pages.index') }}" class="admin-card p-6 block hover:border-amber-500/40 transition-colors">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs text-neutral-400 uppercase tracking-wider font-semibold">CMS Pages</span>
                <div class="w-10 h-10 rounded-xl bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400">
                    <i class="fa fa-file-lines"></i>
                </div>
            </div>
            <div class="text-3xl font-heading font-bold text-white">{{ $stats['total_pages'] }}</div>
            <div class="text-xs text-neutral-400 mt-2">
                Submenu articles & pages
            </div>
        </a>

        <!-- Testimonials -->
        <div class="admin-card p-6">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs text-neutral-400 uppercase tracking-wider font-semibold">Devotee Reviews</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                    <i class="fa fa-star"></i>
                </div>
            </div>
            <div class="text-3xl font-heading font-bold text-white">{{ $stats['total_testimonials'] }}</div>
            <div class="text-xs text-emerald-400 mt-2">
                Verified devotee miracles
            </div>
        </div>
    </div>

    <!-- Recent Inquiries Table -->
    <div class="admin-card p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="font-heading text-lg font-bold text-white">Recent Sankalp Inquiries</h3>
                <p class="text-xs text-neutral-400">Latest devotee booking and consultation requests.</p>
            </div>
            <a href="{{ route('admin.inquiries.index') }}" class="text-xs text-amber-400 hover:text-amber-300 font-semibold">
                View All Inquiries →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-[#242436] text-neutral-400 uppercase tracking-wider text-[11px]">
                        <th class="py-3 px-4">Seeker</th>
                        <th class="py-3 px-4">Type</th>
                        <th class="py-3 px-4">Service / Pandit</th>
                        <th class="py-3 px-4">Gotra / Coordinates</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#1e1e2d]">
                    @forelse($recentInquiries as $inq)
                    <tr class="hover:bg-[#181824] transition-colors">
                        <td class="py-3.5 px-4">
                            <div class="font-bold text-white">{{ $inq->full_name }}</div>
                            <div class="text-[11px] text-neutral-400">{{ $inq->phone }} • {{ $inq->email }}</div>
                        </td>
                        <td class="py-3.5 px-4 uppercase font-semibold text-neutral-300">
                            {{ str_replace('_', ' ', $inq->inquiry_type) }}
                        </td>
                        <td class="py-3.5 px-4 text-amber-300 font-medium">
                            {{ $inq->service->title ?? ($inq->astrologer->name ?? 'General Inquiry') }}
                        </td>
                        <td class="py-3.5 px-4 text-neutral-400">
                            {{ $inq->gotra ?? 'Gotra N/A' }} • {{ $inq->place_of_birth ?? 'Place N/A' }}
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
                        <td class="py-3.5 px-4 text-right">
                            <a href="{{ route('admin.inquiries.show', $inq->id) }}" class="px-2.5 py-1 bg-neutral-800 hover:bg-neutral-700 text-amber-300 rounded text-xs transition-colors">
                                View Details
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-neutral-500">
                            No inquiries recorded yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
