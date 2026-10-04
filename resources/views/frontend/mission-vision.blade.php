@extends('frontend.layouts.app')

@section('title', (app()->getLocale() === 'en' ? 'Mission & Vision | ' : 'মিশন ও ভিশন | ') . ($websiteSetting->site_title ?? ($websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'বিদ্যালয়')))

@section('meta_description', 'বিদ্যালয়ের মিশন ও ভিশন।')

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
            <span class="text-brand-300">{{ app()->getLocale() === 'en' ? 'Mission & Vision' : 'মিশন ও ভিশন' }}</span>
        </nav>

        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-800/60 border border-brand-700/60 text-brand-200 text-xs font-bold tracking-wide mb-4 shadow-sm">
            🎯 {{ app()->getLocale() === 'en' ? 'Core Purpose & Objectives' : 'আমাদের লক্ষ্য ও উদ্দেশ্য' }}
        </span>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white">
            {{ app()->getLocale() === 'en' ? 'Our Mission & Vision' : 'আমাদের মিশন ও ভিশন' }}
        </h1>

        <p class="mt-4 text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
            {{ app()->getLocale() === 'en' ? 'The foundational principles, values, and long-term vision guiding our educational journey.' : 'সুশিক্ষিত, দক্ষ ও মানবিক গুণসম্পন্ন ভবিষ্যৎ প্রজন্ম গড়ে তোলার প্রত্যয়ে আমাদের অবিরাম প্রচেষ্টা।' }}
        </p>
    </div>
</section>

{{-- =========================================================
    MAIN CONTENT
========================================================= --}}
<section class="py-12 sm:py-16 bg-slate-50 min-h-[60vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($missionVision)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Mission --}}
                <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-slate-200/90 hover:border-brand-300 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-brand-50 text-brand-700 border border-brand-100 text-2xl mb-6 shadow-xs">
                        🎯
                    </div>

                    <h2 class="text-2xl font-bold text-slate-900 mb-4">
                        {{ $missionVision->mission_title ?? (app()->getLocale() === 'en' ? 'Our Mission' : 'আমাদের মিশন') }}
                    </h2>

                    <div class="text-slate-600 leading-8 text-base text-justify">
                        {!! nl2br(e($missionVision->mission_description)) !!}
                    </div>
                </div>

                {{-- Vision --}}
                <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-sm border border-slate-200/90 hover:border-brand-300 hover:shadow-xl transition-all duration-300">
                    <div class="w-14 h-14 flex items-center justify-center rounded-2xl bg-brand-50 text-brand-700 border border-brand-100 text-2xl mb-6 shadow-xs">
                        🔭
                    </div>

                    <h2 class="text-2xl font-bold text-slate-900 mb-4">
                        {{ $missionVision->vision_title ?? (app()->getLocale() === 'en' ? 'Our Vision' : 'আমাদের ভিশন') }}
                    </h2>

                    <div class="text-slate-600 leading-8 text-base text-justify">
                        {!! nl2br(e($missionVision->vision_description)) !!}
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-slate-200 max-w-xl mx-auto">
                <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center mx-auto text-3xl mb-4 text-brand-600">
                    🎯
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1">
                    {{ app()->getLocale() === 'en' ? 'Mission & Vision Pending' : 'মিশন ও ভিশনের তথ্য উপলব্ধ নেই' }}
                </h3>
                <p class="text-slate-500 text-sm">
                    {{ app()->getLocale() === 'en' ? 'Content is being updated by administration.' : 'মিশন ও ভিশনের তথ্য শীঘ্রই আপডেট করা হবে।' }}
                </p>
            </div>
        @endif
    </div>
</section>
@endsection
