@extends('layouts.frontend')

@section('title', 'Vedic Jyotish & Kundli Consultation | 108 Astro Yagya')
@section('meta_description', 'Get authentic Janam Kundli analysis, Horoscope reading, Kundli Milan, and Prashna Jyotish from revered Kashi Vedic Astrologers.')

@section('content')
<!-- Page Hero Banner -->
<section class="relative bg-gradient-to-b from-stone-900 to-black text-white py-20 md:py-28 overflow-hidden">
    <div class="absolute inset-0 opacity-30 bg-cover bg-center" style="background-image: url('{{ asset('images/jyo.jpg') }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/75 to-transparent"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/20 border border-amber-400/40 text-amber-300 text-xs uppercase font-bold tracking-widest mb-4 backdrop-blur-sm animate-pulse">
                ✦ Sacred Parashara Vedic Tradition
            </span>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-heading font-extrabold text-white mb-6 leading-tight">
                Vedic Jyotish & Divine Horoscope Wisdom
            </h1>
            <p class="text-lg md:text-xl text-stone-300 font-light leading-relaxed mb-8">
                Jyotish is the "Eye of the Vedas" (Vedanga). Our revered Acharyas in Kashi interpret your planetary alignments with mathematical rigor and spiritual insight to illuminate your destiny, career, marriage, and health.
            </p>
            <div class="flex flex-wrap items-center gap-4">
                <a href="#jyotish-booking" class="btn-vedic-gold">
                    <i class="fa fa-calendar-check text-xs"></i>
                    <span>Book Personal Consultation</span>
                </a>
                <a href="#jyotish-services" class="btn-vedic-outline bg-white/10 dark:bg-black/30 text-amber-300 border-amber-400/50 hover:bg-amber-500/20">
                    <i class="fa fa-compass text-xs"></i>
                    <span>Explore Jyotish Services</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Sacred Philosophy of Vedic Jyotish -->
<section class="py-16 md:py-20 bg-amber-50/50 dark:bg-[#120608] border-b border-amber-200/40 dark:border-amber-900/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="reveal-fade-up">
                <span class="section-tag">✦ The Science of Karma & Light</span>
                <h2 class="section-title text-slate-900 dark:text-amber-100 mb-6">
                    Why Vedic Astrology Transcends Ordinary Fortune-Telling
                </h2>
                <div class="space-y-4 text-slate-700 dark:text-stone-300 text-base leading-relaxed">
                    <p>
                        In the Vedic world view, your <strong>Janam Kundli (Birth Chart)</strong> is a cosmic blueprint of your <em>Prarabdha Karma</em> — the accumulated impressions of past actions manifesting in this lifetime. The Navagrahas (Nine Cosmic Influencers) act not as oppressors, but as divine mirrors reflecting your soul's karmic ledger.
                    </p>
                    <p>
                        Through the classical principles of Maharishi Parashara and Jaimini, our Acharyas identify the root cause of financial blockages, delay in marriage, health crises, or mental distress, and prescribe authentic Vedic remedies — including personalized Yagyas, Mantras, and gemstones.
                    </p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-8">
                    <div class="p-4 rounded-xl bg-white dark:bg-[#1b0a0e] border border-amber-200 dark:border-amber-900/40 text-center shadow-sm">
                        <div class="text-2xl font-extrabold text-amber-600 dark:text-amber-400">100%</div>
                        <div class="text-xs text-slate-600 dark:text-stone-400 font-medium mt-1">Shastric Parashari Vidhi</div>
                    </div>
                    <div class="p-4 rounded-xl bg-white dark:bg-[#1b0a0e] border border-amber-200 dark:border-amber-900/40 text-center shadow-sm">
                        <div class="text-2xl font-extrabold text-amber-600 dark:text-amber-400">25+ Yrs</div>
                        <div class="text-xs text-slate-600 dark:text-stone-400 font-medium mt-1">Kashi Vidwat Lineage</div>
                    </div>
                    <div class="p-4 rounded-xl bg-white dark:bg-[#1b0a0e] border border-amber-200 dark:border-amber-900/40 text-center shadow-sm col-span-2 sm:col-span-1">
                        <div class="text-2xl font-extrabold text-amber-600 dark:text-amber-400">108+</div>
                        <div class="text-xs text-slate-600 dark:text-stone-400 font-medium mt-1">Planetary Remediations</div>
                    </div>
                </div>
            </div>

            <div class="relative reveal-fade-up">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl border-4 border-white dark:border-stone-800">
                    <img src="{{ asset('images/jyo.jpg') }}" alt="Vedic Horoscope Analysis" class="w-full h-[420px] object-cover hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-8">
                        <div>
                            <span class="text-amber-400 text-xs font-bold uppercase tracking-wider">Kashi Vishwanath Dhaam</span>
                            <h3 class="text-white text-xl font-bold font-heading">Direct Guidance from Varanasi Scholars</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Comprehensive Jyotish Services Grid -->
<section id="jyotish-services" class="py-20 bg-white dark:bg-[#0b0305]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal-fade-up">
            <span class="section-tag">✦ Sacred Consultations & Horoscopy</span>
            <h2 class="section-title text-slate-900 dark:text-amber-100">
                Specialized Jyotish & Horoscope Offerings
            </h2>
            <p class="section-subtitle dark:text-stone-300">
                Each consultation is conducted through direct Shastric calculations, Dasha-Bhukti evaluations, and Divisional Chart (Varga) analysis.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($jyotishServices as $serv)
            <a href="{{ route('service.detail', $serv->slug) }}" class="service-card dark:bg-[#17080b] dark:border-amber-950/60 reveal-fade-up group block hover:border-amber-500/60 transition-all duration-300 hover:-translate-y-1">
                <div class="service-card-header overflow-hidden">
                    <img src="{{ $serv->image_url }}" alt="{{ $serv->title }}" class="group-hover:scale-105 transition-transform duration-500">
                    <span class="service-category-badge">
                        {{ $serv->category->name ?? 'Jyotish Vidya' }}
                    </span>
                </div>
                <div class="service-card-body flex flex-col justify-between">
                    <div>
                        <h3 class="service-title group-hover:text-amber-500 dark:group-hover:text-amber-400 transition-colors">
                            {{ $serv->title }}
                        </h3>
                        <p class="service-desc dark:text-stone-300">
                            {{ Str::limit(strip_tags($serv->short_desc ?: $serv->detailed_desc), 130) }}
                        </p>
                    </div>

                    @if($serv->duration)
                    <div class="pt-3 border-t border-slate-100 dark:border-stone-800/80 flex items-center justify-between text-xs text-slate-500 dark:text-stone-400">
                        <span><i class="fa fa-clock text-amber-500 mr-1"></i> {{ $serv->duration }}</span>
                        <span class="text-amber-600 dark:text-amber-400 font-semibold group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">
                            Read Vidhi <i class="fa fa-arrow-right text-[10px]"></i>
                        </span>
                    </div>
                    @endif
                </div>
            </a>
            @empty
            <div class="col-span-3 text-center py-12 text-slate-500">
                Services are currently being loaded. Please contact directly.
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Meet the Revered Jyotish Acharyas -->
<section class="py-20 bg-stone-50 dark:bg-[#120608] border-t border-amber-200/30 dark:border-amber-950/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16 reveal-fade-up">
            <span class="section-tag">✦ Lineage of Kashi Vidwat Parishad</span>
            <h2 class="section-title text-slate-900 dark:text-amber-100">
                Revered Vedic Astrologers & Acharyas
            </h2>
            <p class="section-subtitle dark:text-stone-300">
                Meet the blessed masters of Vedic mathematics and Jyotish Shastra who preside over consultations.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($astrologers as $astro)
            <div class="astrologer-card dark:bg-[#18080b] dark:border-amber-950/60 reveal-fade-up">
                <img src="{{ $astro->avatar_url }}" alt="{{ $astro->name }}">
                <h3 class="text-xl font-bold text-slate-800 dark:text-amber-200 mb-1 font-heading">{{ $astro->name }}</h3>
                <span class="text-xs uppercase font-bold text-amber-600 dark:text-amber-400 tracking-wider block mb-3">
                    {{ $astro->title }}
                </span>
                <p class="text-sm text-slate-600 dark:text-stone-300 line-clamp-3 mb-4 leading-relaxed">
                    {{ strip_tags($astro->bio) }}
                </p>
                
                <div class="pt-4 border-t border-slate-100 dark:border-stone-800 flex items-center justify-between text-xs">
                    <span class="text-slate-500 dark:text-stone-400"><i class="fa fa-award text-amber-500"></i> {{ $astro->experience_years }}+ Yrs Exp</span>
                    <a href="{{ route('astrologer.detail', $astro->slug) }}" class="text-amber-600 dark:text-amber-400 font-bold hover:underline">
                        View Profile →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Dedicated Jyotish Booking Form -->
<section id="jyotish-booking" class="py-20 bg-white dark:bg-[#0b0305]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="booking-form-box dark:bg-[#16080b] dark:border-amber-900/50 reveal-fade-up">
            <div class="text-center mb-10">
                <span class="section-tag">✦ Sacred Birth Details</span>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-amber-100 font-heading mb-2">
                    Schedule Your Personalized Horoscope Consultation
                </h2>
                <p class="text-sm text-slate-600 dark:text-stone-300">
                    Please provide accurate birth data for precision astronomical calculations. Our Acharya will review your planetary chart before the live session.
                </p>
            </div>

            <div id="inquiryAlertBox" class="hidden"></div>

            <form id="vedicInquiryForm" action="{{ route('inquiry.submit') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="inquiry_type" value="jyotish_consultation">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Full Name *</label>
                        <input type="text" name="full_name" required placeholder="e.g. Ramesh Chandra Sharma" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Email Address *</label>
                        <input type="email" name="email" required placeholder="name@example.com" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Phone / Mobile *</label>
                        <input type="text" name="phone" required placeholder="+91 98765 43210" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">WhatsApp Number</label>
                        <input type="text" name="whatsapp" placeholder="For instant consultation link" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                    </div>
                </div>

                <!-- Astronomical Coordinates -->
                <div class="p-5 rounded-xl bg-amber-50/60 dark:bg-[#200c10] border border-amber-200/50 dark:border-amber-950 space-y-4">
                    <h4 class="text-sm font-bold text-amber-800 dark:text-amber-300 uppercase tracking-wider flex items-center gap-2">
                        <i class="fa fa-star-and-crescent text-amber-500"></i> Astrological Birth Coordinates
                    </h4>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 dark:text-stone-300 mb-1">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-input-vedic dark:bg-[#16080b] dark:border-amber-950 dark:text-stone-100">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 dark:text-stone-300 mb-1">Exact Time of Birth</label>
                            <input type="text" name="time_of_birth" placeholder="e.g. 06:45 AM" class="form-input-vedic dark:bg-[#16080b] dark:border-amber-950 dark:text-stone-100">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 dark:text-stone-300 mb-1">Place of Birth (City/State)</label>
                            <input type="text" name="place_of_birth" placeholder="e.g. Varanasi, UP" class="form-input-vedic dark:bg-[#16080b] dark:border-amber-950 dark:text-stone-100">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 dark:text-stone-300 mb-1">Gotra (If Known)</label>
                            <input type="text" name="gotra" placeholder="e.g. Kashyap, Bhardwaj, Vashishtha" class="form-input-vedic dark:bg-[#16080b] dark:border-amber-950 dark:text-stone-100">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 dark:text-stone-300 mb-1">Select Astrologer (Optional)</label>
                            <select name="astrologer_id" class="form-input-vedic dark:bg-[#16080b] dark:border-amber-950 dark:text-stone-100">
                                <option value="">Any Available Senior Acharya</option>
                                @foreach($astrologers as $astro)
                                <option value="{{ $astro->id }}">{{ $astro->name }} ({{ $astro->title }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Life Area / Questions for Astrologer</label>
                    <textarea name="problem_description" rows="4" placeholder="Briefly describe your career, health, marital question or specific planetary curiosity..." class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100"></textarea>
                </div>

                <div class="text-center pt-4">
                    <button id="inquirySubmitBtn" type="submit" class="btn-vedic-gold w-full md:w-auto px-10 py-3.5 text-base shadow-xl">
                        <span>Submit Sacred Consultation Request</span>
                        <i class="fa fa-paper-plane ml-2"></i>
                    </button>
                    <p class="text-xs text-slate-500 dark:text-stone-400 mt-3">
                        🔒 Confidential & Secure. Your birth data is never shared with third parties.
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
