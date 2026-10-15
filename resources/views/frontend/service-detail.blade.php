@extends('layouts.frontend')

@section('title', ($service->meta_title ?: $service->title) . ' - 108 Astro Yagya')
@section('meta_description', $service->meta_description ?: $service->short_desc)

@section('content')
<div class="py-12 bg-stone-50 dark:bg-[#0b0305] text-slate-800 dark:text-stone-200 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs text-slate-500 dark:text-stone-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-amber-600 dark:hover:text-amber-400">Home</a>
            <span>/</span>
            <a href="{{ route('yagyas') }}" class="hover:text-amber-600 dark:hover:text-amber-400">{{ $service->category->name ?? 'Yagyas' }}</a>
            <span>/</span>
            <span class="text-amber-700 dark:text-amber-400 font-semibold">{{ $service->title }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Left Main Column (2 Cols) -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Main Header Card -->
                <div class="bg-white dark:bg-[#16080b] p-6 sm:p-8 rounded-2xl border border-slate-200 dark:border-amber-950 shadow-sm reveal-fade-up">
                    @if($service->image)
                    <div class="mb-6 rounded-xl overflow-hidden shadow-md border border-amber-200/50 dark:border-amber-900/40">
                        <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="w-full h-64 sm:h-80 object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    @endif
                    <div class="inline-block px-3 py-1 bg-amber-100 dark:bg-amber-950/80 text-amber-800 dark:text-amber-300 rounded-full text-xs font-bold uppercase tracking-wider mb-4 border border-amber-300/40">
                        {{ $service->category->name ?? 'Sacred Vedic Ritual' }}
                    </div>

                    <h1 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-amber-100 mb-3 font-heading">
                        {{ $service->title }}
                    </h1>

                    @if($service->subtitle)
                    <p class="text-base text-amber-800 dark:text-amber-300 font-medium mb-6">
                        {{ $service->subtitle }}
                    </p>
                    @endif

                    <!-- Highlight Badges -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 p-4 rounded-xl bg-orange-50/60 dark:bg-[#200c10] border border-orange-200 dark:border-amber-950 mb-8">
                        <div>
                            <span class="text-[10px] text-slate-500 dark:text-stone-400 uppercase tracking-wider block">Duration</span>
                            <span class="text-sm font-bold text-slate-800 dark:text-stone-200">{{ $service->duration ?? '1 Day' }}</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-slate-500 dark:text-stone-400 uppercase tracking-wider block">Chief Acharya</span>
                            <span class="text-sm font-bold text-slate-800 dark:text-stone-200">Pt. Tarkeshwar Dwivedi</span>
                        </div>
                        @if($service->dakshina_inr > 0)
                        <div>
                            <span class="text-[10px] text-slate-500 dark:text-stone-400 uppercase tracking-wider block">Dakshina</span>
                            <span class="text-sm font-bold text-amber-700 dark:text-amber-400">₹{{ number_format($service->dakshina_inr) }} @if($service->dakshina_usd > 0)/ ${{ number_format($service->dakshina_usd) }}@endif</span>
                        </div>
                        @endif
                    </div>

                    <!-- Mantra Box -->
                    @if($service->mantra_chanted)
                    <div class="p-6 rounded-xl bg-amber-50 dark:bg-[#220d11] border-l-4 border-amber-500 mb-8">
                        <span class="text-[11px] font-bold text-amber-800 dark:text-amber-300 uppercase tracking-wider block mb-1">
                            Consecrated Vedic Mantra & Chants
                        </span>
                        <p class="text-base sm:text-lg text-slate-800 dark:text-stone-200 italic leading-relaxed">
                            {{ $service->mantra_chanted }}
                        </p>
                    </div>
                    @endif

                    <!-- Detailed Description -->
                    <div class="rich-content prose max-w-none text-slate-700 dark:text-stone-300 text-sm leading-relaxed space-y-4">
                        {!! $service->detailed_desc ?: '<p>' . e($service->short_desc) . '</p>' !!}
                    </div>
                </div>

                <!-- Benefits & Spiritual Significance -->
                @if($service->benefits && is_array($service->benefits))
                <div class="bg-white dark:bg-[#16080b] p-8 rounded-2xl border border-slate-200 dark:border-amber-950 shadow-sm reveal-fade-up">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-amber-100 mb-6 flex items-center gap-2 font-heading">
                        <i class="fa fa-sparkles text-amber-500"></i>
                        Spiritual Merits & Life Transformations
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($service->benefits as $b)
                        <div class="flex items-start gap-3 p-3.5 rounded-lg bg-slate-50 dark:bg-[#200c10] border border-slate-100 dark:border-amber-950">
                            <i class="fa fa-check-circle text-amber-600 dark:text-amber-400 mt-0.5 text-sm"></i>
                            <span class="text-xs text-slate-700 dark:text-stone-300 leading-relaxed">{{ $b }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Samagri Details -->
                @if($service->samagri_details)
                <div class="bg-white dark:bg-[#16080b] p-8 rounded-2xl border border-slate-200 dark:border-amber-950 shadow-sm reveal-fade-up">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-amber-100 mb-4 flex items-center gap-2 font-heading">
                        <i class="fa fa-fire text-amber-500"></i>
                        Authentic Vedic Samagri Included
                    </h3>
                    <p class="text-xs text-slate-600 dark:text-stone-300 leading-relaxed">
                        {{ $service->samagri_details }}
                    </p>
                </div>
                @endif
            </div>

            <!-- Right Sidebar: Sacred Ashram Guidance & Direct Contact (No Book Now) -->
            <div class="space-y-6">
                <div class="bg-white dark:bg-[#16080b] p-6 sm:p-7 rounded-2xl border border-amber-200 dark:border-amber-950 shadow-md sticky top-28 reveal-fade-up">
                    <div class="w-12 h-12 rounded-full bg-amber-500/10 text-amber-500 flex items-center justify-center text-xl mb-4 border border-amber-500/20">
                        ❖
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-amber-100 mb-2 font-heading">
                        Vedic Guidance & Inquiries
                    </h3>
                    <p class="text-xs text-slate-600 dark:text-stone-300 leading-relaxed mb-6">
                        For auspicious Muhurta determination, Sankalp procedure, and consultation for <strong>{{ $service->title }}</strong>, you may connect directly with Pandit Tarkeshwar Dwivedi.
                    </p>

                    <!-- Direct Ashram Contact Details -->
                    <div class="space-y-3.5 pb-6 border-b border-slate-100 dark:border-stone-800 text-xs">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-amber-50 dark:bg-stone-800 flex items-center justify-center text-amber-600 dark:text-amber-400 shrink-0">
                                <i class="fa fa-phone"></i>
                            </span>
                            <div>
                                <span class="text-[10px] text-slate-400 dark:text-stone-500 block">Direct Phone</span>
                                <a href="tel:{{ $settings['contact_phone'] ?? '+918009767597' }}" class="font-bold text-slate-800 dark:text-amber-200 hover:text-amber-600">
                                    {{ $settings['contact_phone'] ?? '+91 8009767597' }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-950/50 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shrink-0">
                                <i class="fab fa-whatsapp"></i>
                            </span>
                            <div>
                                <span class="text-[10px] text-slate-400 dark:text-stone-500 block">WhatsApp Chat</span>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '918009767597') }}?text=Hari%20Om!%20I%20wish%20to%20know%20more%20about%20{{ urlencode($service->title) }}" target="_blank" class="font-bold text-emerald-600 dark:text-emerald-400 hover:underline">
                                    Chat with Panditji
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-amber-50 dark:bg-stone-800 flex items-center justify-center text-amber-600 dark:text-amber-400 shrink-0">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <div>
                                <span class="text-[10px] text-slate-400 dark:text-stone-500 block">Official Email</span>
                                <a href="mailto:{{ $settings['contact_email'] ?? 'tarkeshwardeep@gmail.com' }}" class="font-bold text-slate-800 dark:text-amber-200 hover:text-amber-600 break-all">
                                    {{ $settings['contact_email'] ?? 'tarkeshwardeep@gmail.com' }}
                                </a>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-lg bg-amber-50 dark:bg-stone-800 flex items-center justify-center text-amber-600 dark:text-amber-400 shrink-0">
                                <i class="fa fa-map-marker-alt"></i>
                            </span>
                            <div>
                                <span class="text-[10px] text-slate-400 dark:text-stone-500 block">Ashram Location</span>
                                <span class="font-medium text-slate-700 dark:text-stone-300 text-xs">
                                    ED2/60 ADA Colony Naini, Allahabad. (UP) India
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Direct Action Links (No Book Now) -->
                    <div class="pt-6 space-y-3">
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '918009767597') }}?text=Hari%20Om!%20I%20wish%20to%20know%20more%20about%20{{ urlencode($service->title) }}" target="_blank" class="btn-vedic-gold w-full text-center py-2.5 text-xs flex items-center justify-center gap-2">
                            <i class="fab fa-whatsapp text-sm"></i> Connect on WhatsApp
                        </a>
                        <a href="{{ route('contact') }}" class="btn-vedic-outline w-full text-center py-2.5 text-xs block dark:bg-[#1f0b10] dark:text-amber-300">
                            Ashram Contact Page →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
