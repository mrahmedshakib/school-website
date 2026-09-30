@extends('frontend.layouts.app')

@section('title', 'ডিজিটাল লটারি ফলাফল ও মেধা তালিকা | Admission Lottery Results')

@section('meta_description')
{{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'আমাদের বিদ্যালয়' }} এ ডিজিটাল লটারি ড্র ও মেধা তালিকা ফলাফল দেখুন।
@endsection

@section('content')

{{-- HERO SECTION --}}
<section class="relative overflow-hidden bg-slate-950 py-10 sm:py-14 text-white">
    <div class="absolute inset-0 bg-gradient-to-br from-indigo-950 via-slate-950 to-slate-900"></div>
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-indigo-500/10 blur-3xl"></div>
    <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-indigo-500/20 border border-indigo-400/30 text-indigo-300 text-xs font-bold uppercase tracking-widest">
            🎲 Digital Lottery Result {{ $academicYear }}
        </span>
        <h1 class="mt-4 text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight">
            লটারি ফলাফল ও মেধা তালিকা
        </h1>
        <p class="mt-3 text-sm sm:text-base text-slate-300 max-w-2xl mx-auto leading-6">
            {{ $websiteSetting->school_name_bn ?? 'বিয়াম ল্যাবরেটরি স্কুল এন্ড কলেজ' }}-এর স্বয়ংক্রিয় ডিজিটাল লটারির ফলাফল, মেধা ও অপেক্ষমাণ তালিকা।
        </p>

        <div class="mt-6 flex items-center justify-center gap-3">
            <button onclick="window.print()" class="px-5 py-2.5 rounded-xl bg-white text-indigo-950 font-bold text-xs shadow-md hover:bg-indigo-50 transition flex items-center gap-1.5">
                <span>🖨️</span> ফলাফল প্রিন্ট করুন
            </button>
            <a href="{{ route('online-admission.download') }}" class="px-5 py-2.5 rounded-xl bg-indigo-800/80 hover:bg-indigo-800 text-white font-semibold text-xs border border-indigo-400/30 transition flex items-center gap-1.5">
                <span>📥</span> প্রবেশপত্র রি-ডাউনলোড
            </a>
        </div>
    </div>
</section>

<div class="bg-slate-50 py-10 sm:py-14">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 space-y-8">

        {{-- FILTER CARD --}}
        <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-sm">
            <form action="{{ route('admission.lottery') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-end">
                <div class="sm:col-span-4">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                        শিক্ষাবর্ষ (Academic Year)
                    </label>
                    <select name="academic_year" class="w-full rounded-2xl border-slate-300 text-sm font-semibold focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @for($y = date('Y') + 1; $y >= 2024; $y--)
                            <option value="{{ $y }}" {{ $academicYear == $y ? 'selected' : '' }}>{{ $y }} শিক্ষাবর্ষ</option>
                        @endfor
                    </select>
                </div>

                <div class="sm:col-span-6">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                        শ্রেণি (Select Class)
                    </label>
                    <select name="class" class="w-full rounded-2xl border-slate-300 text-sm font-semibold focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        @forelse($classes as $c)
                            <option value="{{ $c }}" {{ $selectedClass == $c ? 'selected' : '' }}>{{ $c }}</option>
                        @empty
                            <option value="">কোনো শ্রেণি পাওয়া যায়নি</option>
                        @endforelse
                    </select>
                </div>

                <div class="sm:col-span-2">
                    <button type="submit" class="w-full py-3 px-4 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-md shadow-indigo-600/20 transition">
                        ফলাফল দেখুন
                    </button>
                </div>
            </form>
        </div>

        {{-- METRICS SUMMARY --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-2xl font-bold">
                    👥
                </div>
                <div>
                    <p class="text-xs font-bold uppercase text-slate-400">মোট আবেদনকারী</p>
                    <h3 class="text-2xl font-black text-slate-900">{{ $totalApplicants }} জন</h3>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-indigo-200 bg-indigo-50/20 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center text-2xl font-bold">
                    🏆
                </div>
                <div>
                    <p class="text-xs font-bold uppercase text-indigo-600">মেধাতালিকায় উত্তীর্ণ</p>
                    <h3 class="text-2xl font-black text-indigo-800">{{ $totalSelected }} জন</h3>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-amber-200 bg-amber-50/20 shadow-sm flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-2xl font-bold">
                    ⏳
                </div>
                <div>
                    <p class="text-xs font-bold uppercase text-amber-600">অপেক্ষমাণ তালিকায়</p>
                    <h3 class="text-2xl font-black text-amber-700">{{ $totalWaiting }} জন</h3>
                </div>
            </div>
        </div>

        {{-- MERIT LIST TABLE --}}
        @if($selectedCandidates->isNotEmpty())
            <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm">
                <div class="p-6 bg-gradient-to-r from-indigo-900 to-blue-900 text-white flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <span class="text-xs font-bold text-indigo-300 uppercase tracking-wider block">মেধাতালিকা (Merit List)</span>
                        <h2 class="text-xl font-black mt-0.5">
                            {{ $selectedClass }} — নির্বাচিত শিক্ষার্থী তালিকা
                        </h2>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/10 backdrop-blur border border-white/20 text-white self-start sm:self-auto">
                        মোট নির্বাচিত: {{ $selectedCandidates->count() }} জন
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                            <tr>
                                <th class="px-5 py-4 text-center">মেধা ক্রম</th>
                                <th class="px-5 py-4">আবেদন নম্বর</th>
                                <th class="px-5 py-4">শিক্ষার্থীর নাম</th>
                                <th class="px-5 py-4">পিতার নাম</th>
                                <th class="px-5 py-4">কোটা</th>
                                <th class="px-5 py-4 text-center">ভর্তি স্ট্যাটাস</th>
                                <th class="px-5 py-4 text-right">ডাউনলোড</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @foreach($selectedCandidates as $student)
                                <tr class="hover:bg-indigo-50/30 transition">
                                    <td class="px-5 py-4 text-center font-black text-indigo-700">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-indigo-100 font-bold">
                                            #{{ $student->lottery_rank }}
                                        </span>
                                    </td>

                                    <td class="px-5 py-4 font-mono font-bold text-slate-900">
                                        {{ $student->application_no }}
                                    </td>

                                    <td class="px-5 py-4">
                                        <p class="font-bold text-slate-900">
                                            {{ $student->student_name_bn ?? $student->student_name }}
                                        </p>
                                        <p class="text-xs text-slate-400 font-medium">
                                            {{ $student->student_name_en }}
                                        </p>
                                    </td>

                                    <td class="px-5 py-4 font-medium text-slate-700">
                                        {{ $student->father_name }}
                                    </td>

                                    <td class="px-5 py-4">
                                        @php
                                            $quotas = [
                                                'general' => 'সাধারণ',
                                                'freedom_fighter' => 'মুক্তিযোদ্ধা',
                                                'sibling' => 'সহোদর',
                                                'catchment' => 'ক্যাচমেন্ট',
                                            ];
                                        @endphp
                                        <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                            {{ $quotas[$student->lottery_quota] ?? 'সাধারণ' }}
                                        </span>
                                    </td>

                                    <td class="px-5 py-4 text-center">
                                        @if($student->is_confirmed)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-black bg-emerald-100 text-emerald-800">
                                                <span>✓</span> ভর্তি নিশ্চিত
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                                নির্বাচিত (ভর্তি বাকি)
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-4 text-right">
                                        <div class="inline-flex items-center gap-2">
                                            <a href="{{ route('online-admission.admit-card', $student->application_no) }}" target="_blank"
                                               class="p-2 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold text-xs transition" title="প্রবেশপত্র">
                                                🪪 প্রবেশপত্র
                                            </a>
                                            <a href="{{ route('online-admission.pdf', $student->application_no) }}" target="_blank"
                                               class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs transition" title="আবেদন ফরম">
                                                📄 কপি
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        {{-- WAITING LIST TABLE --}}
        @if($waitingCandidates->isNotEmpty())
            <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm">
                <div class="p-6 bg-slate-900 text-white flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <span class="text-xs font-bold text-amber-300 uppercase tracking-wider block">অপেক্ষমাণ তালিকা (Waiting List)</span>
                        <h2 class="text-xl font-black mt-0.5">
                            {{ $selectedClass }} — অপেক্ষমাণ শিক্ষার্থী তালিকা
                        </h2>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/10 backdrop-blur border border-white/20 text-white">
                        মোট অপেক্ষমাণ: {{ $waitingCandidates->count() }} জন
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                            <tr>
                                <th class="px-5 py-4 text-center">অপেক্ষমাণ ক্রম</th>
                                <th class="px-5 py-4">আবেদন নম্বর</th>
                                <th class="px-5 py-4">শিক্ষার্থীর নাম</th>
                                <th class="px-5 py-4">পিতার নাম</th>
                                <th class="px-5 py-4 text-center">অবস্থা</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @foreach($waitingCandidates as $wait)
                                <tr class="hover:bg-slate-50/80 transition">
                                    <td class="px-5 py-4 text-center font-bold text-amber-700">
                                        WL-{{ $loop->iteration }}
                                    </td>
                                    <td class="px-5 py-4 font-mono font-medium text-slate-900">
                                        {{ $wait->application_no }}
                                    </td>
                                    <td class="px-5 py-4 font-bold text-slate-900">
                                        {{ $wait->student_name_bn ?? $wait->student_name }}
                                    </td>
                                    <td class="px-5 py-4 text-slate-600">
                                        {{ $wait->father_name }}
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                        @if($wait->is_confirmed)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-black bg-emerald-100 text-emerald-800">
                                                ভর্তি গ্রহণ করা হয়েছে
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600">
                                                অপেক্ষমাণ
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @elseif($selectedCandidates->isEmpty())
            <div class="bg-white border-2 border-dashed border-slate-200 rounded-3xl p-12 text-center">
                <span class="text-5xl block mb-3">🎲</span>
                <h3 class="text-lg font-bold text-slate-800">এই শ্রেণির জন্য এখনও লটারি ড্র সম্পন্ন হয়নি</h3>
                <p class="text-xs text-slate-500 max-w-md mx-auto mt-1">
                    কর্তৃপক্ষ লটারি পরিচালনা সম্পন্ন করলে স্বয়ংক্রিয়ভাবে এখানে মেধা ও অপেক্ষমাণ তালিকা প্রকাশিত হবে।
                </p>
            </div>
        @endif

    </div>
</div>

@endsection
