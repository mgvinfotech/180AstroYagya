<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Sanctuary') - 108 Astro Yagya</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @php
        $siteLogo = \App\Models\SiteSetting::get('site_logo');
        $siteLogoUrl = asset('images/logo.png');
        if (!empty($siteLogo)) {
            if (str_starts_with($siteLogo, 'http')) {
                $siteLogoUrl = $siteLogo;
            } elseif (file_exists(public_path('uploads/settings/' . $siteLogo))) {
                $siteLogoUrl = asset('uploads/settings/' . $siteLogo);
            } elseif (file_exists(public_path('images/' . $siteLogo))) {
                $siteLogoUrl = asset('images/' . $siteLogo);
            }
        }
    @endphp

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Outfit:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Theme Pre-Initialization (Prevents Theme Flickering) -->
    <script>
        (function() {
            var savedTheme = localStorage.getItem('admin_theme');
            // If user explicitly chose dark, keep dark; otherwise default to clean light mode!
            if (savedTheme === 'dark') {
                document.documentElement.classList.remove('light-mode');
            } else {
                document.documentElement.classList.add('light-mode');
            }
        })();
    </script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'admin-dark': '#0a0a0f',
                        'admin-card': '#14141d',
                        'admin-border': '#262638',
                        'admin-gold': '#d4af37',
                    },
                    fontFamily: {
                        heading: ['Cinzel', 'serif'],
                        body: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #0b0b12;
            color: #f1f1f6;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 0.88rem;
            color: #a3a3bd;
            transition: all 0.2s ease;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: rgba(212, 175, 55, 0.12);
            color: #ffd700;
            border-left: 3px solid #d4af37;
        }

        .admin-card {
            background: #13131c;
            border: 1px solid #232332;
            border-radius: 12px;
            transition: background-color 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .form-input-admin {
            width: 100%;
            background: #0d0d15;
            border: 1px solid #2c2c3e;
            border-radius: 8px;
            padding: 10px 14px;
            color: #fff;
            font-size: 0.9rem;
            outline: none;
            transition: border-color 0.2s ease, background-color 0.2s ease, color 0.2s ease;
        }

        .form-input-admin:focus {
            border-color: #d4af37;
            box-shadow: 0 0 0 1px #d4af37;
        }

        /* Admin Theme Toggle Button */
        .admin-theme-toggle {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 6px 14px;
            border-radius: 9px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            border: 1px solid #2c2c3e;
            background: #171724;
            color: #f6c85f;
        }

        .admin-theme-toggle:hover {
            background: #232334;
            border-color: #d4af37;
            transform: translateY(-1px);
        }

        /* ========================================================
           COMPREHENSIVE LIGHT MODE OVERRIDES FOR ADMIN SANCTUARY
           ======================================================== */
        html.light-mode body {
            background-color: #f8fafc !important;
            color: #1e293b !important;
        }

        html.light-mode header {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05) !important;
        }

        html.light-mode aside {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 1px 0 2px rgba(0, 0, 0, 0.02) !important;
        }

        html.light-mode .sidebar-link {
            color: #475569 !important;
        }

        html.light-mode .sidebar-link:hover {
            background-color: #f1f5f9 !important;
            color: #b45309 !important;
        }

        html.light-mode .sidebar-link.active {
            background-color: #fef3c7 !important;
            color: #b45309 !important;
            border-left: 3px solid #d97706 !important;
            font-weight: 700 !important;
        }

        html.light-mode .sidebar-link i {
            color: #d97706 !important;
        }

        html.light-mode .admin-card {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            color: #1e293b !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.02) !important;
        }

        html.light-mode .form-input-admin {
            background-color: #ffffff !important;
            border-color: #cbd5e1 !important;
            color: #0f172a !important;
        }

        html.light-mode .form-input-admin:focus {
            border-color: #d97706 !important;
            box-shadow: 0 0 0 2px rgba(217, 119, 6, 0.15) !important;
        }

        html.light-mode .form-input-admin::placeholder {
            color: #94a3b8 !important;
        }

        html.light-mode select.form-input-admin option {
            background-color: #ffffff !important;
            color: #0f172a !important;
        }

        html.light-mode .admin-theme-toggle {
            background-color: #f1f5f9 !important;
            border-color: #cbd5e1 !important;
            color: #475569 !important;
            box-shadow: 0 1px 2px rgba(0,0,0,0.04) !important;
        }

        html.light-mode .admin-theme-toggle:hover {
            background-color: #e2e8f0 !important;
            border-color: #94a3b8 !important;
            color: #0f172a !important;
        }

        /* Typography & Colors in Light Mode */
        html.light-mode .text-white {
            color: #0f172a !important;
        }

        html.light-mode .text-neutral-200 {
            color: #1e293b !important;
        }

        html.light-mode .text-neutral-300 {
            color: #334155 !important;
        }

        html.light-mode .text-neutral-400,
        html.light-mode .text-neutral-500 {
            color: #64748b !important;
        }

        html.light-mode .text-amber-300,
        html.light-mode .text-amber-400,
        html.light-mode .text-amber-200,
        html.light-mode .text-amber-200\/90 {
            color: #b45309 !important;
        }

        html.light-mode a.text-amber-400:hover,
        html.light-mode a.text-amber-300:hover,
        html.light-mode a.text-amber-200:hover {
            color: #d97706 !important;
        }

        /* Background & Border Overrides */
        html.light-mode .bg-\[\#090910\],
        html.light-mode .bg-\[\#0b0b12\],
        html.light-mode .bg-\[\#0a0a0f\],
        html.light-mode .bg-\[\#0d0d15\],
        html.light-mode .bg-\[\#101018\],
        html.light-mode .bg-\[\#13131c\],
        html.light-mode .bg-\[\#14141d\],
        html.light-mode .bg-\[\#18080b\],
        html.light-mode .bg-\[\#171724\],
        html.light-mode .bg-\[\#171725\],
        html.light-mode .bg-\[\#111119\] {
            background-color: #ffffff !important;
        }

        html.light-mode tr.bg-\[\#101018\] {
            background-color: #f8fafc !important;
        }

        html.light-mode .hover\:bg-\[\#141420\]:hover {
            background-color: #f1f5f9 !important;
        }

        html.light-mode .bg-black\/30,
        html.light-mode .bg-black\/20,
        html.light-mode .bg-black\/40 {
            background-color: #f8fafc !important;
            border-color: #e2e8f0 !important;
        }

        html.light-mode .bg-neutral-800,
        html.light-mode .bg-neutral-900 {
            background-color: #f1f5f9 !important;
            color: #1e293b !important;
        }

        html.light-mode .bg-\[\#1c1c28\],
        html.light-mode .bg-\[\#252536\] {
            background-color: #f1f5f9 !important;
            color: #1e293b !important;
            border-color: #cbd5e1 !important;
        }

        html.light-mode .border-\[\#212130\],
        html.light-mode .border-\[\#232332\],
        html.light-mode .border-\[\#242436\],
        html.light-mode .border-\[\#262638\],
        html.light-mode .border-\[\#28283c\],
        html.light-mode .border-\[\#2a2a3c\],
        html.light-mode .border-\[\#2c2c3e\],
        html.light-mode .border-\[\#2e2e42\],
        html.light-mode .border-\[\#222233\],
        html.light-mode .border-\[\#1d1d2b\],
        html.light-mode .border-\[\#1e1e2d\],
        html.light-mode .border-neutral-800,
        html.light-mode .border-neutral-700 {
            border-color: #e2e8f0 !important;
        }

        html.light-mode .divide-\[\#1e1e2d\] > :not([hidden]) ~ :not([hidden]),
        html.light-mode .divide-\[\#232336\] > :not([hidden]) ~ :not([hidden]) {
            border-color: #f1f5f9 !important;
        }

        /* Tables in Light Mode */
        html.light-mode table {
            color: #1e293b !important;
        }

        html.light-mode thead tr {
            background-color: #f8fafc !important;
            border-bottom: 2px solid #e2e8f0 !important;
        }

        html.light-mode th {
            color: #475569 !important;
        }

        html.light-mode tbody tr:hover,
        html.light-mode .hover\:bg-\[\#181824\]:hover,
        html.light-mode .hover\:bg-neutral-800\/40:hover {
            background-color: #f8fafc !important;
        }

        /* Badges & Alerts in Light Mode */
        html.light-mode .bg-black\/80 {
            background-color: rgba(15, 23, 42, 0.6) !important;
        }

        html.light-mode .bg-emerald-950\/80 {
            background-color: #ecfdf5 !important;
            border-color: #6ee7b7 !important;
            color: #065f46 !important;
        }

        html.light-mode .bg-emerald-950\/80 i,
        html.light-mode .bg-emerald-950\/80 button {
            color: #059669 !important;
        }

        html.light-mode .bg-red-950\/80 {
            background-color: #fef2f2 !important;
            border-color: #fca5a5 !important;
            color: #991b1b !important;
        }

        html.light-mode .bg-red-950\/80 i,
        html.light-mode .bg-red-950\/80 button {
            color: #dc2626 !important;
        }

        html.light-mode .bg-amber-500\/10 {
            background-color: #fffbeb !important;
            border-color: #fde68a !important;
            color: #78350f !important;
        }

        /* Modals in Light Mode */
        html.light-mode #addMenuModal > div,
        html.light-mode #editMenuModal > div {
            background-color: #ffffff !important;
            border-color: #e2e8f0 !important;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
        }

        /* Summernote Sanctuary Dark Theme */
        .note-editor.note-frame {
            border: 1px solid #2e2e42 !important;
            border-radius: 10px !important;
            background-color: #111119 !important;
            overflow: hidden !important;
        }

        .note-editor.note-frame .note-toolbar {
            background-color: #171724 !important;
            border-bottom: 1px solid #28283c !important;
            padding: 8px 10px !important;
        }

        .note-toolbar .note-btn:not(.note-color-btn):not(.note-color-reset):not(.note-color-select-btn) {
            background-color: #232334 !important;
            border: 1px solid #34344d !important;
            color: #e2e8f0 !important;
            border-radius: 6px !important;
            padding: 5px 10px !important;
            font-size: 12px !important;
            cursor: pointer !important;
            transition: all 0.2s ease !important;
        }

        .note-toolbar .note-btn:not(.note-color-btn):not(.note-color-reset):not(.note-color-select-btn):hover {
            background-color: #35354e !important;
            color: #ffd700 !important;
            border-color: #d4af37 !important;
        }

        .note-toolbar .note-btn:not(.note-color-btn):not(.note-color-reset):not(.note-color-select-btn).active,
        .note-toolbar .note-btn:not(.note-color-btn):not(.note-color-reset):not(.note-color-select-btn):active {
            background-color: #d4af37 !important;
            color: #0b0b12 !important;
            font-weight: bold !important;
        }

        .note-editor.note-frame .note-editable {
            background-color: #0d0d15 !important;
            color: #f8fafc !important;
            font-family: 'Outfit', sans-serif !important;
            font-size: 14px !important;
            line-height: 1.7 !important;
            min-height: 220px;
            padding: 16px !important;
        }

        .note-editor.note-frame .note-editable p {
            margin-bottom: 0.75rem;
        }

        .note-editor.note-frame .note-statusbar {
            background-color: #171724 !important;
            border-top: 1px solid #28283c !important;
        }

        .note-editor.note-frame .note-resizebar .note-icon-bar {
            border-top: 1px solid #4a4a68 !important;
        }

        .note-editor .note-dropdown-menu {
            background-color: #171725 !important;
            border: 1px solid #34344d !important;
            color: #f1f5f9 !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7) !important;
            border-radius: 8px !important;
            padding: 8px 6px !important;
            z-index: 1050 !important;
        }

        .note-editor .note-dropdown-item,
        .note-editor .note-dropdown-menu a {
            color: #e2e8f0 !important;
            padding: 6px 14px !important;
            display: block !important;
            font-size: 13px !important;
            text-decoration: none !important;
        }

        .note-editor .note-dropdown-item:hover,
        .note-editor .note-dropdown-menu a:hover {
            background-color: #27273c !important;
            color: #ffd700 !important;
        }

        /* Color Palette & Color Buttons (Preserve inline background colors!) */
        .note-color .note-dropdown-menu {
            min-width: 360px !important;
            padding: 12px !important;
        }

        .note-color-palette {
            background-color: #1a1a29 !important;
            border: 1px solid #34344d !important;
            padding: 10px !important;
            border-radius: 8px !important;
        }

        .note-color-palette .note-color-row {
            display: flex !important;
            margin-bottom: 3px !important;
            gap: 2px !important;
        }

        .note-color-palette .note-color-btn {
            width: 20px !important;
            height: 20px !important;
            padding: 0 !important;
            margin: 0 !important;
            border: 1px solid rgba(0, 0, 0, 0.4) !important;
            border-radius: 3px !important;
            cursor: pointer !important;
            display: inline-block !important;
            transition: transform 0.15s ease, box-shadow 0.15s ease !important;
            /* DO NOT override background-color so actual colors show */
        }

        .note-color-palette .note-color-btn:hover {
            transform: scale(1.3) !important;
            z-index: 20 !important;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.9) !important;
            border-color: #ffffff !important;
        }

        .note-color-reset {
            background: #232334 !important;
            color: #e2e8f0 !important;
            border: 1px solid #34344d !important;
            margin: 6px 0 4px 0 !important;
            border-radius: 6px !important;
            padding: 5px 10px !important;
            font-size: 11px !important;
            cursor: pointer !important;
            width: 100% !important;
            text-align: center !important;
            display: block !important;
        }

        .note-color-reset:hover {
            background: #35354e !important;
            color: #ffd700 !important;
            border-color: #d4af37 !important;
        }

        .note-color-select-btn {
            background: #232334 !important;
            color: #ffd700 !important;
            border: 1px solid #34344d !important;
            border-radius: 6px !important;
            padding: 5px 10px !important;
            font-size: 11px !important;
            margin-top: 6px !important;
            cursor: pointer !important;
            width: 100% !important;
            text-align: center !important;
            display: block !important;
        }

        .note-color-select-btn:hover {
            background: #35354e !important;
            border-color: #d4af37 !important;
        }

        .note-color-palette .note-color-select {
            margin-top: 6px !important;
        }

        .note-modal .note-modal-content {
            background-color: #141420 !important;
            border: 1px solid #33334d !important;
            color: #f1f5f9 !important;
            border-radius: 12px !important;
        }

        .note-modal .note-modal-header {
            border-bottom: 1px solid #28283c !important;
            padding: 12px 18px !important;
        }

        .note-modal .note-modal-footer {
            border-top: 1px solid #28283c !important;
            padding: 12px 18px !important;
        }

        .note-modal .form-control {
            background-color: #0b0b12 !important;
            border: 1px solid #33334d !important;
            color: #fff !important;
            border-radius: 6px !important;
            padding: 8px 12px !important;
        }
    </style>

    <!-- jQuery & Summernote Lite (Rich WYSIWYG Editor) -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

    @stack('styles')
</head>

<body class="bg-[#090910] text-[#f1f1f6] min-h-screen flex flex-col">

    <!-- Top Admin Header -->
    <header
        class="bg-[#101018] border-b border-[#212130] px-6 py-3.5 flex items-center justify-between sticky top-0 z-40">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <img src="{{ $siteLogoUrl }}" alt="108 Astro Yagya" class="h-8 w-auto object-contain">
                <!-- <span class="font-heading font-bold text-amber-300 text-base tracking-wider hidden sm:inline">
                    108 ASTRO YAGYA <span class="text-[10px] text-neutral-400 font-sans uppercase px-2 py-0.5 bg-amber-500/10 border border-amber-500/20 rounded">Admin</span>
                </span> -->
            </a>
        </div>

        <div class="flex items-center gap-3">
            <!-- Light / Dark Mode Toggle Button -->
            <button id="adminThemeToggleBtn" type="button" class="admin-theme-toggle" title="Switch Light / Dark Mode">
                <i id="adminThemeIcon" class="fa fa-moon"></i>
                <span id="adminThemeText">Dark Mode</span>
            </button>

            <a href="{{ route('home') }}" target="_blank"
                class="text-xs px-3 py-1.5 rounded-lg bg-neutral-800 text-amber-300 hover:bg-neutral-700 transition-colors flex items-center gap-2">
                <i class="fa fa-external-link-alt text-[10px]"></i> Visit Live Website
            </a>

            <div class="flex items-center gap-3 pl-4 border-l border-neutral-800 text-xs text-neutral-300">
                <span>{{ auth()->user()->name ?? 'Administrator' }}</span>
                <a href="{{ route('admin.logout') }}" class="text-red-400 hover:text-red-300 transition-colors p-1 flex items-center gap-1.5 font-medium bg-red-500/10 hover:bg-red-500/20 px-2.5 py-1 rounded-lg border border-red-500/20" title="Logout">
                    <i class="fa fa-sign-out-alt"></i> <span class="text-[11px]">Logout</span>
                </a>
            </div>
        </div>
    </header>

    <!-- App Body: Sidebar + Main Content -->
    <div class="flex flex-1">
        <!-- Sidebar Navigation -->
        <aside class="w-64 bg-[#0d0d15] border-r border-[#1d1d2b] p-4 flex flex-col justify-between hidden md:flex">
            <div class="space-y-1">
                <div class="text-[11px] uppercase tracking-wider text-neutral-400 px-3 py-2 font-bold">
                    Core Management
                </div>
                <a href="{{ route('admin.dashboard') }}"
                    class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa fa-tachometer-alt w-5 text-amber-400"></i> Dashboard
                </a>
                <a href="{{ route('admin.inquiries.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}">
                    <i class="fa fa-envelope-open-text w-5 text-amber-400"></i> Inquiries & Leads
                </a>
                <a href="{{ route('admin.services.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                    <i class="fa fa-fire w-5 text-amber-400"></i> Services & Yagyas
                </a>
                <a href="{{ route('admin.categories.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="fa fa-layer-group w-5 text-amber-400"></i> Categories & Subs
                </a>
                <a href="{{ route('admin.testimonials.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                    <i class="fa fa-star w-5 text-amber-400"></i> Devotee Reviews
                </a>

                <div class="text-[11px] uppercase tracking-wider text-neutral-400 px-3 pt-4 pb-2 font-bold">
                    Frontend Customization
                </div>
                <a href="{{ route('admin.sliders.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.sliders.*') ? 'active' : '' }}">
                    <i class="fa fa-images w-5 text-amber-400"></i> Hero Sliders
                </a>
                <a href="{{ route('admin.pages.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                    <i class="fa fa-file-lines w-5 text-amber-400"></i> CMS Pages
                </a>
                <a href="{{ route('admin.menus.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
                    <i class="fa fa-bars w-5 text-amber-400"></i> Dynamic Menus
                </a>
                <a href="{{ route('admin.socials.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.socials.*') ? 'active' : '' }}">
                    <i class="fa fa-share-alt w-5 text-amber-400"></i> Social Links
                </a>
                <a href="{{ route('admin.faqs.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                    <i class="fa fa-question-circle w-5 text-amber-400"></i> Vedic FAQs
                </a>

                <div class="text-[11px] uppercase tracking-wider text-neutral-400 px-3 pt-4 pb-2 font-bold">
                    System & Settings
                </div>
                <a href="{{ route('admin.settings.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i class="fa fa-cog w-5 text-amber-400"></i> Site Settings
                </a>
            </div>

            <div class="pt-4 border-t border-neutral-800 text-[11px] text-neutral-400 px-3 flex items-center justify-between">
                <span>108 Astro Yagya v1.0</span>
                <a href="{{ route('admin.logout') }}" class="text-red-400 hover:text-red-300 flex items-center gap-1 font-semibold" title="Logout">
                    <i class="fa fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 p-6 md:p-8 overflow-y-auto">
            <!-- Flash Messages -->
            @if(session('success'))
                <div
                    class="mb-6 p-4 rounded-xl bg-emerald-950/80 border border-emerald-500 text-emerald-200 text-sm flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="fa fa-check-circle text-emerald-400 text-lg"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div
                    class="mb-6 p-4 rounded-xl bg-red-950/80 border border-red-500 text-red-200 text-sm flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="fa fa-exclamation-triangle text-red-400 text-lg"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-red-400 hover:text-white">&times;</button>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-950/80 border border-red-500 text-red-200 text-sm">
                    <div class="font-bold mb-1">Please fix the following validation issues:</div>
                    <ul class="list-disc list-inside space-y-1 text-xs">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Rich WYSIWYG Editor Auto Initialization -->
    <script>
        $(document).ready(function () {
            function fixSummernoteColorPalette() {
                $('.note-color-palette .note-color-btn').each(function () {
                    var colorVal = $(this).attr('data-value') || $(this).data('value');
                    if (colorVal) {
                        this.style.setProperty('background-color', colorVal, 'important');
                        this.style.setProperty('border', '1px solid rgba(0,0,0,0.25)', 'important');
                    }
                });
            }

            if (typeof $.fn.summernote !== 'undefined') {
                $('.rich-editor').each(function () {
                    var $textarea = $(this);
                    var placeholderText = $textarea.attr('placeholder') || 'Type content here... Use toolbar to style text, bold, colors, etc.';
                    var editorHeight = parseInt($textarea.data('height')) || 240;

                    $textarea.summernote({
                        placeholder: placeholderText,
                        tabsize: 2,
                        height: editorHeight,
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'italic', 'underline', 'clear']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link']],
                            ['view', ['fullscreen', 'codeview', 'undo', 'redo']]
                        ],
                        styleTags: [
                            'p',
                            { title: 'Heading 2', tag: 'h2', className: 'text-2xl font-bold', value: 'h2' },
                            { title: 'Heading 3', tag: 'h3', className: 'text-xl font-bold', value: 'h3' },
                            { title: 'Heading 4', tag: 'h4', className: 'text-lg font-bold', value: 'h4' },
                            'blockquote'
                        ],
                        callbacks: {
                            onInit: function () {
                                setTimeout(fixSummernoteColorPalette, 50);
                                setTimeout(fixSummernoteColorPalette, 300);
                            },
                            onChange: function (contents) {
                                $textarea.val(contents);
                            }
                        }
                    });
                });

                // Re-apply whenever color dropdown is toggled or clicked
                $(document).on('click mouseenter', '.note-color, .note-color .dropdown-toggle', function () {
                    setTimeout(fixSummernoteColorPalette, 10);
                    setTimeout(fixSummernoteColorPalette, 100);
                });
            }
        });
    </script>

    <!-- Admin Light / Dark Mode Toggle Script -->
    <script>
        function updateAdminThemeUI(isLight) {
            var textEl = document.getElementById('adminThemeText');
            var iconEl = document.getElementById('adminThemeIcon');
            if (textEl && iconEl) {
                if (isLight) {
                    textEl.textContent = 'Dark Mode';
                    iconEl.className = 'fa fa-moon text-indigo-500';
                } else {
                    textEl.textContent = 'Light Mode';
                    iconEl.className = 'fa fa-sun text-amber-400';
                }
            }
        }

        $(document).ready(function() {
            var isLight = $('html').hasClass('light-mode');
            updateAdminThemeUI(isLight);

            $('#adminThemeToggleBtn').on('click', function(e) {
                e.preventDefault();
                var currentlyLight = $('html').toggleClass('light-mode').hasClass('light-mode');
                localStorage.setItem('admin_theme', currentlyLight ? 'light' : 'dark');
                updateAdminThemeUI(currentlyLight);
            });
        });
    </script>

    @stack('scripts')
</body>

</html>