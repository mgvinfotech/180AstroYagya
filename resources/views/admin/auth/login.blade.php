<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - 108 Astro Yagya Sanctuary</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Outfit:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Outfit', sans-serif; background: #070204; color: #fdf8ee; }
        .font-heading { font-family: 'Cinzel', serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-b from-[#180608] via-[#0d0406] to-[#070204]">

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

    <div class="max-w-md w-full bg-[#140608] border border-amber-500/40 rounded-2xl p-8 shadow-2xl shadow-black relative overflow-hidden">
        <!-- Top Glow -->
        <div class="absolute -top-20 -left-20 w-40 h-40 bg-amber-500/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <a href="{{ route('home') }}" class="inline-block transition-transform duration-300 hover:scale-105" title="Go to Website">
                    <img src="{{ $siteLogoUrl }}" alt="108 Astro Yagya" class="h-16 w-auto max-w-[240px] object-contain mx-auto filter drop-shadow-[0_2px_12px_rgba(212,175,55,0.3)]">
                </a>
            </div>
            <h1 class="text-xl font-bold font-heading text-amber-300 tracking-wider">
                108 ASTRO YAGYA
            </h1>
            <p class="text-xs text-neutral-400 mt-1 uppercase tracking-wider">
                Vedic Administrative Sanctuary
            </p>
        </div>

        @if(session('success'))
        <div class="mb-5 p-3 rounded-lg bg-emerald-950/80 border border-emerald-500/50 text-emerald-200 text-xs flex items-center gap-2">
            <i class="fa fa-check-circle text-emerald-400"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-5 p-3 rounded-lg bg-red-950/80 border border-red-500/50 text-red-200 text-xs">
            {{ session('error') }}
        </div>
        @endif

        @if($errors->any())
        <div class="mb-5 p-3 rounded-lg bg-red-950/80 border border-red-500/50 text-red-200 text-xs">
            {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-amber-300 uppercase tracking-wider mb-1.5">Email Address</label>
                <div class="relative">
                    <i class="fa fa-envelope absolute left-3.5 top-3.5 text-neutral-500 text-sm"></i>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required class="w-full bg-[#0a0304] border border-amber-500/30 rounded-lg pl-10 pr-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-400">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-amber-300 uppercase tracking-wider mb-1.5">Vedic Passkey</label>
                <div class="relative">
                    <i class="fa fa-lock absolute left-3.5 top-3.5 text-neutral-500 text-sm"></i>
                    <input type="password" name="password" value="" placeholder="••••••••" required class="w-full bg-[#0a0304] border border-amber-500/30 rounded-lg pl-10 pr-4 py-2.5 text-sm text-white focus:outline-none focus:border-amber-400">
                </div>
            </div>

            <div class="flex items-center justify-between text-xs text-neutral-400 pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-neutral-700 bg-neutral-900 text-amber-500">
                    <span>Keep me logged in</span>
                </label>
            </div>

            <button type="submit" class="w-full mt-2 py-3 bg-gradient-to-r from-amber-500 via-amber-400 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-black font-bold uppercase tracking-wider text-xs rounded-lg transition-all shadow-lg shadow-amber-500/20">
                Enter Sanctuary Portal
            </button>
        </form>

        <div class="mt-6 text-center text-xs text-neutral-400 pt-4 border-t border-neutral-800">
            <a href="{{ route('home') }}" class="hover:text-amber-300">← Return to Website</a>
        </div>
    </div>

</body>
</html>
