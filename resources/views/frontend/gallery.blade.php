@extends('frontend.layouts.app')

@section('title', (app()->getLocale() === 'en' ? 'Photo Gallery | ' : 'ফটো গ্যালারি | ') . ($websiteSetting->site_title ?? ($websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'বিদ্যালয়')))

@section('meta_description')
{{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name }} এর বিভিন্ন কার্যক্রম, অনুষ্ঠান ও বিশেষ মুহূর্তের ছবি দেখুন।
@endsection

@section('content')

{{-- =========================================================
    PAGE HEADER (HERO)
========================================================= --}}
<section class="relative overflow-hidden bg-gradient-to-br from-brand-950 via-brand-900 to-slate-950 py-16 sm:py-20 text-white text-center">
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center z-10">
        {{-- Breadcrumb --}}
        <nav class="flex items-center justify-center gap-2 text-xs font-semibold uppercase tracking-wider text-slate-400 mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition">{{ app()->getLocale() === 'en' ? 'Home' : 'হোম' }}</a>
            <span>/</span>
            <span class="text-brand-300">{{ app()->getLocale() === 'en' ? 'Gallery' : 'ফটো গ্যালারি' }}</span>
        </nav>

        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-800/60 border border-brand-700/60 text-brand-200 text-xs font-bold tracking-wide mb-4 shadow-sm">
            📸 {{ app()->getLocale() === 'en' ? 'Campus Life & Activities' : 'আমাদের কার্যক্রম ও স্মৃতিচিহ্ন' }}
        </span>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white">
            {{ app()->getLocale() === 'en' ? 'Photo Gallery' : 'ফটো গ্যালারি' }}
        </h1>

        <p class="mt-4 text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
            {{ app()->getLocale() === 'en' ? 'Memorable moments, cultural events, sports competitions and academic activities of our school.' : 'বিদ্যালয়ের বিভিন্ন অনুষ্ঠান, সহশিক্ষা কার্যক্রম, জাতীয় দিবস উদযাপন ও স্মরণীয় মুহূর্তের স্থিরচিত্র।' }}
        </p>
    </div>
</section>

{{-- =========================================================
    MAIN CONTENT
========================================================= --}}
<section class="py-12 sm:py-16 bg-slate-50 min-h-[60vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($galleries->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($galleries as $gallery)
                    <div class="group overflow-hidden rounded-3xl bg-white border border-slate-200/90 shadow-sm hover:shadow-xl hover:border-brand-300 transition-all duration-300 flex flex-col justify-between">
                        <a href="{{ asset($gallery->image) }}" target="_blank" class="block overflow-hidden relative">
                            @if($gallery->image)
                                <img
                                    src="{{ asset($gallery->image) }}"
                                    alt="{{ $gallery->title ?? 'Gallery Image' }}"
                                    class="w-full h-56 sm:h-64 object-cover group-hover:scale-105 transition duration-500"
                                >
                            @else
                                <div class="w-full h-56 sm:h-64 bg-slate-100 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4-4a3 3 0 014 0l4 4m-2-2l1-1a3 3 0 014 0l1 1M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2zm4-9h.01"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition flex items-center justify-center opacity-0 group-hover:opacity-100">
                                <span class="p-3 rounded-full bg-white/90 text-slate-900 shadow-md">
                                    🔍
                                </span>
                            </div>
                        </a>

                        @if($gallery->title || $gallery->description)
                            <div class="p-5">
                                @if($gallery->title)
                                    <h2 class="font-bold text-slate-900 group-hover:text-brand-700 transition text-base">
                                        {{ $gallery->title }}
                                    </h2>
                                @endif

                                @if($gallery->description)
                                    <p class="mt-1 text-xs text-slate-500 line-clamp-2">
                                        {{ $gallery->description }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-3xl border border-slate-200 py-16 text-center max-w-xl mx-auto shadow-sm">
                <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center mx-auto text-3xl mb-4 text-brand-600">
                    📸
                </div>
                <h2 class="mt-4 text-xl font-bold text-slate-900">
                    কোনো ছবি পাওয়া যায়নি
                </h2>
                <p class="mt-2 text-slate-500 text-sm">
                    বর্তমানে গ্যালারিতে কোনো ছবি প্রকাশিত হয়নি।
                </p>
            </div>
        @endif
    </div>
</section>
@endsection