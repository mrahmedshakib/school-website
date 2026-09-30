@extends('frontend.layouts.app')

@section('title', 'ভর্তি আবেদন নিশ্চিতকরণ | Application Confirmation - ' . $application->application_no)

@section('meta_description', 'অনলাইন ভর্তি আবেদন নিশ্চিতকরণ বিবরণী - ' . ($websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'বিদ্যালয়'))

@section('content')

<div class="bg-slate-50 py-10 sm:py-16 min-h-[75vh]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- 4-STEP FLOW INDICATOR --}}
        <div class="mb-8 grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-3 text-left">
            <!-- Step 1: Done -->
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50/90 p-3 shadow-sm">
                <span class="w-6 h-6 rounded-full bg-emerald-600 text-white text-xs font-bold inline-flex items-center justify-center mb-1">✓</span>
                <p class="text-xs font-bold text-emerald-900">১. আবেদন ফরম পূরণ</p>
                <span class="text-[10px] text-emerald-700 block">সফলভাবে দাখিলকৃত</span>
            </div>
            <!-- Step 2: Active -->
            <div class="rounded-2xl border-2 border-indigo-600 bg-indigo-50/90 p-3 shadow-md">
                <span class="w-6 h-6 rounded-full bg-indigo-600 text-white text-xs font-black inline-flex items-center justify-center mb-1">২</span>
                <p class="text-xs font-bold text-indigo-950">২. নিশ্চিতকরণ ও PDF</p>
                <span class="text-[10px] text-indigo-700 font-semibold block">বর্তমান ধাপ (Active)</span>
            </div>
            <!-- Step 3: Next -->
            <div class="rounded-2xl border border-slate-200 bg-white p-3 shadow-sm">
                <span class="w-6 h-6 rounded-full bg-amber-100 text-amber-800 text-xs font-bold inline-flex items-center justify-center mb-1">৩</span>
                <p class="text-xs font-bold text-slate-800">৩. ভর্তি ফি প্রদান</p>
                <span class="text-[10px] text-amber-700 font-semibold block">পরবর্তী আবশ্যক ধাপ</span>
            </div>
            <!-- Step 4 -->
            <div class="rounded-2xl border border-slate-200 bg-white p-3 shadow-sm text-slate-400">
                <span class="w-6 h-6 rounded-full bg-slate-100 text-slate-400 text-xs font-bold inline-flex items-center justify-center mb-1">৪</span>
                <p class="text-xs font-bold text-slate-400">৪. রসিদ ও চূড়ান্ত ভর্তি</p>
                <span class="text-[10px] text-slate-400 block">ভর্তি নিশ্চিতকরণ</span>
            </div>
        </div>

        {{-- CONFIRMATION CARD --}}
        <div class="rounded-3xl border border-slate-200 bg-white shadow-xl overflow-hidden">

            {{-- Top Hero Banner --}}
            <div class="bg-gradient-to-r from-emerald-600 via-teal-600 to-indigo-700 p-8 sm:p-10 text-white text-center relative overflow-hidden">
                <div class="w-20 h-20 rounded-full bg-white/20 backdrop-blur border border-white/30 text-white flex items-center justify-center text-4xl font-black mx-auto mb-4 shadow-lg animate-bounce">
                    ✓
                </div>

                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur border border-white/20 text-xs font-bold uppercase tracking-widest text-emerald-200 mb-2">
                    Application Successfully Submitted
                </span>

                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight">
                    ভর্তি আবেদন সফলভাবে সম্পন্ন হয়েছে!
                </h1>

                <p class="mt-2 text-sm sm:text-base text-emerald-50 max-w-xl mx-auto">
                    {{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'আমাদের বিদ্যালয়' }}-এ আপনার সন্তানের ভর্তি আবেদনটি সফলভাবে গৃহীত হয়েছে।
                </p>
            </div>

            {{-- Application No Display Box --}}
            <div class="p-6 sm:p-10">

                <div class="rounded-2xl border-2 border-indigo-200 bg-indigo-50/70 p-6 text-center max-w-xl mx-auto shadow-sm">
                    <span class="text-xs font-bold uppercase tracking-widest text-indigo-700">
                        আপনার নির্ধারিত Application Number
                    </span>

                    <div class="mt-2 flex flex-col sm:flex-row items-center justify-center gap-3">
                        <span id="appNoText" class="text-3xl sm:text-4xl font-black text-indigo-900 font-mono tracking-wider">
                            {{ $application->application_no }}
                        </span>

                        <button
                            type="button"
                            onclick="copyAppNo()"
                            id="copyBtn"
                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-white border border-indigo-200 text-indigo-700 text-xs font-bold hover:bg-indigo-50 shadow-sm transition"
                        >
                            <span>📋</span>
                            <span id="copyBtnText">নম্বর কপি করুন</span>
                        </button>
                    </div>

                    <p class="mt-2 text-xs text-indigo-600">
                        ভর্তি সংক্রান্ত যেকোনো তথ্য বা ভর্তি ফি পরিশোধের সময় এই নম্বরটি প্রয়োজন হবে।
                    </p>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-2xl mx-auto">
                    <!-- PDF Download -->
                    <a
                        href="{{ route('online-admission.application.pdf', ['applicationNo' => $application->application_no]) }}"
                        target="_blank"
                        class="flex items-center justify-center gap-2.5 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm sm:text-base py-4 px-6 shadow-xl shadow-indigo-600/25 transition text-center"
                    >
                        <span class="text-xl">📄</span>
                        <span>Application Form (PDF) ডাউনলোড</span>
                    </a>

                    <!-- Pay Fee -->
                    <a
                        href="{{ route('admission-fee', ['application_no' => $application->application_no]) }}"
                        class="flex items-center justify-center gap-2.5 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm sm:text-base py-4 px-6 shadow-xl shadow-emerald-600/25 transition text-center"
                    >
                        <span class="text-xl">💳</span>
                        <span>ভর্তি ফি পরিশোধ করুন (৳ {{ number_format((float) $totalFee, 2) }})</span>
                    </a>
                </div>

                {{-- Applicant Summary Table --}}
                <div class="mt-10 pt-8 border-t border-slate-200">
                    <h3 class="font-bold text-slate-900 text-base mb-4 flex items-center gap-2">
                        <span>📝</span> আবেদনের সংক্ষিপ্ত বিবরণ
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 text-xs sm:text-sm">
                        <div class="rounded-xl bg-slate-50 border border-slate-100 p-4">
                            <span class="text-slate-400 block text-[11px] font-semibold uppercase">শিক্ষার্থীর নাম</span>
                            <strong class="text-slate-900 text-sm mt-0.5 block">{{ $application->student_name }}</strong>
                        </div>

                        <div class="rounded-xl bg-slate-50 border border-slate-100 p-4">
                            <span class="text-slate-400 block text-[11px] font-semibold uppercase">ভর্তির শ্রেণি</span>
                            <strong class="text-slate-900 text-sm mt-0.5 block text-indigo-600">{{ $application->class }}</strong>
                        </div>

                        <div class="rounded-xl bg-slate-50 border border-slate-100 p-4">
                            <span class="text-slate-400 block text-[11px] font-semibold uppercase">পিতার নাম</span>
                            <strong class="text-slate-900 text-sm mt-0.5 block">{{ $application->father_name }}</strong>
                        </div>

                        <div class="rounded-xl bg-slate-50 border border-slate-100 p-4">
                            <span class="text-slate-400 block text-[11px] font-semibold uppercase">অভিভাবকের মোবাইল</span>
                            <strong class="text-slate-900 text-sm mt-0.5 block font-mono">{{ $application->guardian_phone }}</strong>
                        </div>

                        <div class="rounded-xl bg-slate-50 border border-slate-100 p-4">
                            <span class="text-slate-400 block text-[11px] font-semibold uppercase">আবেদনের তারিখ</span>
                            <strong class="text-slate-900 text-sm mt-0.5 block">{{ optional($application->created_at)->format('d M Y, h:i A') }}</strong>
                        </div>

                        <div class="rounded-xl bg-slate-50 border border-slate-100 p-4">
                            <span class="text-slate-400 block text-[11px] font-semibold uppercase">আবেদনের অবস্থা</span>
                            <span class="inline-block mt-1 font-bold text-amber-700 bg-amber-50 border border-amber-200 px-2.5 py-0.5 rounded-full text-xs">
                                ⏳ ভর্তি ফি অপরিশোধিত
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Important Notice / Next Steps --}}
                <div class="mt-8 rounded-2xl bg-amber-50/80 border border-amber-200 p-5 text-xs text-amber-900 leading-6">
                    <h4 class="font-bold text-sm text-amber-950 flex items-center gap-1.5 mb-1">
                        <span>ℹ️</span> পরবর্তী করণীয় ও নির্দেশাবলী:
                    </h4>
                    <ol class="list-decimal list-inside space-y-1 text-slate-700 mt-2">
                        <li>উপরে প্রদত্ত <strong>Application Form (PDF)</strong> ডাউনলোড করে ১ কপি প্রিন্ট করে রাখুন।</li>
                        <li><strong>'ভর্তি ফি পরিশোধ করুন'</strong> বাটনে ক্লিক করে SSLCOMMERZ অথবা বিকাশ/নগদ/রকেটের মাধ্যমে নির্ধারিত ফি (৳ {{ number_format((float) $totalFee, 2) }}) পরিশোধ করুন।</li>
                        <li>অভিভাবকের মোবাইল নম্বরে SMS-এর মাধ্যমে আপনার Application No. পাঠানো হয়েছে।</li>
                        <li>ফি পরিশোধের পর মানি রসিদ (Money Receipt) ডাউনলোড করে বিদ্যালয় অফিসে সংরক্ষণ করতে হবে।</li>
                    </ol>
                </div>

                <div class="mt-8 flex items-center justify-between text-xs text-slate-500 pt-4 border-t border-slate-100">
                    <a href="{{ route('home') }}" class="font-semibold text-indigo-600 hover:text-indigo-800">
                        ← হোম পেজে ফিরে যান
                    </a>
                    <a href="{{ route('contact') }}" class="font-semibold text-slate-600 hover:text-slate-900">
                        যোগাযোগ ও সহায়তা ↗
                    </a>
                </div>

            </div>

        </div>

    </div>
</div>

<script>
    function copyAppNo() {
        const text = document.getElementById('appNoText').innerText.trim();
        navigator.clipboard.writeText(text).then(() => {
            const btn = document.getElementById('copyBtn');
            const btnText = document.getElementById('copyBtnText');
            btnText.innerText = 'কপি হয়েছে!';
            btn.classList.add('bg-emerald-50', 'text-emerald-700', 'border-emerald-300');
            setTimeout(() => {
                btnText.innerText = 'নম্বর কপি করুন';
                btn.classList.remove('bg-emerald-50', 'text-emerald-700', 'border-emerald-300');
            }, 2500);
        });
    }
</script>

@endsection
