@extends('layouts.frontend')

@section('title', 'Sacred Ashram & Contact Us | 108 Astro Yagya')
@section('meta_description', 'Contact 108 Astro Yagya Ashram in Allahabad (UP) for authentic Vedic Yagya bookings, Jyotish consultations, and spiritual guidance.')

@section('content')
<!-- Page Hero Banner -->
<section class="relative bg-gradient-to-b from-stone-950 via-stone-900 to-black text-white py-20 md:py-28 overflow-hidden">
    <div class="absolute inset-0 opacity-25 bg-cover bg-center" style="background-image: url('{{ asset('images/part.jpg') }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-black/95 via-black/80 to-transparent"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/20 border border-amber-400/40 text-amber-300 text-xs uppercase font-bold tracking-widest mb-4 backdrop-blur-sm animate-pulse">
                ✦ Sacred Ashram & Spiritual Sanctuary
            </span>
            <h1 class="text-4xl sm:text-5xl md:text-6xl font-heading font-extrabold text-white mb-6 leading-tight">
                Connect with the Sacred Ashram
            </h1>
            <p class="text-lg md:text-xl text-stone-300 font-light leading-relaxed mb-8">
                Whether you wish to schedule a Vedic Yagya, consult with Acharya Pandit Tarkeshwar Dwivedi, or connect with our ashram in Allahabad, our coordinators are here to assist you.
            </p>
            <div class="flex flex-wrap items-center gap-4">
                <a href="#contact-form-section" class="btn-vedic-gold">
                    <i class="fa fa-envelope text-xs"></i>
                    <span>Send Sacred Inquiry</span>
                </a>
                @if(!empty($settings['contact_phone']))
                <a href="tel:{{ $settings['contact_phone'] }}" class="btn-vedic-outline bg-white/10 dark:bg-black/30 text-amber-300 border-amber-400/50 hover:bg-amber-500/20">
                    <i class="fa fa-phone text-xs"></i>
                    <span>Call Us : {{ $settings['contact_phone'] }}</span>
                </a>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Ashram Coordinates & Cards -->
<section class="py-16 bg-stone-50 dark:bg-[#120608] border-b border-amber-200/40 dark:border-amber-900/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            
            <!-- Card 1: Ashram Address -->
            <div class="p-8 rounded-2xl bg-white dark:bg-[#18080b] border border-amber-200 dark:border-amber-950 shadow-md reveal-fade-up">
                <div class="w-14 h-14 rounded-2xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center text-2xl mb-6 border border-amber-400/30">
                    <i class="fa fa-map-marked-alt"></i>
                </div>
                <h3 class="text-xl font-bold font-heading text-slate-900 dark:text-amber-100 mb-3">Vedic Ashram Address</h3>
                <p class="text-sm text-slate-600 dark:text-stone-300 leading-relaxed mb-4">
                    {{ $settings['office_address'] ?? 'ED2/60 ADA Colony Naini, Allahabad. (UP) India' }}
                </p>
                <span class="text-xs text-amber-600 dark:text-amber-400 font-semibold flex items-center gap-1">
                    <i class="fa fa-compass"></i> ED-2/60, ADA Colony, Naini, Allahabad (UP) 211008
                </span>
            </div>

            <!-- Card 2: Phone & WhatsApp -->
            <div class="p-8 rounded-2xl bg-white dark:bg-[#18080b] border border-amber-200 dark:border-amber-950 shadow-md reveal-fade-up">
                <div class="w-14 h-14 rounded-2xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center text-2xl mb-6 border border-amber-400/30">
                    <i class="fa fa-phone-volume"></i>
                </div>
                <h3 class="text-xl font-bold font-heading text-slate-900 dark:text-amber-100 mb-3">Direct Phone & WhatsApp</h3>
                <p class="text-sm text-slate-600 dark:text-stone-300 leading-relaxed mb-4">
                    Speak directly with Pandit Tarkeshwar Dwivedi for auspicious Muhurta timings and spiritual guidance.
                </p>
                <div class="space-y-1 text-sm font-bold">
                    <a href="tel:{{ $settings['contact_phone'] ?? '+918009767597' }}" class="block text-slate-800 dark:text-amber-200 hover:text-amber-600">
                        📞 Call Us : {{ $settings['contact_phone'] ?? '+91 8009767597' }}
                    </a>
                    @if(!empty($settings['whatsapp_number']))
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number']) }}" target="_blank" class="block text-emerald-600 hover:text-emerald-700">
                        💬 WhatsApp: +91 8009767597
                    </a>
                    @endif
                </div>
            </div>

            <!-- Card 3: Sacred Hours & Email -->
            <div class="p-8 rounded-2xl bg-white dark:bg-[#18080b] border border-amber-200 dark:border-amber-950 shadow-md reveal-fade-up">
                <div class="w-14 h-14 rounded-2xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center text-2xl mb-6 border border-amber-400/30">
                    <i class="fa fa-envelope-open-text"></i>
                </div>
                <h3 class="text-xl font-bold font-heading text-slate-900 dark:text-amber-100 mb-3">Email & Timings</h3>
                <p class="text-sm text-slate-600 dark:text-stone-300 leading-relaxed mb-4">
                    Send your horoscope or ritual inquiries directly to Panditji's personal inbox.
                </p>
                <a href="mailto:{{ $settings['contact_email'] ?? 'tarkeshwardeep@gmail.com' }}" class="text-sm font-bold text-amber-600 dark:text-amber-400 hover:underline block mb-2">
                    ✉️ {{ $settings['contact_email'] ?? 'tarkeshwardeep@gmail.com' }}
                </a>
                <span class="text-xs text-slate-500 dark:text-stone-400 block">
                    🕒 Open Daily: 06:00 AM – 10:00 PM IST
                </span>
            </div>

        </div>

        <!-- Official Google Map Embed matching 108astroyagya.com -->
        <div class="rounded-2xl overflow-hidden shadow-xl border border-amber-200 dark:border-amber-950 reveal-fade-up">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3604.407108693395!2d81.8806932144976!3d25.391179830035135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39854a61fddefae1%3A0xc416734e0636978!2sED-2%2F60%2C+ADA+Colony%2C+Naini%2C+Allahabad%2C+Uttar+Pradesh+211008%2C+India!5e0!3m2!1sen!2sin!4v1505901707366" width="100%" height="420" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</section>

<!-- Contact & Sankalp Form Section -->
<section id="contact-form-section" class="py-20 bg-white dark:bg-[#0b0305]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="booking-form-box dark:bg-[#16080b] dark:border-amber-900/50 reveal-fade-up">
            <div class="text-center mb-10">
                <span class="section-tag">✦ Sacred Communication</span>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-amber-100 font-heading mb-2">
                    Register Your Divine Sankalp or Inquiry
                </h2>
                <p class="text-sm text-slate-600 dark:text-stone-300">
                    Our Vedic Acharyas personally examine each request to determine the most beneficial spiritual remediation.
                </p>
            </div>

            <div id="inquiryAlertBox" class="hidden"></div>

            <form id="vedicInquiryForm" action="{{ route('inquiry.submit') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Full Name *</label>
                        <input type="text" name="full_name" required placeholder="e.g. Anand Vardhan" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
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
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Inquiry Type *</label>
                        <select name="inquiry_type" required class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                            <option value="yagya_booking">Book Sacred Vedic Yagya</option>
                            <option value="jyotish_consultation">Personal Jyotish Consultation</option>
                            <option value="kundli_analysis">Complete Janam Kundli Analysis</option>
                            <option value="general">General Ashram Inquiry</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Time of Birth</label>
                        <input type="text" name="time_of_birth" placeholder="e.g. 10:15 AM" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Place of Birth</label>
                        <input type="text" name="place_of_birth" placeholder="City, State, Country" class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 dark:text-stone-300 mb-2">Your Sacred Intention or Questions *</label>
                    <textarea name="problem_description" rows="4" required placeholder="Describe your prayer, life problem, health condition, or desired Yagya ceremony..." class="form-input-vedic dark:bg-[#200c10] dark:border-amber-950 dark:text-stone-100"></textarea>
                </div>

                <div class="text-center pt-4">
                    <button id="inquirySubmitBtn" type="submit" class="btn-vedic-gold w-full md:w-auto px-10 py-3.5 text-base shadow-xl">
                        <span>Submit Sacred Inquiry</span>
                        <i class="fa fa-paper-plane ml-2"></i>
                    </button>
                    <p class="text-xs text-slate-500 dark:text-stone-400 mt-3">
                        ✦ Jai Guru Dev! An Acharya will review your birth data and connect within 24 hours.
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
