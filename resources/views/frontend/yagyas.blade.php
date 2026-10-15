@extends('layouts.frontend')

@section('title', 'Authentic Vedic Yagyas & Havans | 108 Astro Yagya')
@section('meta_description', 'Experience authentic Vedic Yagyas with 108 sacred Ahutis performed by verified Kashi and Himalayan Pandits. Planetary Navagraha, Mahamrityunjaya, and Live Sankalp.')

@section('content')
<!-- Page Hero Banner -->
<section class="relative bg-gradient-to-b from-stone-950 to-black text-white py-20 md:py-28 overflow-hidden">
    <div class="absolute inset-0 opacity-35 bg-cover bg-center" style="background-image: url('{{ asset('images/yagya.jpg') }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/75 to-transparent"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/20 border border-amber-400/40 text-amber-300 text-xs uppercase font-bold tracking-widest mb-4 backdrop-blur-sm animate-pulse">
                ✦ Agnihotra & 108 Sacred Ahutis
            </span>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-heading font-extrabold text-white mb-6 leading-tight">
                Authentic Vedic Yagyas & Fire Ceremonies
            </h1>
            <p class="text-lg md:text-xl text-stone-300 font-light leading-relaxed mb-8">
                Yagya is the supreme remedial technology taught in the Vedas to dissolve past karmic impurities, balance afflicted planetary forces, and invite divine blessings into your life and family.
            </p>
            <div class="flex flex-wrap items-center gap-4">
                <a href="#yagya-booking" class="btn-vedic-gold">
                    <i class="fa fa-fire text-xs"></i>
                    <span>Book Live Gotra Sankalp</span>
                </a>
                <a href="#yagya-catalog" class="btn-vedic-outline bg-white/10 dark:bg-black/30 text-amber-300 border-amber-400/50 hover:bg-amber-500/20">
                    <i class="fa fa-list text-xs"></i>
                    <span>Browse All Yagyas</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- The 4 Classical Pillars of Vedic Yagya (from 108astroyagya.com) -->
<section class="py-20 bg-stone-50 dark:bg-[#120608] border-b border-amber-200/40 dark:border-amber-900/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal-fade-up">
            <span class="section-tag">✦ Ancient Vedic Science</span>
            <h2 class="section-title text-slate-900 dark:text-amber-100">
                Understanding the Sacred Architecture of Yagya
            </h2>
            <p class="section-subtitle dark:text-stone-300">
                A Yagya is not merely a ritual; it is a cosmic quantum technology utilizing sonic sound waves (Mantra), sacred fire (Agni), and biological herbs (Havan Samagri) to reorder consciousness.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Pillar 1 -->
            <div class="pillar-card dark:bg-[#18080b] dark:border-amber-950/60 reveal-fade-up">
                <div>
                    <img src="{{ asset('images/ve.jpg') }}" alt="What is Vedic Yagya">
                    <h3 class="text-xl font-bold font-heading text-slate-800 dark:text-amber-200 mb-2">What is Vedic Yagya</h3>
                    <p class="dark:text-stone-300">
                        According to the Vedic philosophy of Karma, our present suffering stems from past impressions. Yagya provides the highest counteracting force to seed auspicious future destiny.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 dark:border-stone-800">
                    <span class="text-xs font-bold text-amber-600 dark:text-amber-400 uppercase tracking-wider">Karma Dissolution</span>
                </div>
            </div>

            <!-- Pillar 2 -->
            <div class="pillar-card dark:bg-[#18080b] dark:border-amber-950/60 reveal-fade-up">
                <div>
                    <img src="{{ asset('images/part.jpg') }}" alt="Parts of Vedic Yagya">
                    <h3 class="text-xl font-bold font-heading text-slate-800 dark:text-amber-200 mb-2">Parts of Vedic Yagya</h3>
                    <p class="dark:text-stone-300">
                        Comprising Sankalp (sacred vow with seeker's Gotra and Nakshatra), Japa (chanted repetitions), Homa (108 sacred offerings into holy fire), and Purnahuti.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 dark:border-stone-800">
                    <span class="text-xs font-bold text-amber-600 dark:text-amber-400 uppercase tracking-wider">4 Sacred Stages</span>
                </div>
            </div>

            <!-- Pillar 3 -->
            <div class="pillar-card dark:bg-[#18080b] dark:border-amber-950/60 reveal-fade-up">
                <div>
                    <img src="{{ asset('images/efect.jpg') }}" alt="Vedic Yagya Effects">
                    <h3 class="text-xl font-bold font-heading text-slate-800 dark:text-amber-200 mb-2">Vedic Yagya Effects</h3>
                    <p class="dark:text-stone-300">
                        The beneficial vibrations travel through cosmic ether directly to the beneficiary, harmonizing hostile planetary dashas and protecting family lineage.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 dark:border-stone-800">
                    <span class="text-xs font-bold text-amber-600 dark:text-amber-400 uppercase tracking-wider">Planetary Harmony</span>
                </div>
            </div>

            <!-- Pillar 4 -->
            <div class="pillar-card dark:bg-[#18080b] dark:border-amber-950/60 reveal-fade-up">
                <div>
                    <img src="{{ asset('images/divine.jpg') }}" alt="Mother Divine Yagya">
                    <h3 class="text-xl font-bold font-heading text-slate-800 dark:text-amber-200 mb-2">Mother Divine Yagya</h3>
                    <p class="dark:text-stone-300">
                        Specialized Chandi Path, Durga Saptashati, and Sri Suktam ceremonies invoke supreme feminine grace for ultimate obstacle removal and prosperity.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 dark:border-stone-800">
                    <span class="text-xs font-bold text-amber-600 dark:text-amber-400 uppercase tracking-wider">Divine Protection</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filterable Yagya Catalog -->
<section id="yagya-catalog" class="py-20 bg-white dark:bg-[#0b0305]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14 reveal-fade-up">
            <span class="section-tag">✦ Sacred Ceremonies & Havans</span>
            <h2 class="section-title text-slate-900 dark:text-amber-100">
                Vedic Yagya Repository
            </h2>
            <p class="section-subtitle dark:text-stone-300">
                Conducted with pure cow ghee (Gau Ghrita), sacred wood (Samidha), and rare Himalayan herbs at our Dashashwamedh Ghat Ashram in Varanasi.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($yagyas as $yagya)
            <a href="{{ route('service.detail', $yagya->slug) }}" class="service-card dark:bg-[#17080b] dark:border-amber-950/60 reveal-fade-up group block hover:border-amber-500/60 transition-all duration-300 hover:-translate-y-1">
                <div class="service-card-header overflow-hidden">
                    <img src="{{ $yagya->image_url }}" alt="{{ $yagya->title }}" class="group-hover:scale-105 transition-transform duration-500">
                    <span class="service-category-badge">
                        {{ $yagya->category->name ?? 'Sacred Yagya' }}
                    </span>
                </div>
                <div class="service-card-body flex flex-col justify-between">
                    <div>
                        <h3 class="service-title group-hover:text-amber-500 dark:group-hover:text-amber-400 transition-colors">
                            {{ $yagya->title }}
                        </h3>
                        <p class="service-desc dark:text-stone-300">
                            {{ Str::limit(strip_tags($yagya->short_desc ?: $yagya->detailed_desc), 140) }}
                        </p>
                    </div>

                    @if($yagya->duration)
                    <div class="pt-3 border-t border-slate-100 dark:border-stone-800/80 flex items-center justify-between text-xs text-slate-500 dark:text-stone-400">
                        <span><i class="fa fa-clock text-amber-500 mr-1"></i> {{ $yagya->duration }}</span>
                        <span class="text-amber-600 dark:text-amber-400 font-semibold group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">
                            Read Vidhi <i class="fa fa-arrow-right text-[10px]"></i>
                        </span>
                    </div>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- How Remote Live Sankalp Operates -->
<section class="py-16 bg-amber-50/60 dark:bg-[#120608] border-y border-amber-200/40 dark:border-amber-950/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12 reveal-fade-up">
            <span class="section-tag">✦ Remote Participation</span>
            <h2 class="section-title text-slate-900 dark:text-amber-100">
                How Live Sankalp Works for Devotees Worldwide
            </h2>
            <p class="section-subtitle dark:text-stone-300">
                You do not need to be physically in Varanasi to reap the complete spiritual merit. The Shastras sanction remote representation through sacred Gotra Sankalp.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="p-6 rounded-2xl bg-white dark:bg-[#18080b] border border-amber-200 dark:border-amber-950 shadow-sm text-center reveal-fade-up">
                <div class="w-12 h-12 rounded-full bg-amber-100 dark:bg-amber-900/40 text-amber-600 dark:text-amber-300 flex items-center justify-center font-bold text-lg mx-auto mb-4">
                    1
                </div>
                <h3 class="font-bold text-base text-slate-800 dark:text-amber-200 mb-2 font-heading">Register Birth Details</h3>
                <p class="text-xs text-slate-600 dark:text-stone-300 leading-relaxed">
                    Submit your full name, Gotra, birth date, and specific intention or challenge.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white dark:bg-[#18080b] border border-amber-200 dark:border-amber-950 shadow-sm text-center reveal-fade-up">
                <div class="w-12 h-12 rounded-full bg-amber-100 dark:bg-amber-900/40 text-amber-600 dark:text-amber-300 flex items-center justify-center font-bold text-lg mx-auto mb-4">
                    2
                </div>
                <h3 class="font-bold text-base text-slate-800 dark:text-amber-200 mb-2 font-heading">Auspicious Muhurta</h3>
                <p class="text-xs text-slate-600 dark:text-stone-300 leading-relaxed">
                    Our Acharyas calculate the precise planetary day and hora for peak spiritual potency.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white dark:bg-[#18080b] border border-amber-200 dark:border-amber-950 shadow-sm text-center reveal-fade-up">
                <div class="w-12 h-12 rounded-full bg-amber-100 dark:bg-amber-900/40 text-amber-600 dark:text-amber-300 flex items-center justify-center font-bold text-lg mx-auto mb-4">
                    3
                </div>
                <h3 class="font-bold text-base text-slate-800 dark:text-amber-200 mb-2 font-heading">Live HD Streaming</h3>
                <p class="text-xs text-slate-600 dark:text-stone-300 leading-relaxed">
                    Watch the sacred ceremony in real-time on private YouTube / Zoom and chant your Gotra Sankalp.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white dark:bg-[#18080b] border border-amber-200 dark:border-amber-950 shadow-sm text-center reveal-fade-up">
                <div class="w-12 h-12 rounded-full bg-amber-100 dark:bg-amber-900/40 text-amber-600 dark:text-amber-300 flex items-center justify-center font-bold text-lg mx-auto mb-4">
                    4
                </div>
                <h3 class="font-bold text-base text-slate-800 dark:text-amber-200 mb-2 font-heading">Prasad & Yantra Courier</h3>
                <p class="text-xs text-slate-600 dark:text-stone-300 leading-relaxed">
                    Blessed holy Bhasma (Vibhuti), energized copper Yantra, and Raksha Sutra couriered to your doorstep.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Direct Yagya Sankalp Booking Form -->
<section id="yagya-booking" class="py-20 bg-white dark:bg-[#0b0305]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="booking-form-box dark:bg-[#16080b] dark:border-amber-900/50 reveal-fade-up">
            <div class="text-center mb-10">
                <span class="section-tag">✦ Sacred Gotra Sankalp</span>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-amber-100 font-heading mb-2">
                    Vedic Yagya Inquiry & Consultation
                </h2>
                <p class="text-sm text-slate-600 dark:text-stone-300">
                    Connect directly with Pandit Tarkeshwar Dwivedi for personal horoscope review, auspicious Muhurta guidance, and private live stream coordinates.
                </p>
            </div>

            <div id="inquiryAlertBox" class="hidden"></div>

            <form id="vedicInquiryForm" action="{{ route('inquiry.submit') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="inquiry_type" value="yagya_booking">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Yajamana (Beneficiary) Full Name *</label>
                        <input type="text" name="full_name" required placeholder="Full Name as per Kundli" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Email for Live Stream Link *</label>
                        <input type="email" name="email" required placeholder="name@example.com" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Mobile Number *</label>
                        <input type="text" name="phone" required placeholder="+91 98765 43210" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">WhatsApp Number</label>
                        <input type="text" name="whatsapp" placeholder="For live ceremony updates" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Select Sacred Yagya *</label>
                        <select name="service_id" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                            <option value="">-- Choose Desired Yagya Ceremony --</option>
                            @foreach($yagyas as $y)
                            <option value="{{ $y->id }}">{{ $y->title }} (₹{{ number_format($y->price) }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Gotra & Family Lineage</label>
                        <input type="text" name="gotra" placeholder="e.g. Kashyap, Bhardwaj, Parashar" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Place of Birth</label>
                        <input type="text" name="place_of_birth" placeholder="City, State" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Preferred Ritual Date</label>
                        <input type="date" name="preferred_date" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Specific Sankalp / Intention</label>
                    <textarea name="problem_description" rows="4" placeholder="Detail your prayer intention (Health, Overcoming Negative Karma, Debt Relief, Marriage Harmony, Peace)..." class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100"></textarea>
                </div>

                <div class="text-center pt-4">
                    <button id="inquirySubmitBtn" type="submit" class="btn-vedic-gold w-full md:w-auto px-10 py-3.5 text-base shadow-xl">
                        <span>Submit Sacred Sankalp Inquiry</span>
                        <i class="fa fa-envelope ml-2"></i>
                    </button>
                    <p class="text-xs text-slate-500 dark:text-stone-400 mt-3">
                        ✦ Authentic Vedic Mantras chanted with complete purity by Himalayan scholars.
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
