@extends('frontend.layouts.app')

@section('title', (app()->getLocale() === 'en' ? 'Academic Syllabus | ' : 'পাঠ্যক্রম ও সিলেবাস | ') . ($websiteSetting->site_title ?? ($websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'বিদ্যালয়')))

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
            <span class="text-brand-300">{{ app()->getLocale() === 'en' ? 'Academic Syllabus' : 'সিলেবাস ও পাঠ্যক্রম' }}</span>
        </nav>

        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-800/60 border border-brand-700/60 text-brand-200 text-xs font-bold tracking-wide mb-4 shadow-sm">
            📚 {{ app()->getLocale() === 'en' ? 'Academic Curriculum' : 'শিক্ষাক্রম ও মূল্যায়ন নির্দেশিকা' }}
        </span>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white">
            {{ app()->getLocale() === 'en' ? 'Class-wise Syllabus' : 'শ্রেণিভিত্তিক পাঠ্যক্রম ও সিলেবাস' }}
        </h1>

        <p class="mt-4 text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
            {{ app()->getLocale() === 'en' ? 'Download official academic syllabus and lesson plans for all classes in PDF format.' : 'সকল শ্রেণির পাঠ্যক্রম, বার্ষিক পাঠ পরিকল্পনা ও সিলেবাস পিডিএফ ফরম্যাটে ডাউনলোড করুন।' }}
        </p>
    </div>
</section>

{{-- =========================================================
    MAIN CONTENT
========================================================= --}}
<section class="py-12 sm:py-16 bg-slate-50 min-h-[60vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Filter & Search Bar --}}
        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/80 shadow-sm mb-8">
            <form method="GET" action="{{ route('syllabus') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        {{ app()->getLocale() === 'en' ? 'Select Class' : 'শ্রেণি নির্বাচন' }}
                    </label>
                    <select name="class" class="w-full text-sm rounded-xl border-slate-300 focus:border-brand-500 focus:ring-brand-500 bg-slate-50/70 p-2.5">
                        <option value="">{{ app()->getLocale() === 'en' ? 'All Classes' : 'সকল শ্রেণি' }}</option>
                        @foreach($classes as $c)
                            <option value="{{ $c }}" {{ request('class') == $c ? 'selected' : '' }}>{{ $c }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        {{ app()->getLocale() === 'en' ? 'Academic Year' : 'শিক্ষাবর্ষ' }}
                    </label>
                    <select name="academic_year" class="w-full text-sm rounded-xl border-slate-300 focus:border-brand-500 focus:ring-brand-500 bg-slate-50/70 p-2.5">
                        <option value="">{{ app()->getLocale() === 'en' ? 'All Years' : 'সকল শিক্ষাবর্ষ' }}</option>
                        @foreach($years as $y)
                            <option value="{{ $y }}" {{ request('academic_year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        {{ app()->getLocale() === 'en' ? 'Search Keyword' : 'অনুসন্ধান করুন' }}
                    </label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ app()->getLocale() === 'en' ? 'Subject or title...' : 'বিষয় বা শিরোনাম...' }}" class="w-full text-sm rounded-xl border-slate-300 focus:border-brand-500 focus:ring-brand-500 bg-slate-50/70 p-2.5">
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 bg-brand-700 hover:bg-brand-800 text-white font-semibold py-2.5 px-4 rounded-xl text-sm transition flex items-center justify-center gap-2 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        {{ app()->getLocale() === 'en' ? 'Filter' : 'ফিল্টার' }}
                    </button>
                    @if(request('class') || request('academic_year') || request('search'))
                        <a href="{{ route('syllabus') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium py-2.5 px-4 rounded-xl text-sm transition">
                            {{ app()->getLocale() === 'en' ? 'Reset' : 'রিসেট' }}
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Syllabus List --}}
        @if($syllabuses->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($syllabuses as $item)
                    <div class="group bg-white rounded-2xl p-6 border border-slate-200/90 hover:border-brand-300 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="flex items-start justify-between gap-3 mb-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-brand-50 text-brand-700 border border-brand-100">
                                    {{ $item->class }}
                                </span>
                                @if($item->academic_year)
                                    <span class="text-xs font-semibold text-slate-500 bg-slate-100 px-2.5 py-1 rounded-md">
                                        {{ $item->academic_year }}
                                    </span>
                                @endif
                            </div>

                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-brand-700 transition mb-2">
                                {{ $item->title }}
                            </h3>

                            @if($item->subject_name)
                                <p class="text-sm font-medium text-slate-700 mb-2 flex items-center gap-1.5">
                                    <span class="text-brand-600">📖</span>
                                    <span>{{ app()->getLocale() === 'en' ? 'Subject: ' : 'বিষয়: ' }}</span>
                                    <span class="font-bold text-slate-800">{{ $item->subject_name }}</span>
                                </p>
                            @endif

                            @if($item->description)
                                <p class="text-xs text-slate-500 leading-relaxed line-clamp-3 mb-4">
                                    {{ $item->description }}
                                </p>
                            @endif
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-3 mt-4">
                            <span class="text-xs text-slate-400">
                                {{ $item->created_at ? $item->created_at->format('d M, Y') : '' }}
                            </span>
                            @if($item->file_path)
                                <a href="{{ asset($item->file_path) }}" target="_blank" download class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-700 hover:bg-brand-800 text-white text-xs font-bold transition shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    {{ app()->getLocale() === 'en' ? 'Download PDF' : 'ডাউনলোড' }}
                                </a>
                            @else
                                <span class="text-xs font-medium text-slate-400 italic">
                                    {{ app()->getLocale() === 'en' ? 'No file attached' : 'ফাইল সংযুক্ত নেই' }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $syllabuses->links() }}
            </div>
        @else
            <div class="bg-white rounded-3xl p-12 text-center border border-slate-200 shadow-sm max-w-xl mx-auto">
                <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center mx-auto text-3xl mb-4 text-brand-600">
                    📚
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1">
                    {{ app()->getLocale() === 'en' ? 'No syllabus found' : 'কোনো সিলেবাস পাওয়া যায়নি' }}
                </h3>
                <p class="text-sm text-slate-500">
                    {{ app()->getLocale() === 'en' ? 'Try changing your search filters or check back later.' : 'অন্য শ্রেণি বা শিক্ষাবর্ষ নির্বাচন করে আবার চেষ্টা করুন।' }}
                </p>
            </div>
        @endif
    </div>
</section>
@endsection
