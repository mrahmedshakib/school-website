@extends('frontend.layouts.app')

@section('title', 'অনলাইন ভর্তি আবেদন | Online Admission Application')

@section('meta_description')
বিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ, দুপচাঁচিয়া, বগুড়ায় অনলাইন ভর্তি আবেদন ফরম। প্রয়োজনীয় তথ্য দিয়ে সহজে আবেদন করুন।
@endsection

@section('content')

@php
    $captcha1 = rand(2, 9);
    $captcha2 = rand(1, 8);
@endphp

{{-- HERO / PROCESS BREADCRUMB --}}
<section class="relative overflow-hidden bg-slate-950 py-10 sm:py-14 text-white">
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-950 via-slate-950 to-slate-900"></div>
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-indigo-500/10 blur-3xl"></div>
    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-indigo-500/20 border border-indigo-400/30 text-indigo-300 text-xs font-bold uppercase tracking-widest">
            🎓 Admission Session {{ date('Y') }}
        </span>
        <h1 class="mt-4 text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight">
            অনলাইন ভর্তি আবেদন ফরম
        </h1>
        <p class="mt-3 text-sm sm:text-base text-slate-300 max-w-2xl mx-auto leading-6">
            {{ $websiteSetting->school_name_bn ?? 'বিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ' }}-এ {{ date('Y') }} শিক্ষাবর্ষের ভর্তি কার্যক্রম চলছে। সঠিক ও নির্ভুল তথ্য প্রদান করে আবেদন সম্পন্ন করুন।
        </p>

        {{-- 4-STEP FLOW INDICATOR --}}
        <div class="mt-8 grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-3 max-w-4xl mx-auto text-left">
            <!-- Step 1: Active -->
            <div class="rounded-2xl border-2 border-indigo-400 bg-indigo-600/30 p-3.5 backdrop-blur shadow-sm">
                <span class="w-6 h-6 rounded-full bg-indigo-400 text-slate-950 text-xs font-black inline-flex items-center justify-center mb-1.5">১</span>
                <p class="text-xs font-bold text-white">আবেদন ফরম পূরণ</p>
                <span class="text-[10px] text-indigo-200 block">চলমান ধাপ (Active)</span>
            </div>
            <!-- Step 2 -->
            <div class="rounded-2xl border border-white/10 bg-white/5 p-3.5 backdrop-blur text-slate-400">
                <span class="w-6 h-6 rounded-full bg-white/10 text-slate-300 text-xs font-bold inline-flex items-center justify-center mb-1.5">২</span>
                <p class="text-xs font-bold text-slate-200">নিশ্চিতকরণ ও PDF</p>
                <span class="text-[10px] text-slate-400 block">Application No সংগ্রহ</span>
            </div>
            <!-- Step 3 -->
            <div class="rounded-2xl border border-white/10 bg-white/5 p-3.5 backdrop-blur text-slate-400">
                <span class="w-6 h-6 rounded-full bg-white/10 text-slate-300 text-xs font-bold inline-flex items-center justify-center mb-1.5">৩</span>
                <p class="text-xs font-bold text-slate-200">ভর্তি ফি প্রদান</p>
                <span class="text-[10px] text-slate-400 block">SSLCOMMERZ / MFS</span>
            </div>
            <!-- Step 4 -->
            <div class="rounded-2xl border border-white/10 bg-white/5 p-3.5 backdrop-blur text-slate-400">
                <span class="w-6 h-6 rounded-full bg-white/10 text-slate-300 text-xs font-bold inline-flex items-center justify-center mb-1.5">৪</span>
                <p class="text-xs font-bold text-slate-200">লটারি ও ভর্তি</p>
                <span class="text-[10px] text-slate-400 block">মেধাতালিকা ও চূড়ান্ত ভর্তি</span>
            </div>
        </div>
    </div>
</section>

<div class="bg-slate-50 py-10 sm:py-14">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

        {{-- QUICK LINKS BAR --}}
        <div class="mb-8 flex flex-wrap items-center justify-between gap-3 p-4 rounded-2xl bg-white border border-slate-200 shadow-sm text-sm">
            <span class="text-slate-600 font-semibold flex items-center gap-2">
                <span>💡</span> ইতিমধ্যে আবেদন সম্পন্ন করেছেন?
            </span>
            <div class="flex items-center gap-2">
                <a href="{{ route('online-admission.download') }}" class="px-3.5 py-1.5 rounded-xl bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-bold text-xs transition">
                    📥 আবেদন / প্রবেশপত্র রি-ডাউনলোড
                </a>
                <a href="{{ route('admission-fee') }}" class="px-3.5 py-1.5 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-bold text-xs transition">
                    💳 ভর্তি ফি প্রদান
                </a>
                <a href="{{ route('admission.lottery') }}" class="px-3.5 py-1.5 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold text-xs transition">
                    🏆 লটারি ফলাফল
                </a>
            </div>
        </div>

        {{-- VALIDATION ERROR ALERT --}}
        @if(isset($errors) && $errors->any())
            <div class="mb-8 rounded-2xl border border-red-200 bg-red-50 p-5 shadow-sm">
                <div class="flex items-start gap-3">
                    <span class="w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center font-bold text-base shrink-0">✕</span>
                    <div>
                        <h3 class="font-bold text-red-900 text-sm">
                            ফরমে কিছু ভুল পাওয়া গেছে। অনুগ্রহ করে তথ্যগুলো সংশোধন করে পুনরায় জমা দিন:
                        </h3>
                        <ul class="mt-2 list-disc space-y-1 pl-5 text-xs sm:text-sm text-red-700">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- FORM CARD --}}
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm sm:p-10">

            <form
                action="{{ route('online-admission.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-8"
                id="admissionForm"
            >
                @csrf

                {{-- Hidden Captcha operands --}}
                <input type="hidden" name="captcha_num1" value="{{ $captcha1 }}">
                <input type="hidden" name="captcha_num2" value="{{ $captcha2 }}">

                {{-- 1. ACADEMIC & CLASS SELECTION --}}
                <div>
                    <div class="mb-6 border-b border-slate-200 pb-3 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-xl bg-indigo-600 text-white font-bold flex items-center justify-center text-sm shadow-sm">১</span>
                        <div>
                            <h2 class="text-lg sm:text-xl font-bold text-slate-900">
                                শিক্ষাবর্ষ ও শ্রেণি নির্বাচন (Academic Information)
                            </h2>
                            <p class="text-xs text-slate-500">ভর্তিচ্ছু শ্রেণি ও শিক্ষাবর্ষ নির্বাচন করুন</p>
                        </div>
                    </div>

                    <div class="grid gap-5 md:grid-cols-3">
                        {{-- Academic Year --}}
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                শিক্ষাবর্ষ (Academic Year) *
                            </label>
                            <select
                                name="academic_year"
                                id="academicYearInput"
                                required
                                class="w-full rounded-2xl border @error('academic_year') border-red-500 bg-red-50/30 @else border-slate-300 @enderror bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                            >
                                <option value="{{ date('Y') }}" {{ old('academic_year', date('Y')) == date('Y') ? 'selected' : '' }}>{{ date('Y') }} শিক্ষাবর্ষ</option>
                                <option value="{{ date('Y') + 1 }}" {{ old('academic_year') == (date('Y') + 1) ? 'selected' : '' }}>{{ date('Y') + 1 }} শিক্ষাবর্ষ</option>
                            </select>
                        </div>

                        {{-- Target Class --}}
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                যে শ্রেণিতে ভর্তি হতে ইচ্ছুক *
                            </label>
                            <select
                                name="class"
                                id="classSelect"
                                required
                                onchange="handleClassChange(this.value)"
                                class="w-full rounded-2xl border @error('class') border-red-500 bg-red-50/30 @else border-slate-300 @enderror bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                            >
                                <option value="">শ্রেণি নির্বাচন করুন</option>
                                <option value="Play" {{ old('class') === 'Play' ? 'selected' : '' }}>Play (প্লে)</option>
                                <option value="Nursery" {{ old('class') === 'Nursery' ? 'selected' : '' }}>Nursery (নার্সারি)</option>
                                <option value="KG" {{ old('class') === 'KG' ? 'selected' : '' }}>KG (কেজি)</option>
                                <option value="Class 1" {{ old('class') === 'Class 1' ? 'selected' : '' }}>Class 1 (১ম শ্রেণি)</option>
                                <option value="Class 2" {{ old('class') === 'Class 2' ? 'selected' : '' }}>Class 2 (২য় শ্রেণি)</option>
                                <option value="Class 3" {{ old('class') === 'Class 3' ? 'selected' : '' }}>Class 3 (৩য় শ্রেণি)</option>
                                <option value="Class 4" {{ old('class') === 'Class 4' ? 'selected' : '' }}>Class 4 (৪র্থ শ্রেণি)</option>
                                <option value="Class 5" {{ old('class') === 'Class 5' ? 'selected' : '' }}>Class 5 (৫ম শ্রেণি)</option>
                                <option value="Class 6" {{ old('class') === 'Class 6' ? 'selected' : '' }}>Class 6 (৬ষ্ঠ শ্রেণি)</option>
                                <option value="Class 7" {{ old('class') === 'Class 7' ? 'selected' : '' }}>Class 7 (৭ম শ্রেণি)</option>
                                <option value="Class 8" {{ old('class') === 'Class 8' ? 'selected' : '' }}>Class 8 (৮ম শ্রেণি)</option>
                                <option value="Class 9" {{ old('class') === 'Class 9' ? 'selected' : '' }}>Class 9 (৯ম শ্রেণি)</option>
                                <option value="Class 10" {{ old('class') === 'Class 10' ? 'selected' : '' }}>Class 10 (১০ম শ্রেণি)</option>
                                <option value="Class 11" {{ old('class') === 'Class 11' ? 'selected' : '' }}>Class 11 (একাদশ শ্রেণি - কলেজ শাখা)</option>
                            </select>
                            @error('class')
                                <p class="text-xs text-red-500 font-semibold mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Group / Department (Visible for Class 9, 10, 11) --}}
                        <div id="groupWrapper" class="hidden">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                বিভাগ / শাখা (Group) *
                            </label>
                            <select
                                name="group_name"
                                id="groupSelect"
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                            >
                                <option value="">বিভাগ নির্বাচন করুন</option>
                                <option value="Science (বিজ্ঞান)" {{ old('group_name') === 'Science (বিজ্ঞান)' ? 'selected' : '' }}>Science (বিজ্ঞান)</option>
                                <option value="Humanities (মানবিক)" {{ old('group_name') === 'Humanities (মানবিক)' ? 'selected' : '' }}>Humanities (মানবিক)</option>
                                <option value="Business Studies (ব্যবসায় শিক্ষা)" {{ old('group_name') === 'Business Studies (ব্যবসায় শিক্ষা)' ? 'selected' : '' }}>Business Studies (ব্যবসায় শিক্ষা)</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- 2. STUDENT INFORMATION --}}
                <div>
                    <div class="mb-6 border-b border-slate-200 pb-3 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-xl bg-indigo-600 text-white font-bold flex items-center justify-center text-sm shadow-sm">২</span>
                        <div>
                            <h2 class="text-lg sm:text-xl font-bold text-slate-900">
                                শিক্ষার্থীর তথ্যাদি (Student Information)
                            </h2>
                            <p class="text-xs text-slate-500">শিক্ষার্থীর জন্ম সনদ অনুযায়ী সঠিক ও নির্ভুল তথ্য প্রদান করুন</p>
                        </div>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">

                        {{-- Student Name (Bangla) --}}
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                শিক্ষার্থীর নাম (বাংলায়) *
                            </label>
                            <input
                                type="text"
                                name="student_name_bn"
                                id="studentNameBn"
                                value="{{ old('student_name_bn') }}"
                                required
                                maxlength="255"
                                oninput="syncStudentName(this.value)"
                                class="w-full rounded-2xl border @error('student_name_bn') border-red-500 bg-red-50/30 @else border-slate-300 @enderror px-4 py-3 text-sm outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                                placeholder="বাংলায় পূর্ণ নাম লিখুন"
                            >
                        </div>

                        {{-- Student Name (English) --}}
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                শিক্ষার্থীর নাম (ইংরেজিতে CAPITAL LETTERS) *
                            </label>
                            <input
                                type="text"
                                name="student_name_en"
                                id="studentNameEn"
                                value="{{ old('student_name_en') }}"
                                required
                                maxlength="255"
                                style="text-transform: uppercase;"
                                class="w-full rounded-2xl border @error('student_name_en') border-red-500 bg-red-50/30 @else border-slate-300 @enderror px-4 py-3 text-sm font-semibold outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                                placeholder="NAME IN ENGLISH (CAPITAL LETTERS)"
                            >
                            {{-- Fallback primary name field --}}
                            <input type="hidden" name="student_name" id="studentNamePrimary" value="{{ old('student_name', old('student_name_bn')) }}">
                        </div>

                        {{-- Date of Birth with Live Age Calculator --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                    জন্ম তারিখ *
                                </label>
                                <span id="calculatedAgeBadge" class="hidden text-[11px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">
                                    বয়স: <span id="calculatedAgeText">0 বছর</span>
                                </span>
                            </div>

                            <input
                                type="date"
                                name="date_of_birth"
                                id="dobInput"
                                value="{{ old('date_of_birth') }}"
                                max="{{ date('Y-m-d') }}"
                                required
                                onchange="calculateLiveAge(this.value)"
                                class="w-full rounded-2xl border @error('date_of_birth') border-red-500 bg-red-50/30 @else border-slate-300 @enderror px-4 py-3 text-sm outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                            >
                            <p class="text-[11px] text-slate-400 mt-1">১ জানুয়ারি {{ date('Y') }} তারিখ অনুযায়ী শিক্ষার্থীর বয়স গণনা করা হবে</p>
                        </div>

                        {{-- Birth Registration Number (BRN) --}}
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                জন্ম নিবন্ধন নম্বর (১৭ ডিজিট) *
                            </label>
                            <input
                                type="text"
                                name="birth_reg_no"
                                id="brnInput"
                                value="{{ old('birth_reg_no') }}"
                                required
                                maxlength="17"
                                pattern="\d{17}"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="w-full rounded-2xl border @error('birth_reg_no') border-red-500 bg-red-50/30 @else border-slate-300 @enderror px-4 py-3 text-sm font-mono font-bold tracking-wider outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                                placeholder="যেমন: 20151234567890123"
                            >
                            <p class="text-[11px] text-slate-400 mt-1">অনলাইন ভেরিফায়েড ১৭ ডিজিটের জন্ম নিবন্ধন নম্বর দিন</p>
                        </div>

                        {{-- Gender --}}
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                লিঙ্গ (Gender) *
                            </label>
                            <select
                                name="gender"
                                required
                                class="w-full rounded-2xl border @error('gender') border-red-500 bg-red-50/30 @else border-slate-300 @enderror bg-white px-4 py-3 text-sm outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                            >
                                <option value="">লিঙ্গ নির্বাচন করুন</option>
                                <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>ছাত্র (Male)</option>
                                <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>ছাত্রী (Female)</option>
                                <option value="other" {{ old('gender') === 'other' ? 'selected' : '' }}>অন্যান্য (Other)</option>
                            </select>
                        </div>

                        {{-- Blood Group --}}
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                রক্তের গ্রুপ (Blood Group)
                            </label>
                            <select
                                name="blood_group"
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                            >
                                <option value="">নির্বাচন করুন (জানা থাকলে)</option>
                                <option value="A+" {{ old('blood_group') === 'A+' ? 'selected' : '' }}>A+ (পজিটিভ)</option>
                                <option value="A-" {{ old('blood_group') === 'A-' ? 'selected' : '' }}>A- (নেগেটিভ)</option>
                                <option value="B+" {{ old('blood_group') === 'B+' ? 'selected' : '' }}>B+ (পজিটিভ)</option>
                                <option value="B-" {{ old('blood_group') === 'B-' ? 'selected' : '' }}>B- (নেগেটিভ)</option>
                                <option value="O+" {{ old('blood_group') === 'O+' ? 'selected' : '' }}>O+ (পজিটিভ)</option>
                                <option value="O-" {{ old('blood_group') === 'O-' ? 'selected' : '' }}>O- (নেগেটিভ)</option>
                                <option value="AB+" {{ old('blood_group') === 'AB+' ? 'selected' : '' }}>AB+ (পজিটিভ)</option>
                                <option value="AB-" {{ old('blood_group') === 'AB-' ? 'selected' : '' }}>AB- (নেগেটিভ)</option>
                            </select>
                        </div>

                        {{-- Religion --}}
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                ধর্ম (Religion) *
                            </label>
                            <select
                                name="religion"
                                required
                                class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                            >
                                <option value="Islam" {{ old('religion', 'Islam') === 'Islam' ? 'selected' : '' }}>ইসলাম (Islam)</option>
                                <option value="Hinduism" {{ old('religion') === 'Hinduism' ? 'selected' : '' }}>হিন্দু (Hinduism)</option>
                                <option value="Buddhism" {{ old('religion') === 'Buddhism' ? 'selected' : '' }}>বৌদ্ধ (Buddhism)</option>
                                <option value="Christianity" {{ old('religion') === 'Christianity' ? 'selected' : '' }}>খ্রিস্টান (Christianity)</option>
                                <option value="Other" {{ old('religion') === 'Other' ? 'selected' : '' }}>অন্যান্য (Other)</option>
                            </select>
                        </div>

                        {{-- Nationality --}}
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                জাতীয়তা (Nationality)
                            </label>
                            <input
                                type="text"
                                name="nationality"
                                value="{{ old('nationality', 'Bangladeshi') }}"
                                class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm font-semibold outline-none"
                                readonly
                            >
                        </div>

                        {{-- Previous School --}}
                        <div class="md:col-span-2">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                পূর্ববর্তী বিদ্যালয় ও শ্রেণি (প্রযোজ্য ক্ষেত্রে)
                            </label>
                            <input
                                type="text"
                                name="previous_school"
                                value="{{ old('previous_school') }}"
                                maxlength="255"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                                placeholder="পূর্বে কোনো বিদ্যালয়ে পড়ে থাকলে বিদ্যালয়ের নাম ও শেষ শ্রেণি লিখুন"
                            >
                        </div>

                    </div>
                </div>

                {{-- 3. PARENTS INFORMATION --}}
                <div>
                    <div class="mb-6 border-b border-slate-200 pb-3 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-xl bg-indigo-600 text-white font-bold flex items-center justify-center text-sm shadow-sm">৩</span>
                        <div>
                            <h2 class="text-lg sm:text-xl font-bold text-slate-900">
                                পিতা ও মাতার তথ্যাদি (Parents Information)
                            </h2>
                            <p class="text-xs text-slate-500">পিতা-মাতার এনআইডি ও শিক্ষাগত যোগ্যতা অনুযায়ী তথ্য লিখুন</p>
                        </div>
                    </div>

                    {{-- Father Details Card --}}
                    <div class="rounded-2xl border border-indigo-100 bg-indigo-50/30 p-5 mb-5 space-y-4">
                        <h3 class="text-sm font-extrabold text-indigo-950 flex items-center gap-2">
                            <span>👨</span> পিতার বিবরণ (Father's Details)
                        </h3>

                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                            <div>
                                <label class="mb-1.5 block text-xs font-bold text-slate-700">পিতার নাম (বাংলায়) *</label>
                                <input type="text" name="father_name" value="{{ old('father_name') }}" required
                                       class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm outline-none focus:border-indigo-600" placeholder="পিতার পূর্ণ নাম">
                            </div>
                            <div>
                                <label class="mb-1.5 block text-xs font-bold text-slate-700">পিতার নাম (ইংরেজিতে)</label>
                                <input type="text" name="father_name_en" value="{{ old('father_name_en') }}" style="text-transform: uppercase;"
                                       class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm outline-none focus:border-indigo-600" placeholder="FATHER'S NAME IN ENGLISH">
                            </div>
                            <div>
                                <label class="mb-1.5 block text-xs font-bold text-slate-700">পিতার জাতীয় পরিচয়পত্র (NID)</label>
                                <input type="text" name="father_nid" value="{{ old('father_nid') }}" maxlength="20"
                                       class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm font-mono outline-none focus:border-indigo-600" placeholder="১০ বা ১৭ ডিজিটের NID">
                            </div>
                            <div>
                                <label class="mb-1.5 block text-xs font-bold text-slate-700">শিক্ষাগত যোগ্যতা</label>
                                <input type="text" name="father_education" value="{{ old('father_education') }}"
                                       class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm outline-none focus:border-indigo-600" placeholder="যেমন: স্নাতক / এইচএসসি">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="mb-1.5 block text-xs font-bold text-slate-700">পেশা ও আনুমানিক বার্ষিক আয়</label>
                                <input type="text" name="father_occupation_info" value="{{ old('father_occupation_info') }}"
                                       class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm outline-none focus:border-indigo-600" placeholder="যেমন: সরকারি চাকরি / ব্যবসা, বার্ষিক ৩,০০,০০০ টাকা">
                            </div>
                        </div>
                    </div>

                    {{-- Mother Details Card --}}
                    <div class="rounded-2xl border border-pink-100 bg-pink-50/30 p-5 space-y-4">
                        <h3 class="text-sm font-extrabold text-pink-950 flex items-center gap-2">
                            <span>👩</span> মাতার বিবরণ (Mother's Details)
                        </h3>

                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                            <div>
                                <label class="mb-1.5 block text-xs font-bold text-slate-700">মাতার নাম (বাংলায়) *</label>
                                <input type="text" name="mother_name" value="{{ old('mother_name') }}" required
                                       class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm outline-none focus:border-indigo-600" placeholder="মাতার পূর্ণ নাম">
                            </div>
                            <div>
                                <label class="mb-1.5 block text-xs font-bold text-slate-700">মাতার নাম (ইংরেজিতে)</label>
                                <input type="text" name="mother_name_en" value="{{ old('mother_name_en') }}" style="text-transform: uppercase;"
                                       class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm outline-none focus:border-indigo-600" placeholder="MOTHER'S NAME IN ENGLISH">
                            </div>
                            <div>
                                <label class="mb-1.5 block text-xs font-bold text-slate-700">মাতার জাতীয় পরিচয়পত্র (NID)</label>
                                <input type="text" name="mother_nid" value="{{ old('mother_nid') }}" maxlength="20"
                                       class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm font-mono outline-none focus:border-indigo-600" placeholder="১০ বা ১৭ ডিজিটের NID">
                            </div>
                            <div class="sm:col-span-3">
                                <label class="mb-1.5 block text-xs font-bold text-slate-700">শিক্ষাগত যোগ্যতা</label>
                                <input type="text" name="mother_education" value="{{ old('mother_education') }}"
                                       class="w-full rounded-xl border border-slate-300 bg-white px-3.5 py-2.5 text-sm outline-none focus:border-indigo-600" placeholder="যেমন: গৃহিণী / স্নাতক / চাকরি">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 4. ADDRESS & GUARDIAN CONTACT --}}
                <div>
                    <div class="mb-6 border-b border-slate-200 pb-3 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-xl bg-indigo-600 text-white font-bold flex items-center justify-center text-sm shadow-sm">৪</span>
                        <div>
                            <h2 class="text-lg sm:text-xl font-bold text-slate-900">
                                ঠিকানা ও অভিভাবকের যোগাযোগ (Address & Contact)
                            </h2>
                            <p class="text-xs text-slate-500">বর্তমান ঠিকানা, স্থায়ী ঠিকানা এবং SMS যোগাযোগের নম্বর দিন</p>
                        </div>
                    </div>

                    <div class="grid gap-5 md:grid-cols-2">

                        {{-- Present Address --}}
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                বর্তমান ঠিকানা (Present Address) *
                            </label>
                            <textarea
                                name="present_address"
                                id="presentAddressInput"
                                rows="3"
                                required
                                maxlength="1000"
                                oninput="if(document.getElementById('sameAddressCheckbox').checked) copyAddress()"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                                placeholder="গ্রাম/মহল্লা, ডাকঘর, উপজেলা, জেলা"
                            >{{ old('present_address', old('address')) }}</textarea>
                            <input type="hidden" name="address" id="addressFallback" value="{{ old('address') }}">
                        </div>

                        {{-- Permanent Address with "Same as Present" Checkbox --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                                    স্থায়ী ঠিকানা (Permanent Address) *
                                </label>
                                <label class="inline-flex items-center gap-1.5 text-xs text-indigo-700 font-bold cursor-pointer">
                                    <input type="checkbox" id="sameAddressCheckbox" onchange="toggleSameAddress(this.checked)" class="w-3.5 h-3.5 rounded border-slate-300 text-indigo-600">
                                    <span>বর্তমান ঠিকানা ও স্থায়ী ঠিকানা একই</span>
                                </label>
                            </div>
                            <textarea
                                name="permanent_address"
                                id="permanentAddressInput"
                                rows="3"
                                required
                                maxlength="1000"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                                placeholder="গ্রাম/মহল্লা, ডাকঘর, উপজেলা, জেলা"
                            >{{ old('permanent_address', old('address')) }}</textarea>
                        </div>

                        {{-- Guardian Mobile (SMS Primary) --}}
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                অভিভাবকের মোবাইল নম্বর * (SMS প্রাপ্তি নিশ্চিতকরণ)
                            </label>
                            <input
                                type="tel"
                                name="guardian_phone"
                                id="guardianPhoneInput"
                                value="{{ old('guardian_phone') }}"
                                required
                                pattern="01[3-9][0-9]{8}"
                                maxlength="11"
                                class="w-full rounded-2xl border @error('guardian_phone') border-red-500 bg-red-50/30 @else border-slate-300 @enderror px-4 py-3 text-sm font-mono font-bold outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                                placeholder="01XXXXXXXXX"
                            >
                            <p class="text-[11px] text-slate-400 mt-1">১১ ডিজিটের বাংলাদেশি মোবাইল নম্বর (যেমন: 017XXXXXXXX)</p>
                        </div>

                        {{-- Alternate Contact / WhatsApp --}}
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                বিকল্প মোবাইল / WhatsApp নম্বর <span class="font-normal text-slate-400">(ঐচ্ছিক)</span>
                            </label>
                            <input
                                type="tel"
                                name="contact_mobile"
                                value="{{ old('contact_mobile') }}"
                                maxlength="15"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm font-mono outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                                placeholder="01XXXXXXXXX"
                            >
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                ই-মেইল ঠিকানা <span class="font-normal text-slate-400">(ঐচ্ছিক)</span>
                            </label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                maxlength="255"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                                placeholder="example@gmail.com"
                            >
                        </div>

                        {{-- Legal Guardian Info (If other than parents) --}}
                        <div>
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                পিতা/মাতার অনুপস্থিতিতে আইনগত অভিভাবক <span class="font-normal text-slate-400">(প্রযোজ্য ক্ষেত্রে)</span>
                            </label>
                            <input
                                type="text"
                                name="guardian_info"
                                value="{{ old('guardian_info') }}"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                                placeholder="নাম ও শিক্ষার্থীর সাথে সম্পর্ক (যেমন: চাচা / মামা)"
                            >
                        </div>

                        {{-- Other Siblings studying in this school --}}
                        <div class="md:col-span-2">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                এই বিদ্যালয়ে কোনো সহোদর ভাই/বোন অধ্যয়নরত থাকলে তার তথ্য <span class="font-normal text-slate-400">(কোটার জন্য প্রযোজ্য)</span>
                            </label>
                            <input
                                type="text"
                                name="other_children_info"
                                value="{{ old('other_children_info') }}"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                                placeholder="ভাই/বোনের নাম, শ্রেণি, শাখা ও রোল নম্বর (যদি থাকে)"
                            >
                        </div>

                    </div>
                </div>

                {{-- 5. DOCUMENTS UPLOAD & PHOTO PREVIEW --}}
                <div>
                    <div class="mb-6 border-b border-slate-200 pb-3 flex items-center gap-3">
                        <span class="w-8 h-8 rounded-xl bg-indigo-600 text-white font-bold flex items-center justify-center text-sm shadow-sm">৫</span>
                        <div>
                            <h2 class="text-lg sm:text-xl font-bold text-slate-900">
                                প্রয়োজনীয় ডকুমেন্ট ও ছবি (Required Documents)
                            </h2>
                            <p class="text-xs text-slate-500">শিক্ষার্থীর পাসপোর্ট সাইজের ছবি ও জন্ম নিবন্ধন সনদ আপলোড করুন</p>
                        </div>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">

                        {{-- Student Photo with Interactive Preview Box --}}
                        <div class="rounded-2xl border border-slate-200 p-4 bg-slate-50/60">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                শিক্ষার্থীর পাসপোর্ট সাইজের ছবি *
                            </label>

                            <div class="flex items-center gap-4">
                                <!-- Photo Preview Area -->
                                <div id="photoPreviewBox" class="w-24 h-28 rounded-2xl border-2 border-dashed border-indigo-300 bg-indigo-50/60 flex flex-col items-center justify-center overflow-hidden shrink-0 shadow-sm relative">
                                    <img id="photoPreviewImg" src="" alt="Photo Preview" class="w-full h-full object-cover hidden">
                                    <div id="photoPlaceholder" class="text-center p-2 text-indigo-400">
                                        <span class="text-2xl block mb-1">📷</span>
                                        <span class="text-[10px] font-bold block leading-tight">ছবি প্রিভিউ</span>
                                    </div>
                                </div>

                                <div class="flex-1">
                                    <input
                                        type="file"
                                        name="student_photo"
                                        id="studentPhotoInput"
                                        accept="image/jpeg,image/png,image/webp"
                                        required
                                        onchange="previewStudentPhoto(this)"
                                        class="block w-full rounded-2xl border @error('student_photo') border-red-500 bg-red-50/30 @else border-slate-300 @enderror bg-white px-3 py-2 text-xs text-slate-600 file:mr-3 file:py-1 file:px-2.5 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                    >
                                    <p class="mt-1.5 text-[11px] text-slate-500">
                                        JPG, PNG বা WEBP | সর্বোচ্চ 2MB | পরিষ্কার ও সাম্প্রতিক ছবি
                                    </p>
                                    <p id="photoErrorMsg" class="text-xs text-red-600 font-semibold mt-1 hidden"></p>
                                </div>
                            </div>
                        </div>

                        {{-- Birth Certificate with Document Preview --}}
                        <div class="rounded-2xl border border-slate-200 p-4 bg-slate-50/60">
                            <label class="mb-2 block text-xs font-bold uppercase tracking-wider text-slate-700">
                                জন্ম নিবন্ধন সনদ কপি <span class="font-normal text-slate-400">(ঐচ্ছিক)</span>
                            </label>

                            <div class="flex items-center gap-4">
                                <div id="docPreviewBox" class="w-24 h-28 rounded-2xl border-2 border-dashed border-slate-300 bg-white flex flex-col items-center justify-center overflow-hidden shrink-0 shadow-sm text-center p-2">
                                    <span class="text-2xl block mb-1 text-slate-400">📄</span>
                                    <span id="docTypeLabel" class="text-[10px] font-bold block text-slate-500 break-all leading-tight">ডকুমেন্ট</span>
                                </div>

                                <div class="flex-1">
                                    <input
                                        type="file"
                                        name="birth_certificate"
                                        id="birthCertInput"
                                        accept=".jpg,.jpeg,.png,.pdf"
                                        onchange="checkBirthCert(this)"
                                        class="block w-full rounded-2xl border @error('birth_certificate') border-red-500 bg-red-50/30 @else border-slate-300 @enderror bg-white px-3 py-2 text-xs text-slate-600 file:mr-3 file:py-1 file:px-2.5 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200"
                                    >
                                    <p class="mt-1.5 text-[11px] text-slate-500">
                                        JPG, PNG বা PDF ফরম্যাট | সর্বোচ্চ 4MB
                                    </p>
                                    <p id="certErrorMsg" class="text-xs text-red-600 font-semibold mt-1 hidden"></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- 6. SECURITY CAPTCHA & DECLARATION --}}
                <div class="space-y-4">
                    <div class="p-4 rounded-2xl bg-slate-100 border border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">🔒</span>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900">নিরাপত্তা যাচাই (Anti-Spam Verification)</h4>
                                <p class="text-xs text-slate-500">স্প্যাম রোধে নিচের সহজ যোগফলটি লিখুন:</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-4 py-2 rounded-xl bg-white border border-slate-300 font-mono font-black text-lg text-indigo-700 shadow-sm">
                                {{ $captcha1 }} + {{ $captcha2 }} = ?
                            </span>
                            <input
                                type="number"
                                name="captcha_answer"
                                required
                                class="w-24 rounded-xl border border-slate-300 px-3 py-2 text-center text-base font-bold font-mono outline-none focus:border-indigo-600"
                                placeholder="উত্তর"
                            >
                        </div>
                    </div>

                    <div class="rounded-2xl bg-indigo-50/70 border border-indigo-100 p-5">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" required checked class="mt-1 h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="text-xs sm:text-sm text-slate-700 leading-5">
                                আমি এই মর্মে অঙ্গীকার করছি যে, উপরে প্রদত্ত সকল তথ্য সম্পূর্ণ সত্য ও নির্ভুল। কোনো তথ্য অসত্য বা অসম্পূর্ণ প্রমাণিত হলে অত্র প্রতিষ্ঠানে ভর্তি বাতিলসহ কর্তৃপক্ষের সিদ্ধান্ত মেনে নিতে বাধ্য থাকব।
                            </span>
                        </label>
                    </div>
                </div>

                {{-- SUBMIT BUTTON --}}
                <div class="border-t border-slate-200 pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-xs text-slate-500 text-center sm:text-left">
                        আবেদন সাবমিটের পর প্রদত্ত <strong>Application Number</strong> সংরক্ষণ করবেন এবং পরবর্তী ধাপে ভর্তি ফি পরিশোধ করবেন।
                    </p>

                    <button
                        type="submit"
                        id="submitBtn"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-8 py-4 text-sm font-black text-white shadow-xl shadow-indigo-600/25 transition hover:bg-indigo-700 active:scale-95"
                    >
                        <span>📝</span>
                        <span>আবেদন জমা দিন (Submit Application)</span>
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    // Synchronize Name fields
    function syncStudentName(val) {
        document.getElementById('studentNamePrimary').value = val;
    }

    // Toggle Group for High School classes
    function handleClassChange(val) {
        const groupWrapper = document.getElementById('groupWrapper');
        const groupSelect = document.getElementById('groupSelect');
        const highClasses = ['Class 9', 'Class 10', 'Class 11'];

        if (highClasses.includes(val)) {
            groupWrapper.classList.remove('hidden');
            groupSelect.setAttribute('required', 'required');
        } else {
            groupWrapper.classList.add('hidden');
            groupSelect.removeAttribute('required');
            groupSelect.value = '';
        }
    }

    // Live Age Calculation on Jan 1
    function calculateLiveAge(dobVal) {
        if (!dobVal) return;
        const dob = new Date(dobVal);
        const acadYear = parseInt(document.getElementById('academicYearInput').value) || {{ date('Y') }};
        const targetDate = new Date(acadYear, 0, 1); // 1st Jan of Academic Year

        if (dob >= targetDate) {
            document.getElementById('calculatedAgeBadge').classList.add('hidden');
            return;
        }

        let years = targetDate.getFullYear() - dob.getFullYear();
        let months = targetDate.getMonth() - dob.getMonth();
        let days = targetDate.getDate() - dob.getDate();

        if (days < 0) {
            months--;
            const prevMonthDays = new Date(targetDate.getFullYear(), targetDate.getMonth(), 0).getDate();
            days += prevMonthDays;
        }
        if (months < 0) {
            years--;
            months += 12;
        }

        const ageBadge = document.getElementById('calculatedAgeBadge');
        const ageText = document.getElementById('calculatedAgeText');
        ageText.innerText = `${years} বছর ${months} মাস ${days} দিন (১ জানু ${acadYear})`;
        ageBadge.classList.remove('hidden');
    }

    // Same Address Checkbox
    function toggleSameAddress(checked) {
        const present = document.getElementById('presentAddressInput').value;
        const permanent = document.getElementById('permanentAddressInput');
        if (checked) {
            permanent.value = present;
            permanent.setAttribute('readonly', 'readonly');
            permanent.classList.add('bg-slate-100');
        } else {
            permanent.removeAttribute('readonly');
            permanent.classList.remove('bg-slate-100');
        }
    }

    function copyAddress() {
        document.getElementById('permanentAddressInput').value = document.getElementById('presentAddressInput').value;
        document.getElementById('addressFallback').value = document.getElementById('presentAddressInput').value;
    }

    // Student Photo Preview
    function previewStudentPhoto(input) {
        const errorEl = document.getElementById('photoErrorMsg');
        const previewImg = document.getElementById('photoPreviewImg');
        const placeholder = document.getElementById('photoPlaceholder');
        const box = document.getElementById('photoPreviewBox');

        errorEl.classList.add('hidden');
        errorEl.innerText = '';

        if (input.files && input.files[0]) {
            const file = input.files[0];

            if (file.size > 2 * 1024 * 1024) {
                errorEl.innerText = 'ছবির আকার সর্বোচ্চ 2MB হতে পারবে। অনুগ্রহ করে ছোট সাইজের ছবি দিন।';
                errorEl.classList.remove('hidden');
                input.value = '';
                previewImg.classList.add('hidden');
                placeholder.classList.remove('hidden');
                box.classList.remove('border-emerald-500');
                box.classList.add('border-red-400');
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.classList.remove('hidden');
                placeholder.classList.add('hidden');
                box.classList.remove('border-dashed', 'border-indigo-300', 'border-red-400');
                box.classList.add('border-solid', 'border-emerald-500');
            };
            reader.readAsDataURL(file);
        } else {
            previewImg.src = '';
            previewImg.classList.add('hidden');
            placeholder.classList.remove('hidden');
            box.classList.remove('border-solid', 'border-emerald-500');
            box.classList.add('border-dashed', 'border-indigo-300');
        }
    }

    // Birth Certificate File Check
    function checkBirthCert(input) {
        const errorEl = document.getElementById('certErrorMsg');
        const typeLabel = document.getElementById('docTypeLabel');
        errorEl.classList.add('hidden');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            if (file.size > 4 * 1024 * 1024) {
                errorEl.innerText = 'সনদ ফাইলের আকার সর্বোচ্চ 4MB হতে পারবে।';
                errorEl.classList.remove('hidden');
                input.value = '';
                typeLabel.innerText = 'ডকুমেন্ট';
                return;
            }
            const ext = file.name.split('.').pop().toUpperCase();
            typeLabel.innerText = ext + ' (' + (file.size / 1024).toFixed(0) + 'KB)';
        } else {
            typeLabel.innerText = 'ডকুমেন্ট';
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        const classSelect = document.getElementById('classSelect');
        if (classSelect && classSelect.value) {
            handleClassChange(classSelect.value);
        }
        const dobInput = document.getElementById('dobInput');
        if (dobInput && dobInput.value) {
            calculateLiveAge(dobInput.value);
        }

        const form = document.getElementById('admissionForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                // Ensure primary name is populated
                const bn = document.getElementById('studentNameBn').value;
                const en = document.getElementById('studentNameEn').value;
                document.getElementById('studentNamePrimary').value = en || bn;
                document.getElementById('addressFallback').value = document.getElementById('presentAddressInput').value;

                const btn = document.getElementById('submitBtn');
                if (btn && !btn.disabled) {
                    btn.disabled = true;
                    btn.innerHTML = `
                        <span class="inline-block animate-spin mr-2">⏳</span>
                        <span>আবেদন জমা হচ্ছে... অনুগ্রহ করে অপেক্ষা করুন</span>
                    `;
                    btn.classList.add('opacity-80', 'cursor-not-allowed');
                }
            });
        }
    });
</script>

@endsection