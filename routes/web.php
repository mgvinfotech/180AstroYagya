<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\NavigationMenuController;
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AstrologerController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PageController;

/*
|--------------------------------------------------------------------------
| Frontend Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jyotish', [HomeController::class, 'jyotish'])->name('jyotish');
Route::get('/yagyas', [HomeController::class, 'yagyas'])->name('yagyas');
Route::get('/testimonials', [HomeController::class, 'testimonials'])->name('testimonials');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/service/{slug}', [HomeController::class, 'service'])->name('service.detail');
Route::get('/astrologer/{slug}', [HomeController::class, 'astrologer'])->name('astrologer.detail');
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category.detail');
Route::get('/vedic/{slug}', [HomeController::class, 'vedicPage'])->name('vedic.page');
Route::get('/page/{slug}', [HomeController::class, 'vedicPage'])->name('page.detail');
Route::post('/inquiry/submit', [HomeController::class, 'submitInquiry'])->name('inquiry.submit');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    | Protected Admin Sanctuary Routes
    */
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Site Settings
        Route::get('/settings', [SiteSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SiteSettingController::class, 'update'])->name('settings.update');

        // Navigation Menus
        Route::get('/menus', [NavigationMenuController::class, 'index'])->name('menus.index');
        Route::post('/menus', [NavigationMenuController::class, 'store'])->name('menus.store');
        Route::put('/menus/{menu}', [NavigationMenuController::class, 'update'])->name('menus.update');
        Route::delete('/menus/{menu}', [NavigationMenuController::class, 'destroy'])->name('menus.destroy');

        // Hero Sliders
        Route::resource('sliders', HeroSliderController::class)->except(['show']);

        // CMS Informational Pages
        Route::resource('pages', PageController::class)->except(['show']);

        // Categories & Subcategories
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::post('/subcategories', [CategoryController::class, 'storeSubcategory'])->name('subcategories.store');
        Route::delete('/subcategories/{subcategory}', [CategoryController::class, 'destroySubcategory'])->name('subcategories.destroy');

        // Services & Yagyas
        Route::resource('services', ServiceController::class)->except(['show']);

        // Astrologers / Acharyas
        Route::resource('astrologers', AstrologerController::class)->except(['show']);

        // Testimonials / Reviews
        Route::resource('testimonials', TestimonialController::class)->except(['show']);

        // Inquiries / Bookings Leads
        Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
        Route::get('/inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
        Route::patch('/inquiries/{inquiry}/status', [InquiryController::class, 'updateStatus'])->name('inquiries.status');
        Route::delete('/inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');

        // Social Links
        Route::get('/socials', [SocialLinkController::class, 'index'])->name('socials.index');
        Route::post('/socials', [SocialLinkController::class, 'store'])->name('socials.store');
        Route::put('/socials/{social}', [SocialLinkController::class, 'update'])->name('socials.update');
        Route::delete('/socials/{social}', [SocialLinkController::class, 'destroy'])->name('socials.destroy');

        // FAQs
        Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
        Route::post('/faqs', [FaqController::class, 'store'])->name('faqs.store');
        Route::put('/faqs/{faq}', [FaqController::class, 'update'])->name('faqs.update');
        Route::delete('/faqs/{faq}', [FaqController::class, 'destroy'])->name('faqs.destroy');
    });
});
