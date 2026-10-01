@extends('frontend.layouts.app')

@section('title', 'ভর্তি আবেদন ও প্রবেশপত্র রি-ডাউনলোড | Download Application & Admit Card')

@section('content')

{{-- HERO SECTION --}}
<section class="relative overflow-hidden bg-[#061d36] py-10 sm:py-14 text-white">
    <div class="absolute inset-0 bg-gradient-to-br from-[#05172d] via-[#0c3c74] to-[#061d36]"></div>
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-brand-400/10 blur-3xl"></div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-500/20 border border-brand-400/30 text-brand-200 text-xs font-bold uppercase tracking-widest">
            📥 Student Portal
        </span>
        <h1 class="mt-4 text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight">
            আবেদন ও প্রবেশপত্র রি-ডাউনলোড
        </h1>
        <p class="mt-3 text-sm sm:text-base text-slate-300 max-w-2xl mx-auto leading-6">
            পূর্বে পূরণকৃত ভর্তি আবেদন ফরম, প্রবেশপত্র (Admit Card) অথবা পেমেন্ট রসিদ যেকোনো সময় ডাউনলোড করুন।
        </p>
    </div>
</section>

<div class="bg-slate-50 py-10 sm:py-14">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 space-y-8">

        {{-- Alerts --}}
        @if(session('error'))
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center gap-3 shadow-sm">
                <span class="text-xl">⚠️</span>
                <div class="font-medium text-sm">{{ session('error') }}</div>
            </div>
        @endif

        {{-- SEARCH CARD --}}
        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-8 shadow-sm">
            <h2 class="text-lg font-extrabold text-slate-900 mb-1 flex items-center gap-2">
                <span>🔍</span> আবেদন অনুসন্ধান করুন (Search Application)
            </h2>
            <p class="text-xs text-slate-500 mb-6">
                আবেদন নম্বর অথবা অভিভাবকের মোবাইল নম্বর ও শিক্ষার্থীর জন্ম তারিখ ব্যবহার করে অনুসন্ধান করুন।
            </p>

            {{-- Tab selector --}}
            <div class="flex items-center gap-3 p-1.5 rounded-2xl bg-slate-100 max-w-md mb-6">
                <button type="button" id="tabAppNo" onclick="switchSearchTab('app_no')"
                        class="flex-1 py-2 px-3 rounded-xl text-xs font-bold transition bg-white text-brand-primary shadow-sm">
                    আবেদন নম্বর দিয়ে
                </button>
                <button type="button" id="tabMobileDob" onclick="switchSearchTab('mobile_dob')"
                        class="flex-1 py-2 px-3 rounded-xl text-xs font-semibold text-slate-600 transition hover:text-slate-900">
                    মোবাইল ও জন্ম তারিখ দিয়ে
                </button>
            </div>

            <form action="{{ route('online-admission.download.search') }}" method="POST" id="searchForm">
                @csrf
                <input type="hidden" name="search_type" id="searchTypeInput" value="app_no">

                {{-- Option 1: Search by App No --}}
                <div id="sectionAppNo" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                            আবেদন নম্বর (Application No) *
                        </label>
                        <input type="text" name="application_no" value="{{ old('application_no') }}"
                               placeholder="যেমন: BLSC-{{ date('Y') }}-XXXXX"
                               class="w-full rounded-2xl border border-slate-300 font-mono font-bold text-sm px-4 py-3 outline-none focus:border-brand-primary focus:ring-4 focus:ring-brand-100">
                        <span class="text-[11px] text-slate-400 mt-1 block">অনলাইন আবেদন সম্পন্ন করার সময় আপনাকে প্রদত্ত নম্বর</span>
                    </div>
                </div>

                {{-- Option 2: Search by Mobile & DOB --}}
                <div id="sectionMobileDob" class="space-y-4 hidden">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                অভিভাবকের মোবাইল নম্বর *
                            </label>
                            <input type="tel" name="guardian_phone" value="{{ old('guardian_phone') }}"
                                   placeholder="01XXXXXXXXX"
                                   class="w-full rounded-2xl border border-slate-300 font-mono text-sm px-4 py-3 outline-none focus:border-brand-primary focus:ring-4 focus:ring-brand-100">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">
                                শিক্ষার্থীর জন্ম তারিখ *
                            </label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                   class="w-full rounded-2xl border border-slate-300 text-sm px-4 py-3 outline-none focus:border-brand-primary focus:ring-4 focus:ring-brand-100">
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-end">
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-8 py-3 rounded-2xl bg-brand-primary hover:bg-brand-secondary text-white font-extrabold text-sm shadow-lg shadow-brand-500/20 transition active:scale-95">
                        <span>🔍</span> অনুসন্ধান করুন (Search)
                    </button>
                </div>
            </form>
        </div>

        {{-- RESULT SECTION (If Application Found) --}}
        @if(isset($application) && $application)
            @php
                $approvedPayment = $application->payments->where('status', 'approved')->first();
            @endphp
            <div class="bg-white rounded-3xl border border-brand-200 p-6 sm:p-8 shadow-md relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-brand-50 rounded-bl-full -z-0"></div>

                <div class="relative z-10 space-y-6">
                    {{-- Student Header --}}
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5 pb-6 border-b border-slate-100">
                        @if($application->student_photo)
                            <img src="{{ asset($application->student_photo) }}" alt="Photo"
                                 class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl object-cover border-2 border-brand-100 shadow-sm">
                        @else
                            <div class="w-20 h-20 rounded-2xl bg-brand-50 text-brand-400 font-bold flex items-center justify-center text-xs">
                                ছবি নেই
                            </div>
                        @endif

                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <h3 class="text-xl sm:text-2xl font-black text-slate-900">
                                    {{ $application->student_name_bn ?? $application->student_name }}
                                </h3>
                                @if($application->is_confirmed)
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-black bg-blue-100 text-blue-800">
                                        ভর্তি নিশ্চিত ✓
                                    </span>
                                @elseif($application->status === 'selected_lottery')
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-brand-100 text-brand-800">
                                        লটারিতে নির্বাচিত (মেধা #{{ $application->lottery_rank }})
                                    </span>
                                @endif
                            </div>

                            <p class="text-sm font-semibold text-slate-600 mt-0.5">
                                {{ $application->student_name_en }}
                            </p>

                            <div class="flex flex-wrap items-center gap-3 mt-3 text-xs text-slate-600">
                                <span class="font-mono font-bold text-brand-700 bg-brand-50 px-2.5 py-1 rounded-lg">
                                    App No: {{ $application->application_no }}
                                </span>
                                <span class="bg-slate-100 px-2.5 py-1 rounded-lg font-semibold">
                                    শ্রেণি: {{ $application->class }}
                                </span>
                                <span class="bg-slate-100 px-2.5 py-1 rounded-lg">
                                    পিতা: {{ $application->father_name }}
                                </span>
                            </div>
                        </div>

                        {{-- Payment Status Badge --}}
                        <div class="sm:text-right">
                            @if($approvedPayment)
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-black bg-emerald-100 text-emerald-800">
                                    <span>✓</span> ফি পরিশোধিত (Paid)
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-black bg-amber-100 text-amber-800">
                                    <span>⏳</span> ফি অপেক্ষমাণ (Unpaid)
                                </span>
                            @endif
                        </div>
                    </div>

                    {{-- Download Action Buttons --}}
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">
                            উপলব্ধ ডাউনলোড ও কার্যক্রম
                        </h4>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            {{-- Application PDF --}}
                            <a href="{{ route('online-admission.pdf', $application->application_no) }}" target="_blank"
                               class="flex items-center justify-between p-4 rounded-2xl border border-slate-200 bg-slate-50/50 hover:bg-brand-50 hover:border-brand-300 transition group">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">📄</span>
                                    <div>
                                        <p class="text-xs font-bold text-slate-900 group-hover:text-brand-700">আবেদন ফরম (PDF)</p>
                                        <span class="text-[10px] text-slate-400">Application Copy</span>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-brand-600">ডাউনলোড ↓</span>
                            </a>

                            {{-- Admit Card PDF --}}
                            <a href="{{ route('online-admission.admit-card', $application->application_no) }}" target="_blank"
                               class="flex items-center justify-between p-4 rounded-2xl border border-slate-200 bg-slate-50/50 hover:bg-blue-50 hover:border-blue-300 transition group">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">🪪</span>
                                    <div>
                                        <p class="text-xs font-bold text-slate-900 group-hover:text-blue-700">প্রবেশপত্র (Admit Card)</p>
                                        <span class="text-[10px] text-slate-400">লটারি / পরীক্ষার প্রবেশপত্র</span>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-blue-600">ডাউনলোড ↓</span>
                            </a>

                            {{-- Money Receipt PDF --}}
                            @if($approvedPayment)
                                <a href="{{ route('online-admission.receipt', $application->application_no) }}" target="_blank"
                                   class="flex items-center justify-between p-4 rounded-2xl border border-slate-200 bg-slate-50/50 hover:bg-emerald-50 hover:border-emerald-300 transition group">
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">🧾</span>
                                        <div>
                                            <p class="text-xs font-bold text-slate-900 group-hover:text-emerald-700">মানি রিসিট (Receipt)</p>
                                            <span class="text-[10px] text-slate-400">পেমেন্ট প্রত্যয়নপত্র</span>
                                        </div>
                                    </div>
                                    <span class="text-xs font-bold text-emerald-600">ডাউনলোড ↓</span>
                                </a>
                            @else
                                <a href="{{ route('admission-fee', ['application_no' => $application->application_no]) }}"
                                   class="flex items-center justify-between p-4 rounded-2xl border border-amber-300 bg-amber-50 hover:bg-amber-100 transition group">
                                    <div class="flex items-center gap-3">
                                        <span class="text-2xl">💳</span>
                                        <div>
                                            <p class="text-xs font-bold text-amber-900">ভর্তি ফি পরিশোধ করুন</p>
                                            <span class="text-[10px] text-amber-700">SSLCOMMERZ / bKash</span>
                                        </div>
                                    </div>
                                    <span class="text-xs font-black text-amber-800">পেমেন্ট করুন ↗</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>

<script>
    function switchSearchTab(tab) {
        const tabApp = document.getElementById('tabAppNo');
        const tabMobile = document.getElementById('tabMobileDob');
        const secApp = document.getElementById('sectionAppNo');
        const secMobile = document.getElementById('sectionMobileDob');
        const typeInput = document.getElementById('searchTypeInput');

        if (tab === 'app_no') {
            tabApp.classList.add('bg-white', 'text-indigo-700', 'shadow-sm');
            tabApp.classList.remove('text-slate-600');
            tabMobile.classList.remove('bg-white', 'text-indigo-700', 'shadow-sm');
            tabMobile.classList.add('text-slate-600');

            secApp.classList.remove('hidden');
            secMobile.classList.add('hidden');
            typeInput.value = 'app_no';
        } else {
            tabMobile.classList.add('bg-white', 'text-indigo-700', 'shadow-sm');
            tabMobile.classList.remove('text-slate-600');
            tabApp.classList.remove('bg-white', 'text-indigo-700', 'shadow-sm');
            tabApp.classList.add('text-slate-600');

            secMobile.classList.remove('hidden');
            secApp.classList.add('hidden');
            typeInput.value = 'mobile_dob';
        }
    }
</script>

@endsection
