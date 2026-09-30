@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Result Search | ' . ($websiteSetting->site_title ?? 'School') : 'ফলাফল অনুসন্ধান | ' . ($websiteSetting->site_title ?? 'বিদ্যালয়'))

@section('content')
<section class="bg-gradient-to-b from-blue-50/50 via-slate-50 to-white py-12 sm:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb & Title --}}
        <div class="text-center mb-8">
            <nav class="flex items-center justify-center gap-2 text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">{{ app()->getLocale() === 'en' ? 'Home' : 'হোম' }}</a>
                <span>/</span>
                <a href="{{ route('results') }}" class="hover:text-blue-600 transition">{{ app()->getLocale() === 'en' ? 'Results' : 'ফলাফল' }}</a>
                <span>/</span>
                <span class="text-blue-600">{{ app()->getLocale() === 'en' ? 'Result Search' : 'ফলাফল অনুসন্ধান' }}</span>
            </nav>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                🔍 {{ app()->getLocale() === 'en' ? 'Individual Progress Report' : 'ব্যক্তিগত ফলাফল ও মার্কশিট' }}
            </span>
            <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                {{ app()->getLocale() === 'en' ? 'Online Result Search' : 'অনলাইন ফলাফল ও মার্কশিট অনুসন্ধান' }}
            </h1>
            <p class="mt-2 text-slate-600 max-w-xl mx-auto text-sm sm:text-base">
                {{ app()->getLocale() === 'en' ? 'Select your examination, class and enter your roll number to view and print your marksheet.' : 'পরীক্ষার নাম, শ্রেণি নির্বাচন করে এবং রোল নম্বর প্রদান করে আপনার বিস্তারিত মার্কশিট দেখুন ও প্রিন্ট করুন।' }}
            </p>
        </div>

        {{-- Search Card --}}
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-lg mb-10">
            <form method="GET" action="{{ route('result') }}" class="space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                            {{ app()->getLocale() === 'en' ? 'Select Class *' : 'শ্রেণি নির্বাচন করুন *' }}
                        </label>
                        <select name="class" required class="w-full text-sm rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 bg-slate-50 p-3">
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
                        <select name="exam_name" class="w-full text-sm rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 bg-slate-50 p-3">
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
                        <select name="academic_year" class="w-full text-sm rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 bg-slate-50 p-3">
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
                        <input type="text" name="roll_no" value="{{ request('roll_no') }}" required placeholder="{{ app()->getLocale() === 'en' ? 'e.g. 01, 101' : 'উদাহরণ: ০১, ১০১' }}" class="w-full text-base font-semibold rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 bg-slate-50 p-3 pl-11">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            🎓
                        </div>
                    </div>
                </div>

                <div class="pt-2 flex flex-col sm:flex-row gap-3">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3.5 px-6 rounded-xl text-base shadow-md hover:shadow-lg transition flex items-center justify-center gap-2">
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
                <div class="bg-white rounded-3xl border-2 border-indigo-100 shadow-xl overflow-hidden mb-12" id="printable-marksheet">
                    {{-- Marksheet Header --}}
                    <div class="bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 text-white p-6 sm:p-8 text-center relative">
                        <div class="flex items-center justify-center gap-3 mb-2">
                            @if(!empty($websiteSetting->logo))
                                <img src="{{ asset($websiteSetting->logo) }}" alt="Logo" class="h-14 w-14 object-contain rounded-full bg-white p-1">
                            @endif
                            <div class="text-left">
                                <h2 class="text-xl sm:text-2xl font-black tracking-wide">
                                    {{ $websiteSetting->site_title ?? 'BIAM LABORATORY SCHOOL' }}
                                </h2>
                                <p class="text-xs text-indigo-200">
                                    {{ $websiteSetting->address ?? 'Dhaka, Bangladesh' }}
                                </p>
                            </div>
                        </div>
                        <div class="inline-block mt-3 px-4 py-1 rounded-full bg-indigo-500/30 border border-indigo-400/40 text-xs font-bold uppercase tracking-wider text-indigo-200">
                            {{ app()->getLocale() === 'en' ? 'Official Academic Transcript / Marksheet' : 'অফিসিয়াল একাডেমিক মার্কশিট ও গ্রেড বিবরণী' }}
                        </div>
                    </div>

                    {{-- Student Information Card --}}
                    <div class="p-6 sm:p-8 bg-indigo-50/30 border-b border-indigo-100">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs sm:text-sm">
                            <div>
                                <span class="block text-slate-500 text-xs">{{ app()->getLocale() === 'en' ? 'Student Name' : 'শিক্ষার্থীর নাম' }}</span>
                                <span class="font-bold text-slate-900">{{ $studentMark->student_name }}</span>
                            </div>
                            <div>
                                <span class="block text-slate-500 text-xs">{{ app()->getLocale() === 'en' ? 'Roll No' : 'রোল নম্বর' }}</span>
                                <span class="font-bold text-slate-900">{{ $studentMark->roll_no }}</span>
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
                                <span class="font-black text-indigo-700 text-base">{{ number_format($studentMark->gpa, 2) }}</span>
                            </div>
                            <div>
                                <span class="block text-slate-500 text-xs">{{ app()->getLocale() === 'en' ? 'Grade / Result' : 'প্রাপ্ত গ্রেড ও ফলাফল' }}</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-bold text-xs {{ $studentMark->status === 'Passed' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                    {{ $studentMark->letter_grade }} ({{ $studentMark->status }})
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Subject Wise Marks Table --}}
                    <div class="p-6 sm:p-8">
                        <h4 class="text-sm font-bold uppercase tracking-wider text-slate-700 mb-4">
                            {{ app()->getLocale() === 'en' ? 'Subject-wise Performance & Grade' : 'বিষয়ভিত্তিক নম্বর ও গ্রেড বিবরণী' }}
                        </h4>

                        @php
                            $details = is_array($studentMark->marks_details) ? $studentMark->marks_details : json_decode($studentMark->marks_details, true);
                        @endphp

                        @if(!empty($details))
                            <div class="overflow-x-auto rounded-xl border border-slate-200">
                                <table class="w-full text-left border-collapse text-sm">
                                    <thead>
                                        <tr class="bg-slate-100 text-xs font-bold text-slate-700 uppercase tracking-wider">
                                            <th class="py-3 px-4">{{ app()->getLocale() === 'en' ? 'Subject' : 'বিষয়' }}</th>
                                            <th class="py-3 px-4 text-center">{{ app()->getLocale() === 'en' ? 'Marks' : 'প্রাপ্ত নম্বর' }}</th>
                                            <th class="py-3 px-4 text-center">{{ app()->getLocale() === 'en' ? 'Grade' : 'গ্রেড' }}</th>
                                            <th class="py-3 px-4 text-center">{{ app()->getLocale() === 'en' ? 'Point' : 'পয়েন্ট' }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @foreach($details as $sub)
                                            <tr class="hover:bg-slate-50">
                                                <td class="py-3 px-4 font-semibold text-slate-800">
                                                    {{ $sub['subject'] ?? $sub['subject_bn'] ?? '-' }}
                                                </td>
                                                <td class="py-3 px-4 text-center font-bold text-slate-900">
                                                    {{ $sub['marks'] ?? '-' }}
                                                </td>
                                                <td class="py-3 px-4 text-center">
                                                    <span class="inline-block px-2 py-0.5 rounded font-bold text-xs bg-indigo-50 text-indigo-700">
                                                        {{ $sub['grade'] ?? '-' }}
                                                    </span>
                                                </td>
                                                <td class="py-3 px-4 text-center font-mono font-semibold text-slate-700">
                                                    {{ isset($sub['point']) ? number_format($sub['point'], 2) : '-' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-indigo-50/70 font-bold text-slate-900 border-t-2 border-indigo-200">
                                            <td class="py-3 px-4">{{ app()->getLocale() === 'en' ? 'Total Marks / GPA' : 'সর্বমোট নম্বর ও গড় জিপিএ' }}</td>
                                            <td class="py-3 px-4 text-center text-indigo-800 font-extrabold">{{ $studentMark->total_marks ?? '-' }}</td>
                                            <td class="py-3 px-4 text-center text-indigo-800 font-extrabold">{{ $studentMark->letter_grade }}</td>
                                            <td class="py-3 px-4 text-center text-indigo-800 font-extrabold">{{ number_format($studentMark->gpa, 2) }}</td>
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
                                <p class="text-[11px]">{{ $websiteSetting->site_title ?? 'School Authority' }}</p>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-8 flex justify-end gap-3 print:hidden">
                            <button onclick="window.print()" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-semibold text-sm transition shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                                <span>{{ app()->getLocale() === 'en' ? 'Print Marksheet' : 'মার্কশিট প্রিন্ট করুন' }}</span>
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-3xl p-10 text-center border border-rose-200 shadow-sm mb-12">
                    <div class="w-16 h-16 bg-rose-50 rounded-full flex items-center justify-center mx-auto text-2xl text-rose-500 mb-4">
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
