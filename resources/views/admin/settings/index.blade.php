@extends('layouts.admin')

@section('title', 'Site Settings')

@section('content')
<div class="max-w-5xl space-y-8">
    
    <div>
        <h1 class="text-2xl font-heading font-bold text-amber-300">
            Sanctuary & Website Settings
        </h1>
        <p class="text-xs text-neutral-400 mt-1">
            Manage global header alerts, ashram coordinates, footer content, branding, and SEO meta tags.
        </p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- 1. Branding & Header Top Alert -->
        <div class="admin-card p-6 space-y-5">
            <h3 class="font-heading text-lg font-bold text-white border-b border-[#222233] pb-3 flex items-center gap-2">
                <i class="fa fa-paint-brush text-amber-400"></i>
                Branding & Header Notification
            </h3>

            <!-- Logo & Favicon Upload -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 p-4 rounded-xl bg-black/30 border border-[#2a2a3e]">
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-2">Website Logo</label>
                    <div class="flex items-center gap-4">
                        @php
                            $currentLogo = $settings['general']['site_logo']->value ?? null;
                            $logoPreviewUrl = asset('images/logo.png');
                            if ($currentLogo) {
                                if (str_starts_with($currentLogo, 'http')) {
                                    $logoPreviewUrl = $currentLogo;
                                } elseif (file_exists(public_path('uploads/settings/' . $currentLogo))) {
                                    $logoPreviewUrl = asset('uploads/settings/' . $currentLogo);
                                } elseif (file_exists(public_path('images/' . $currentLogo))) {
                                    $logoPreviewUrl = asset('images/' . $currentLogo);
                                }
                            }
                        @endphp
                        <div class="w-32 h-14 bg-neutral-900 border border-neutral-700 rounded-lg p-1.5 flex items-center justify-center overflow-hidden shrink-0">
                            <img id="logoPreviewImg" src="{{ $logoPreviewUrl }}" alt="Logo" class="max-h-full max-w-full object-contain">
                        </div>
                        <div class="flex-1">
                            <input type="file" name="site_logo_file" id="site_logo_file" accept="image/*" class="form-input-admin text-xs py-1" onchange="previewSettingImage(this, 'logoPreviewImg')">
                            <span class="text-[10px] text-neutral-400 mt-1 block">PNG, WebP or JPG (Transparent background recommended)</span>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-2">Favicon Icon</label>
                    <div class="flex items-center gap-4">
                        @php
                            $currentFavicon = $settings['general']['site_favicon']->value ?? null;
                            $favPreviewUrl = asset('images/logo.png');
                            if ($currentFavicon) {
                                if (str_starts_with($currentFavicon, 'http')) {
                                    $favPreviewUrl = $currentFavicon;
                                } elseif (file_exists(public_path('uploads/settings/' . $currentFavicon))) {
                                    $favPreviewUrl = asset('uploads/settings/' . $currentFavicon);
                                }
                            }
                        @endphp
                        <div class="w-12 h-12 bg-neutral-900 border border-neutral-700 rounded-lg p-1 flex items-center justify-center overflow-hidden shrink-0">
                            <img id="favPreviewImg" src="{{ $favPreviewUrl }}" alt="Favicon" class="max-h-full max-w-full object-contain">
                        </div>
                        <div class="flex-1">
                            <input type="file" name="favicon_file" id="favicon_file" accept="image/*,.ico" class="form-input-admin text-xs py-1" onchange="previewSettingImage(this, 'favPreviewImg')">
                            <span class="text-[10px] text-neutral-400 mt-1 block">PNG or ICO (32x32 px)</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Website Name</label>
                    <input type="text" name="site_name" value="{{ $settings['general']['site_name']->value ?? '108 Astro Yagya' }}" class="form-input-admin">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Logo Text</label>
                    <input type="text" name="logo_text" value="{{ $settings['general']['logo_text']->value ?? '108 ASTRO YAGYA' }}" class="form-input-admin">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Website Tagline</label>
                <input type="text" name="site_tagline" value="{{ $settings['general']['site_tagline']->value ?? '' }}" class="form-input-admin">
            </div>

            <div class="p-4 rounded-xl bg-black/40 border border-amber-500/20 space-y-4">
                <div class="text-xs font-bold text-amber-400 uppercase tracking-wider">Top Header Alert Bar</div>
                <div>
                    <label class="block text-xs text-neutral-400 mb-1">Alert Notification Text</label>
                    <input type="text" name="header_alert_text" value="{{ $settings['header']['header_alert_text']->value ?? '' }}" class="form-input-admin" placeholder="e.g. Navratri Special Yagya Sankalp Open!">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-neutral-400 mb-1">Button Label</label>
                        <input type="text" name="header_alert_btn_text" value="{{ $settings['header']['header_alert_btn_text']->value ?? 'Book Live Sankalp' }}" class="form-input-admin">
                    </div>
                    <div>
                        <label class="block text-xs text-neutral-400 mb-1">Button Destination Link</label>
                        <input type="text" name="header_alert_url" value="{{ $settings['header']['header_alert_url']->value ?? '#booking-section' }}" class="form-input-admin">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Sacred Vedic Shloka (Displayed in Top Utility Bar)</label>
                <input type="text" name="shloka_text" value="{{ $settings['general']['shloka_text']->value ?? '' }}" class="form-input-admin">
            </div>
        </div>

        <!-- 2. Contact & Ashram Coordinates -->
        <div class="admin-card p-6 space-y-5">
            <h3 class="font-heading text-lg font-bold text-white border-b border-[#222233] pb-3 flex items-center gap-2">
                <i class="fa fa-phone-alt text-amber-400"></i>
                Ashram Contacts & Communication
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Contact Email</label>
                    <input type="email" name="contact_email" value="{{ $settings['contact']['contact_email']->value ?? '' }}" class="form-input-admin">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Primary Phone</label>
                    <input type="text" name="contact_phone" value="{{ $settings['contact']['contact_phone']->value ?? '' }}" class="form-input-admin">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">WhatsApp (Digits with country code)</label>
                    <input type="text" name="whatsapp_number" value="{{ $settings['contact']['whatsapp_number']->value ?? '' }}" class="form-input-admin" placeholder="919450545678">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">International Toll-Free / Alt Phone</label>
                    <input type="text" name="contact_phone_alt" value="{{ $settings['contact']['contact_phone_alt']->value ?? '' }}" class="form-input-admin">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-neutral-300 mb-1">Service & Consultation Hours</label>
                    <input type="text" name="working_hours" value="{{ $settings['contact']['working_hours']->value ?? '' }}" class="form-input-admin">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Headquarters & Ashram Address</label>
                <textarea name="office_address" rows="2" class="form-input-admin">{{ $settings['contact']['office_address']->value ?? '' }}</textarea>
            </div>
        </div>

        <!-- 3. Footer Content -->
        <div class="admin-card p-6 space-y-5">
            <h3 class="font-heading text-lg font-bold text-white border-b border-[#222233] pb-3 flex items-center gap-2">
                <i class="fa fa-shoe-prints text-amber-400"></i>
                Footer & Legal
            </h3>

            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Footer About Description</label>
                <textarea name="footer_about" rows="3" class="form-input-admin">{{ $settings['footer']['footer_about']->value ?? '' }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Copyright Text</label>
                <input type="text" name="footer_copyright" value="{{ $settings['footer']['footer_copyright']->value ?? '' }}" class="form-input-admin">
            </div>
        </div>

        <!-- 4. SEO Meta Tags -->
        <div class="admin-card p-6 space-y-5">
            <h3 class="font-heading text-lg font-bold text-white border-b border-[#222233] pb-3 flex items-center gap-2">
                <i class="fa fa-search text-amber-400"></i>
                Search Engine Optimization (SEO)
            </h3>

            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Default Meta Title</label>
                <input type="text" name="meta_title" value="{{ $settings['seo']['meta_title']->value ?? '' }}" class="form-input-admin">
            </div>

            <div>
                <label class="block text-xs font-semibold text-neutral-300 mb-1">Default Meta Description</label>
                <textarea name="meta_description" rows="2" class="form-input-admin">{{ $settings['seo']['meta_description']->value ?? '' }}</textarea>
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex justify-end">
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-black font-bold uppercase tracking-wider text-xs rounded-lg transition-all shadow-lg shadow-amber-500/20">
                <i class="fa fa-save mr-2"></i> Save Sanctuary Configurations
            </button>
        </div>
    </form>
</div>

<script>
function previewSettingImage(input, targetId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var target = document.getElementById(targetId);
            if (target) {
                target.src = e.target.result;
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
