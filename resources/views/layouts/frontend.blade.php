<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', $settings['meta_title'] ?? '108 Astro Yagya - Authentic Vedic Yagyas & Divine Astrology')</title>
    <meta name="description" content="@yield('meta_description', $settings['meta_description'] ?? 'Authentic Vedic Yagyas conducted by verified Kashi & Himalayan Pandits. 108 Sacred Ahutis, Live Sankalp and precision horoscope consultations.')">
    
    <!-- Dark/Light Mode Immediate Execution (Zero FOUC) -->
    <script>
        (function() {
            const saved = localStorage.getItem('astro_theme');
            if (saved === 'dark' || (!saved && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Roboto:wght@300;400;500;700&family=Yanone+Kaffeesatz:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS (Play CDN with Dark Mode support) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'vedic-saffron': '#fb8806',
                        'vedic-orange': '#e65100',
                        'vedic-gold': '#d4af37',
                        'vedic-gold-bright': '#ffd700',
                        'vedic-dark': '#0b0305',
                        'vedic-dark-card': '#16080b',
                        'vedic-dark-border': '#3a171e',
                    },
                    fontFamily: {
                        heading: ['Yanone Kaffeesatz', 'sans-serif'],
                        body: ['Roboto', 'Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Vedic Official Theme Styles (Light + Dark + Animations) -->
    <link rel="stylesheet" href="{{ asset('css/vedic-luxury.css') }}">

    @php
        $settings = $settings ?? (\Illuminate\Support\Facades\Schema::hasTable('site_settings') ? \App\Models\SiteSetting::all()->pluck('value', 'key')->toArray() : []);
        $socialLinks = $socialLinks ?? (\Illuminate\Support\Facades\Schema::hasTable('social_links') ? \App\Models\SocialLink::where('is_active', true)->orderBy('order_index')->get() : collect());
        $headerMenus = $headerMenus ?? (\Illuminate\Support\Facades\Schema::hasTable('navigation_menus') ? \App\Models\NavigationMenu::where('location', 'header')->whereNull('parent_id')->where('is_active', true)->with(['children' => fn($q) => $q->where('is_active', true)->orderBy('order_index')])->orderBy('order_index')->get() : collect());
        $allCategories = $allCategories ?? (\Illuminate\Support\Facades\Schema::hasTable('categories') ? \App\Models\Category::where('is_active', true)->with(['services' => fn($q) => $q->where('is_active', true)->orderBy('order_index')])->orderBy('order_index')->get() : collect());

        $siteLogoUrl = asset('images/logo.png');
        if (!empty($settings['site_logo'])) {
            if (str_starts_with($settings['site_logo'], 'http')) {
                $siteLogoUrl = $settings['site_logo'];
            } elseif (file_exists(public_path('uploads/settings/' . $settings['site_logo']))) {
                $siteLogoUrl = asset('uploads/settings/' . $settings['site_logo']);
            } elseif (file_exists(public_path('images/' . $settings['site_logo']))) {
                $siteLogoUrl = asset('images/' . $settings['site_logo']);
            }
        }
        $siteFaviconUrl = asset('images/logo.png');
        if (!empty($settings['site_favicon'])) {
            if (str_starts_with($settings['site_favicon'], 'http')) {
                $siteFaviconUrl = $settings['site_favicon'];
            } elseif (file_exists(public_path('uploads/settings/' . $settings['site_favicon']))) {
                $siteFaviconUrl = asset('uploads/settings/' . $settings['site_favicon']);
            }
        }
    @endphp
    <link rel="icon" type="image/png" href="{{ $siteFaviconUrl }}">

    @stack('styles')
</head>
<body class="bg-white dark:bg-[#0b0305] text-slate-800 dark:text-slate-200 font-body selection:bg-amber-400 selection:text-black transition-colors duration-300">

    <!-- Top Announcement Bar (Admin Managed) -->
    @if(!empty($settings['header_alert_text']))
    <div class="header-alert-top">
        <div class="max-w-7xl mx-auto px-4 flex flex-wrap items-center justify-center gap-2">
            <span>{{ $settings['header_alert_text'] }}</span>
            @if(!empty($settings['header_alert_btn_text']))
            <a href="{{ $settings['header_alert_url'] ?? route('contact') }}">
                {{ $settings['header_alert_btn_text'] }} →
            </a>
            @endif
        </div>
    </div>
    @endif

    <!-- Top Sacred Utility Bar -->
    <div class="top-utility-bar hidden md:block">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">
            <div class="flex items-center gap-6 text-xs">
                @if(!empty($settings['contact_phone']))
                <a href="tel:{{ $settings['contact_phone'] }}" class="flex items-center gap-1.5 font-medium hover:text-amber-200">
                    <i class="fa fa-phone text-amber-300"></i> {{ $settings['contact_phone'] }}
                </a>
                @endif
                @if(!empty($settings['contact_email']))
                <a href="mailto:{{ $settings['contact_email'] }}" class="flex items-center gap-1.5 font-medium hover:text-amber-200">
                    <i class="fa fa-envelope text-amber-300"></i> {{ $settings['contact_email'] }}
                </a>
                @endif
                <span class="text-white/80 hidden xl:inline">
                    Vedic Jyotish Technology & Science of Vedic Yagyas
                </span>
            </div>
            
            <div class="flex items-center gap-4">
                <span class="text-xs text-amber-200 uppercase font-semibold tracking-wider hidden sm:inline">Connect:</span>
                <div class="flex items-center gap-2">
                    @foreach($socialLinks as $soc)
                    <a href="{{ $soc->url }}" target="_blank" rel="noopener noreferrer" title="{{ $soc->title }}" class="social-pill">
                        <i class="{{ $soc->icon ?? 'fa fa-link' }}"></i>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header class="main-navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Authentic Official Logo -->
                <a href="{{ route('home') }}" class="flex items-center shrink-0 py-2 group">
                    <img src="{{ $siteLogoUrl }}" alt="{{ $settings['site_title'] ?? '108 Astro Yagya' }}" class="h-12 sm:h-14 md:h-16 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                </a>

                <!-- Desktop Dynamic Navigation Menus (Direct Dedicated Pages) -->
                <nav class="hidden lg:flex items-center gap-1 xl:gap-2">
                    @foreach($headerMenus as $menu)
                        @php
                            $isActive = request()->is(trim($menu->url, '/')) || (request()->is('/') && ($menu->url === '/' || $menu->url === ''));
                        @endphp
                        @if($menu->children->count() > 0)
                            <!-- Dropdown Menu -->
                            <div class="relative group">
                                <a href="{{ $menu->url }}" class="nav-link-vedic {{ $isActive ? 'active' : '' }}">
                                    <span>{{ $menu->title }}</span>
                                    <i class="fa fa-chevron-down text-[10px] opacity-60 transition-transform group-hover:rotate-180 ml-0.5"></i>
                                </a>
                                <div class="dropdown-menu-vedic">
                                    @foreach($menu->children as $child)
                                    <a href="{{ $child->url }}" target="{{ $child->target }}" class="dropdown-item-vedic">
                                        {{ $child->title }}
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <!-- Single Link -->
                            <a href="{{ $menu->url }}" target="{{ $menu->target }}" class="nav-link-vedic {{ $isActive ? 'active' : '' }}">
                                <span>{{ $menu->title }}</span>
                            </a>
                        @endif
                    @endforeach
                </nav>

                <!-- Right Header CTAs & Theme Toggle -->
                <div class="flex items-center gap-3 shrink-0">
                    
                    <!-- Theme Toggle Switch (Dark / Light Mode) -->
                    <button id="themeToggleBtn" type="button" class="theme-toggle-btn" aria-label="Toggle Dark and Light Mode" title="Switch Theme">
                        <span class="theme-sun-icon"><i class="fa fa-sun text-amber-500"></i></span>
                        <span class="theme-moon-icon"><i class="fa fa-moon text-amber-300"></i></span>
                        <span class="text-xs font-semibold uppercase tracking-wider hidden sm:inline ml-1 text-slate-700 dark:text-amber-200" id="themeModeText">Mode</span>
                    </button>

                    <!-- Desktop CTA -->
                    <div class="hidden sm:flex items-center gap-2">
                        <a href="{{ route('contact') }}" class="btn-vedic-gold">
                            <i class="fa fa-calendar-check text-xs"></i>
                            <span>Book Live Sankalp</span>
                        </a>
                    </div>

                    <!-- Mobile Hamburger Button -->
                    <button id="mobileMenuBtn" type="button" class="lg:hidden p-2.5 rounded-xl text-slate-800 dark:text-amber-300 hover:text-amber-600 bg-amber-50 dark:bg-stone-800 border border-amber-200 dark:border-amber-900/50 transition-colors">
                        <i class="fa fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Drawer Menu -->
    <div id="mobileMenuDrawer" class="fixed inset-0 z-[1000] hidden bg-black/75 backdrop-blur-sm transition-opacity duration-300">
        <div class="fixed inset-y-0 right-0 max-w-xs w-full bg-white dark:bg-[#140608] text-slate-800 dark:text-slate-100 p-6 shadow-2xl flex flex-col justify-between overflow-y-auto border-l border-amber-500/20">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-slate-200 dark:border-stone-800 mb-6">
                    <img src="{{ $siteLogoUrl }}" alt="108 Astro Yagya" class="h-10 w-auto object-contain">
                    <button id="mobileCloseBtn" class="text-slate-500 dark:text-stone-400 text-2xl hover:text-rose-600 dark:hover:text-rose-400 p-1">&times;</button>
                </div>

                <div class="space-y-3">
                    @foreach($headerMenus as $menu)
                        @php
                            $isActive = request()->is(trim($menu->url, '/')) || (request()->is('/') && ($menu->url === '/' || $menu->url === ''));
                        @endphp
                        <div class="border-b border-slate-100 dark:border-stone-800/80 pb-2">
                            <a href="{{ $menu->url }}" class="block py-2 text-base font-semibold {{ $isActive ? 'text-amber-600 dark:text-amber-400 font-bold' : 'text-slate-800 dark:text-stone-200' }} hover:text-amber-600 transition-colors">
                                {{ $menu->title }}
                            </a>
                            @if($menu->children->count() > 0)
                                <div class="pl-4 space-y-2 mt-1">
                                    @foreach($menu->children as $ch)
                                    <a href="{{ $ch->url }}" class="block py-1 text-sm text-slate-600 dark:text-stone-400 hover:text-amber-600">
                                        • {{ $ch->title }}
                                    </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="pt-6 border-t border-slate-200 dark:border-stone-800 space-y-4">
                <a href="{{ route('contact') }}" class="btn-vedic-gold w-full text-center">
                    Book Live Sankalp
                </a>
                <div class="text-xs text-slate-500 dark:text-stone-400 text-center space-y-1">
                    <p>{{ $settings['contact_phone'] ?? '+91 8009767597' }}</p>
                    <p>{{ $settings['contact_email'] ?? 'tarkeshwardeep@gmail.com' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <main>
        @yield('content')
    </main>

    <!-- Footer (.footer matching 108astroyagya.com) -->
    <footer class="footer-main">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <!-- Column 1: Brand & About -->
                <div>
                    <div class="bg-white p-3 rounded-xl inline-block mb-4 shadow-md">
                        <img src="{{ $siteLogoUrl }}" alt="108 Astro Yagya" class="h-12 w-auto object-contain">
                    </div>
                    <h4 class="text-white text-lg font-bold mb-3">About 108 Astro Yagya</h4>
                    <p class="text-sm text-slate-300 dark:text-stone-300 leading-relaxed mb-6">
                        {{ $settings['footer_about'] ?? 'According to the Vedic philosophy of Karma (action), what we experience in life now is the result of our own past actions or karma. A yagya is the most auspicious remedial action to counteract past negative karma and to create positive karma for the future.' }}
                    </p>
                    <div class="flex items-center gap-2">
                        @foreach($socialLinks as $soc)
                        <a href="{{ $soc->url }}" target="_blank" rel="noopener noreferrer" class="social-pill" title="{{ $soc->title }}">
                            <i class="{{ $soc->icon }}"></i>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Column 2: Dedicated Pages & Quick Links -->
                <div>
                    <h4>Dedicated Services</h4>
                    <ul class="space-y-2.5 text-sm text-slate-300 dark:text-stone-300">
                        <li><a href="{{ route('home') }}" class="hover:text-amber-400 transition-colors">✦ Home Portal</a></li>
                        <li><a href="{{ route('jyotish') }}" class="hover:text-amber-400 transition-colors">✦ Vedic Jyotish & Horoscope</a></li>
                        <li><a href="{{ route('yagyas') }}" class="hover:text-amber-400 transition-colors">✦ Vedic Yagyas & Havans</a></li>
                        <li><a href="{{ route('testimonials') }}" class="hover:text-amber-400 transition-colors">✦ Devotee Experiences & Reviews</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-amber-400 transition-colors">✦ Ashram & Live Sankalp Booking</a></li>
                    </ul>
                </div>

                <!-- Column 3: Sacred Ashram Contact -->
                <div>
                    <h4>Ashram & Sanctuary</h4>
                    <div class="space-y-3 text-sm text-slate-300 dark:text-stone-300">
                        <div class="flex items-start gap-2.5">
                            <i class="fa fa-map-marker-alt text-amber-400 mt-1"></i>
                            <span class="text-xs leading-relaxed">
                                {{ $settings['office_address'] ?? 'ED2/60 ADA Colony Naini, Allahabad. (UP) India' }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="fa fa-phone text-amber-400"></i>
                            <a href="tel:{{ $settings['contact_phone'] ?? '+918009767597' }}" class="hover:text-amber-400">
                                {{ $settings['contact_phone'] ?? '+91 8009767597' }}
                            </a>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <i class="fa fa-envelope text-amber-400"></i>
                            <a href="mailto:{{ $settings['contact_email'] ?? 'tarkeshwardeep@gmail.com' }}" class="hover:text-amber-400">
                                {{ $settings['contact_email'] ?? 'tarkeshwardeep@gmail.com' }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Column 4: Quick Sankalp -->
                <div>
                    <h4>Connect with Panditji</h4>
                    <p class="text-xs text-slate-400 dark:text-stone-400 mb-4 leading-relaxed">
                        Register your birth details or book your Gotra Sankalp for auspicious planetary remedies and Vedic blessings.
                    </p>
                    <a href="{{ route('contact') }}" class="btn-vedic-gold w-full text-center text-xs">
                        Book Live Sankalp Now
                    </a>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom flex flex-col md:flex-row items-center justify-between gap-4">
                <div>
                    © {{ date('Y') }} 108astroyagya.com . All rights reserved. * JAI GURU DEV *
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('testimonials') }}" class="text-slate-400 hover:text-amber-400 text-xs">
                        <i class="fa fa-star text-amber-400"></i> Devotee Experiences
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Action -->
    @if(!empty($settings['whatsapp_number']))
    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number']) }}?text=Hari%20Om!%20I%20am%20interested%20in%20booking%20a%20Vedic%20Yagya%20or%20Jyotish%20Consultation." target="_blank" rel="noopener noreferrer" class="floating-whatsapp" title="Chat directly with Panditji on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
    @endif

    <!-- Scripts -->
    <script src="{{ asset('js/vedic-luxury.js') }}"></script>
    @stack('scripts')
</body>
</html>
