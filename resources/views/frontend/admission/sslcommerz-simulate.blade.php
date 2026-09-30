@extends('frontend.layouts.app')

@section('title', 'SSLCOMMERZ Payment Gateway | Secure Checkout')

@section('content')
<div class="bg-slate-100 min-h-[80vh] py-10 sm:py-14">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">

        <!-- SSLCOMMERZ Header Card -->
        <div class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-red-600 via-rose-600 to-indigo-800 p-6 text-white flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur border border-white/20 flex items-center justify-center font-black text-2xl tracking-wider">
                        SSL
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="inline-block w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span class="text-xs uppercase font-bold tracking-widest text-emerald-300">Sandbox / Secure Gateway</span>
                        </div>
                        <h1 class="text-xl sm:text-2xl font-black mt-0.5">SSLCOMMERZ Payment Gateway</h1>
                        <p class="text-xs text-white/80">Authorized Payment Gateway of Bangladesh Bank</p>
                    </div>
                </div>
                <div class="text-right sm:border-l sm:border-white/20 sm:pl-6">
                    <span class="text-xs text-white/80 uppercase font-semibold">Payable Amount</span>
                    <p class="text-2xl sm:text-3xl font-black text-white">৳ {{ number_format($payment->amount, 2) }}</p>
                </div>
            </div>

            <!-- Merchant & Applicant Details Bar -->
            <div class="bg-slate-50 border-b border-slate-200 px-6 py-4 grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs">
                <div>
                    <span class="text-slate-500 block">Merchant:</span>
                    <strong class="text-slate-800">{{ $websiteSetting->school_name ?? 'BIAM Laboratory School' }}</strong>
                </div>
                <div>
                    <span class="text-slate-500 block">App No:</span>
                    <strong class="text-indigo-600 font-mono">{{ $payment->application->application_no }}</strong>
                </div>
                <div>
                    <span class="text-slate-500 block">Applicant:</span>
                    <strong class="text-slate-800">{{ $payment->application->student_name }}</strong>
                </div>
                <div>
                    <span class="text-slate-500 block">Payment No:</span>
                    <strong class="text-slate-800 font-mono">{{ $payment->payment_no }}</strong>
                </div>
            </div>

            <!-- Payment Options Selection -->
            <div class="p-6 sm:p-8">
                <h2 class="text-base font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <span>💳</span> Select Your Payment Channel
                </h2>

                <!-- Tabs -->
                <div class="grid grid-cols-3 gap-2 p-1.5 bg-slate-100 rounded-2xl mb-6 text-xs sm:text-sm font-bold text-center">
                    <button type="button" class="py-2.5 px-3 rounded-xl bg-white shadow-sm text-indigo-700 font-bold border border-slate-200">
                        📱 Mobile Banking
                    </button>
                    <button type="button" class="py-2.5 px-3 rounded-xl text-slate-600 hover:text-slate-900 font-semibold">
                        💳 Cards
                    </button>
                    <button type="button" class="py-2.5 px-3 rounded-xl text-slate-600 hover:text-slate-900 font-semibold">
                        🏦 Net Banking
                    </button>
                </div>

                <!-- Channels Showcase -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-8">
                    <!-- bKash -->
                    <div class="rounded-2xl border-2 border-pink-500 bg-pink-50/60 p-3.5 text-center flex flex-col items-center justify-center cursor-pointer hover:shadow-md transition">
                        <span class="text-2xl mb-1">📱</span>
                        <span class="font-bold text-slate-800 text-sm">bKash</span>
                        <span class="text-[10px] text-pink-700 font-semibold">Instant / Wallet</span>
                    </div>

                    <!-- Nagad -->
                    <div class="rounded-2xl border border-slate-200 bg-white p-3.5 text-center flex flex-col items-center justify-center cursor-pointer hover:border-orange-400 hover:shadow-md transition">
                        <span class="text-2xl mb-1">🟠</span>
                        <span class="font-bold text-slate-800 text-sm">Nagad</span>
                        <span class="text-[10px] text-slate-500">Post / Direct</span>
                    </div>

                    <!-- Rocket -->
                    <div class="rounded-2xl border border-slate-200 bg-white p-3.5 text-center flex flex-col items-center justify-center cursor-pointer hover:border-purple-400 hover:shadow-md transition">
                        <span class="text-2xl mb-1">🚀</span>
                        <span class="font-bold text-slate-800 text-sm">Rocket</span>
                        <span class="text-[10px] text-slate-500">DBBL MFS</span>
                    </div>

                    <!-- Visa / Mastercard -->
                    <div class="rounded-2xl border border-slate-200 bg-white p-3.5 text-center flex flex-col items-center justify-center cursor-pointer hover:border-blue-400 hover:shadow-md transition">
                        <span class="text-2xl mb-1">💳</span>
                        <span class="font-bold text-slate-800 text-sm">Cards</span>
                        <span class="text-[10px] text-slate-500">Visa / Master / Amex</span>
                    </div>
                </div>

                <!-- Sandbox Simulation Actions -->
                <div class="rounded-2xl bg-amber-50 border border-amber-200 p-5 mb-6">
                    <div class="flex items-start gap-3">
                        <span class="text-amber-600 text-xl">ℹ️</span>
                        <div>
                            <h3 class="font-bold text-amber-900 text-sm">SSLCOMMERZ Gateway Simulation Mode</h3>
                            <p class="text-xs text-amber-800 mt-1 leading-5">
                                আপনি এখন SSLCOMMERZ পেমেন্ট টেস্ট এনভায়রনমেন্টে আছেন। নিচে দেওয়া বাটনে ক্লিক করে আপনি পেমেন্ট সফল (Success), ব্যর্থ (Fail) অথবা বাতিল (Cancel) সিমুলেট করতে পারেন।
                            </p>
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <!-- Success Form -->
                    <form action="{{ route('admission-fee.sslcommerz.success') }}" method="POST">
                        @csrf
                        <input type="hidden" name="tran_id" value="{{ $payment->payment_no }}">
                        <input type="hidden" name="value_b" value="{{ $payment->payment_no }}">
                        <input type="hidden" name="bank_tran_id" value="SSLCZ-{{ strtoupper(Str::random(10)) }}">
                        <input type="hidden" name="card_type" value="bKash-Online Gateway">
                        <input type="hidden" name="card_no" value="017XXXXXX89">
                        <input type="hidden" name="amount" value="{{ $payment->amount }}">
                        <input type="hidden" name="status" value="VALID">

                        <button type="submit" class="w-full flex items-center justify-center gap-2 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm sm:text-base py-4 px-6 shadow-lg shadow-emerald-600/25 transition">
                            <span>✓</span>
                            <span>পেমেন্ট নিশ্চিত করুন (Pay ৳ {{ number_format($payment->amount, 2) }} via SSLCOMMERZ)</span>
                        </button>
                    </form>

                    <div class="grid grid-cols-2 gap-3 pt-2">
                        <!-- Fail Form -->
                        <form action="{{ route('admission-fee.sslcommerz.fail') }}" method="POST">
                            @csrf
                            <input type="hidden" name="tran_id" value="{{ $payment->payment_no }}">
                            <input type="hidden" name="value_b" value="{{ $payment->payment_no }}">
                            <input type="hidden" name="error" value="Failed transaction simulation by user.">

                            <button type="submit" class="w-full rounded-xl border border-red-200 bg-red-50 hover:bg-red-100 text-red-700 font-semibold text-xs sm:text-sm py-3 px-4 transition text-center">
                                ✕ Fail Simulation
                            </button>
                        </form>

                        <!-- Cancel Form -->
                        <form action="{{ route('admission-fee.sslcommerz.cancel') }}" method="POST">
                            @csrf
                            <input type="hidden" name="tran_id" value="{{ $payment->payment_no }}">
                            <input type="hidden" name="value_b" value="{{ $payment->payment_no }}">

                            <button type="submit" class="w-full rounded-xl border border-slate-300 bg-white hover:bg-slate-100 text-slate-700 font-semibold text-xs sm:text-sm py-3 px-4 transition text-center">
                                ↩ Cancel Payment
                            </button>
                        </form>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3 text-[11px] text-slate-400">
                    <span>🔒 256-bit SSL End-to-End Encrypted</span>
                    <span>PCI DSS Certified Gateway</span>
                    <span>Bangladesh Bank Approved</span>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
