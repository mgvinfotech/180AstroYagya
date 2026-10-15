<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\SocialLink;
use App\Models\NavigationMenu;
use App\Models\HeroSlider;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Service;
use App\Models\Astrologer;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\Inquiry;
use App\Models\Page;
use App\Mail\InquiryNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Share common layout variables across views.
     */
    private function getCommonData(): array
    {
        $settings = SiteSetting::all()->pluck('value', 'key')->toArray();
        $socialLinks = SocialLink::where('is_active', true)->orderBy('order_index')->get();
        $headerMenus = NavigationMenu::where('location', 'header')
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->with(['children' => function ($q) {
                $q->where('is_active', true)->orderBy('order_index');
            }])
            ->orderBy('order_index')
            ->get();

        $allCategories = Category::where('is_active', true)
            ->with(['services' => function ($q) {
                $q->where('is_active', true)->orderBy('order_index');
            }])
            ->orderBy('order_index')
            ->get();

        return compact('settings', 'socialLinks', 'headerMenus', 'allCategories');
    }

    /**
     * Homepage with rich Vedic luxury sections.
     */
    public function index()
    {
        $common = $this->getCommonData();

        $sliders = HeroSlider::where('is_active', true)->orderBy('order_index')->get();
        $featuredServices = Service::where('is_active', true)
            ->with('category')
            ->orderBy('is_featured', 'desc')
            ->orderBy('order_index')
            ->get();

        $astrologers = Astrologer::where('is_active', true)->orderBy('order_index')->get();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order_index')->get();
        $faqs = Faq::where('is_active', true)->orderBy('order_index')->get();

        return view('frontend.home', array_merge($common, compact(
            'sliders',
            'featuredServices',
            'astrologers',
            'testimonials',
            'faqs'
        )));
    }

    /**
     * Dedicated Vedic Jyotish & Kundli Services Page.
     */
    public function jyotish()
    {
        $common = $this->getCommonData();

        $astrologers = Astrologer::where('is_active', true)->orderBy('order_index')->get();
        
        $jyotishServices = Service::where('is_active', true)
            ->whereHas('category', function ($cq) {
                $cq->where('type', 'jyotish');
            })
            ->with(['category', 'subcategory'])
            ->orderBy('order_index')
            ->get();

        $faqs = Faq::where('is_active', true)
            ->where(function($q) {
                $q->where('category', 'like', '%jyotish%')->orWhere('question', 'like', '%horoscope%')->orWhere('question', 'like', '%kundli%');
            })
            ->get();
        if ($faqs->isEmpty()) {
            $faqs = Faq::where('is_active', true)->take(5)->get();
        }

        return view('frontend.jyotish', array_merge($common, compact('astrologers', 'jyotishServices', 'faqs')));
    }

    /**
     * Dedicated Vedic Yagyas & Fire Ceremonies Page.
     */
    public function yagyas()
    {
        $common = $this->getCommonData();

        $yagyas = Service::where('is_active', true)
            ->whereHas('category', function ($q) {
                $q->where('type', 'yagya');
            })
            ->with(['category', 'subcategory'])
            ->orderBy('order_index')
            ->get();

        $yagyaCategories = Category::where('is_active', true)
            ->where('type', 'yagya')
            ->with(['services' => function ($q) {
                $q->where('is_active', true)->orderBy('order_index');
            }])
            ->orderBy('order_index')
            ->get();

        $astrologers = Astrologer::where('is_active', true)->orderBy('order_index')->get();

        return view('frontend.yagyas', array_merge($common, compact('yagyas', 'yagyaCategories', 'astrologers')));
    }

    /**
     * Dedicated Devotee Experiences & Testimonials Page.
     */
    public function testimonials()
    {
        $common = $this->getCommonData();

        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('order_index')
            ->get();

        $featuredServices = Service::where('is_active', true)->take(6)->get();

        return view('frontend.testimonials', array_merge($common, compact('testimonials', 'featuredServices')));
    }

    /**
     * Dedicated Ashram Contact & Sacred Sankalp Booking Page.
     */
    public function contact()
    {
        $common = $this->getCommonData();

        $astrologers = Astrologer::where('is_active', true)->get();
        $services = Service::where('is_active', true)->get();
        $faqs = Faq::where('is_active', true)->take(6)->get();

        return view('frontend.contact', array_merge($common, compact('astrologers', 'services', 'faqs')));
    }

    /**
     * Service / Yagya detail page.
     */
    public function service(string $slug)
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'subcategory'])
            ->firstOrFail();

        $relatedServices = Service::where('category_id', $service->category_id)
            ->where('id', '!=', $service->id)
            ->where('is_active', true)
            ->take(3)
            ->get();

        $astrologers = Astrologer::where('is_active', true)->get();
        $common = $this->getCommonData();

        return view('frontend.service-detail', array_merge($common, compact(
            'service',
            'relatedServices',
            'astrologers'
        )));
    }

    /**
     * Astrologer detail profile.
     */
    public function astrologer(string $slug)
    {
        $astrologer = Astrologer::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $services = Service::where('is_active', true)->get();
        $common = $this->getCommonData();

        return view('frontend.astrologer-detail', array_merge($common, compact(
            'astrologer',
            'services'
        )));
    }

    /**
     * Category archive page.
     */
    public function category(string $slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->with(['subcategories', 'services' => function ($q) {
                $q->where('is_active', true)->orderBy('order_index');
            }])
            ->firstOrFail();

        $common = $this->getCommonData();

        return view('frontend.category', array_merge($common, compact('category')));
    }

    /**
     * Specific Vedic Wisdom static/informational pages matching original site.
     */
    public function vedicPage(string $slug)
    {
        $common = $this->getCommonData();
        $page = Page::where('slug', $slug)->first();

        if (!$page || !$page->is_active) {
            abort(404, 'The sacred page you requested does not exist or has been removed.');
        }

        return view('frontend.vedic-page', array_merge($common, compact('slug', 'page')));
    }

    /**
     * Handle Inquiry and Booking Submission.
     */
    public function submitInquiry(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:150',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:30',
            'whatsapp' => 'nullable|string|max:30',
            'inquiry_type' => 'required|string|in:yagya_booking,jyotish_consultation,kundli_analysis,general',
            'service_id' => 'nullable|exists:services,id',
            'astrologer_id' => 'nullable|exists:astrologers,id',
            'date_of_birth' => 'nullable|date',
            'time_of_birth' => 'nullable|string|max:20',
            'place_of_birth' => 'nullable|string|max:120',
            'gotra' => 'nullable|string|max:100',
            'rashi_nakshatra' => 'nullable|string|max:100',
            'preferred_language' => 'nullable|string|max:50',
            'preferred_date' => 'nullable|date',
            'problem_description' => 'nullable|string|max:2000',
        ]);

        $inquiry = Inquiry::create($validated);

        // Attempt Email Dispatch via .env SMTP configuration
        $emailSent = false;
        try {
            $adminRecipient = config('mail.admin_address') 
                ?: env('MAIL_ADMIN_ADDRESS', SiteSetting::get('contact_email', config('mail.from.address', 'contact@108astroyagya.com')));

            // Send alert to admin
            Mail::to($adminRecipient)->send(new InquiryNotification($inquiry, 'admin'));
            
            // Send confirmation to devotee if email provided
            if (!empty($inquiry->email)) {
                Mail::to($inquiry->email)->send(new InquiryNotification($inquiry, 'seeker'));
            }

            $emailSent = true;
            $inquiry->update(['email_sent' => true]);
        } catch (\Throwable $e) {
            Log::error('Inquiry Mail Dispatch Failed: ' . $e->getMessage());
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Hari Om! Your sacred Sankalp request has been successfully registered. Our Vedic Acharya will contact you shortly.',
                'email_notified' => $emailSent,
            ]);
        }

        return back()->with('success', 'Hari Om! Your sacred Sankalp request has been successfully registered. Our Vedic Acharya will contact you shortly.');
    }
}
