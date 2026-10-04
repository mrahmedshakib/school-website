@extends('frontend.layouts.app')

@section('title', (app()->getLocale() === 'en' ? 'Notice Board | ' : 'নোটিশ বোর্ড | ') . ($websiteSetting->site_title ?? ($websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'বিদ্যালয়')))

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
            <span class="text-brand-300">{{ app()->getLocale() === 'en' ? 'Notice Board' : 'নোটিশ বোর্ড' }}</span>
        </nav>

        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-800/60 border border-brand-700/60 text-brand-200 text-xs font-bold tracking-wide mb-4 shadow-sm">
            🔔 {{ app()->getLocale() === 'en' ? 'Official Announcements' : 'জরুরি বিজ্ঞপ্তি ও নোটিশ' }}
        </span>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white">
            {{ app()->getLocale() === 'en' ? 'School Notice Board' : 'বিদ্যালয়ের নোটিশ বোর্ড' }}
        </h1>

        <p class="mt-4 text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
            {{ app()->getLocale() === 'en' ? 'Find all official academic, exam and admission related announcements here.' : 'বিদ্যালয়ের প্রাতিষ্ঠানিক, একাডেমিক, পরীক্ষা ও ভর্তি সংক্রান্ত সকল জরুরি নোটিশ এখানে প্রকাশিত হয়।' }}
        </p>
    </div>
</section>

{{-- =========================================================
    MAIN CONTENT & NOTICES
========================================================= --}}
<section class="py-12 sm:py-16 bg-slate-50 min-h-[60vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Filter & Search Bar --}}
        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/80 shadow-sm mb-8">
            <form method="GET" action="{{ route('notice') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        {{ app()->getLocale() === 'en' ? 'Category' : 'ক্যাটাগরি' }}
                    </label>
                    <select name="category" class="w-full text-sm rounded-xl border-slate-300 focus:border-brand-500 focus:ring-brand-500 bg-slate-50/70 p-2.5">
                        <option value="">{{ app()->getLocale() === 'en' ? 'All Categories' : 'সকল ক্যাটাগরি' }}</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        {{ app()->getLocale() === 'en' ? 'Search Keyword' : 'অনুসন্ধান' }}
                    </label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ app()->getLocale() === 'en' ? 'Search title or details...' : 'শিরোনাম বা বিবরণ দিয়ে খুঁজুন...' }}" class="w-full text-sm rounded-xl border-slate-300 focus:border-brand-500 focus:ring-brand-500 bg-slate-50/70 p-2.5">
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 bg-brand-700 hover:bg-brand-800 text-white font-semibold py-2.5 px-4 rounded-xl text-sm transition flex items-center justify-center gap-2 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        {{ app()->getLocale() === 'en' ? 'Filter' : 'ফিল্টার' }}
                    </button>
                    @if(request('category') || request('search'))
                        <a href="{{ route('notice') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium py-2.5 px-4 rounded-xl text-sm transition">
                            {{ app()->getLocale() === 'en' ? 'Reset' : 'রিসেট' }}
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Notice List --}}
        @if($notices->count() > 0)
            <div class="space-y-4">
                @foreach($notices as $notice)
                    <div class="group bg-white rounded-2xl border border-slate-200/90 p-5 sm:p-6 hover:shadow-lg hover:border-brand-200 transition-all duration-300">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                            <div class="flex items-start gap-4">
                                {{-- Date Badge --}}
                                <div class="shrink-0 w-16 h-16 rounded-2xl bg-brand-50 border border-brand-100 text-brand-800 flex flex-col items-center justify-center shadow-xs">
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-brand-600">{{ $notice->notice_date ? \Carbon\Carbon::parse($notice->notice_date)->format('M') : 'NEW' }}</span>
                                    <span class="text-xl font-black leading-none mt-0.5">{{ $notice->notice_date ? \Carbon\Carbon::parse($notice->notice_date)->format('d') : '📌' }}</span>
                                </div>

                                {{-- Title & Content --}}
                                <div>
                                    <div class="flex items-center gap-2 mb-2">
                                        @if($notice->category)
                                            <span class="px-3 py-0.5 rounded-full text-xs font-semibold bg-brand-50 text-brand-700 border border-brand-100">
                                                {{ $notice->category }}
                                            </span>
                                        @endif
                                        <span class="text-xs text-slate-400">
                                            {{ $notice->notice_date ? \Carbon\Carbon::parse($notice->notice_date)->format('Y') : '' }}
                                        </span>
                                    </div>

                                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-brand-700 transition mb-2">
                                        {{ $notice->title }}
                                    </h3>

                                    @if($notice->description)
                                        <p class="text-sm text-slate-600 leading-relaxed max-w-3xl">
                                            {{ $notice->description }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            {{-- File Attachment --}}
                            @if($notice->file)
                                <div class="shrink-0 sm:self-center mt-2 sm:mt-0">
                                    <a href="{{ asset($notice->file) }}" target="_blank" download class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-brand-700 text-white text-xs font-bold transition shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        {{ app()->getLocale() === 'en' ? 'Download PDF' : 'পিডিএফ ডাউনলোড' }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $notices->links() }}
            </div>
        @else
            <div class="bg-white rounded-3xl p-12 text-center border border-slate-200 shadow-sm max-w-xl mx-auto">
                <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center mx-auto text-3xl mb-4 text-brand-600">
                    🔔
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1">
                    {{ app()->getLocale() === 'en' ? 'No notices found' : 'কোনো নোটিশ পাওয়া যায়নি' }}
                </h3>
                <p class="text-sm text-slate-500">
                    {{ app()->getLocale() === 'en' ? 'Please adjust your search criteria or check back later.' : 'অন্য ক্যাটাগরি বা কিওয়ার্ড দিয়ে অনুসন্ধান করুন অথবা পরে আবার দেখুন।' }}
                </p>
            </div>
        @endif
    </div>
</section>
@endsection