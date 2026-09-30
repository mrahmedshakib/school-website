@extends('frontend.layouts.app')

@section('title', 'ভর্তি ফি রসিদ | Payment Receipt - ' . $payment->payment_no)

@section('content')

<style>
    @media print {
        header, footer, nav, .no-print {
            display: none !important;
        }
        body {
            background: white !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .receipt-card {
            border: 1px solid #cbd5e1 !important;
            box-shadow: none !important;
            margin: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
        }
    }
</style>

<div class="py-12 sm:py-16 bg-slate-100">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">

        {{-- 4-STEP FLOW INDICATOR (HIDDEN WHEN PRINTING) --}}
        <div class="no-print mb-8 grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-3 text-left">
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50/90 p-3 shadow-sm">
                <span class="w-6 h-6 rounded-full bg-emerald-600 text-white text-xs font-bold inline-flex items-center justify-center mb-1">✓</span>
                <p class="text-xs font-bold text-emerald-900">১. আবেদন ফরম</p>
                <span class="text-[10px] text-emerald-700 block">সম্পন্ন</span>
            </div>
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50/90 p-3 shadow-sm">
                <span class="w-6 h-6 rounded-full bg-emerald-600 text-white text-xs font-bold inline-flex items-center justify-center mb-1">✓</span>
                <p class="text-xs font-bold text-emerald-900">২. Application No.</p>
                <span class="text-[10px] text-emerald-700 block">সংগৃহীত</span>
            </div>
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50/90 p-3 shadow-sm">
                <span class="w-6 h-6 rounded-full bg-emerald-600 text-white text-xs font-bold inline-flex items-center justify-center mb-1">✓</span>
                <p class="text-xs font-bold text-emerald-900">৩. ফি পরিশোধ</p>
                <span class="text-[10px] text-emerald-700 block">সম্পন্ন</span>
            </div>
            <div class="rounded-2xl border-2 border-emerald-500 bg-emerald-100/90 p-3 shadow-md">
                <span class="w-6 h-6 rounded-full bg-emerald-600 text-white text-xs font-black inline-flex items-center justify-center mb-1">✓</span>
                <p class="text-xs font-bold text-emerald-950">৪. মানি রসিদ ও ভর্তি</p>
                <span class="text-[10px] text-emerald-800 font-semibold block">চূড়ান্ত ধাপ সম্পন্ন!</span>
            </div>
        </div>

        <!-- Receipt Card -->
        <div class="receipt-card bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden">

            <!-- School Header -->
            <div class="bg-gradient-to-r from-indigo-900 via-slate-900 to-indigo-950 p-6 sm:p-8 text-white text-center relative overflow-hidden">
                <div class="relative z-10 flex flex-col items-center">
                    @if(!empty($websiteSetting->logo) && file_exists(public_path($websiteSetting->logo)))
                        <img src="{{ asset($websiteSetting->logo) }}" alt="Logo" class="w-16 h-16 rounded-2xl bg-white p-1 mb-3 shadow">
                    @endif

                    <h1 class="text-xl sm:text-2xl font-black tracking-tight">
                        {{ $websiteSetting->school_name_bn ?? 'বিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ, দুপচাঁচিয়া, বগুড়া' }}
                    </h1>
                    <p class="text-xs text-indigo-200 mt-0.5">
                        {{ $websiteSetting->school_name ?? 'BIAM Laboratory School & College, Dupchanchia, Bogura' }}
                    </p>
                    <p class="text-[11px] text-slate-400 mt-1">
                        EIIN: 135255 | {{ $websiteSetting->address ?? 'উপজেলা কমপ্লেক্স, দুপচাঁচিয়া, বগুড়া' }} | ফোন: {{ $websiteSetting->mobile ?? '01309-135255' }}
                    </p>

                    <div class="mt-4 inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur border border-white/20 text-xs font-bold uppercase tracking-wider text-emerald-300">
                        <span>🧾 Official Money Receipt</span>
                    </div>
                </div>
            </div>

            <!-- Receipt Body -->
            <div class="p-6 sm:p-8">

                <!-- Status Banner -->
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-4 rounded-2xl {{ $payment->status === 'approved' ? 'bg-emerald-50 border border-emerald-200' : ($payment->status === 'pending' ? 'bg-amber-50 border border-amber-200' : 'bg-red-50 border border-red-200') }}">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-white text-sm {{ $payment->status === 'approved' ? 'bg-emerald-600' : ($payment->status === 'pending' ? 'bg-amber-600' : 'bg-red-600') }}">
                            {{ $payment->status === 'approved' ? '✓' : ($payment->status === 'pending' ? '⏳' : '✕') }}
                        </span>
                        <div>
                            <span class="text-xs font-bold uppercase tracking-wider {{ $payment->status === 'approved' ? 'text-emerald-700' : ($payment->status === 'pending' ? 'text-amber-700' : 'text-red-700') }}">
                                {{ $payment->status === 'approved' ? 'Payment Verified & Approved' : ($payment->status === 'pending' ? 'Payment Under Verification' : 'Payment Rejected') }}
                            </span>
                            <p class="text-xs text-slate-600 mt-0.5">
                                {{ $payment->status === 'approved' ? 'আপনার ভর্তি ফি যাচাইপূর্বক নিশ্চিত করা হয়েছে।' : ($payment->status === 'pending' ? 'আপনার পেমেন্ট তথ্য গৃহীত হয়েছে। কর্তৃপক্ষ যাচাই করছেন।' : 'পেমেন্ট অনুমোদিত হয়নি। অনুগ্রহ করে যোগাযোগ করুন।') }}
                            </p>
                        </div>
                    </div>

                    <div class="text-right">
                        <span class="text-[10px] text-slate-400 block uppercase font-semibold">Payment Date</span>
                        <strong class="text-xs text-slate-800">{{ optional($payment->paid_at ?? $payment->created_at)->format('d M Y, h:i A') }}</strong>
                    </div>
                </div>

                <!-- Info Table -->
                <div class="rounded-2xl border border-slate-200 overflow-hidden divide-y divide-slate-100 text-sm">
                    <div class="grid grid-cols-2 p-3.5 bg-slate-50/50">
                        <span class="text-slate-500 text-xs uppercase font-semibold">Money Receipt No.</span>
                        <span class="font-mono font-bold text-slate-900 text-right">{{ $payment->payment_no }}</span>
                    </div>

                    <div class="grid grid-cols-2 p-3.5">
                        <span class="text-slate-500 text-xs uppercase font-semibold">Application Number</span>
                        <span class="font-mono font-bold text-indigo-700 text-right">{{ $payment->application->application_no }}</span>
                    </div>

                    <div class="grid grid-cols-2 p-3.5 bg-slate-50/50">
                        <span class="text-slate-500 text-xs uppercase font-semibold">শিক্ষার্থীর নাম (Student Name)</span>
                        <span class="font-bold text-slate-900 text-right">{{ $payment->application->student_name }}</span>
                    </div>

                    <div class="grid grid-cols-2 p-3.5">
                        <span class="text-slate-500 text-xs uppercase font-semibold">শ্রেণি (Class)</span>
                        <span class="font-bold text-slate-900 text-right">{{ $payment->application->class }}</span>
                    </div>

                    <div class="grid grid-cols-2 p-3.5 bg-slate-50/50">
                        <span class="text-slate-500 text-xs uppercase font-semibold">অভিভাবক ও ফোন নম্বর</span>
                        <span class="font-medium text-slate-800 text-right">{{ $payment->application->father_name }} ({{ $payment->application->guardian_phone }})</span>
                    </div>

                    <div class="grid grid-cols-2 p-3.5">
                        <span class="text-slate-500 text-xs uppercase font-semibold">পেমেন্ট মাধ্যম (Payment Method)</span>
                        <span class="font-bold text-slate-900 text-right uppercase">{{ $payment->payment_method }}</span>
                    </div>

                    @if($payment->account_number)
                        <div class="grid grid-cols-2 p-3.5 bg-slate-50/50">
                            <span class="text-slate-500 text-xs uppercase font-semibold">প্রেরকের নম্বর (Sender Account)</span>
                            <span class="font-mono font-medium text-slate-800 text-right">{{ $payment->account_number }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-2 p-3.5">
                        <span class="text-slate-500 text-xs uppercase font-semibold">Transaction ID (TrxID)</span>
                        <span class="font-mono font-black text-indigo-600 text-right tracking-wider">{{ $payment->transaction_id }}</span>
                    </div>

                    <div class="grid grid-cols-2 p-4 bg-indigo-50/70 items-center">
                        <span class="font-black text-slate-900 text-base">পরিশোধিত মোট অর্থ (Total Paid)</span>
                        <span class="font-black text-xl text-indigo-700 text-right">৳ {{ number_format($payment->amount, 2) }}</span>
                    </div>
                </div>

                @if($payment->payment_proof)
                    <div class="mt-4 p-3 rounded-xl bg-slate-50 border border-slate-200 text-xs flex items-center justify-between">
                        <span class="text-slate-600">সংযুক্ত পেমেন্ট রসিদ / প্রমাণপত্র:</span>
                        <a href="{{ asset($payment->payment_proof) }}" target="_blank" class="text-indigo-600 font-bold hover:underline">
                            ডকুমেন্ট দেখুন ↗
                        </a>
                    </div>
                @endif

                @if($payment->admin_note)
                    <div class="mt-4 p-3 rounded-xl bg-slate-50 border border-slate-200 text-xs">
                        <span class="font-bold text-slate-700">অফিস মন্তব্য:</span>
                        <span class="text-slate-600">{{ $payment->admin_note }}</span>
                    </div>
                @endif

                <!-- Official Signatures for Printed Copy -->
                <div class="mt-12 pt-8 border-t border-slate-200 grid grid-cols-2 text-center text-xs text-slate-600">
                    <div>
                        <div class="w-32 border-t border-slate-400 mx-auto mb-1"></div>
                        <p class="font-semibold">আবেদনকারী / অভিভাবক</p>
                    </div>
                    <div>
                        <div class="w-32 border-t border-slate-400 mx-auto mb-1"></div>
                        <p class="font-semibold">হিসাব শাখা / বিদ্যালয় কর্তৃপক্ষ</p>
                    </div>
                </div>

                <!-- Action Buttons (Hidden when printing) -->
                <div class="no-print mt-8 flex flex-wrap items-center justify-center gap-3">
                    <button
                        onclick="window.print()"
                        type="button"
                        class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-slate-900 text-white font-bold text-sm hover:bg-slate-800 shadow-lg shadow-slate-900/20 transition"
                    >
                        <span>🖨</span>
                        <span>রসিদ প্রিন্ট করুন (Print Receipt)</span>
                    </button>

                    <a
                        href="{{ route('online-admission.application.pdf', ['applicationNo' => $payment->application->application_no]) }}"
                        target="_blank"
                        class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl border border-indigo-200 bg-indigo-50 text-indigo-700 font-bold text-sm hover:bg-indigo-100 transition"
                    >
                        <span>📄</span>
                        <span>Application PDF</span>
                    </a>

                    <a
                        href="{{ route('admission') }}"
                        class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl border border-slate-300 text-slate-700 font-bold text-sm hover:bg-slate-50 transition"
                    >
                        <span>←</span>
                        <span>ভর্তি বিজ্ঞপ্তি পাতা</span>
                    </a>
                </div>

            </div>

        </div>

    </div>
</div>

@endsection