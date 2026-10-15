@extends('layouts.frontend')

@section('title', '404 - Page Not Found | 108 Astro Yagya')

@section('content')
<div class="py-20 sm:py-28 bg-slate-50 dark:bg-[#0c0507] text-slate-800 dark:text-slate-100 min-h-[70vh] flex items-center justify-center">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 text-center space-y-8">
        
        <!-- Sacred Vedic Icon & 404 Badge -->
        <div class="space-y-4">
            <div class="w-24 h-24 mx-auto rounded-full bg-amber-500/10 border-2 border-amber-500/30 flex items-center justify-center text-amber-500 text-4xl shadow-lg shadow-amber-500/10">
                ❖
            </div>
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase bg-amber-500/20 text-amber-600 dark:text-amber-300 border border-amber-500/30">
                404 • Page Not Found
            </span>
        </div>

        <!-- Main Title & Description -->
        <div class="space-y-3">
            <h1 class="text-3xl sm:text-5xl font-heading font-bold text-slate-900 dark:text-amber-200">
                The Sacred Page Is Unavailable
            </h1>
            <p class="text-sm sm:text-base text-slate-600 dark:text-stone-400 max-w-lg mx-auto leading-relaxed">
                The divine ritual, informational article, or page you are looking for has been removed, updated, or is temporarily not found.
            </p>
        </div>

        <!-- Sacred Shloka Card -->
        <div class="p-6 rounded-2xl bg-white dark:bg-[#16080c] border border-amber-500/30 shadow-sm max-w-md mx-auto">
            <p class="text-amber-700 dark:text-amber-300 font-serif text-sm italic">
                "ॐ असतो मा सद्गमय । तमसो मा ज्योतिर्गमय । मृत्योर्मा अमृतं गमय ॥"
            </p>
            <p class="text-[11px] text-slate-500 dark:text-stone-400 mt-1">
                Lead us from the unreal to the real, from darkness to light.
            </p>
        </div>

        <!-- Action CTAs -->
        <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
            <a href="{{ route('home') }}" class="btn-vedic-gold px-6 py-3 text-xs uppercase tracking-wider font-bold">
                <i class="fa fa-home text-xs mr-1"></i> Return to Home
            </a>
            <a href="{{ route('yagyas') }}" class="px-6 py-3 rounded-xl border border-amber-500/40 text-amber-700 dark:text-amber-300 hover:bg-amber-500/10 transition-colors text-xs font-semibold">
                Explore Vedic Yagyas
            </a>
            <a href="{{ route('contact') }}" class="px-6 py-3 rounded-xl bg-slate-200 dark:bg-stone-800 text-slate-700 dark:text-stone-200 hover:bg-slate-300 transition-colors text-xs font-semibold">
                Contact Ashram
            </a>
        </div>

    </div>
</div>
@endsection
