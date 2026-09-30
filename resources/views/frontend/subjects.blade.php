@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Academic Subjects | ' . ($websiteSetting->site_title ?? 'School') : 'পাঠ্য বিষয়সমূহ | ' . ($websiteSetting->site_title ?? 'বিদ্যালয়'))

@section('content')
<section class="bg-gradient-to-b from-blue-50/50 via-slate-50 to-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb & Title --}}
        <div class="mb-8">
            <nav class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">{{ app()->getLocale() === 'en' ? 'Home' : 'হোম' }}</a>
                <span>/</span>
                <span class="text-blue-600">{{ app()->getLocale() === 'en' ? 'Academic Subjects' : 'বিষয়সমূহ' }}</span>
            </nav>
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800">
                        📖 {{ app()->getLocale() === 'en' ? 'Curriculum Structure' : 'পাঠ্য বিষয় ও নম্বর বণ্টন' }}
                    </span>
                    <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        {{ app()->getLocale() === 'en' ? 'List of Academic Subjects' : 'শ্রেণিভিত্তিক পাঠ্য বিষয়সমূহ' }}
                    </h1>
                    <p class="mt-2 text-slate-600 max-w-2xl text-sm sm:text-base">
                        {{ app()->getLocale() === 'en' ? 'Detailed list of compulsory and elective subjects with subject codes and mark distributions.' : 'আবশ্যিক ও নৈর্বাচনিক বিষয়সমূহ, বিষয় কোড এবং পূর্ণমান ও মূল্যায়ন নির্দেশিকা।' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm mb-8">
            <form method="GET" action="{{ route('subjects') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        {{ app()->getLocale() === 'en' ? 'Filter by Class' : 'শ্রেণি নির্বাচন' }}
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
                        {{ app()->getLocale() === 'en' ? 'Group / Department' : 'বিভাগ / শাখা' }}
                    </label>
                    <select name="group_name" class="w-full text-sm rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 bg-slate-50 p-2.5">
                        <option value="">{{ app()->getLocale() === 'en' ? 'All Groups' : 'সকল বিভাগ' }}</option>
                        @foreach($groups as $g)
                            <option value="{{ $g }}" {{ request('group_name') == $g ? 'selected' : '' }}>{{ $g }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-4 rounded-xl text-sm transition flex items-center justify-center gap-2 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        {{ app()->getLocale() === 'en' ? 'Filter' : 'ফিল্টার' }}
                    </button>
                    <a href="{{ route('subjects') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium py-2.5 px-3 rounded-xl text-sm transition">
                        {{ app()->getLocale() === 'en' ? 'Reset' : 'রিসেট' }}
                    </a>
                </div>
            </form>
        </div>

        {{-- Class Groups Accordion/Cards --}}
        @if($subjects->count() > 0)
            <div class="space-y-8">
                @foreach($subjects as $className => $classSubjects)
                    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden">
                        <div class="bg-gradient-to-r from-slate-900 to-indigo-900 px-6 py-4 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="w-3 h-3 rounded-full bg-emerald-400"></span>
                                <h2 class="text-lg font-bold text-white tracking-wide">
                                    {{ $className }}
                                </h2>
                            </div>
                            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-white/20 text-white backdrop-blur-sm">
                                {{ $classSubjects->count() }} {{ app()->getLocale() === 'en' ? 'Subjects' : 'টি বিষয়' }}
                            </span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-50/80 text-xs font-bold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                        <th class="py-3.5 px-6">{{ app()->getLocale() === 'en' ? 'Code' : 'বিষয় কোড' }}</th>
                                        <th class="py-3.5 px-6">{{ app()->getLocale() === 'en' ? 'Subject Name' : 'বিষয়ের নাম' }}</th>
                                        <th class="py-3.5 px-6">{{ app()->getLocale() === 'en' ? 'Group' : 'বিভাগ' }}</th>
                                        <th class="py-3.5 px-6">{{ app()->getLocale() === 'en' ? 'Type' : 'ধরন' }}</th>
                                        <th class="py-3.5 px-6 text-center">{{ app()->getLocale() === 'en' ? 'Total Marks' : 'পূর্ণমান' }}</th>
                                        <th class="py-3.5 px-6 text-center">{{ app()->getLocale() === 'en' ? 'Theory / Practical' : 'তত্ত্বীয় / ব্যবহারিক' }}</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm">
                                    @foreach($classSubjects as $sub)
                                        <tr class="hover:bg-indigo-50/30 transition">
                                            <td class="py-3.5 px-6 font-mono font-bold text-indigo-700">
                                                {{ $sub->subject_code ?? '-' }}
                                            </td>
                                            <td class="py-3.5 px-6 font-bold text-slate-900">
                                                {{ $sub->name }}
                                                @if($sub->name_en && app()->getLocale() !== 'en')
                                                    <span class="block text-xs font-normal text-slate-500">{{ $sub->name_en }}</span>
                                                @elseif($sub->name_bn && app()->getLocale() === 'en')
                                                    <span class="block text-xs font-normal text-slate-500">{{ $sub->name_bn }}</span>
                                                @endif
                                            </td>
                                            <td class="py-3.5 px-6">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-700">
                                                    {{ $sub->group_name ?? 'General' }}
                                                </span>
                                            </td>
                                            <td class="py-3.5 px-6">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $sub->subject_type === 'Elective' ? 'bg-amber-100 text-amber-800' : 'bg-emerald-100 text-emerald-800' }}">
                                                    {{ $sub->subject_type ?? 'Compulsory' }}
                                                </span>
                                            </td>
                                            <td class="py-3.5 px-6 text-center font-bold text-slate-800">
                                                {{ $sub->total_marks ?? 100 }}
                                            </td>
                                            <td class="py-3.5 px-6 text-center text-xs text-slate-600">
                                                {{ $sub->theory_marks ?? '-' }} / {{ $sub->practical_marks ?? '0' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-2xl p-12 text-center border border-slate-200 shadow-sm">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-2xl text-slate-400 mb-4">
                    📖
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1">
                    {{ app()->getLocale() === 'en' ? 'No subjects found' : 'কোনো বিষয় পাওয়া যায়নি' }}
                </h3>
                <p class="text-sm text-slate-500">
                    {{ app()->getLocale() === 'en' ? 'Try adjusting your filters.' : 'অন্য শ্রেণি বা বিভাগ নির্বাচন করে চেষ্টা করুন।' }}
                </p>
            </div>
        @endif
    </div>
</section>
@endsection
