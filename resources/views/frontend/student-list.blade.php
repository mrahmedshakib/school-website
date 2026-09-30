@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Student List | ' . ($websiteSetting->site_title ?? 'School') : 'শিক্ষার্থী তালিকা | ' . ($websiteSetting->site_title ?? 'বিদ্যালয়'))

@section('content')
<section class="bg-gradient-to-b from-blue-50/50 via-slate-50 to-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb & Title --}}
        <div class="mb-8">
            <nav class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">{{ app()->getLocale() === 'en' ? 'Home' : 'হোম' }}</a>
                <span>/</span>
                <a href="{{ route('students') }}" class="hover:text-blue-600 transition">{{ app()->getLocale() === 'en' ? 'Students' : 'শিক্ষার্থী' }}</a>
                <span>/</span>
                <span class="text-blue-600">{{ app()->getLocale() === 'en' ? 'Student List' : 'শিক্ষার্থী তালিকা' }}</span>
            </nav>
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                        📋 {{ app()->getLocale() === 'en' ? 'Student Records' : 'শ্রেণিভিত্তিক শিক্ষার্থী তালিকা' }}
                    </span>
                    <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        {{ app()->getLocale() === 'en' ? 'Enrolled Student Directory' : 'অধ্যয়নরত শিক্ষার্থী তালিকা' }}
                    </h1>
                    <p class="mt-2 text-slate-600 max-w-2xl text-sm sm:text-base">
                        {{ app()->getLocale() === 'en' ? 'Search and view registered students by class, section and roll number.' : 'শ্রেণি, শাখা, শিক্ষাবর্ষ ও রোল নম্বর অনুযায়ী অধ্যয়নরত শিক্ষার্থীদের তথ্য অনুসন্ধান করুন।' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm mb-8">
            <form method="GET" action="{{ route('student-list') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        {{ app()->getLocale() === 'en' ? 'Class' : 'শ্রেণি' }}
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
                        {{ app()->getLocale() === 'en' ? 'Section' : 'শাখা' }}
                    </label>
                    <select name="section" class="w-full text-sm rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 bg-slate-50 p-2.5">
                        <option value="">{{ app()->getLocale() === 'en' ? 'All Sections' : 'সকল শাখা' }}</option>
                        @foreach($sections as $s)
                            <option value="{{ $s }}" {{ request('section') == $s ? 'selected' : '' }}>{{ $s }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        {{ app()->getLocale() === 'en' ? 'Session / Year' : 'শিক্ষাবর্ষ' }}
                    </label>
                    <select name="academic_year" class="w-full text-sm rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 bg-slate-50 p-2.5">
                        <option value="">{{ app()->getLocale() === 'en' ? 'All Years' : 'সকল শিক্ষাবর্ষ' }}</option>
                        @foreach($years as $y)
                            <option value="{{ $y }}" {{ request('academic_year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        {{ app()->getLocale() === 'en' ? 'Search Student' : 'অনুসন্ধান' }}
                    </label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ app()->getLocale() === 'en' ? 'Name, ID or Roll...' : 'নাম, আইডি বা রোল...' }}" class="w-full text-sm rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 bg-slate-50 p-2.5">
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-xl text-sm transition flex items-center justify-center gap-2 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        {{ app()->getLocale() === 'en' ? 'Filter' : 'ফিল্টার' }}
                    </button>
                    <a href="{{ route('student-list') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium py-2.5 px-3 rounded-xl text-sm transition">
                        {{ app()->getLocale() === 'en' ? 'Reset' : 'রিসেট' }}
                    </a>
                </div>
            </form>
        </div>

        {{-- Student Table --}}
        @if($students->count() > 0)
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden mb-8">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                            <tr class="bg-slate-50 text-xs font-bold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                                <th class="py-3.5 px-6">{{ app()->getLocale() === 'en' ? 'Roll' : 'রোল' }}</th>
                                <th class="py-3.5 px-6">{{ app()->getLocale() === 'en' ? 'Student Name' : 'শিক্ষার্থীর নাম' }}</th>
                                <th class="py-3.5 px-6">{{ app()->getLocale() === 'en' ? 'Class & Section' : 'শ্রেণি ও শাখা' }}</th>
                                <th class="py-3.5 px-6">{{ app()->getLocale() === 'en' ? 'Student ID' : 'আইডি নম্বর' }}</th>
                                <th class="py-3.5 px-6 text-center">{{ app()->getLocale() === 'en' ? 'Gender' : 'লিঙ্গ' }}</th>
                                <th class="py-3.5 px-6 text-center">{{ app()->getLocale() === 'en' ? 'Year' : 'শিক্ষাবর্ষ' }}</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($students as $st)
                                <tr class="hover:bg-blue-50/40 transition">
                                    <td class="py-3.5 px-6 font-mono font-bold text-blue-700">
                                        {{ $st->roll_no }}
                                    </td>
                                    <td class="py-3.5 px-6">
                                        <div class="flex items-center gap-3">
                                            @if($st->photo)
                                                <img src="{{ asset($st->photo) }}" alt="Photo" class="w-10 h-10 rounded-full object-cover border border-slate-200">
                                            @else
                                                <div class="w-10 h-10 rounded-full bg-slate-100 text-slate-500 font-bold flex items-center justify-center text-sm">
                                                    {{ mb_substr($st->name, 0, 1) }}
                                                </div>
                                            @endif
                                            <div>
                                                <span class="font-bold text-slate-900 block">{{ $st->name }}</span>
                                                @if($st->father_name_bn || $st->father_name_en)
                                                    <span class="text-xs text-slate-400 block">{{ app()->getLocale() === 'en' ? 'Father: ' . ($st->father_name_en ?? $st->father_name_bn) : 'পিতা: ' . ($st->father_name_bn ?? $st->father_name_en) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3.5 px-6 font-semibold text-slate-800">
                                        {{ $st->class }}
                                        @if($st->section)
                                            <span class="text-xs font-normal text-slate-500">({{ $st->section }})</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-6 font-mono text-xs text-slate-600">
                                        {{ $st->student_id ?? '-' }}
                                    </td>
                                    <td class="py-3.5 px-6 text-center">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $st->gender === 'Male' ? 'bg-sky-100 text-sky-800' : 'bg-pink-100 text-pink-800' }}">
                                            {{ $st->gender === 'Male' ? (app()->getLocale() === 'en' ? 'Male' : 'ছাত্র') : (app()->getLocale() === 'en' ? 'Female' : 'ছাত্রী') }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 px-6 text-center font-semibold text-slate-700">
                                        {{ $st->academic_year ?? date('Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-8">
                {{ $students->links() }}
            </div>
        @else
            <div class="bg-white rounded-2xl p-12 text-center border border-slate-200 shadow-sm">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-2xl text-slate-400 mb-4">
                    📋
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1">
                    {{ app()->getLocale() === 'en' ? 'No students found' : 'কোনো শিক্ষার্থী পাওয়া যায়নি' }}
                </h3>
                <p class="text-sm text-slate-500">
                    {{ app()->getLocale() === 'en' ? 'Try changing your search query or filter criteria.' : 'অন্য কোনো শ্রেণি বা কীওয়ার্ড দিয়ে অনুসন্ধান করুন।' }}
                </p>
            </div>
        @endif
    </div>
</section>
@endsection
