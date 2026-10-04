@extends('frontend.layouts.app')

@section('title', (app()->getLocale() === 'en' ? 'Result Search | ' : 'ফলাফল অনুসন্ধান | ') . ($websiteSetting->site_title ?? ($websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'বিদ্যালয়')))

@section('content')

{{-- =========================================================
    PAGE HEADER (HERO)
========================================================= --}}
<section class="relative overflow-hidden bg-gradient-to-br from-brand-950 via-brand-900 to-slate-950 py-16 sm:py-20 text-white text-center print:hidden">
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center z-10">
        {{-- Breadcrumb --}}
        <nav class="flex items-center justify-center gap-2 text-xs font-semibold uppercase tracking-wider text-slate-400 mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition">{{ app()->getLocale() === 'en' ? 'Home' : 'হোম' }}</a>
            <span>/</span>
            <a href="{{ route('results') }}" class="hover:text-white transition">{{ app()->getLocale() === 'en' ? 'Results' : 'ফলাফল' }}</a>
            <span>/</span>
            <span class="text-brand-300">{{ app()->getLocale() === 'en' ? 'Result Search' : 'ফলাফল অনুসন্ধান' }}</span>
        </nav>

        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-800/60 border border-brand-700/60 text-brand-200 text-xs font-bold tracking-wide mb-4 shadow-sm">
            🔍 {{ app()->getLocale() === 'en' ? 'Individual Progress Report' : 'ব্যক্তিগত ফলাফল ও মার্কশিট' }}
        </span>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white">
            {{ app()->getLocale() === 'en' ? 'Online Result Search' : 'অনলাইন ফলাফল ও মার্কশিট অনুসন্ধান' }}
        </h1>

        <p class="mt-4 text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
            {{ app()->getLocale() === 'en' ? 'Select your examination, class and enter your roll number to view and print your official marksheet.' : 'পরীক্ষার নাম, শ্রেণি নির্বাচন করে এবং রোল নম্বর প্রদান করে আপনার বিস্তারিত মার্কশিট দেখুন ও প্রিন্ট করুন।' }}
        </p>
    </div>
</section>

{{-- =========================================================
    MAIN CONTENT & SEARCH
========================================================= --}}
<section class="py-12 sm:py-16 bg-slate-50 min-h-[60vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Search Card --}}
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-xl mb-10 print:hidden">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                <span class="w-10 h-10 rounded-xl bg-brand-50 text-brand-700 flex items-center justify-center text-lg font-bold">
                    📝
                </span>
                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        {{ app()->getLocale() === 'en' ? 'Student Credentials' : 'শিক্ষার্থীর তথ্য প্রদান করুন' }}
                    </h2>
                    <p class="text-xs text-slate-500">
                        {{ app()->getLocale() === 'en' ? 'Fill all required fields to fetch official transcript' : 'মার্কশিট দেখতে প্রয়োজনীয় তথ্য সঠিকভাবে পূরণ করুন' }}
                    </p>
                </div>
            </div>

            <form method="GET" action="{{ route('result') }}" class="space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            {{ app()->getLocale() === 'en' ? 'Select Class *' : 'শ্রেণি নির্বাচন করুন *' }}
                        </label>
                        <select name="class" required class="w-full text-sm rounded-xl border-slate-300 focus:border-brand-500 focus:ring-brand-500 bg-slate-50/70 p-3">
                            <option value="">{{ app()->getLocale() === 'en' ? '-- Select Class --' : '-- শ্রেণি নির্বাচন --' }}</option>
                            @foreach($classes as $c)
                                <option value="{{ $c }}" {{ request('class') == $c ? 'selected' : '' }}>{{ $c }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            {{ app()->getLocale() === 'en' ? 'Examination Type' : 'পরীক্ষার ধরন' }}
                        </label>
                        <select name="exam_name" class="w-full text-sm rounded-xl border-slate-300 focus:border-brand-500 focus:ring-brand-500 bg-slate-50/70 p-3">
                            <option value="">{{ app()->getLocale() === 'en' ? '-- All Exams --' : '-- সকল পরীক্ষা --' }}</option>
                            @foreach($examNames as $e)
                                <option value="{{ $e }}" {{ request('exam_name') == $e ? 'selected' : '' }}>{{ $e }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            {{ app()->getLocale() === 'en' ? 'Academic Year' : 'শিক্ষাবর্ষ' }}
                        </label>
                        <select name="academic_year" class="w-full text-sm rounded-xl border-slate-300 focus:border-brand-500 focus:ring-brand-500 bg-slate-50/70 p-3">
                            <option value="">{{ app()->getLocale() === 'en' ? '-- All Years --' : '-- সকল বছর --' }}</option>
                            @foreach($years as $y)
                                <option value="{{ $y }}" {{ request('academic_year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                        {{ app()->getLocale() === 'en' ? 'Class Roll No. *' : 'শ্রেণির রোল নম্বর *' }}
                    </label>
                    <div class="relative">
                        <input type="text" name="roll_no" value="{{ request('roll_no') }}" required placeholder="{{ app()->getLocale() === 'en' ? 'e.g. 01, 101' : 'উদাহরণ: ০১, ১০১' }}" class="w-full text-base font-semibold rounded-xl border-slate-300 focus:border-brand-500 focus:ring-brand-500 bg-slate-50/70 p-3 pl-11">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            🎓
                        </div>
                    </div>
                </div>

                <div class="pt-2 flex flex-col sm:flex-row gap-3">
                    <button type="submit" class="flex-1 bg-brand-700 hover:bg-brand-800 text-white font-bold py-3.5 px-6 rounded-xl text-base shadow-md hover:shadow-brand-700/20 transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <span>{{ app()->getLocale() === 'en' ? 'Search Marksheet' : 'মার্কশিট অনুসন্ধান করুন' }}</span>
                    </button>
                    @if($searched)
                        <a href="{{ route('result') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-3.5 px-6 rounded-xl text-center transition">
                            {{ app()->getLocale() === 'en' ? 'Clear' : 'মুছে ফেলুন' }}
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Search Result Section --}}
        @if($searched)
            @if($studentMark)
                <div class="bg-white rounded-3xl border-2 border-brand-100 shadow-2xl overflow-hidden mb-12" id="printable-marksheet">
                    {{-- Marksheet Header --}}
                    <div class="bg-gradient-to-r from-brand-950 via-brand-900 to-slate-950 text-white p-6 sm:p-8 text-center relative">
                        <div class="flex items-center justify-center gap-3 mb-2">
                            @if(!empty($websiteSetting->logo))
                                <img src="{{ asset($websiteSetting->logo) }}" alt="Logo" class="h-16 w-16 object-contain rounded-2xl bg-white p-1.5 shadow-md">
                            @endif
                            <div class="text-left">
                                <h2 class="text-xl sm:text-2xl font-black tracking-wide">
                                    {{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? $websiteSetting->site_title ?? 'বিদ্যালয়' }}
                                </h2>
                                <p class="text-xs text-brand-200">
                                    {{ $websiteSetting->address ?? 'Bangladesh' }}
                                </p>
                            </div>
                        </div>
                        <div class="inline-block mt-3 px-4 py-1.5 rounded-full bg-brand-800/80 border border-brand-700/60 text-xs font-bold uppercase tracking-wider text-brand-200 shadow-sm">
                            {{ app()->getLocale() === 'en' ? 'Official Academic Transcript / Marksheet' : 'অফিসিয়াল একাডেমিক মার্কশিট ও গ্রেড বিবরণী' }}
                        </div>
                    </div>

                    {{-- Student Information Card --}}
                    <div class="p-6 sm:p-8 bg-brand-50/30 border-b border-brand-100">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs sm:text-sm">
                            <div>
                                <span class="block text-slate-500 text-xs">{{ app()->getLocale() === 'en' ? 'Student Name' : 'শিক্ষার্থীর নাম' }}</span>
                                <span class="font-bold text-slate-900 text-sm sm:text-base">{{ $studentMark->student_name }}</span>
                            </div>
                            <div>
                                <span class="block text-slate-500 text-xs">{{ app()->getLocale() === 'en' ? 'Roll No' : 'রোল নম্বর' }}</span>
                                <span class="font-bold text-brand-800 text-sm sm:text-base">{{ $studentMark->roll_no }}</span>
                            </div>
                            <div>
                                <span class="block text-slate-500 text-xs">{{ app()->getLocale() === 'en' ? 'Class & Section' : 'শ্রেণি ও শাখা' }}</span>
                                <span class="font-bold text-slate-900">{{ $studentMark->class }} {{ $studentMark->section ? '(' . $studentMark->section . ')' : '' }}</span>
                            </div>
                            <div>
                                <span class="block text-slate-500 text-xs">{{ app()->getLocale() === 'en' ? 'Student ID' : 'শিক্ষার্থী আইডি' }}</span>
                                <span class="font-bold text-slate-900">{{ $studentMark->student_id ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="block text-slate-500 text-xs">{{ app()->getLocale() === 'en' ? 'Examination' : 'পরীক্ষার নাম' }}</span>
                                <span class="font-bold text-slate-900">{{ $studentMark->exam_name }}</span>
                            </div>
                            <div>
                                <span class="block text-slate-500 text-xs">{{ app()->getLocale() === 'en' ? 'Academic Year' : 'শিক্ষাবর্ষ' }}</span>
                                <span class="font-bold text-slate-900">{{ $studentMark->academic_year ?? date('Y') }}</span>
                            </div>
                            <div>
                                <span class="block text-slate-500 text-xs">{{ app()->getLocale() === 'en' ? 'GPA' : 'জিপিএ (GPA)' }}</span>
                                <span class="font-black text-brand-700 text-base">{{ number_format($studentMark->gpa, 2) }}</span>
                            </div>
                            <div>
                                <span class="block text-slate-500 text-xs">{{ app()->getLocale() === 'en' ? 'Grade / Result' : 'প্রাপ্ত গ্রেড ও ফলাফল' }}</span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full font-bold text-xs {{ $studentMark->status === 'Passed' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                    {{ $studentMark->letter_grade }} ({{ $studentMark->status }})
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Subject Wise Marks Table --}}
                    <div class="p-6 sm:p-8">
                        <h4 class="text-sm font-bold uppercase tracking-wider text-slate-700 mb-4 flex items-center gap-2">
                            <span>📊</span>
                            <span>{{ app()->getLocale() === 'en' ? 'Subject-wise Performance & Grade' : 'বিষয়ভিত্তিক নম্বর ও গ্রেড বিবরণী' }}</span>
                        </h4>

                        @php
                            $details = is_array($studentMark->marks_details) ? $studentMark->marks_details : json_decode($studentMark->marks_details, true);
                        @endphp

                        @if(!empty($details))
                            <div class="overflow-x-auto rounded-2xl border border-slate-200">
                                <table class="w-full text-left border-collapse text-sm">
                                    <thead>
                                        <tr class="bg-slate-100/80 text-xs font-bold text-slate-700 uppercase tracking-wider">
                                            <th class="py-3.5 px-4">{{ app()->getLocale() === 'en' ? 'Subject' : 'বিষয়' }}</th>
                                            <th class="py-3.5 px-4 text-center">{{ app()->getLocale() === 'en' ? 'Marks' : 'প্রাপ্ত নম্বর' }}</th>
                                            <th class="py-3.5 px-4 text-center">{{ app()->getLocale() === 'en' ? 'Grade' : 'গ্রেড' }}</th>
                                            <th class="py-3.5 px-4 text-center">{{ app()->getLocale() === 'en' ? 'Point' : 'পয়েন্ট' }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @foreach($details as $sub)
                                            <tr class="hover:bg-brand-50/30 transition">
                                                <td class="py-3.5 px-4 font-semibold text-slate-800">
                                                    {{ $sub['subject'] ?? $sub['subject_bn'] ?? '-' }}
                                                </td>
                                                <td class="py-3.5 px-4 text-center font-bold text-slate-900">
                                                    {{ $sub['marks'] ?? '-' }}
                                                </td>
                                                <td class="py-3.5 px-4 text-center">
                                                    <span class="inline-block px-2.5 py-0.5 rounded font-bold text-xs bg-brand-50 text-brand-700 border border-brand-100">
                                                        {{ $sub['grade'] ?? '-' }}
                                                    </span>
                                                </td>
                                                <td class="py-3.5 px-4 text-center font-mono font-semibold text-slate-700">
                                                    {{ isset($sub['point']) ? number_format($sub['point'], 2) : '-' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-brand-50/60 font-bold text-slate-900 border-t-2 border-brand-200">
                                            <td class="py-3.5 px-4">{{ app()->getLocale() === 'en' ? 'Total Marks / GPA' : 'সর্বমোট নম্বর ও গড় জিপিএ' }}</td>
                                            <td class="py-3.5 px-4 text-center text-brand-800 font-extrabold">{{ $studentMark->total_marks ?? '-' }}</td>
                                            <td class="py-3.5 px-4 text-center text-brand-800 font-extrabold">{{ $studentMark->letter_grade }}</td>
                                            <td class="py-3.5 px-4 text-center text-brand-800 font-extrabold">{{ number_format($studentMark->gpa, 2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif

                        {{-- Remarks and Signature Placeholder --}}
                        <div class="mt-8 pt-8 border-t border-slate-200 flex flex-col sm:flex-row justify-between items-end gap-6 text-center text-xs text-slate-500">
                            <div>
                                <p class="italic text-slate-600 mb-1">
                                    {{ app()->getLocale() === 'en' ? 'Remarks: ' : 'মূল্যায়ন মন্তব্য: ' }}
                                    <span class="font-bold text-slate-800">{{ $studentMark->remarks ?? ($studentMark->gpa >= 4.0 ? 'Excellent performance' : 'Satisfactory') }}</span>
                                </p>
                                <p class="text-[11px] text-slate-400">{{ app()->getLocale() === 'en' ? 'System generated transcript' : 'সফটওয়্যার দ্বারা স্বয়ংক্রিয় মুদ্রিত ফলাফল' }}</p>
                            </div>
                            <div class="border-t border-slate-400 pt-2 px-6">
                                <p class="font-bold text-slate-800">{{ app()->getLocale() === 'en' ? 'Principal / Head of Institution' : 'অধ্যক্ষ / প্রতিষ্ঠান প্রধান' }}</p>
                                <p class="text-[11px]">{{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'School Authority' }}</p>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-8 flex justify-end gap-3 print:hidden">
                            <button onclick="window.print()" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-slate-900 hover:bg-brand-700 text-white font-bold text-sm transition shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                <span>{{ app()->getLocale() === 'en' ? 'Print Marksheet' : 'মার্কশিট প্রিন্ট করুন' }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-3xl p-10 text-center border border-rose-200 shadow-sm mb-12">
                    <div class="w-16 h-16 bg-rose-50 rounded-2xl flex items-center justify-center mx-auto text-3xl text-rose-500 mb-4">
                        ⚠️
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">
                        {{ app()->getLocale() === 'en' ? 'No result found!' : 'কোনো ফলাফল পাওয়া যায়নি!' }}
                    </h3>
                    <p class="text-sm text-slate-600 max-w-md mx-auto">
                        {{ app()->getLocale() === 'en' ? 'Please verify your Class, Exam Name and Roll Number and try again.' : 'অনুগ্রহ করে আপনার নির্বাচিত শ্রেণি, পরীক্ষা এবং রোল নম্বর সঠিকভাবে যাচাই করে পুনরায় অনুসন্ধান করুন।' }}
                    </p>
                </div>
            @endif
        @endif
    </div>
</section>
@endsection
