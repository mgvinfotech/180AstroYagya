@extends('layouts.frontend')

@section('title', ($category->meta_title ?: $category->name) . ' - 108 Astro Yagya')
@section('meta_description', $category->meta_description ?: $category->short_desc)

@section('content')
<div class="py-16 bg-slate-50 text-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <nav class="flex items-center gap-2 text-xs text-slate-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-amber-600">Home</a>
            <span>/</span>
            <span class="text-amber-700 font-semibold">{{ $category->name }}</span>
        </nav>

        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="section-tag">
                Vedic Category Archive
            </span>
            <h1 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">
                {{ $category->name }}
            </h1>
            <p class="text-sm text-slate-600 leading-relaxed">
                {{ $category->short_desc }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($category->services as $service)
            <a href="{{ route('service.detail', $service->slug) }}" class="service-card group block hover:border-amber-500/60 transition-all duration-300 hover:-translate-y-1">
                <div class="service-card-header overflow-hidden">
                    <img src="{{ $service->image_url }}" alt="{{ $service->title }}" class="group-hover:scale-105 transition-transform duration-500">
                    <span class="service-category-badge">{{ $category->name }}</span>
                </div>

                <div class="service-card-body flex flex-col justify-between">
                    <div>
                        <h3 class="service-title group-hover:text-amber-500 dark:group-hover:text-amber-400 transition-colors">
                            {{ $service->title }}
                        </h3>

                        @if($service->subtitle)
                        <div class="text-xs text-amber-700 dark:text-amber-400 font-medium mb-2">{{ $service->subtitle }}</div>
                        @endif

                        <p class="service-desc dark:text-stone-300">
                            {{ Str::limit(strip_tags($service->short_desc ?: $service->detailed_desc), 130) }}
                        </p>
                    </div>

                    @if($service->duration)
                    <div class="pt-3 border-t border-slate-100 dark:border-stone-800/80 flex items-center justify-between text-xs text-slate-500 dark:text-stone-400">
                        <span><i class="fa fa-clock text-amber-500 mr-1"></i> {{ $service->duration }}</span>
                        <span class="text-amber-600 dark:text-amber-400 font-semibold group-hover:translate-x-1 transition-transform inline-flex items-center gap-1">
                            Read Vidhi <i class="fa fa-arrow-right text-[10px]"></i>
                        </span>
                    </div>
                    @endif
                </div>
            </a>
            @empty
            <div class="col-span-3 text-center py-16 bg-white rounded-2xl border border-slate-200">
                <p class="text-slate-500 text-sm">Services under this category will be listed shortly.</p>
                <a href="{{ route('home') }}" class="btn-vedic-gold text-xs mt-4">Return to Home</a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
