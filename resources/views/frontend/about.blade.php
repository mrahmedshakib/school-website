@extends('frontend.layouts.app')

@section('title', ($about?->title ?? ($websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'আমাদের কথা')) . ' | ' . ($websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'বিদ্যালয়'))

@section('meta_description')
{{ $about?->description ? Str::limit(strip_tags($about->description), 160) : ($websiteSetting->meta_description ?? '') }}
@endsection

@section('content')

{{-- =========================================================
    PAGE HEADER
========================================================= --}}
<section class="relative overflow-hidden bg-gradient-to-br from-brand-950 via-brand-900 to-slate-950 py-16 sm:py-20 text-white text-center">
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center">
        {{-- Breadcrumb --}}
        <nav class="flex items-center justify-center gap-2 text-xs font-semibold uppercase tracking-wider text-slate-400 mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition">{{ app()->getLocale() === 'en' ? 'Home' : 'হোম' }}</a>
            <span>/</span>
            <span class="text-brand-300">{{ app()->getLocale() === 'en' ? 'About Us' : 'আমাদের পরিচিতি' }}</span>
        </nav>

        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-800/60 border border-brand-700/60 text-brand-200 text-xs font-bold tracking-wide mb-4 shadow-sm">
            🏫 {{ app()->getLocale() === 'en' ? 'Institution Profile' : 'প্রতিষ্ঠান পরিচিতি' }}
        </span>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white">
            {{ $about?->title ?? ($websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'আমাদের পরিচিতি') }}
        </h1>
        @if(isset($websiteSetting) && $websiteSetting->tagline)
            <p class="mt-4 text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
                {{ $websiteSetting->tagline }}
            </p>
        @endif
    </div>
</section>

{{-- =========================================================
    ABOUT INTRO & MAIN CONTENT
========================================================= --}}
<section class="py-16 sm:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid items-center gap-12 lg:grid-cols-2">

            {{-- Image --}}
            <div>
                @if($about?->image)
                    <div class="overflow-hidden rounded-3xl bg-slate-100 shadow-xl border border-slate-200">
                        <img
                            src="{{ asset($about->image) }}"
                            alt="{{ $about->title ?? 'Institution Image' }}"
                            class="w-full h-[320px] sm:h-[420px] lg:h-[480px] object-cover transition-transform duration-500 hover:scale-105"
                        >
                    </div>
                @else
                    <div class="h-[360px] rounded-3xl bg-gradient-to-br from-brand-50 to-slate-100 border border-slate-200 flex flex-col items-center justify-center text-center p-8">
                        @if(isset($websiteSetting) && $websiteSetting->logo)
                            <img src="{{ asset($websiteSetting->logo) }}" alt="Logo" class="w-32 h-32 rounded-2xl object-contain mb-4 shadow-sm bg-white p-2">
                        @else
                            <div class="w-24 h-24 rounded-2xl bg-brand-700 text-white flex items-center justify-center text-4xl font-bold mb-4 shadow-md">
                                🏫
                            </div>
                        @endif
                        <h3 class="text-xl font-bold text-slate-900">
                            {{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'আমাদের বিদ্যালয়' }}
                        </h3>
                    </div>
                @endif
            </div>

            {{-- Text Description --}}
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-50 text-brand-700 border border-brand-100 mb-4">
                    {{ app()->getLocale() === 'en' ? 'History & Excellence' : 'ঐতিহ্য ও লক্ষ্য' }}
                </span>

                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 leading-tight">
                    {{ $about?->title ?? ($websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'আমাদের পরিচিতি') }}
                </h2>

                @if($about?->description)
                    <div class="mt-6 text-slate-600 leading-8 text-base sm:text-lg text-justify space-y-4">
                        {!! nl2br(e($about->description)) !!}
                    </div>
                @elseif(isset($websiteSetting) && $websiteSetting->footer_text)
                    <div class="mt-6 text-slate-600 leading-8 text-base sm:text-lg text-justify">
                        {{ $websiteSetting->footer_text }}
                    </div>
                @endif

                @if($about?->button_text && $about?->button_url)
                    <div class="mt-8">
                        <a
                            href="{{ $about->button_url }}"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-brand-700 hover:bg-brand-800 text-white font-bold text-sm shadow-md shadow-brand-700/20 transition"
                        >
                            {{ $about->button_text }}
                            <span>→</span>
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

{{-- =========================================================
    STATISTICS FROM DATABASE
========================================================= --}}
<section class="py-12 bg-slate-50 border-y border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 text-center">

            <div class="p-6 rounded-2xl bg-white border border-brand-100 shadow-sm hover:shadow-md transition">
                <div class="text-3xl sm:text-4xl font-black text-brand-700">
                    @bnDigit($totalTeachers)+
                </div>
                <p class="mt-2 text-sm font-semibold text-slate-700">
                    {{ app()->getLocale() === 'en' ? 'Honorable Teachers' : 'অভিজ্ঞ শিক্ষকবৃন্দ' }}
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-brand-100 shadow-sm hover:shadow-md transition">
                <div class="text-3xl sm:text-4xl font-black text-brand-700">
                    @bnDigit($totalStudents)+
                </div>
                <p class="mt-2 text-sm font-semibold text-slate-700">
                    {{ app()->getLocale() === 'en' ? 'Active Students' : 'নিয়মিত শিক্ষার্থী' }}
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-brand-100 shadow-sm hover:shadow-md transition">
                <div class="text-3xl sm:text-4xl font-black text-brand-700">
                    @bnDigit($totalClasses)
                </div>
                <p class="mt-2 text-sm font-semibold text-slate-700">
                    {{ app()->getLocale() === 'en' ? 'Academic Classes' : 'একাডেমিক শ্রেণি' }}
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white border border-brand-100 shadow-sm hover:shadow-md transition">
                <div class="text-3xl sm:text-4xl font-black text-brand-700">
                    @bnDigit($totalStaff)+
                </div>
                <p class="mt-2 text-sm font-semibold text-slate-700">
                    {{ app()->getLocale() === 'en' ? 'Supporting Staff' : 'কর্মকর্তা ও কর্মচারী' }}
                </p>
            </div>

        </div>
    </div>
</section>

{{-- =========================================================
    MISSION & VISION SECTION
========================================================= --}}
@if(isset($missionVision) && $missionVision)
<section class="py-16 sm:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-50 text-brand-700 border border-brand-100">
                {{ app()->getLocale() === 'en' ? 'Mission & Vision' : 'মিশন ও ভিশন' }}
            </span>
            <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-slate-900">
                {{ app()->getLocale() === 'en' ? 'Our Goals & Purpose' : 'আমাদের লক্ষ্য ও উদ্দেশ্য' }}
            </h2>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-slate-50 rounded-3xl p-8 border border-slate-200 hover:border-brand-200 shadow-sm transition">
                <div class="w-12 h-12 rounded-2xl bg-brand-700 text-white flex items-center justify-center text-2xl font-bold mb-5 shadow">
                    🎯
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-3">
                    {{ $missionVision->mission_title ?? (app()->getLocale() === 'en' ? 'Our Mission' : 'আমাদের মিশন') }}
                </h3>
                <p class="text-slate-600 leading-8 text-justify">
                    {!! nl2br(e($missionVision->mission_description)) !!}
                </p>
            </div>

            <div class="bg-slate-50 rounded-3xl p-8 border border-slate-200 hover:border-accent-200 shadow-sm transition">
                <div class="w-12 h-12 rounded-2xl bg-accent-600 text-white flex items-center justify-center text-2xl font-bold mb-5 shadow">
                    💡
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-3">
                    {{ $missionVision->vision_title ?? (app()->getLocale() === 'en' ? 'Our Vision' : 'আমাদের ভিশন') }}
                </h3>
                <p class="text-slate-600 leading-8 text-justify">
                    {!! nl2br(e($missionVision->vision_description)) !!}
                </p>
            </div>
        </div>
    </div>
</section>
@endif

{{-- =========================================================
    ADMINISTRATION PREVIEW
========================================================= --}}
@if(isset($administrations) && $administrations->count())
<section class="py-16 sm:py-20 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-10">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-50 text-brand-700 border border-brand-100">
                    {{ app()->getLocale() === 'en' ? 'Leadership' : 'পরিচালনা পর্ষদ' }}
                </span>
                <h2 class="mt-3 text-3xl font-extrabold text-slate-900">
                    {{ app()->getLocale() === 'en' ? 'Governing Body & Leadership' : 'নেতৃত্ব ও পরিচালনা পর্ষদ' }}
                </h2>
            </div>
            <a href="{{ route('leadership') }}" class="font-bold text-brand-700 hover:text-brand-900 transition">
                {{ app()->getLocale() === 'en' ? 'View All' : 'সকল দেখুন' }} →
            </a>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($administrations as $admin)
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-md hover:border-brand-200 transition">
                    <div class="h-52 bg-slate-100 overflow-hidden">
                        @if($admin->image)
                            <img src="{{ asset('storage/' . $admin->image) }}" alt="{{ $admin->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-5xl">👤</div>
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-base text-slate-900">{{ $admin->name }}</h3>
                        <p class="text-xs font-semibold text-brand-700 mt-1">{{ $admin->designation }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection