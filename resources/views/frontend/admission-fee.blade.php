@extends('frontend.layouts.app')
@section('title', 'ভর্তি ফি পরিশোধ | Admission Fee Payment')
@section('meta_description', 'অনলাইন ভর্তি ফি পরিশোধ ও ট্রানজেকশন তথ্য জমাদান - বিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ, দুপচাঁচিয়া, বগুড়া।')
@section('content')

{{-- HERO --}}
<section class="relative overflow-hidden bg-slate-950">
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-950 via-slate-950 to-slate-900"></div>
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-indigo-500/10 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 rounded-full bg-blue-500/10 blur-3xl"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-500/10 border border-indigo-400/20 text-indigo-200 text-sm font-semibold">
                💳 Fee Payment Portal
            </span>
            <h1 class="mt-4 text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-white">
                ভর্তি ফি পরিশোধ
            </h1>
            <p class="mt-3 text-sm sm:text-base text-slate-300 leading-7">
                আপনার Application Number দিয়ে আবেদন অনুসন্ধান করুন এবং SSLCOMMERZ, bKash, Nagad, Rocket বা Bank Transfer মাধ্যমে নির্ধারিত ভর্তি ফি পরিশোধ করুন।
            </p>

            {{-- 4-STEP FLOW INDICATOR --}}
            <div class="mt-8 grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-3 text-left">
                <!-- Step 1: Done -->
                <div class="rounded-2xl border border-white/10 bg-white/5 p-3 backdrop-blur">
                    <span class="w-6 h-6 rounded-full bg-emerald-500 text-white text-xs font-bold inline-flex items-center justify-center mb-1">✓</span>
                    <p class="text-xs font-bold text-white">১. আবেদন ফরম পূরণ</p>
                    <span class="text-[10px] text-emerald-300 block">সম্পন্ন হয়েছে</span>
                </div>
                <!-- Step 2: Done -->
                <div class="rounded-2xl border border-white/10 bg-white/5 p-3 backdrop-blur">
                    <span class="w-6 h-6 rounded-full bg-emerald-500 text-white text-xs font-bold inline-flex items-center justify-center mb-1">✓</span>
                    <p class="text-xs font-bold text-white">২. Application No.</p>
                    <span class="text-[10px] text-emerald-300 block">সংগৃহীত</span>
                </div>
                <!-- Step 3: Active -->
                <div class="rounded-2xl border-2 border-indigo-400 bg-indigo-600/40 p-3 backdrop-blur shadow-md">
                    <span class="w-6 h-6 rounded-full bg-indigo-400 text-slate-950 text-xs font-black inline-flex items-center justify-center mb-1">৩</span>
                    <p class="text-xs font-bold text-white">৩. ভর্তি ফি পরিশোধ</p>
                    <span class="text-[10px] text-indigo-200 block font-semibold">চলমান ধাপ (Active)</span>
                </div>
                <!-- Step 4 -->
                <div class="rounded-2xl border border-white/10 bg-white/5 p-3 backdrop-blur text-slate-400">
                    <span class="w-6 h-6 rounded-full bg-white/10 text-slate-300 text-xs font-bold inline-flex items-center justify-center mb-1">৪</span>
                    <p class="text-xs font-bold text-slate-300">৪. মানি রসিদ ও ভর্তি</p>
                    <span class="text-[10px] text-slate-400 block">চূড়ান্ত নিশ্চয়তা</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MESSAGES --}}
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
    @if(session('success'))
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-5 shadow-sm mb-6">
            <div class="flex items-center gap-3">
                <span class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold">✓</span>
                <p class="text-sm font-bold text-emerald-900">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if(session('info'))
        <div class="rounded-2xl border border-blue-200 bg-blue-50 p-5 shadow-sm mb-6">
            <div class="flex items-center gap-3">
                <span class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">ℹ</span>
                <p class="text-sm font-semibold text-blue-900">{{ session('info') }}</p>
            </div>
        </div>
    @endif

    @if(isset($errors) && $errors->any())
        <div class="rounded-2xl border border-red-200 bg-red-50 p-5 shadow-sm mb-6">
            <div class="flex items-start gap-3">
                <span class="w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center font-bold shrink-0">✕</span>
                <div>
                    <h3 class="font-bold text-red-900 text-sm">অনুগ্রহ করে নিচের ত্রুটিগুলো সংশোধন করুন:</h3>
                    <ul class="mt-2 space-y-1 text-xs sm:text-sm text-red-700">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
</div>

{{-- APPLICATION SEARCH --}}
<section class="py-8 bg-slate-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 sm:p-8 shadow-sm">
            <div class="max-w-xl">
                <span class="text-xs font-bold uppercase tracking-wider text-indigo-600">Step 1</span>
                <h2 class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">আপনার আবেদন খুঁজুন</h2>
                <p class="text-sm text-slate-500 mt-1">
                    অনলাইনে আবেদন ফরম পূরণ করার পর প্রাপ্ত Application Number লিখুন।
                <div class="mt-2 flex items-center gap-3 text-xs">
                    <a href="{{ route('online-admission.download') }}" class="text-indigo-600 font-bold hover:underline flex items-center gap-1">
                        <span>💡</span> আবেদন নম্বর মনে নেই? মোবাইল নম্বর ও জন্ম তারিখ দিয়ে খুঁজুন ↗
                    </a>
                </div>
            </div>

            <form action="{{ route('admission-fee') }}" method="GET" class="mt-6 grid grid-cols-1 sm:grid-cols-[1fr_auto] gap-3">
                <div>
                    <label for="application_no" class="sr-only">Application Number</label>
                    <input
                        type="text"
                        name="application_no"
                        id="application_no"
                        value="{{ old('application_no', $applicationNo ?? '') }}"
                        placeholder="যেমন: BLSC-2026-XXXXX বা ADM-..."
                        required
                        class="w-full rounded-2xl border border-slate-300 px-5 py-3.5 text-sm sm:text-base font-medium outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                    >
                </div>
                <div>
                    <button type="submit" class="w-full sm:w-auto px-8 py-3.5 rounded-2xl bg-indigo-600 text-white font-bold text-sm sm:text-base hover:bg-indigo-700 transition shadow-lg shadow-indigo-600/20">
                        🔎 আবেদন খুঁজুন
                    </button>
                </div>
            </form>

            @if(!$application && request('application_no'))
                <div class="mt-5 rounded-2xl border border-amber-200 bg-amber-50 p-4 text-sm text-amber-800 flex items-center gap-3">
                    <span class="text-lg">⚠️</span>
                    <span>'<strong>{{ request('application_no') }}</strong>' নম্বরযুক্ত কোনো আবেদন পাওয়া যায়নি। অনুগ্রহ করে সঠিক নম্বর দিয়ে পুনরায় চেষ্টা করুন।</span>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- APPLICATION DETAILS --}}
@if($application)
<section class="pb-8 bg-slate-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        @php
            $statusClasses = [
                'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                'payment_pending' => 'bg-blue-50 text-blue-700 border-blue-200',
                'approved' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                'rejected' => 'bg-red-50 text-red-700 border-red-200',
            ];
            $statusLabels = [
                'pending' => 'আবেদন গৃহীত (ফি অপরিশোধিত)',
                'payment_pending' => 'পেমেন্ট যাচাইকরণ চলছে',
                'approved' => 'ভর্তি নিশ্চিত (Paid & Confirmed)',
                'rejected' => 'আবেদন বাতিল',
            ];
            $statusIcons = [
                'pending' => '⏳',
                'payment_pending' => '💳',
                'approved' => '✓',
                'rejected' => '✕',
            ];
            $currentStatus = $application->status;
        @endphp

        <div class="rounded-3xl border border-slate-200 bg-white shadow-sm overflow-hidden">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-b border-slate-200 px-6 py-5 bg-slate-50/70">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Applicant Details</span>
                    <h2 class="text-xl font-black text-slate-900 mt-0.5">
                        {{ $application->application_no }}
                    </h2>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 rounded-full border px-4 py-1.5 text-xs font-bold {{ $statusClasses[$currentStatus] ?? 'bg-slate-100 text-slate-700 border-slate-200' }}">
                        <span>{{ $statusIcons[$currentStatus] ?? '•' }}</span>
                        <span>{{ $statusLabels[$currentStatus] ?? ucfirst($currentStatus) }}</span>
                    </span>

                    <a
                        href="{{ route('online-admission.application.pdf', ['applicationNo' => $application->application_no]) }}"
                        target="_blank"
                        class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full border border-indigo-200 bg-indigo-50 text-indigo-700 text-xs font-bold hover:bg-indigo-100 transition"
                    >
                        📄 Download PDF
                    </a>
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="rounded-2xl bg-slate-50 border border-slate-100 p-4">
                        <span class="text-xs font-semibold text-slate-400 uppercase">শিক্ষার্থীর নাম</span>
                        <p class="mt-1 font-bold text-slate-900 text-base">{{ $application->student_name }}</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 border border-slate-100 p-4">
                        <span class="text-xs font-semibold text-slate-400 uppercase">ভর্তির শ্রেণি</span>
                        <p class="mt-1 font-bold text-slate-900 text-base">{{ $application->class }}</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 border border-slate-100 p-4">
                        <span class="text-xs font-semibold text-slate-400 uppercase">পিতা / অভিভাবক</span>
                        <p class="mt-1 font-bold text-slate-900 text-base">{{ $application->father_name }}</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 border border-slate-100 p-4">
                        <span class="text-xs font-semibold text-slate-400 uppercase">অভিভাবকের মোবাইল</span>
                        <p class="mt-1 font-bold text-slate-900 text-base font-mono">{{ $application->guardian_phone }}</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 border border-slate-100 p-4">
                        <span class="text-xs font-semibold text-slate-400 uppercase">ই-মেইল</span>
                        <p class="mt-1 font-bold text-slate-900 text-sm break-all">{{ $application->email ?: 'উল্লেখ করা হয়নি' }}</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 border border-slate-100 p-4">
                        <span class="text-xs font-semibold text-slate-400 uppercase">আবেদনের তারিখ</span>
                        <p class="mt-1 font-bold text-slate-900 text-base">{{ optional($application->created_at)->format('d M Y') }}</p>
                    </div>
                </div>

                @if($application->status === 'approved')
                    <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 p-6 text-center">
                        <span class="w-12 h-12 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-xl mx-auto">✓</span>
                        <h3 class="text-lg font-bold text-emerald-900 mt-3">ভর্তি আবেদন অনুমোদিত হয়েছে!</h3>
                        <p class="text-sm text-emerald-800 mt-1">
                            আপনার ভর্তি ফি সফলভাবে পরিশোধিত ও অনুমোদিত হয়েছে।
                        </p>
                        @if($application->payments && $application->payments->count())
                            <div class="mt-4">
                                <a href="{{ route('admission-payment.receipt', $application->payments->last()->id) }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 text-white font-bold text-sm shadow hover:bg-emerald-700 transition">
                                    🖨 পেমেন্ট রসিদ দেখুন / প্রিন্ট করুন
                                </a>
                            </div>
                        @endif
                    </div>
                @elseif($application->status === 'payment_pending')
                    <div class="mt-6 rounded-2xl border border-blue-200 bg-blue-50 p-5 flex items-start gap-3">
                        <span class="text-2xl">⏳</span>
                        <div>
                            <h4 class="font-bold text-blue-900 text-sm">পেমেন্ট যাচাইকরণ প্রক্রিয়াধীন</h4>
                            <p class="text-xs sm:text-sm text-blue-800 mt-1 leading-5">
                                আপনার পেমেন্ট তথ্য গৃহীত হয়েছে। কর্তৃপক্ষ Transaction ID ও পেমেন্ট রসিদ যাচাই করে আপনার ভর্তি চূড়ান্ত করবেন। যাচাই সম্পন্ন হলে SMS ও ই-মেইলে জানিয়ে দেওয়া হবে।
                            </p>
                            @if($application->payments && $application->payments->count())
                                <div class="mt-3">
                                    <a href="{{ route('admission-payment.receipt', $application->payments->last()->id) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-blue-700 underline hover:text-blue-900">
                                        সাবমিটকৃত পেমেন্ট রসিদ দেখুন →
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

{{-- PAYMENT FORM & METHODS --}}
@if($application && in_array($application->status, ['pending', 'payment_pending']))
<section class="pb-16 bg-slate-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            {{-- FEE BREAKDOWN & INSTRUCTIONS --}}
            <div class="lg:col-span-2 space-y-6">

                <!-- Payable Fee Box -->
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Payable Amount</span>
                    <h3 class="text-xl font-bold text-slate-900 mt-1">ভর্তি ফি বিবরণী</h3>

                    <div class="mt-4 divide-y divide-slate-100">
                        @forelse($fees as $fee)
                            <div class="py-3 flex items-start justify-between gap-3 first:pt-0 last:pb-0">
                                <div>
                                    <p class="font-bold text-slate-800 text-sm">{{ $fee->name }}</p>
                                    @if($fee->description)
                                        <p class="text-xs text-slate-500 mt-0.5">{{ $fee->description }}</p>
                                    @endif
                                </div>
                                <span class="font-bold text-slate-900 text-sm shrink-0">৳{{ number_format((float) $fee->amount, 2) }}</span>
                            </div>
                        @empty
                            <div class="py-3 flex items-center justify-between text-sm">
                                <span class="text-slate-700">ভর্তি আবেদন ফি</span>
                                <span class="font-bold text-slate-900">৳500.00</span>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-5 pt-4 border-t-2 border-slate-100 flex items-center justify-between">
                        <span class="font-black text-slate-900 text-base">মোট প্রদেয় ফি</span>
                        <span class="font-black text-2xl text-indigo-600">৳ {{ number_format((float) $totalFee, 2) }}</span>
                    </div>
                </div>

                <!-- Payment Guides Card -->
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="font-bold text-slate-900 text-base flex items-center gap-2">
                        <span>📱</span> পেমেন্ট নির্দেশিকা
                    </h3>
                    <p class="text-xs text-slate-500 mt-1">যে মাধ্যমে টাকা পাঠাতে চান তার নির্দেশনা দেখুন:</p>

                    <!-- Instruction Tabs -->
                    <div class="mt-4 space-y-3">
                        <!-- SSLCOMMERZ Info -->
                        <div class="rounded-2xl border border-indigo-200 bg-indigo-50/70 p-4">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-indigo-900 text-sm">💳 SSLCOMMERZ Gateway</span>
                                <span class="text-[10px] bg-indigo-600 text-white px-2 py-0.5 rounded-full font-bold">Recommended</span>
                            </div>
                            <p class="text-xs text-indigo-800 mt-1.5 leading-5">
                                সরাসরি কার্ড (Visa, Mastercard), bKash, Nagad, Rocket অথবা Net Banking-এর মাধ্যমে তাত্ক্ষণিক স্বয়ংক্রিয় পেমেন্ট করুন। কোনো ম্যানুয়াল TrxID লেখার প্রয়োজন নেই।
                            </p>
                        </div>

                        <!-- bKash Guide -->
                        <div class="rounded-2xl border border-pink-200 bg-pink-50/40 p-4">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-pink-900 text-sm">📱 বিকাশ (bKash)</span>
                                <span class="font-mono font-bold text-xs bg-white px-2 py-1 rounded border border-pink-200 text-pink-700">01309-135255</span>
                            </div>
                            <ol class="mt-2 text-xs text-slate-600 space-y-1 list-decimal list-inside leading-5">
                                <li>bKash App বা *247# ডায়াল করে <strong>Send Money</strong> নির্বাচন করুন।</li>
                                <li>নম্বর দিন: <strong>01309-135255</strong></li>
                                <li>টাকার পরিমাণ: <strong>{{ number_format((float) $totalFee, 2) }}</strong></li>
                                <li>রেফারেন্স: <strong>{{ $application->application_no }}</strong></li>
                                <li>পেমেন্ট শেষে পাওয়া <strong>TrxID</strong> নিচের ফর্মে লিখুন।</li>
                            </ol>
                        </div>

                        <!-- Nagad Guide -->
                        <div class="rounded-2xl border border-orange-200 bg-orange-50/40 p-4">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-orange-900 text-sm">🟠 নগদ (Nagad)</span>
                                <span class="font-mono font-bold text-xs bg-white px-2 py-1 rounded border border-orange-200 text-orange-700">01722-152023</span>
                            </div>
                            <ol class="mt-2 text-xs text-slate-600 space-y-1 list-decimal list-inside leading-5">
                                <li>নগদ App বা *167# দিয়ে <strong>Send Money</strong> করুন।</li>
                                <li>নম্বর: <strong>01722-152023</strong></li>
                                <li>রেফারেন্স: <strong>{{ $application->application_no }}</strong></li>
                                <li>পেমেন্ট শেষে <strong>TrxID</strong> ফর্মে লিখুন।</li>
                            </ol>
                        </div>

                        <!-- Rocket Guide -->
                        <div class="rounded-2xl border border-purple-200 bg-purple-50/40 p-4">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-purple-900 text-sm">🚀 রকেট (Rocket)</span>
                                <span class="font-mono font-bold text-xs bg-white px-2 py-1 rounded border border-purple-200 text-purple-700">01309-135255-7</span>
                            </div>
                            <p class="mt-1 text-xs text-slate-600 leading-5">
                                রকেটের মাধ্যমে টাকা পাঠিয়ে প্রাপ্ত Transaction ID ফর্মে লিখুন।
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- PAYMENT FORM --}}
            <div class="lg:col-span-3">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 sm:p-8 shadow-sm">
                    <span class="text-xs font-bold uppercase tracking-wider text-indigo-600">Step 2</span>
                    <h2 class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">পেমেন্ট তথ্য জমাদান</h2>
                    <p class="text-sm text-slate-500 mt-1">
                        নিচের ফর্মটি পূরণ করে আপনার পেমেন্ট নিশ্চিত করুন।
                    </p>

                    <form
                        action="{{ route('admission-fee.store') }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="mt-6 space-y-6"
                        id="admissionPaymentForm"
                    >
                        @csrf

                        <!-- Hidden Application No -->
                        <input type="hidden" name="application_no" value="{{ $application->application_no }}">

                        <!-- Application No Display -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                Application Number
                            </label>
                            <input
                                type="text"
                                value="{{ $application->application_no }} ({{ $application->student_name }})"
                                readonly
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-700 cursor-not-allowed"
                            >
                        </div>

                        <!-- Payment Method Selection -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                পেমেন্ট মাধ্যম নির্বাচন করুন *
                            </label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                <!-- SSLCOMMERZ -->
                                <label class="payment-method-card relative flex flex-col items-center justify-center p-4 rounded-2xl border-2 cursor-pointer transition text-center {{ old('payment_method') === 'sslcommerz' || !old('payment_method') ? 'border-indigo-600 bg-indigo-50/50' : 'border-slate-200 hover:border-slate-300' }}">
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        value="sslcommerz"
                                        {{ old('payment_method') === 'sslcommerz' || !old('payment_method') ? 'checked' : '' }}
                                        class="sr-only"
                                        onchange="handleMethodChange(this.value)"
                                    >
                                    <span class="text-2xl mb-1">💳</span>
                                    <span class="font-bold text-slate-900 text-xs sm:text-sm">SSLCOMMERZ</span>
                                    <span class="text-[10px] text-indigo-600 font-semibold mt-0.5">সব কার্ড ও MFS</span>
                                </label>

                                <!-- bKash -->
                                <label class="payment-method-card relative flex flex-col items-center justify-center p-4 rounded-2xl border-2 cursor-pointer transition text-center {{ old('payment_method') === 'bkash' ? 'border-pink-600 bg-pink-50/50' : 'border-slate-200 hover:border-slate-300' }}">
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        value="bkash"
                                        {{ old('payment_method') === 'bkash' ? 'checked' : '' }}
                                        class="sr-only"
                                        onchange="handleMethodChange(this.value)"
                                    >
                                    <span class="text-2xl mb-1">📱</span>
                                    <span class="font-bold text-slate-900 text-xs sm:text-sm">bKash</span>
                                    <span class="text-[10px] text-pink-600 font-semibold mt-0.5">ম্যানুয়াল TrxID</span>
                                </label>

                                <!-- Nagad -->
                                <label class="payment-method-card relative flex flex-col items-center justify-center p-4 rounded-2xl border-2 cursor-pointer transition text-center {{ old('payment_method') === 'nagad' ? 'border-orange-600 bg-orange-50/50' : 'border-slate-200 hover:border-slate-300' }}">
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        value="nagad"
                                        {{ old('payment_method') === 'nagad' ? 'checked' : '' }}
                                        class="sr-only"
                                        onchange="handleMethodChange(this.value)"
                                    >
                                    <span class="text-2xl mb-1">🟠</span>
                                    <span class="font-bold text-slate-900 text-xs sm:text-sm">Nagad</span>
                                    <span class="text-[10px] text-orange-600 font-semibold mt-0.5">ম্যানুয়াল TrxID</span>
                                </label>

                                <!-- Rocket -->
                                <label class="payment-method-card relative flex flex-col items-center justify-center p-4 rounded-2xl border-2 cursor-pointer transition text-center {{ old('payment_method') === 'rocket' ? 'border-purple-600 bg-purple-50/50' : 'border-slate-200 hover:border-slate-300' }}">
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        value="rocket"
                                        {{ old('payment_method') === 'rocket' ? 'checked' : '' }}
                                        class="sr-only"
                                        onchange="handleMethodChange(this.value)"
                                    >
                                    <span class="text-2xl mb-1">🚀</span>
                                    <span class="font-bold text-slate-900 text-xs sm:text-sm">Rocket</span>
                                    <span class="text-[10px] text-purple-600 font-semibold mt-0.5">ম্যানুয়াল TrxID</span>
                                </label>

                                <!-- Bank -->
                                <label class="payment-method-card relative flex flex-col items-center justify-center p-4 rounded-2xl border-2 cursor-pointer transition text-center {{ old('payment_method') === 'bank' ? 'border-blue-600 bg-blue-50/50' : 'border-slate-200 hover:border-slate-300' }}">
                                    <input
                                        type="radio"
                                        name="payment_method"
                                        value="bank"
                                        {{ old('payment_method') === 'bank' ? 'checked' : '' }}
                                        class="sr-only"
                                        onchange="handleMethodChange(this.value)"
                                    >
                                    <span class="text-2xl mb-1">🏦</span>
                                    <span class="font-bold text-slate-900 text-xs sm:text-sm">Bank Deposit</span>
                                    <span class="text-[10px] text-blue-600 font-semibold mt-0.5">ব্যাংক ডিপোজিট</span>
                                </label>
                            </div>
                            @error('payment_method')
                                <p class="text-red-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- SSLCOMMERZ Notice Banner -->
                        <div id="sslcommerzNotice" class="rounded-2xl border border-indigo-200 bg-indigo-50/80 p-5">
                            <div class="flex items-start gap-3">
                                <span class="text-2xl">🔒</span>
                                <div>
                                    <h4 class="font-bold text-indigo-900 text-sm">তাত্ক্ষণিক ও নিরাপদ SSLCOMMERZ গেটওয়ে</h4>
                                    <p class="text-xs text-indigo-800 mt-1 leading-5">
                                        আপনি সরাসরি ভিসা, মাস্টারকার্ড, বিকাশ, নগদ, রকেট ইত্যাদির মাধ্যমে নিরাপদে ভর্তি ফি প্রদান করতে পারবেন। সাবমিট বাটনে ক্লিক করলে গেটওয়ে পেজে নিয়ে যাওয়া হবে।
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Manual MFS Fields (Account Number & Transaction ID) -->
                        <div id="manualFields" class="space-y-5" style="display: none;">
                            <div>
                                <label for="account_number" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                    যে নম্বর থেকে টাকা পাঠিয়েছেন (Sender Mobile / Account) *
                                </label>
                                <input
                                    type="text"
                                    name="account_number"
                                    id="account_number"
                                    value="{{ old('account_number') }}"
                                    placeholder="01XXXXXXXXX"
                                    maxlength="50"
                                    class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm font-medium outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                                >
                                @error('account_number')
                                    <p class="text-red-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="transaction_id" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                    Transaction ID (TrxID) *
                                </label>
                                <input
                                    type="text"
                                    name="transaction_id"
                                    id="transaction_id"
                                    value="{{ old('transaction_id') }}"
                                    placeholder="যেমন: 9J3K4L2M বা TrxID"
                                    maxlength="100"
                                    class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-sm font-mono uppercase font-bold outline-none transition focus:border-indigo-600 focus:ring-4 focus:ring-indigo-100"
                                >
                                @error('transaction_id')
                                    <p class="text-red-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="payment_proof" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                    পেমেন্ট রসিদ / স্ক্রিনশট <span class="font-normal text-slate-400">(ঐচ্ছিক)</span>
                                </label>
                                <input
                                    type="file"
                                    name="payment_proof"
                                    id="payment_proof"
                                    accept=".jpg,.jpeg,.png,.pdf"
                                    class="block w-full rounded-2xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-600"
                                >
                                <p class="text-[11px] text-slate-400 mt-1">JPG, PNG বা PDF ফরম্যাট, সর্বোচ্চ 4MB</p>
                                @error('payment_proof')
                                    <p class="text-red-500 text-xs font-semibold mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirmation Checkbox -->
                        <label class="flex items-start gap-3 cursor-pointer pt-2">
                            <input type="checkbox" required checked class="mt-1 h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="text-xs sm:text-sm text-slate-600 leading-5">
                                আমি নিশ্চিত করছি যে আমার আবেদন নম্বর ও পেমেন্ট তথ্য সম্পূর্ণ সঠিক এবং বিদ্যালয়ের ভর্তি নীতিমালা মেনে চলব।
                            </span>
                        </label>

                        <!-- Submit Button -->
                        <div class="pt-2">
                            <button
                                type="submit"
                                id="submitBtn"
                                class="w-full flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-base py-4 px-6 shadow-xl shadow-indigo-600/25 transition"
                            >
                                <span id="btnIcon">💳</span>
                                <span id="btnText">SSLCOMMERZ গেটওয়েতে পরিশোধ করুন (Pay ৳ {{ number_format((float) $totalFee, 2) }})</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    function handleMethodChange(method) {
        // Update card borders
        document.querySelectorAll('.payment-method-card').forEach(card => {
            card.classList.remove('border-indigo-600', 'bg-indigo-50/50', 'border-pink-600', 'bg-pink-50/50', 'border-orange-600', 'bg-orange-50/50', 'border-purple-600', 'bg-purple-50/50', 'border-blue-600', 'bg-blue-50/50');
            card.classList.add('border-slate-200');
        });

        const activeRadio = document.querySelector(`input[name="payment_method"][value="${method}"]`);
        if (activeRadio) {
            activeRadio.checked = true;
            const parent = activeRadio.closest('.payment-method-card');
            if (parent) {
                parent.classList.remove('border-slate-200');
                if (method === 'sslcommerz') parent.classList.add('border-indigo-600', 'bg-indigo-50/50');
                if (method === 'bkash') parent.classList.add('border-pink-600', 'bg-pink-50/50');
                if (method === 'nagad') parent.classList.add('border-orange-600', 'bg-orange-50/50');
                if (method === 'rocket') parent.classList.add('border-purple-600', 'bg-purple-50/50');
                if (method === 'bank') parent.classList.add('border-blue-600', 'bg-blue-50/50');
            }
        }

        const sslNotice = document.getElementById('sslcommerzNotice');
        const manualFields = document.getElementById('manualFields');
        const btnText = document.getElementById('btnText');
        const btnIcon = document.getElementById('btnIcon');
        const accInput = document.getElementById('account_number');
        const trxInput = document.getElementById('transaction_id');

        if (method === 'sslcommerz') {
            if (sslNotice) sslNotice.style.display = 'block';
            if (manualFields) manualFields.style.display = 'none';
            if (accInput) accInput.removeAttribute('required');
            if (trxInput) trxInput.removeAttribute('required');
            if (btnIcon) btnIcon.innerText = '💳';
            if (btnText) btnText.innerText = 'SSLCOMMERZ গেটওয়েতে পরিশোধ করুন (Pay ৳ {{ number_format((float) $totalFee, 2) }})';
        } else {
            if (sslNotice) sslNotice.style.display = 'none';
            if (manualFields) manualFields.style.display = 'block';
            if (accInput) accInput.setAttribute('required', 'required');
            if (trxInput) trxInput.setAttribute('required', 'required');
            if (btnIcon) btnIcon.innerText = '✓';
            if (btnText) btnText.innerText = `${method.toUpperCase()} পেমেন্ট তথ্য জমা দিন`;
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        const checked = document.querySelector('input[name="payment_method"]:checked');
        if (checked) {
            handleMethodChange(checked.value);
        }
    });
</script>
@endif

{{-- ADMISSION PROCESS INFO --}}
<section class="py-12 bg-white border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mb-8">
            <span class="text-xs font-bold text-indigo-600 uppercase tracking-widest">Process</span>
            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mt-1">ভর্তি ফি পরিশোধ ও চূড়ান্ত ভর্তি ধাপ</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="rounded-2xl border border-slate-200 p-5 bg-slate-50/50">
                <span class="w-8 h-8 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold text-sm">01</span>
                <h3 class="mt-3 font-bold text-slate-900">আবেদন ফরম পূরণ</h3>
                <p class="mt-1 text-xs text-slate-500 leading-5">অনলাইন ভর্তি আবেদন সম্পন্ন করে প্রাপ্ত Application No. সংগ্রহ করুন।</p>
            </div>
            <div class="rounded-2xl border border-slate-200 p-5 bg-slate-50/50">
                <span class="w-8 h-8 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold text-sm">02</span>
                <h3 class="mt-3 font-bold text-slate-900">মাধ্যম নির্বাচন ও ফি প্রদান</h3>
                <p class="mt-1 text-xs text-slate-500 leading-5">SSLCOMMERZ বা bKash/Nagad/Rocket মাধ্যমে ভর্তি ফি প্রদান করুন।</p>
            </div>
            <div class="rounded-2xl border border-slate-200 p-5 bg-slate-50/50">
                <span class="w-8 h-8 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold text-sm">03</span>
                <h3 class="mt-3 font-bold text-slate-900">যাচাইকরণ</h3>
                <p class="mt-1 text-xs text-slate-500 leading-5">কর্তৃপক্ষ Transaction ID ও আবেদনকারীর তথ্য মিলিয়ে চূড়ান্ত অনুমোদন করবেন।</p>
            </div>
            <div class="rounded-2xl border border-slate-200 p-5 bg-slate-50/50">
                <span class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold text-sm">04</span>
                <h3 class="mt-3 font-bold text-slate-900">ভর্তি নিশ্চিতকরণ ও রসিদ</h3>
                <p class="mt-1 text-xs text-slate-500 leading-5">SMS ও ই-মেইলে নিশ্চিতকরণ বার্তা এবং অনলাইন পেমেন্ট রসিদ ডাউনলোড করুন।</p>
            </div>
        </div>
    </div>
</section>

@endsection
