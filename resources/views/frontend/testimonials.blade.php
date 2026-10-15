@extends('layouts.frontend')

@section('title', 'Devotee Experiences & Transformations | 108 Astro Yagya')
@section('meta_description', 'Read authentic reviews, life transformation stories, and testimonials of devotees who experienced divine grace through Vedic Yagyas and Jyotish consultations.')

@section('content')
<!-- Page Hero Banner -->
<section class="relative bg-gradient-to-b from-stone-950 via-stone-900 to-black text-white py-20 md:py-28 overflow-hidden">
    <div class="absolute inset-0 opacity-25 bg-cover bg-center" style="background-image: url('{{ asset('images/divine.jpg') }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-black/95 via-black/80 to-transparent"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/20 border border-amber-400/40 text-amber-300 text-xs uppercase font-bold tracking-widest mb-4 backdrop-blur-sm animate-pulse">
                ✦ Sacred Devotee Testimonials & Transformations
            </span>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-heading font-extrabold text-white mb-6 leading-tight">
                Stories of Divine Grace & Karmic Breakthroughs
            </h1>
            <p class="text-lg md:text-xl text-stone-300 font-light leading-relaxed mb-8">
                Every Yagya performed with pure Sanskrit vibration and authentic Ahutis creates an undeniable shift in cosmic energy. Read real experiences from devotees across India, the United States, Europe, and worldwide.
            </p>
            <div class="flex flex-wrap items-center gap-4">
                <a href="#testimonial-grid" class="btn-vedic-gold">
                    <i class="fa fa-book-open text-xs"></i>
                    <span>Read Devotee Stories</span>
                </a>
                <a href="#share-experience" class="btn-vedic-outline bg-white/10 dark:bg-black/30 text-amber-300 border-amber-400/50 hover:bg-amber-500/20">
                    <i class="fa fa-pen-fancy text-xs"></i>
                    <span>Share Your Experience</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Trust & Verification Ribbon -->
<section class="bg-amber-500 text-white py-6 shadow-inner border-y border-amber-600/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="border-r border-amber-400/50 last:border-none">
                <div class="text-3xl sm:text-4xl font-extrabold font-heading text-white stat-counter" data-target="15000">15,000+</div>
                <div class="text-xs uppercase font-bold tracking-wider text-amber-100 mt-1">Sankalps Completed</div>
            </div>
            <div class="border-r border-amber-400/50 last:border-none">
                <div class="text-3xl sm:text-4xl font-extrabold font-heading text-white">4.98 / 5</div>
                <div class="text-xs uppercase font-bold tracking-wider text-amber-100 mt-1">Devotee Satisfaction</div>
            </div>
            <div class="border-r border-amber-400/50 last:border-none">
                <div class="text-3xl sm:text-4xl font-extrabold font-heading text-white stat-counter" data-target="42">42+</div>
                <div class="text-xs uppercase font-bold tracking-wider text-amber-100 mt-1">Countries Served</div>
            </div>
            <div>
                <div class="text-3xl sm:text-4xl font-extrabold font-heading text-white">100%</div>
                <div class="text-xs uppercase font-bold tracking-wider text-amber-100 mt-1">Verified Vedic Vidhi</div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Main Showcase Grid -->
<section id="testimonial-grid" class="py-20 bg-stone-50/60 dark:bg-[#0b0305]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-16 reveal-fade-up">
            <span class="section-tag">✦ Authentic Experiences</span>
            <h2 class="section-title text-slate-900 dark:text-amber-100">
                Witnessing the Power of Vedic Remediation
            </h2>
            <p class="section-subtitle dark:text-stone-300">
                Below are real accounts of obstacles faced, sacred rituals performed, and the miraculous transformations experienced by our seekers.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $testi)
            <div class="testimonial-story-card bg-white dark:bg-[#16080b] border border-amber-200/70 dark:border-amber-950/70 rounded-2xl p-6 sm:p-7 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 flex flex-col justify-between reveal-fade-up">
                
                <div>
                    <!-- Top Author Profile Bar -->
                    <div class="flex items-start gap-4 pb-5 border-b border-slate-100 dark:border-stone-800">
                        <img src="{{ $testi->avatar_url }}" alt="{{ $testi->client_name }}" class="w-16 h-16 rounded-full object-cover border-2 border-amber-500 shadow-md shrink-0">
                        <div>
                            <div class="flex items-center gap-1.5 flex-wrap">
                                <h3 class="font-bold text-lg text-slate-900 dark:text-amber-100 font-heading leading-tight">{{ $testi->client_name }}</h3>
                                @if($testi->is_verified)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-100 dark:bg-emerald-950/80 text-emerald-800 dark:text-emerald-400 text-[10px] font-bold" title="Verified Ashram Devotee">
                                    <i class="fa fa-check-circle"></i> Verified
                                </span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-500 dark:text-stone-400 font-medium mt-0.5">{{ $testi->client_title }}</p>
                            <p class="text-xs text-amber-600 dark:text-amber-400 font-semibold flex items-center gap-1 mt-1">
                                <i class="fa fa-map-marker-alt text-[10px]"></i> {{ $testi->location }}
                            </p>
                        </div>
                    </div>

                    <!-- Ritual Badge -->
                    <div class="my-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-amber-50 dark:bg-[#220d11] text-amber-800 dark:text-amber-300 text-xs font-bold border border-amber-200 dark:border-amber-900/50">
                            <i class="fa fa-fire text-amber-500"></i> {{ $testi->service_taken ?: 'Vedic Yagya & Consultation' }}
                        </span>
                    </div>

                    <!-- Rating Stars -->
                    <div class="flex items-center gap-1 text-amber-400 text-sm mb-4">
                        @for($i = 0; $i < ($testi->rating ?: 5); $i++)
                        <i class="fa fa-star"></i>
                        @endfor
                        <span class="text-xs font-bold text-slate-600 dark:text-stone-400 ml-2">5.0 Star Experience</span>
                    </div>

                    <!-- Full Devotee Story -->
                    <div class="rich-content text-sm text-slate-700 dark:text-stone-300 leading-relaxed italic mb-6">
                        "{!! $testi->review_text !!}"
                    </div>
                </div>

                <!-- Card Footer Seal -->
                <div class="pt-4 border-t border-slate-100 dark:border-stone-800 flex items-center justify-between text-xs text-slate-500 dark:text-stone-400">
                    <span class="flex items-center gap-1 text-amber-600 dark:text-amber-400 font-bold">
                        <i class="fa fa-certificate"></i> Sankalp Fulfilled
                    </span>
                    <span>108 Sacred Ahutis</span>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

<!-- Devotee Anubhav Submission Form -->
<section id="share-experience" class="py-20 bg-white dark:bg-[#0b0305] border-t border-amber-200/30 dark:border-amber-950/40">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="booking-form-box dark:bg-[#16080b] dark:border-amber-900/50 reveal-fade-up">
            <div class="text-center mb-8">
                <span class="section-tag">✦ Share Your Blessings</span>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-amber-100 font-heading mb-2">
                    Share Your Sacred Experience (दिव्य अनुभव)
                </h2>
                <p class="text-sm text-slate-600 dark:text-stone-300">
                    Have you experienced positive transformations after a Vedic Yagya or consultation with Panditji? Share your words to inspire fellow seekers on their spiritual path.
                </p>
            </div>

            <form id="testimonialSubmitForm" action="{{ route('inquiry.submit') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="inquiry_type" value="general">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Your Name *</label>
                        <input type="text" name="full_name" required placeholder="e.g. Ramesh Patel" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">City & Country *</label>
                        <input type="text" name="place_of_birth" required placeholder="e.g. London, UK / Mumbai, India" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Email *</label>
                        <input type="email" name="email" required placeholder="name@example.com" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Phone / WhatsApp *</label>
                        <input type="text" name="phone" required placeholder="+91 98765 43210" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Which Yagya or Consultation Did You Perform?</label>
                    <input type="text" name="gotra" placeholder="e.g. Maha Mrityunjaya Yagya, Rahu Graha Shanti, Kundli Reading..." class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Your Sacred Story & Experience *</label>
                    <textarea name="problem_description" rows="5" required placeholder="Describe what challenge you were facing, how the ceremony was conducted, and what positive outcome occurred in your life..." class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100"></textarea>
                </div>

                <div class="text-center pt-2">
                    <button type="submit" class="btn-vedic-gold w-full md:w-auto px-10 py-3.5 text-base shadow-xl">
                        <span>Submit Sacred Testimonial</span>
                        <i class="fa fa-heart ml-2 text-rose-200"></i>
                    </button>
                    <p class="text-xs text-slate-500 dark:text-stone-400 mt-2">
                        Your testimonial will be reviewed with reverence before being featured.
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
