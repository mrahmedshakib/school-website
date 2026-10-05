@extends('backend.layouts.app')

@section('title', 'ডিজিটাল লটারি ব্যবস্থাপনা')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-gradient-to-r from-indigo-900 via-indigo-800 to-blue-900 p-6 rounded-2xl text-white shadow-xl">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 backdrop-blur-sm text-xs font-semibold text-indigo-200 uppercase tracking-wider mb-2">
                <span>🎲</span> ডিজিটাল লটারি ম্যানেজমেন্ট
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                ভর্তি লটারি ড্র ও মেধাতালিকা
            </h1>
            <p class="text-indigo-200 text-sm mt-1">
                সরকারি নীতিমালা ও কোটা অনুযায়ী সম্পূর্ণ নিরপেক্ষ ও স্বয়ংক্রিয় ডিজিটাল লটারি পরিচালনা করুন।
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admission.lottery', ['class' => $selectedClass, 'academic_year' => $academicYear]) }}" target="_blank"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white text-indigo-900 font-bold text-sm shadow-md hover:bg-indigo-50 transition">
                <span>👁️</span> পাবলিক রেজাল্ট দেখুন
            </a>
            <button onclick="window.print()"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-700/80 hover:bg-indigo-700 text-white font-semibold text-sm border border-indigo-400/30 transition">
                <span>🖨️</span> প্রিন্ট
            </button>
        </div>
    </div>

    {{-- Class & Year Filter --}}
    <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm">
        <form action="{{ route('admin.admission-lottery.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-end">
            <div class="sm:col-span-4">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1.5">
                    শিক্ষাবর্ষ (Academic Year)
                </label>
                <select name="academic_year" class="w-full rounded-xl border-slate-300 text-sm font-medium focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @for($y = date('Y') + 1; $y >= 2024; $y--)
                        <option value="{{ $y }}" {{ $academicYear == $y ? 'selected' : '' }}>{{ $y }} শিক্ষাবর্ষ</option>
                    @endfor
                </select>
            </div>

            <div class="sm:col-span-6">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1.5">
                    শ্রেণি (Target Class)
                </label>
                <select name="class" class="w-full rounded-xl border-slate-300 text-sm font-medium focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @forelse($classes as $cls)
                        <option value="{{ $cls }}" {{ $selectedClass == $cls ? 'selected' : '' }}>{{ $cls }}</option>
                    @empty
                        <option value="৬ষ্ঠ শ্রেণি (Class Six)">৬ষ্ঠ শ্রেণি (Class Six)</option>
                    @endforelse
                </select>
            </div>

            <div class="sm:col-span-2">
                <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-sm shadow-sm transition">
                    ফিল্টার লোড
                </button>
            </div>
        </form>
    </div>

    {{-- Metrics Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-2xl font-bold">
                👥
            </div>
            <div>
                <p class="text-xs font-bold uppercase text-slate-400">মোট আবেদনকারী</p>
                <h3 class="text-2xl font-extrabold text-slate-800">{{ $totalApplicants }} জন</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-2xl font-bold">
                💳
            </div>
            <div>
                <p class="text-xs font-bold uppercase text-slate-400">ফি পরিশোধিত</p>
                <h3 class="text-2xl font-extrabold text-emerald-600">{{ $paidApplicants }} জন</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center text-2xl font-bold">
                🏆
            </div>
            <div>
                <p class="text-xs font-bold uppercase text-slate-400">মেধাতালিকায় নির্বাচিত</p>
                <h3 class="text-2xl font-extrabold text-indigo-700">{{ $selectedCandidates->count() }} জন</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center text-2xl font-bold">
                ⏳
            </div>
            <div>
                <p class="text-xs font-bold uppercase text-slate-400">অপেক্ষমাণ তালিকায়</p>
                <h3 class="text-2xl font-extrabold text-amber-600">{{ $waitingCandidates->count() }} জন</h3>
            </div>
        </div>
    </div>

    {{-- Lottery Execution Form --}}
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <div class="flex items-center justify-between pb-4 mb-4 border-b border-slate-100">
            <div>
                <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                    <span>⚡</span> লটারি পরিচালনা কনসোল ({{ $selectedClass }} - {{ $academicYear }})
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">আসন সংখ্যা ও কোটা বিন্যাস নির্ধারণ করে ড্র শুরু করুন।</p>
            </div>
            @if($isDrawn)
                <form action="{{ route('admin.admission-lottery.reset') }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে বর্তমান লটারি ফলাফল রিসেট করতে চান?');">
                    @csrf
                    <input type="hidden" name="academic_year" value="{{ $academicYear }}">
                    <input type="hidden" name="class" value="{{ $selectedClass }}">
                    <button type="submit" class="px-4 py-2 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold text-xs border border-rose-200 transition">
                        🔄 ফলাফল রিসেট করুন
                    </button>
                </form>
            @endif
        </div>

        <form action="{{ route('admin.admission-lottery.draw') }}" method="POST" onsubmit="return confirm('আপনি কি {{ $selectedClass }} শ্রেণির জন্য ডিজিটাল লটারি ড্র চালু করতে চান?');">
            @csrf
            <input type="hidden" name="academic_year" value="{{ $academicYear }}">
            <input type="hidden" name="class" value="{{ $selectedClass }}">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                        মোট নির্ধারিত আসন সংখ্যা <span class="text-rose-500">*</span>
                    </label>
                    <input type="number" name="seats" min="1" max="1000" value="{{ old('seats', max(1, $selectedCandidates->count() ?: 50)) }}" required
                           class="w-full rounded-xl border-slate-300 text-sm font-semibold focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <span class="text-[11px] text-slate-400">লটারিতে নির্বাচিত মেধা তালিকার আসন</span>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                        মুক্তিযোদ্ধা কোটা (%)
                    </label>
                    <input type="number" name="quota_ff" min="0" max="100" value="{{ old('quota_ff', 5) }}"
                           class="w-full rounded-xl border-slate-300 text-sm font-medium focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <span class="text-[11px] text-slate-400">সরকারি নীতিমালা অনুযায়ী সাধারণত ৫%</span>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                        সহোদর/কর্মী কোটা (%)
                    </label>
                    <input type="number" name="quota_sibling" min="0" max="100" value="{{ old('quota_sibling', 5) }}"
                           class="w-full rounded-xl border-slate-300 text-sm font-medium focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <span class="text-[11px] text-slate-400">সহোদর ভাই/বোন বা কর্মকর্তা-কর্মচারী</span>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                        ক্যাচমেন্ট কোটা (%)
                    </label>
                    <input type="number" name="quota_catchment" min="0" max="100" value="{{ old('quota_catchment', 10) }}"
                           class="w-full rounded-xl border-slate-300 text-sm font-medium focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <span class="text-[11px] text-slate-400">এলাকাভিত্তিক ক্যাচমেন্ট এলাকা কোটা</span>
                </div>
            </div>

            <div class="mt-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-4 border-t border-slate-100">
                <label class="inline-flex items-center gap-2 text-sm font-semibold text-slate-700 cursor-pointer">
                    <input type="checkbox" name="only_paid" value="1" class="w-4 h-4 rounded text-indigo-600 focus:ring-indigo-500 border-slate-300">
                    <span>শুধুমাত্র পেমেন্ট সম্পন্নকারী আবেদনকারীদের ড্র-তে অন্তর্ভুক্ত করুন</span>
                </label>

                <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white font-extrabold text-sm shadow-lg shadow-indigo-600/30 transition transform active:scale-95">
                    <span>🎲</span> ডিজিটাল লটারি ড্র চালান (Run Draw)
                </button>
            </div>
        </form>
    </div>

    {{-- Selected Candidates (Merit List) --}}
    @if($selectedCandidates->isNotEmpty())
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-200 bg-indigo-50/50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h3 class="text-base font-extrabold text-indigo-950 flex items-center gap-2">
                        <span>🏆</span> নির্বাচিত মেধা তালিকা (Merit List) — মোট {{ $selectedCandidates->count() }} জন
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">লটারিতে মেধা অনুযায়ী আসন বরাদ্দকৃত শিক্ষার্থীদের তালিকা।</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-800">
                    ড্র তারিখ: {{ optional($selectedCandidates->first()->lottery_drawn_at)->format('d M, Y h:i A') }}
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                        <tr>
                            <th class="px-3 py-2.5 text-center w-14">র‍্যাংক</th>
                            <th class="px-3 py-2.5 text-center w-12">ছবি</th>
                            <th class="px-3 py-2.5 w-28">আবেদন নম্বর</th>
                            <th class="px-3 py-2.5">শিক্ষার্থীর নাম</th>
                            <th class="px-3 py-2.5 w-28">অভিভাবকের মোবাইল</th>
                            <th class="px-3 py-2.5 w-20">কোটা</th>
                            <th class="px-3 py-2.5 text-center w-24">ভর্তি স্ট্যাটাস</th>
                            <th class="px-3 py-2.5 text-right w-28">পদক্ষেপ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($selectedCandidates as $student)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="px-3 py-2 text-center font-black text-indigo-700 whitespace-nowrap">
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-indigo-100 text-[11px]">
                                        #{{ $student->lottery_rank }}
                                    </span>
                                </td>
                                <td class="px-3 py-2 text-center">
                                    @if($student->student_photo)
                                        <img src="{{ asset($student->student_photo) }}" alt="" class="w-8 h-8 rounded-lg object-cover border border-slate-200 mx-auto">
                                    @else
                                        <div class="w-8 h-8 rounded-lg bg-slate-200 flex items-center justify-center text-[10px] font-bold text-slate-500 mx-auto">
                                            N/A
                                        </div>
                                    @endif
                                </td>
                                <td class="px-3 py-2 font-mono font-bold text-slate-900 whitespace-nowrap">
                                    {{ $student->application_no }}
                                </td>
                                <td class="px-3 py-2">
                                    <div class="font-bold text-slate-900 line-clamp-1">{{ $student->student_name_bn ?? $student->student_name }}</div>
                                    <div class="text-[11px] text-slate-500 line-clamp-1">{{ $student->student_name_en }}</div>
                                </td>
                                <td class="px-3 py-2 font-medium text-slate-700 whitespace-nowrap text-[11px]">
                                    {{ $student->guardian_phone }}
                                </td>
                                <td class="px-3 py-2 whitespace-nowrap">
                                    @php
                                        $quotaLabels = [
                                            'general' => ['সাধারণ', 'bg-blue-50 text-blue-700 border-blue-200'],
                                            'freedom_fighter' => ['মুক্তিযোদ্ধা', 'bg-red-50 text-red-700 border-red-200'],
                                            'sibling' => ['সহোদর', 'bg-purple-50 text-purple-700 border-purple-200'],
                                            'catchment' => ['ক্যাচমেন্ট', 'bg-emerald-50 text-emerald-700 border-emerald-200'],
                                        ];
                                        $qInfo = $quotaLabels[$student->lottery_quota] ?? ['সাধারণ', 'bg-slate-100 text-slate-700 border-slate-200'];
                                    @endphp
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold border {{ $qInfo[1] }}">
                                        {{ $qInfo[0] }}
                                    </span>
                                </td>
                                <td class="px-3 py-2 text-center whitespace-nowrap">
                                    @if($student->is_confirmed)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                            ✓ নিশ্চিত
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                            অপেক্ষমাণ
                                        </span>
                                    @endif
                                </td>
                                <td class="px-3 py-2 text-right whitespace-nowrap">
                                    <div class="inline-flex items-center gap-1">
                                        @if(!$student->is_confirmed)
                                            <form action="{{ route('admin.admission-lottery.confirm', $student->id) }}" method="POST" onsubmit="return confirm('{{ $student->student_name }} শিক্ষার্থীর ভর্তি নিশ্চিত করতে চান?');">
                                                @csrf
                                                <button type="submit" class="px-2 py-1 rounded bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-[11px] shadow-sm transition">
                                                    কনফার্ম
                                                </button>
                                            </form>
                                        @endif
                                        <a href="{{ route('admin.admission-applications.show', $student->id) }}"
                                           class="p-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition" title="বিস্তারিত">
                                            👁️
                                        </a>
                                        <a href="{{ route('online-admission.pdf', $student->application_no) }}" target="_blank"
                                           class="p-1.5 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-700 transition" title="PDF">
                                            📄
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

    {{-- Waiting Candidates --}}
    @if($waitingCandidates->isNotEmpty())
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-200 bg-amber-50/50">
                <h3 class="text-base font-extrabold text-amber-950 flex items-center gap-2">
                    <span>⏳</span> অপেক্ষমাণ তালিকা (Waiting List) — মোট {{ $waitingCandidates->count() }} জন
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">মেধা তালিকার কোনো আসন খালি হলে ক্রমানুসারে অপেক্ষমাণ তালিকা থেকে ভর্তি নেওয়া হবে।</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                        <tr>
                            <th class="px-3 py-2.5 text-center w-20">অপেক্ষমাণ ক্র</th>
                            <th class="px-3 py-2.5 w-28">আবেদন নম্বর</th>
                            <th class="px-3 py-2.5">শিক্ষার্থীর নাম</th>
                            <th class="px-3 py-2.5 w-28">মোবাইল</th>
                            <th class="px-3 py-2.5 text-right w-28">পদক্ষেপ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($waitingCandidates as $wait)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="px-3 py-2 text-center font-bold text-amber-700 whitespace-nowrap">
                                    WL-{{ $loop->iteration }}
                                </td>
                                <td class="px-3 py-2 font-mono font-medium text-slate-900 whitespace-nowrap">
                                    {{ $wait->application_no }}
                                </td>
                                <td class="px-3 py-2 font-medium text-slate-900">
                                    <span class="line-clamp-1">{{ $wait->student_name_bn ?? $wait->student_name }}</span>
                                </td>
                                <td class="px-3 py-2 text-slate-600 whitespace-nowrap text-[11px]">
                                    {{ $wait->guardian_phone }}
                                </td>
                                <td class="px-3 py-2 text-right whitespace-nowrap">
                                    <form action="{{ route('admin.admission-lottery.confirm', $wait->id) }}" method="POST" class="inline-block" onsubmit="return confirm('অপেক্ষমাণ তালিকা থেকে এই শিক্ষার্থীর ভর্তি নিশ্চিত করবেন?');">
                                        @csrf
                                        <button type="submit" class="px-2 py-1 rounded bg-amber-600 hover:bg-amber-700 text-white font-bold text-[11px] transition">
                                            ভর্তি গ্রহণ
                                        </button>
                                    </form>
                                    <a href="{{ route('admin.admission-applications.show', $wait->id) }}" class="inline-block ml-1 p-1 text-slate-500 hover:text-slate-800">
                                        👁️
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @elseif(!$isDrawn)
        <div class="bg-slate-50 border-2 border-dashed border-slate-300 rounded-2xl p-12 text-center">
            <span class="text-4xl block mb-2">🎯</span>
            <h3 class="text-lg font-bold text-slate-800">এই শ্রেণির জন্য এখনও লটারি ড্র সম্পন্ন হয়নি</h3>
            <p class="text-sm text-slate-500 max-w-md mx-auto mt-1">
                উপরে আসন সংখ্যা নির্ধারণ করে "ডিজিটাল লটারি ড্র চালান" বাটনে ক্লিক করলে স্বয়ংক্রিয়ভাবে মেধা তালিকা প্রস্তুত হবে।
            </p>
        </div>
    @endif

</div>
@endsection
