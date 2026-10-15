@extends('layouts.frontend')

@section('title', $astrologer->name . ' - Vedic Astrologer Profile - 108 Astro Yagya')

@section('content')
<div class="py-12 bg-stone-50 dark:bg-[#0b0305] text-slate-800 dark:text-stone-200 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <nav class="flex items-center gap-2 text-xs text-slate-500 dark:text-stone-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-amber-600 dark:hover:text-amber-400">Home</a>
            <span>/</span>
            <a href="{{ route('jyotish') }}" class="hover:text-amber-600 dark:hover:text-amber-400">Vedic Astrologers</a>
            <span>/</span>
            <span class="text-amber-700 dark:text-amber-400 font-semibold">{{ $astrologer->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Left Bio Column (2 Cols) -->
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white dark:bg-[#16080b] p-8 rounded-2xl border border-slate-200 dark:border-amber-950 shadow-sm flex flex-col sm:flex-row gap-6 items-start reveal-fade-up">
                    <div class="w-32 h-32 rounded-2xl overflow-hidden border-2 border-amber-400 flex-shrink-0 shadow-lg bg-orange-50 dark:bg-stone-900">
                        <img src="{{ $astrologer->avatar_url }}" alt="{{ $astrologer->name }}" class="w-full h-full object-cover">
                    </div>

                    <div class="space-y-2">
                        <div class="inline-block px-2.5 py-0.5 bg-amber-100 dark:bg-amber-950/80 text-amber-800 dark:text-amber-300 rounded text-[11px] font-bold uppercase tracking-wider border border-amber-300/40">
                            Verified Kashi Vedic Acharya
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-amber-100 font-heading">
                            {{ $astrologer->name }}
                        </h1>
                        <div class="text-xs text-amber-700 dark:text-amber-400 font-semibold">
                            {{ $astrologer->title }}
                        </div>
                        <div class="text-xs text-slate-500 dark:text-stone-400">
                            {{ $astrologer->qualification }}
                        </div>
                        <div class="flex items-center gap-4 pt-2 text-xs text-slate-600 dark:text-stone-300">
                            <span><strong class="text-amber-700 dark:text-amber-400">{{ $astrologer->experience_years }}+ Years</strong> Experience</span>
                            <span>•</span>
                            <span><strong class="text-amber-700 dark:text-amber-400">★ {{ number_format($astrologer->rating, 2) }}</strong> ({{ $astrologer->reviews_count }} Consultations)</span>
                        </div>
                    </div>
                </div>

                <!-- Biography & Philosophy -->
                <div class="bg-white dark:bg-[#16080b] p-8 rounded-2xl border border-slate-200 dark:border-amber-950 shadow-sm space-y-6 reveal-fade-up">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-amber-100 border-b border-slate-200 dark:border-stone-800 pb-3 font-heading">
                        Vedic Lineage & Astrological Background
                    </h3>
                    <div class="rich-content text-sm text-slate-600 dark:text-stone-300 leading-relaxed space-y-3">
                        {!! $astrologer->bio !!}
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-100 dark:border-stone-800">
                        <div>
                            <span class="text-xs text-slate-400 uppercase tracking-wider block mb-1">Key Specialties</span>
                            <span class="text-sm text-amber-800 dark:text-amber-300 font-semibold">{{ $astrologer->specialties ?? 'Vedic Jyotish, Muhurta, Dosh Nivaran' }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-400 uppercase tracking-wider block mb-1">Languages Spoken</span>
                            <span class="text-sm text-slate-700 dark:text-stone-300 font-semibold">{{ $astrologer->languages ?? 'Hindi, Sanskrit, English' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Booking Widget -->
            <div>
                <div class="bg-white dark:bg-[#16080b] p-6 rounded-2xl border border-amber-200 dark:border-amber-950 shadow-md sticky top-28 reveal-fade-up">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-amber-100 mb-1 font-heading">
                        Consult {{ $astrologer->name }}
                    </h3>
                    <p class="text-xs text-slate-500 dark:text-stone-400 mb-5">
                        Dakshina: ₹{{ number_format($astrologer->consultation_fee) }} per comprehensive Kundli session.
                    </p>

                    <form id="vedicInquiryForm" action="{{ route('inquiry.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="inquiry_type" value="jyotish_consultation">
                        <input type="hidden" name="astrologer_id" value="{{ $astrologer->id }}">

                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-1">Your Full Name *</label>
                                <input type="text" name="full_name" required class="form-input-vedic text-sm" placeholder="Full Name">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-1">Email Address *</label>
                                <input type="email" name="email" required class="form-input-vedic text-sm" placeholder="devotee@example.com">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-1">Phone / WhatsApp *</label>
                                <input type="tel" name="phone" required class="form-input-vedic text-sm" placeholder="+91 8009767597">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-1">Birth Details & Questions</label>
                                <textarea name="problem_description" rows="3" class="form-input-vedic text-sm" placeholder="Date, Time, Place of birth and your specific questions..."></textarea>
                            </div>

                            <button type="submit" class="btn-vedic-gold w-full text-xs py-3 mt-2">
                                Request Consultation Slot
                            </button>
                        </div>
                    </form>

                    <div class="mt-4 pt-4 border-t border-slate-200 dark:border-stone-800 text-center">
                        <span class="text-[11px] text-slate-500 dark:text-stone-400 block mb-2">Need immediate consultation?</span>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '918009767597') }}?text=Hari%20Om!%20I%20want%20to%20consult%20{{ urlencode($astrologer->name) }}" target="_blank" class="inline-flex items-center gap-2 text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700">
                            <i class="fab fa-whatsapp text-sm"></i> WhatsApp Acharyaji
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
