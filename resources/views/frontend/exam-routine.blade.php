@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Exam Routine | ' . ($websiteSetting->site_title ?? 'School') : 'পরীক্ষার রুটিন | ' . ($websiteSetting->site_title ?? 'বিদ্যালয়'))

@section('content')
<section class="bg-gradient-to-b from-blue-50/50 via-slate-50 to-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb & Title --}}
        <div class="mb-8">
            <nav class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">{{ app()->getLocale() === 'en' ? 'Home' : 'হোম' }}</a>
                <span>/</span>
                <span class="text-blue-600">{{ app()->getLocale() === 'en' ? 'Exam Routine' : 'পরীক্ষার রুটিন' }}</span>
            </nav>
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                        📝 {{ app()->getLocale() === 'en' ? 'Exam Schedules' : 'পরীক্ষা নিয়ন্ত্রক শাখা' }}
                    </span>
                    <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        {{ app()->getLocale() === 'en' ? 'Examination Routine & Schedule' : 'পরীক্ষার সময়সূচি ও রুটিন' }}
                    </h1>
                    <p class="mt-2 text-slate-600 max-w-2xl text-sm sm:text-base">
                        {{ app()->getLocale() === 'en' ? 'View and download term examinations, pre-test and model test routines.' : 'অর্ধবার্ষিক, বার্ষিক, প্রাক-নির্বাচনী ও মডেল টেস্ট পরীক্ষার সময়সূচি দেখুন ও ডাউনলোড করুন।' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm mb-8">
            <form method="GET" action="{{ route('exam-routine') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        {{ app()->getLocale() === 'en' ? 'Select Class' : 'শ্রেণি নির্বাচন' }}
                    </label>
                    <select name="class" class="w-full text-sm rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 bg-slate-50 p-2.5">
                        <option value="">{{ app()->getLocale() === 'en' ? 'All Classes' : 'সকল শ্রেণি' }}</option>
                        @foreach($classes as $c)
                            <option value="{{ $c }}" {{ request('class') == $c ? 'selected' : '' }}>{{ $c }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        {{ app()->getLocale() === 'en' ? 'Academic Year' : 'শিক্ষাবর্ষ' }}
                    </label>
                    <select name="academic_year" class="w-full text-sm rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 bg-slate-50 p-2.5">
                        <option value="">{{ app()->getLocale() === 'en' ? 'All Years' : 'সকল শিক্ষাবর্ষ' }}</option>
                        @foreach($years as $y)
                            <option value="{{ $y }}" {{ request('academic_year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2.5 px-4 rounded-xl text-sm transition flex items-center justify-center gap-2 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        {{ app()->getLocale() === 'en' ? 'Filter' : 'ফিল্টার' }}
                    </button>
                    <a href="{{ route('exam-routine') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium py-2.5 px-3 rounded-xl text-sm transition">
                        {{ app()->getLocale() === 'en' ? 'Reset' : 'রিসেট' }}
                    </a>
                </div>
            </form>
        </div>

        {{-- Exam Routines Grid --}}
        @if($examRoutines->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($examRoutines as $item)
                    <div class="group bg-white rounded-2xl p-6 border border-slate-200/90 hover:border-amber-300 hover:shadow-lg transition-all duration-200 flex flex-col justify-between">
                        <div>
                            <div class="flex items-start justify-between gap-3 mb-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                    {{ $item->class }}
                                </span>
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-md bg-slate-100 text-slate-700">
                                    {{ $item->academic_year ?? date('Y') }}
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-amber-600 transition mb-2">
                                {{ $item->title }}
                            </h3>

                            @if($item->exam_name)
                                <p class="text-sm font-semibold text-slate-700 mb-3 flex items-center gap-1.5">
                                    <span class="text-amber-500">🎯</span>
                                    <span>{{ $item->exam_name }}</span>
                                </p>
                            @endif

                            <div class="bg-amber-50/60 rounded-xl p-3 border border-amber-100 text-xs text-amber-900 space-y-1 mb-4">
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-600">{{ app()->getLocale() === 'en' ? 'Start Date:' : 'পরীক্ষা শুরু:' }}</span>
                                    <span class="font-bold">{{ $item->start_date ? $item->start_date->format('d M, Y') : '-' }}</span>
                                </div>
                                @if($item->end_date)
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-600">{{ app()->getLocale() === 'en' ? 'End Date:' : 'পরীক্ষা সমাপ্তি:' }}</span>
                                        <span class="font-bold">{{ $item->end_date->format('d M, Y') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-3">
                            <span class="text-xs text-slate-400">
                                {{ $item->created_at ? $item->created_at->format('d M, Y') : '' }}
                            </span>
                            @if($item->file_path)
                                <a href="{{ asset($item->file_path) }}" target="_blank" download class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold transition shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    {{ app()->getLocale() === 'en' ? 'Download Routine' : 'রুটিন ডাউনলোড' }}
                                </a>
                            @else
                                <span class="text-xs font-medium text-slate-400 italic">
                                    {{ app()->getLocale() === 'en' ? 'No routine file' : 'ফাইল সংযুক্ত নেই' }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $examRoutines->links() }}
            </div>
        @else
            <div class="bg-white rounded-2xl p-12 text-center border border-slate-200 shadow-sm">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-2xl text-slate-400 mb-4">
                    📝
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1">
                    {{ app()->getLocale() === 'en' ? 'No exam routine found' : 'কোনো পরীক্ষার রুটিন পাওয়া যায়নি' }}
                </h3>
                <p class="text-sm text-slate-500">
                    {{ app()->getLocale() === 'en' ? 'Try changing your search filters or check back later.' : 'অন্য শ্রেণি বা শিক্ষাবর্ষ নির্বাচন করে আবার চেষ্টা করুন।' }}
                </p>
            </div>
        @endif
    </div>
</section>
@endsection
