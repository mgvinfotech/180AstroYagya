@extends('layouts.frontend')

@section('title', ($page && $page->meta_title ? $page->meta_title : ($page ? $page->title : ucwords(str_replace('-', ' ', $slug)))) . ' - 108 Astro Yagya')

@if($page && $page->meta_description)
@section('meta_description', $page->meta_description)
@endif

@section('content')
<div class="py-12 sm:py-16 bg-slate-50 dark:bg-[#0c0507] text-slate-800 dark:text-slate-100 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center gap-2 text-xs text-slate-500 dark:text-stone-400 mb-6">
            <a href="{{ route('home') }}" class="hover:text-amber-600 dark:hover:text-amber-400 transition-colors">Home</a>
            <span>/</span>
            <span class="text-amber-700 dark:text-amber-400 font-semibold">{{ $page ? $page->title : ucwords(str_replace('-', ' ', $slug)) }}</span>
        </nav>

        <article class="bg-white dark:bg-[#16080c] rounded-2xl border border-slate-200 dark:border-stone-800/80 shadow-sm overflow-hidden space-y-8">
            
            @if($page && $page->banner_image)
            <!-- Page Banner Image if uploaded by Admin -->
            <div class="w-full h-56 sm:h-72 overflow-hidden relative">
                <img src="{{ $page->banner_url }}" alt="{{ $page->title }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-6 sm:p-8">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-500/90 text-black">
                        Vedic Wisdom & Traditions
                    </span>
                </div>
            </div>
            @endif

            <div class="p-6 sm:p-10 space-y-8">
                <!-- Header Title & Tagline -->
                <div class="text-center pb-6 border-b border-slate-200 dark:border-stone-800">
                    <span class="section-tag inline-block mb-2">
                        Ancient Vedic Shastra
                    </span>
                    <h1 class="text-3xl sm:text-4xl font-heading font-bold text-slate-900 dark:text-amber-200">
                        {{ $page ? $page->title : ucwords(str_replace('-', ' ', $slug)) }}
                    </h1>
                    @if($page && $page->subtitle)
                    <p class="text-sm sm:text-base text-amber-700 dark:text-amber-400/90 mt-2 font-medium">
                        {{ $page->subtitle }}
                    </p>
                    @endif
                </div>

                <!-- Main Content Body -->
                <div class="prose dark:prose-invert max-w-none text-slate-700 dark:text-stone-300 text-sm sm:text-base leading-relaxed space-y-6">
                    @if($page && !empty($page->content))
                        {!! $page->content !!}
                    @else
                        <!-- Fallback Authentic Content if page content not yet customized -->
                        <p>
                            In authentic Vedic tradition, the sacred fire ceremony (Yagya or Homa) and astrological divine sciences connect finite human intent with infinite universal cosmic consciousness. Guided strictly by the Shukla Yajurveda Samhitas and ancient Karma Kanda treatises, these traditional rituals cleanse environmental prana and mitigate adverse planetary transits.
                        </p>

                        <div class="p-6 rounded-xl bg-amber-50 dark:bg-amber-950/30 border-l-4 border-amber-500 my-6">
                            <p class="text-slate-800 dark:text-amber-200 font-medium italic mb-2">
                                "अग्निर्होता कविक्रतुः सत्यश्चित्रश्रवस्तमः । देवो देवेभिरागमत् ॥" — Rigveda 1.1.5
                            </p>
                            <p class="text-xs text-slate-500 dark:text-stone-400">
                                Lord Agni is the divine Priest, the master of supreme wisdom, truthful and bountiful. May He awaken higher cosmic order and blessings within our lives.
                            </p>
                        </div>

                        <h3 class="text-xl font-bold text-slate-900 dark:text-amber-200 mt-8 mb-4">
                            The Science of Sound & Fire
                        </h3>
                        <p>
                            The acoustic vibrational frequencies produced during Sanskrit Vedic recitation penetrate deep human biofields and psychic energy vortices (Chakras). Combined with high-temperature offerings of certified medicinal herbs, pure Gir cow ghee, and consecrated samidhas, inimical elemental frequencies are pacified.
                        </p>

                        <h3 class="text-xl font-bold text-slate-900 dark:text-amber-200 mt-8 mb-4">
                            Experiencing Divine Blessings
                        </h3>
                        <p>
                            Devotees worldwide regularly witness profound inner tranquility, clearing of persistent career or litigation blockages, harmony in married life, and revitalization of holistic health. Each ceremony is conducted with personalized Gotra, Nakshatra, and Rashi Sankalp.
                        </p>
                    @endif
                </div>

                <!-- Sankalp Booking CTA Footer -->
                <div class="pt-8 border-t border-slate-200 dark:border-stone-800 flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <span class="text-xs text-slate-500 dark:text-stone-400 block">Wish to experience this authentic sacred ritual?</span>
                        <strong class="text-sm text-amber-700 dark:text-amber-300">Consult with Acharya Tarkeshwar Dwivedi today</strong>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('contact') }}" class="btn-vedic-gold text-xs py-2.5 px-6">
                            Book Live Sankalp
                        </a>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>
@endsection
