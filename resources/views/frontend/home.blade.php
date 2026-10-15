@extends('layouts.frontend')

@section('title', $settings['meta_title'] ?? '108 Astro Yagya - Authentic Vedic Yagyas & Divine Astrology by Pandit Dwivedi')

@section('content')

<!-- ==========================================
     1. HERO BANNER SLIDER (AUTHENTIC SLIDES)
     ========================================== -->
<section class="hero-wrapper relative min-h-[540px] flex items-center overflow-hidden">
    <div class="w-full h-full relative">
        @forelse($sliders as $index => $slider)
        <div class="hero-slider-item {{ $index === 0 ? 'active' : '' }}" style="background: linear-gradient(90deg, rgba(17,5,7,0.88) 0%, rgba(17,5,7,0.55) 100%), url('{{ $slider->image_url }}') center/cover no-repeat;">
            <div class="hero-overlay"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-30 w-full">
                <div class="max-w-2xl text-white">
                    @if($slider->badge)
                    <span class="inline-block px-3.5 py-1 bg-amber-500 text-black font-bold text-xs uppercase tracking-wider rounded-md mb-3.5 shadow-md">
                        {{ $slider->badge }}
                    </span>
                    @endif
                    <h1 class="hero-title text-4xl sm:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                        {{ $slider->title }}
                    </h1>
                    @if($slider->subtitle)
                    <p class="hero-subtitle text-lg sm:text-xl text-amber-300 font-medium mb-4">
                        {{ $slider->subtitle }}
                    </p>
                    @endif
                    @if($slider->description)
                    <div class="hero-desc text-slate-200 text-sm sm:text-base mb-6 leading-relaxed">
                        {!! $slider->description !!}
                    </div>
                    @endif
                    <div class="flex flex-wrap items-center gap-3">
                        @if($slider->btn_primary_text)
                        <a href="{{ $slider->btn_primary_url ?: route('yagyas') }}" class="btn-vedic-gold">
                            <i class="fa fa-fire text-sm"></i>
                            <span>{{ $slider->btn_primary_text }}</span>
                        </a>
                        @endif
                        @if($slider->btn_secondary_text)
                        <a href="{{ $slider->btn_secondary_url ?: route('jyotish') }}" class="btn-vedic-outline bg-white/10 dark:bg-black/40 text-amber-300 border-amber-400/50 hover:bg-amber-500/20">
                            <span>{{ $slider->btn_secondary_text }}</span>
                            <i class="fa fa-arrow-right text-xs"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <!-- Fallback slide if none configured in admin -->
        <div class="hero-slider-item active" style="background: linear-gradient(90deg, rgba(17,5,7,0.88) 0%, rgba(17,5,7,0.55) 100%), url('{{ asset('images/1.jpg') }}') center/cover no-repeat;">
            <div class="hero-overlay"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-30 w-full">
                <div class="max-w-2xl text-white">
                    <span class="inline-block px-3.5 py-1 bg-amber-500 text-black font-bold text-xs uppercase tracking-wider rounded-md mb-3.5 shadow-md">
                        ✦ Sacred Vedic Fire Ceremonies
                    </span>
                    <h1 class="hero-title text-4xl sm:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                        Shardiy Navratri & Auspicious Vedic Yagyas
                    </h1>
                    <p class="hero-subtitle text-lg sm:text-xl text-amber-300 font-medium mb-4">
                        Conducted by Verified Vedic Pandits & Acharyas
                    </p>
                    <p class="hero-desc text-slate-200 text-sm sm:text-base mb-6 leading-relaxed">
                        Experience the transformative power of ancient Shukla Yajurvedic fire rituals, 108 Sacred Ahutis, and personalized Live Sankalp for health, wealth, and karmic obstacle removal.
                    </p>
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="{{ route('yagyas') }}" class="btn-vedic-gold">
                            <i class="fa fa-fire text-sm"></i>
                            <span>Explore Vedic Yagyas</span>
                        </a>
                        <a href="{{ route('jyotish') }}" class="btn-vedic-outline bg-white/10 dark:bg-black/40 text-amber-300 border-amber-400/50 hover:bg-amber-500/20">
                            <span>Vedic Jyotish Vidya</span>
                            <i class="fa fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Slider Navigation Buttons & Dots -->
    <div class="absolute bottom-6 left-0 right-0 z-30 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
        <div id="heroSliderDots" class="flex items-center gap-2"></div>
        <div class="flex items-center gap-2">
            <button id="heroPrevBtn" type="button" class="w-9 h-9 rounded-full border border-white/30 bg-black/50 text-white hover:bg-amber-500 hover:text-black flex items-center justify-center transition-all">
                <i class="fa fa-chevron-left text-xs"></i>
            </button>
            <button id="heroNextBtn" type="button" class="w-9 h-9 rounded-full border border-white/30 bg-black/50 text-white hover:bg-amber-500 hover:text-black flex items-center justify-center transition-all">
                <i class="fa fa-chevron-right text-xs"></i>
            </button>
        </div>
    </div>
</section>

<!-- ==========================================
     2. JAI GURU DEV PHILOSOPHY BANNER
     ========================================== -->
<section class="banner-jaigurudev">
    <div class="max-w-5xl mx-auto px-4 reveal-fade-up">
        <h2>* JAI GURU DEV *</h2>
        <h3 class="text-xl sm:text-2xl font-bold text-slate-800 dark:text-amber-200 mb-3">
            Vedic Jyotish Technology and the Science of Vedic Yagyas
        </h3>
        <p class="text-slate-600 dark:text-stone-300 text-base sm:text-lg italic leading-relaxed">
            "Vedic Yagyas neutralize negative influences and enhance success in Life presented by the Pandit Dwivedi Jyotish and Yagya Program. Our present destiny is shaped by our past actions and our actions will determine our future destiny."
        </p>
        <span class="block text-xs uppercase font-bold tracking-widest text-amber-700 dark:text-amber-400 mt-2">
            — Vedic Shastric Literature
        </span>
    </div>
</section>

<!-- ==========================================
     3. WELCOME MESSAGE FROM PANDIT DWIVEDI (.bg2)
     ========================================== -->
<section id="consultant-section" class="section-panditji">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            <!-- Panditji Photo -->
            <div class="lg:col-span-4 text-center reveal-fade-up">
                <div class="relative inline-block">
                    <img src="{{ asset('images/panditji.jpg') }}" alt="Pandit Tarkeshwar Dwivedi" class="rounded-2xl shadow-2xl border-4 border-amber-300 w-full max-w-[320px] mx-auto object-cover">
                    <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 bg-amber-950 text-amber-300 text-xs font-bold uppercase tracking-wider py-1.5 px-4 rounded-full border border-amber-400 shadow-lg whitespace-nowrap">
                        Pandit Tarkeshwar Dwivedi
                    </div>
                </div>
            </div>

            <!-- Welcome Message Text -->
            <div class="lg:col-span-8 reveal-fade-up">
                <span class="inline-block px-3 py-1 bg-amber-400/20 text-white border border-amber-300/40 font-bold text-xs uppercase tracking-wider rounded-md mb-3">
                    ✦ Personal Guarantee of Authentic Vedic Service
                </span>
                <h3 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                    Welcome Message from Pandit Dwivedi, 108astroyagya.com
                </h3>
                <div class="space-y-3.5 text-white/95 text-base leading-relaxed">
                    <p>
                        Warm wishes and welcome to our website! As a prospective client of our vedic astrology and yagya services, I want to give you my promise of excellent service. I have been coordinating yagyas for clients around the world with our esteemed vedic astrologer and pundits for more than 10 years.
                    </p>
                    <p>
                        I often participate in the yagyas in India and represent our international clients in the yagya performance. Our vedic pundits work closely with me to provide high quality service to our clients.
                    </p>
                    <p>
                        Our service is highly personalized. I am accessible to serve all your needs by email or phone within hours of your initial contact with us. Once you begin a jyotish or yagya program with us, you can expect comprehensive follow-up and attention to your complete satisfaction.
                    </p>
                    <p>
                        I warmly invite you to try our services and experience the transforming power of vedic astrology and yagya in your life. You have my personal guarantee that each yagya is authentic, complete and effective.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-white/20 flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <h4 class="text-xl font-bold text-amber-200">Jai Guru Dev</h4>
                        <p class="text-sm font-semibold text-white">Pandit Dwivedi</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('contact') }}" class="px-6 py-2.5 bg-white text-amber-800 hover:bg-amber-100 font-bold text-sm uppercase tracking-wider rounded-full shadow-md transition-all">
                            Consult Panditji Now
                        </a>
                        <a href="{{ route('testimonials') }}" class="px-6 py-2.5 bg-amber-700/60 hover:bg-amber-700 text-white font-bold text-sm uppercase tracking-wider rounded-full border border-white/30 transition-all">
                            Devotee Stories
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================
     4. THE 4 CORE VEDIC PILLARS (.bg1)
     ========================================== -->
<section id="what-is-vedic-yagya" class="section-pillars">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14 reveal-fade-up">
            <span class="section-tag">
                Foundations of Ancient Wisdom
            </span>
            <h2 class="section-title text-slate-900 dark:text-amber-100">
                The Science of Vedic Yagya & Jyotish
            </h2>
            <p class="section-subtitle dark:text-stone-300">
                Learn how cosmic sound vibration, Vedic fire rituals, and planetary charts bring health, prosperity, and spiritual evolution.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Pillar 1: What is Vedic Yagya -->
            <div class="pillar-card reveal-fade-up">
                <div>
                    <img src="{{ asset('images/ve.jpg') }}" alt="What is Vedic Yagya">
                    <h4 class="dark:text-amber-100">What Is Vedic Yagya</h4>
                    <p class="dark:text-stone-300">
                        The Sanskrit word "Yagya" originated from the Sanskrit root YAJ = to sacrifice. A sacred Vedic combination to counteract negative karma and awaken divine protection.
                    </p>
                </div>
                <a href="{{ route('yagyas') }}" class="btn-vedic-outline w-full text-center mt-3">
                    View Yagyas Page →
                </a>
            </div>

            <!-- Pillar 2: Parts of Vedic Yagya -->
            <div id="parts-of-vedic-yagya" class="pillar-card reveal-fade-up">
                <div>
                    <img src="{{ asset('images/part.jpg') }}" alt="Parts of Vedic Yagya">
                    <h4 class="dark:text-amber-100">Parts of Vedic Yagya</h4>
                    <p class="dark:text-stone-300">
                        Comprising Gotra Sankalp, Mantra Japa, 108 Sacred Ahutis into holy fire, and Purnahuti. Sound moves in the cosmos and influences destiny.
                    </p>
                </div>
                <a href="{{ route('yagyas') }}" class="btn-vedic-outline w-full text-center mt-3">
                    View Ritual Vidhi →
                </a>
            </div>

            <!-- Pillar 3: Vedic Yagya Effects -->
            <div id="vedic-yagya-effects" class="pillar-card reveal-fade-up">
                <div>
                    <img src="{{ asset('images/efect.jpg') }}" alt="Vedic Yagya effects">
                    <h4 class="dark:text-amber-100">Vedic Yagya Effects</h4>
                    <p class="dark:text-stone-300">
                        The effect of a Vedic Yagya varies depending on personal Karma and planetary dasha cycles. Yagyas provide supreme remedial support and shielding.
                    </p>
                </div>
                <a href="{{ route('yagyas') }}" class="btn-vedic-outline w-full text-center mt-3">
                    Read Yagya Science →
                </a>
            </div>

            <!-- Pillar 4: The Jyotish Services -->
            <div id="the-jyotish-services" class="pillar-card reveal-fade-up">
                <div>
                    <img src="{{ asset('images/jyo.jpg') }}" alt="The Jyotish Services">
                    <h4 class="dark:text-amber-100">The Jyotish Services</h4>
                    <p class="dark:text-stone-300">
                        Once Pandit Dwivedi receives your birth data, he will cast a precise chart of the heavens for your birth time and place to determine planetary remedies.
                    </p>
                </div>
                <a href="{{ route('jyotish') }}" class="btn-vedic-outline w-full text-center mt-3">
                    View Jyotish Page →
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ==========================================
     5. FEATURED SACRED YAGYAS (.news)
     ========================================== -->
<section id="yagyas-section" class="py-20 bg-white dark:bg-[#0b0305]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14 reveal-fade-up">
            <span class="section-tag">
                Sacred Fire Ceremonies
            </span>
            <h2 class="section-title text-slate-900 dark:text-amber-100">
                Featured Vedic Yagyas
            </h2>
            <p class="section-subtitle dark:text-stone-300">
                All Yagyas are performed under the expert direction of Pandit Dwivedi with lifetime-trained Vedic scholars.
            </p>
        </div>

        <div class="space-y-12">
            <!-- 1. Planetary Yagyas -->
            <div id="graha-shanti-yagya" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center p-8 bg-orange-50/50 dark:bg-[#16080b] rounded-2xl border border-orange-200 dark:border-amber-950 reveal-fade-up">
                <div class="lg:col-span-8">
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-700 dark:text-amber-300 bg-amber-100 dark:bg-amber-950/80 px-3 py-1 rounded-md">
                        Planetary Remedial Service
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-amber-100 mt-2 mb-3">
                        Planetary Yagyas (Graha Shanti)
                    </h3>
                    <p class="text-slate-600 dark:text-stone-300 text-base leading-relaxed mb-4">
                        The performance of a planetary yagya creates positive influence from a specific planet (Sun, Moon, Mars, Mercury, Jupiter, Saturn, Rahu, Ketu). Planetary Yagyas neutralize negative and strengthen positive influence from the lords of the dashas or transits.
                    </p>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('yagyas') }}" class="btn-vedic-gold">
                            <span>Explore Planetary Yagya</span>
                            <i class="fa fa-arrow-right text-xs"></i>
                        </a>
                        <a href="{{ route('yagyas') }}" class="btn-vedic-outline dark:bg-[#1e0a0e]">
                            <span>All Yagya Types</span>
                        </a>
                    </div>
                </div>
                <div class="lg:col-span-4">
                    <img src="{{ asset('images/img1.jpg') }}" alt="Planetary Yagyas" class="rounded-xl shadow-lg w-full h-64 object-cover">
                </div>
            </div>

            <!-- 2. Birthday Yagya -->
            <div id="birthday-yagya" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center p-8 bg-amber-50/40 dark:bg-[#16080b] rounded-2xl border border-amber-200 dark:border-amber-950 reveal-fade-up">
                <div class="lg:col-span-8 lg:order-1">
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-700 dark:text-amber-300 bg-amber-100 dark:bg-amber-950/80 px-3 py-1 rounded-md">
                        Annual Auspicious Blessing
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-amber-100 mt-2 mb-3">
                        Birthday Yagya (Janmadin Sankalp)
                    </h3>
                    <p class="text-slate-600 dark:text-stone-300 text-base leading-relaxed mb-4">
                        Birthday yagya sets a positive tone for your coming year. Done on the exact date of birth to bestow health, longevity, and spiritual protection against unseen hurdles.
                    </p>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('yagyas') }}" class="btn-vedic-gold">
                            <span>Explore Birthday Yagya</span>
                            <i class="fa fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
                <div class="lg:col-span-4 lg:order-2">
                    <img src="{{ asset('images/yagya.jpg') }}" alt="Birthday Yagya" class="rounded-xl shadow-lg w-full h-64 object-cover">
                </div>
            </div>

            <!-- 3. Divine Yagya -->
            <div id="divine-yagya" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center p-8 bg-orange-50/50 dark:bg-[#16080b] rounded-2xl border border-orange-200 dark:border-amber-950 reveal-fade-up">
                <div class="lg:col-span-8">
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-700 dark:text-amber-300 bg-amber-100 dark:bg-amber-950/80 px-3 py-1 rounded-md">
                        Supreme Mother Divine Rite
                    </span>
                    <h3 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-amber-100 mt-2 mb-3">
                        Mother Divine Yagya (Chandi & Durga Saptashati)
                    </h3>
                    <p class="text-slate-600 dark:text-stone-300 text-base leading-relaxed mb-4">
                        Mother divine yagya is a very unique and rare ritual. Done as an act of great merit, it brings immense blessings from the divine mother and bestows immense spiritual energy. Even the greatest hardships can be conquered.
                    </p>
                    <a href="{{ route('yagyas') }}" class="btn-vedic-gold">
                        <span>Explore Divine Yagya</span>
                        <i class="fa fa-arrow-right text-xs"></i>
                    </a>
                </div>
                <div class="lg:col-span-4">
                    <img src="{{ asset('images/divine.jpg') }}" alt="Mother Divine Yagya" class="rounded-xl shadow-lg w-full h-64 object-cover">
                </div>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('yagyas') }}" class="btn-vedic-outline px-8 py-3 text-sm">
                View Entire Vedic Yagyas Catalog & Vidhi →
            </a>
        </div>
    </div>
</section>

<!-- ==========================================
     6. KUNDLI & JYOTISH SERVICES SHOWCASE
     ========================================== -->
<section id="jyotish-section" class="py-20 bg-slate-50 dark:bg-[#120608] border-t border-amber-200/40 dark:border-amber-950/40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14 reveal-fade-up">
            <span class="section-tag">
                Precision Vedic Astrology
            </span>
            <h2 class="section-title text-slate-900 dark:text-amber-100">
                Comprehensive Jyotish Services
            </h2>
            <p class="section-subtitle dark:text-stone-300">
                Cast your planetary chart to uncover life patterns, compatibility, auspicious timings, and personalized remedial measures.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-[#18080b] p-6 rounded-xl border border-slate-200 dark:border-amber-950 shadow-sm hover:border-amber-500 hover:shadow-md transition-all reveal-fade-up">
                <div class="w-12 h-12 rounded-lg bg-orange-100 dark:bg-amber-950/60 text-orange-600 dark:text-amber-400 flex items-center justify-center text-xl mb-4">
                    <i class="fa fa-chart-pie"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-800 dark:text-amber-100 mb-2 font-heading">Full Birth Chart Reading</h4>
                <p class="text-slate-600 dark:text-stone-300 text-sm leading-relaxed mb-4">
                    Complete analysis of your 12 bhavas, Dasha timeline, Lagna, and planetary strengths with remedial guidance.
                </p>
                <a href="{{ route('jyotish') }}" class="text-amber-600 dark:text-amber-400 font-bold text-xs uppercase tracking-wider hover:underline">
                    View Details on Jyotish Page →
                </a>
            </div>

            <div class="bg-white dark:bg-[#18080b] p-6 rounded-xl border border-slate-200 dark:border-amber-950 shadow-sm hover:border-amber-500 hover:shadow-md transition-all reveal-fade-up">
                <div class="w-12 h-12 rounded-lg bg-orange-100 dark:bg-amber-950/60 text-orange-600 dark:text-amber-400 flex items-center justify-center text-xl mb-4">
                    <i class="fa fa-heart"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-800 dark:text-amber-100 mb-2 font-heading">Compatibility (Kundli Milan)</h4>
                <p class="text-slate-600 dark:text-stone-300 text-sm leading-relaxed mb-4">
                    Ashtakoot Guna Milan for marital compatibility, Nadi dosha analysis, and spiritual harmony between couples.
                </p>
                <a href="{{ route('jyotish') }}" class="text-amber-600 dark:text-amber-400 font-bold text-xs uppercase tracking-wider hover:underline">
                    Match Kundlis →
                </a>
            </div>

            <div class="bg-white dark:bg-[#18080b] p-6 rounded-xl border border-slate-200 dark:border-amber-950 shadow-sm hover:border-amber-500 hover:shadow-md transition-all reveal-fade-up">
                <div class="w-12 h-12 rounded-lg bg-orange-100 dark:bg-amber-950/60 text-orange-600 dark:text-amber-400 flex items-center justify-center text-xl mb-4">
                    <i class="fa fa-clock"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-800 dark:text-amber-100 mb-2 font-heading">Muhurta (Auspicious Time)</h4>
                <p class="text-slate-600 dark:text-stone-300 text-sm leading-relaxed mb-4">
                    Identification of the perfect planetary alignment for weddings, Griha Pravesh, new business launches, and rituals.
                </p>
                <a href="{{ route('jyotish') }}" class="text-amber-600 dark:text-amber-400 font-bold text-xs uppercase tracking-wider hover:underline">
                    Find Muhurta →
                </a>
            </div>

            <div class="bg-white dark:bg-[#18080b] p-6 rounded-xl border border-slate-200 dark:border-amber-950 shadow-sm hover:border-amber-500 hover:shadow-md transition-all reveal-fade-up">
                <div class="w-12 h-12 rounded-lg bg-orange-100 dark:bg-amber-950/60 text-orange-600 dark:text-amber-400 flex items-center justify-center text-xl mb-4">
                    <i class="fa fa-hourglass-half"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-800 dark:text-amber-100 mb-2 font-heading">Birth Time Rectification</h4>
                <p class="text-slate-600 dark:text-stone-300 text-sm leading-relaxed mb-4">
                    Precise minute-by-minute calibration of uncertain birth times through life event cross-verification.
                </p>
                <a href="{{ route('jyotish') }}" class="text-amber-600 dark:text-amber-400 font-bold text-xs uppercase tracking-wider hover:underline">
                    Rectify Time →
                </a>
            </div>

            <div class="bg-white dark:bg-[#18080b] p-6 rounded-xl border border-slate-200 dark:border-amber-950 shadow-sm hover:border-amber-500 hover:shadow-md transition-all reveal-fade-up">
                <div class="w-12 h-12 rounded-lg bg-orange-100 dark:bg-amber-950/60 text-orange-600 dark:text-amber-400 flex items-center justify-center text-xl mb-4">
                    <i class="fa fa-gem"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-800 dark:text-amber-100 mb-2 font-heading">Gemstone Recommendation</h4>
                <p class="text-slate-600 dark:text-stone-300 text-sm leading-relaxed mb-4">
                    Identify your favorable Vedic Ratna (Ruby, Yellow Sapphire, Emerald, Blue Sapphire) aligned with your Lagna.
                </p>
                <a href="{{ route('jyotish') }}" class="text-amber-600 dark:text-amber-400 font-bold text-xs uppercase tracking-wider hover:underline">
                    Get Gem Advice →
                </a>
            </div>

            <div class="bg-white dark:bg-[#18080b] p-6 rounded-xl border border-slate-200 dark:border-amber-950 shadow-sm hover:border-amber-500 hover:shadow-md transition-all reveal-fade-up">
                <div class="w-12 h-12 rounded-lg bg-orange-100 dark:bg-amber-950/60 text-orange-600 dark:text-amber-400 flex items-center justify-center text-xl mb-4">
                    <i class="fa fa-question-circle"></i>
                </div>
                <h4 class="text-xl font-bold text-slate-800 dark:text-amber-100 mb-2 font-heading">Prashna (Specific Query)</h4>
                <p class="text-slate-600 dark:text-stone-300 text-sm leading-relaxed mb-4">
                    Horary astrology for urgent immediate life questions concerning career choices, health crises, or decisions.
                </p>
                <a href="{{ route('jyotish') }}" class="text-amber-600 dark:text-amber-400 font-bold text-xs uppercase tracking-wider hover:underline">
                    Ask Question →
                </a>
            </div>
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('jyotish') }}" class="btn-vedic-gold px-8 py-3 text-sm">
                Explore Dedicated Vedic Jyotish Portal →
            </a>
        </div>
    </div>
</section>

<!-- ==========================================
     7. DEVOTEE TESTIMONIALS (REDESIGNED CARDS)
     ========================================== -->
<section id="testimonials-section" class="py-20 bg-amber-50/40 dark:bg-[#0b0305] border-t border-amber-200/30 dark:border-amber-950/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14 reveal-fade-up">
            <span class="section-tag">
                ✦ Sacred Transformations & Reviews
            </span>
            <h2 class="section-title text-slate-900 dark:text-amber-100">
                Devotee Experiences from Around the World
            </h2>
            <p class="section-subtitle dark:text-stone-300">
                Hear how devotees from India, the USA, the UK, Germany, and Switzerland experienced profound peace and relief through Pandit Dwivedi's Vedic guidance.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($testimonials->take(3) as $testi)
            <div class="testimonial-story-card bg-white dark:bg-[#16080b] border border-amber-200/70 dark:border-amber-950/70 rounded-2xl p-6 sm:p-7 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 flex flex-col justify-between reveal-fade-up">
                <div>
                    <!-- Top Author Profile Bar -->
                    <div class="flex items-start gap-4 pb-4 border-b border-slate-100 dark:border-stone-800">
                        <img src="{{ $testi->avatar_url }}" alt="{{ $testi->client_name }}" class="w-14 h-14 rounded-full object-cover border-2 border-amber-500 shadow-sm shrink-0">
                        <div>
                            <div class="flex items-center gap-1.5 flex-wrap">
                                <h3 class="font-bold text-base text-slate-900 dark:text-amber-100 font-heading leading-tight">{{ $testi->client_name }}</h3>
                                @if($testi->is_verified)
                                <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-950/80 text-emerald-800 dark:text-emerald-400 text-[9px] font-bold">
                                    <i class="fa fa-check-circle"></i> Verified
                                </span>
                                @endif
                            </div>
                            <p class="text-xs text-amber-600 dark:text-amber-400 font-semibold flex items-center gap-1 mt-0.5">
                                <i class="fa fa-map-marker-alt text-[10px]"></i> {{ $testi->location }}
                            </p>
                        </div>
                    </div>

                    <!-- Ritual Badge -->
                    <div class="my-3">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-amber-50 dark:bg-[#220d11] text-amber-800 dark:text-amber-300 text-xs font-semibold border border-amber-200 dark:border-amber-900/50">
                            <i class="fa fa-fire text-amber-500 text-[10px]"></i> {{ $testi->service_taken ?: 'Vedic Yagya & Consultation' }}
                        </span>
                    </div>

                    <!-- Rating Stars -->
                    <div class="flex items-center gap-1 text-amber-400 text-xs mb-3">
                        @for($i = 0; $i < ($testi->rating ?: 5); $i++)
                        <i class="fa fa-star"></i>
                        @endfor
                        <span class="text-[11px] font-bold text-slate-500 dark:text-stone-400 ml-1">5.0 Star</span>
                    </div>

                    <!-- Quote -->
                    <blockquote class="text-sm text-slate-700 dark:text-stone-300 leading-relaxed italic line-clamp-4">
                        "{!! Str::limit(strip_tags($testi->review_text), 180) !!}"
                    </blockquote>
                </div>

                <div class="pt-4 border-t border-slate-100 dark:border-stone-800 mt-4 flex items-center justify-between text-xs text-slate-500 dark:text-stone-400">
                    <span class="text-amber-600 dark:text-amber-400 font-bold">
                        ✦ Sankalp Fulfilled
                    </span>
                    <a href="{{ route('testimonials') }}" class="hover:underline font-semibold text-slate-700 dark:text-amber-300">
                        Read Story →
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('testimonials') }}" class="btn-vedic-outline px-8 py-3 text-sm">
                View All Devotee Transformations & Reviews →
            </a>
        </div>
    </div>
</section>

<!-- ==========================================
     8. LIVE SANKALP & INQUIRY BOOKING FORM
     ========================================== -->
<section id="booking-section" class="py-20 bg-white dark:bg-[#0b0305] border-t border-slate-200 dark:border-amber-950/50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 reveal-fade-up">
            <span class="section-tag">
                Live Sankalp Registration
            </span>
            <h2 class="section-title text-slate-900 dark:text-amber-100">
                Book Your Sacred Yagya or Consultation
            </h2>
            <p class="section-subtitle dark:text-stone-300">
                Fill in your birth details. Pandit Dwivedi will personally review your planetary chart and coordinate your live fire ritual.
            </p>
        </div>

        <div class="booking-form-box reveal-fade-up">
            <!-- Alert Box -->
            <div id="inquiryAlertBox" class="hidden mb-6"></div>

            <form id="vedicInquiryForm" action="{{ route('inquiry.submit') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">
                            Your Full Name <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" name="full_name" required class="form-input-vedic" placeholder="e.g. Rahul Sharma">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">
                            Email Address <span class="text-rose-500">*</span>
                        </label>
                        <input type="email" name="email" required class="form-input-vedic" placeholder="e.g. rahul@example.com">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">
                            Phone / Mobile <span class="text-rose-500">*</span>
                        </label>
                        <input type="tel" name="phone" required class="form-input-vedic" placeholder="+91 98765 43210">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">
                            WhatsApp Number
                        </label>
                        <input type="text" name="whatsapp" class="form-input-vedic" placeholder="For live updates">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">
                            Inquiry Type <span class="text-rose-500">*</span>
                        </label>
                        <select name="inquiry_type" required class="form-input-vedic">
                            <option value="yagya_booking">Sacred Vedic Yagya Booking</option>
                            <option value="jyotish_consultation">Personal Jyotish Consultation</option>
                            <option value="kundli_analysis">Complete Janam Kundli Reading</option>
                            <option value="general">General Inquiry</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">
                            Gotra (If known)
                        </label>
                        <input type="text" name="gotra" class="form-input-vedic" placeholder="e.g. Kashyap, Vashistha">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">
                            Date of Birth
                        </label>
                        <input type="date" name="date_of_birth" class="form-input-vedic">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">
                            Time of Birth
                        </label>
                        <input type="text" name="time_of_birth" class="form-input-vedic" placeholder="e.g. 06:45 AM">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">
                            Place of Birth (City, State, Country)
                        </label>
                        <input type="text" name="place_of_birth" class="form-input-vedic" placeholder="e.g. Varanasi, UP, India">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">
                            Select Yagya or Service of Interest
                        </label>
                        <select name="service_id" id="serviceSelectField" class="form-input-vedic">
                            <option value="">-- General Vedic Jyotish Consultation --</option>
                            @foreach($featuredServices as $srv)
                            <option value="{{ $srv->id }}">{{ $srv->title }} (₹{{ number_format($srv->price) }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">
                            Specific Sankalp Concern or Life Challenge
                        </label>
                        <textarea name="problem_description" rows="4" class="form-input-vedic" placeholder="Please describe any health, financial, marriage, or planetary obstacles you wish to resolve..."></textarea>
                    </div>
                </div>

                <div class="text-center pt-2">
                    <button id="inquirySubmitBtn" type="submit" class="btn-vedic-gold w-full sm:w-auto px-10 py-3 text-base">
                        <span>Submit Sacred Sankalp Request</span>
                        <i class="fa fa-paper-plane text-xs"></i>
                    </button>
                    <p class="text-xs text-slate-500 dark:text-stone-400 mt-3">
                        🔒 All information is held in strict Vedic confidentiality and personally reviewed by Pandit Dwivedi.
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
