@extends('frontend.layouts.app')

@section('title', (app()->getLocale() === 'en' ? 'Administration & Governing Body | ' : 'প্রশাসন ও পরিচালনা পর্ষদ | ') . ($websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'বিদ্যালয়'))

@section('meta_description')
{{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name }} এর পরিচালনা পর্ষদ ও প্রশাসনিক কর্মকর্তা।
@endsection

@section('content')

{{-- =========================================================
    PAGE HEADER
========================================================= --}}
<section class="relative overflow-hidden bg-slate-950 py-16 sm:py-20 text-white">
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-950 via-slate-950 to-slate-900 opacity-90"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-slate-400 mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition">{{ app()->getLocale() === 'en' ? 'Home' : 'হোম' }}</a>
            <span>/</span>
            <span class="text-indigo-400">{{ app()->getLocale() === 'en' ? 'Administration' : 'প্রশাসন' }}</span>
        </nav>

        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 text-emerald-400 text-xs font-bold tracking-wide mb-4">
                🏛️ {{ app()->getLocale() === 'en' ? 'Governing Body' : 'পরিচালনা পর্ষদ ও প্রশাসন' }}
            </span>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight">
                {{ app()->getLocale() === 'en' ? 'Administration & Governance' : 'প্রশাসন ও পরিচালনা পর্ষদ' }}
            </h1>
            <p class="mt-4 text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl">
                {{ app()->getLocale() === 'en' ? 'Meet the dedicated administrative team and leadership steering our institution towards excellence.' : 'বিদ্যালয়ের সুষ্ঠু পরিচালনা, নীতি নির্ধারণ ও শিক্ষা পরিবেশ সমুন্নত রাখতে নিবেদিত পরিচালনা পর্ষদ।' }}
            </p>
        </div>
    </div>
</section>

{{-- =========================================================
    ADMINISTRATION SECTION
========================================================= --}}
<section class="bg-slate-50 py-16 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Heading --}}
        <div class="max-w-2xl mx-auto text-center mb-12">
            <span class="inline-flex items-center rounded-full bg-indigo-50 px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-indigo-700">
                {{ app()->getLocale() === 'en' ? 'Our Leaders' : 'সম্মানিত ব্যক্তিবর্গ' }}
            </span>
            <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-slate-900">
                {{ app()->getLocale() === 'en' ? 'Administration Members' : 'পরিচালনা পর্ষদের সম্মানিত সদস্যবৃন্দ' }}
            </h2>
        </div>

        {{-- Administration Cards --}}
        @if($administrations->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($administrations as $administration)
                    @php
                        $imgSrc = null;
                        if ($administration->image) {
                            $imgSrc = Str::startsWith($administration->image, ['http://', 'https://', 'images/', 'assets/'])
                                ? asset($administration->image)
                                : asset('storage/' . $administration->image);
                        }
                    @endphp

                    <article class="group bg-white rounded-3xl border border-slate-200/90 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between">
                        <div>
                            {{-- Image Area --}}
                            <div class="relative bg-slate-100 h-72 overflow-hidden">
                                @if($imgSrc)
                                    <img
                                        src="{{ $imgSrc }}"
                                        alt="{{ $administration->name }}"
                                        class="w-full h-full object-cover object-top group-hover:scale-105 transition-transform duration-500"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-slate-100 text-6xl text-slate-300">
                                        👤
                                    </div>
                                @endif

                                <div class="absolute top-4 right-4">
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-white/95 backdrop-blur-sm px-3 py-1 text-xs font-bold text-emerald-700 shadow-sm">
                                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                        {{ app()->getLocale() === 'en' ? 'Active' : 'সক্রিয়' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-slate-900 group-hover:text-indigo-600 transition">
                                    {{ $administration->name }}
                                </h3>

                                <p class="mt-1 text-sm font-semibold text-indigo-700">
                                    {{ $administration->designation }}
                                </p>

                                {{-- Contact Details --}}
                                @if($administration->phone || $administration->email)
                                    <div class="mt-5 pt-4 border-t border-slate-100 space-y-2 text-xs text-slate-600">
                                        @if($administration->phone)
                                            <p class="flex items-center gap-2">
                                                <span class="text-indigo-600">📞</span>
                                                <a href="tel:{{ $administration->phone }}" class="hover:underline font-medium">{{ $administration->phone }}</a>
                                            </p>
                                        @endif

                                        @if($administration->email)
                                            <p class="flex items-center gap-2">
                                                <span class="text-indigo-600">✉️</span>
                                                <a href="mailto:{{ $administration->email }}" class="hover:underline truncate">{{ $administration->email }}</a>
                                            </p>
                                        @endif
                                    </div>
                                @endif

                                {{-- Description / Message --}}
                                @if($administration->description)
                                    <div class="mt-4 pt-4 border-t border-slate-100 text-xs text-slate-500 leading-relaxed text-justify line-clamp-4">
                                        {{ $administration->description }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="max-w-xl mx-auto text-center py-16 bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">
                <div class="mx-auto w-20 h-20 rounded-2xl bg-indigo-50 flex items-center justify-center text-3xl mb-4">
                    👔
                </div>
                <h3 class="text-xl font-bold text-slate-900">
                    {{ app()->getLocale() === 'en' ? 'No Administration Data Found' : 'কোনো প্রশাসনিক তথ্য পাওয়া যায়নি' }}
                </h3>
            </div>
        @endif

    </div>
</section>

@endsection