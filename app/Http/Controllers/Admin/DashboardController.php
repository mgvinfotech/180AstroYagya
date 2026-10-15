<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Service;
use App\Models\Page;
use App\Models\Testimonial;
use App\Models\HeroSlider;
use App\Models\NavigationMenu;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_inquiries' => Inquiry::count(),
            'pending_inquiries' => Inquiry::where('status', 'pending')->count(),
            'total_services' => Service::count(),
            'total_pages' => Page::count(),
            'total_testimonials' => Testimonial::count(),
            'active_sliders' => HeroSlider::where('is_active', true)->count(),
            'menu_items' => NavigationMenu::count(),
        ];

        $recentInquiries = Inquiry::with(['service', 'astrologer'])
            ->latest()
            ->take(8)
            ->get();

        $featuredServices = Service::where('is_featured', true)
            ->with('category')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentInquiries', 'featuredServices'));
    }
}
