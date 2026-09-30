@extends('backend.layouts.app')

@section('title', 'অনলাইন ভর্তি আবেদনসমূহ')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 text-xs font-semibold text-indigo-700 uppercase tracking-wider mb-2">
                <span>🎓</span> ভর্তি আবেদন ব্যবস্থাপনা
            </div>
            <h1 class="text-2xl font-black text-slate-900">
                অনলাইন ভর্তি আবেদন তালিকা
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                শিক্ষার্থীদের জমাকৃত সকল ভর্তি আবেদন পর্যালোচনা, যাচাই ও অনুমোদন করুন।
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.admission-lottery.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm shadow-md transition">
                <span>🎲</span> ডিজিটাল লটারি ড্র
            </a>
            <a href="{{ route('admin.admission-payments.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-sm transition">
                <span>💳</span> পেমেন্ট হিস্ট্রি
            </a>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 shadow-sm">
            <span class="text-xl">✅</span>
            <div class="font-medium text-sm">{{ session('success') }}</div>
        </div>
    @endif

    {{-- Statistics Overview --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
        <a href="{{ route('admin.admission-applications.index') }}"
           class="bg-white border p-4 rounded-2xl transition hover:shadow-md {{ !request('status') || request('status') === 'all' ? 'border-indigo-500 ring-2 ring-indigo-500/20' : 'border-slate-200' }}">
            <p class="text-xs font-bold uppercase text-slate-400">মোট আবেদন</p>
            <p class="text-2xl font-black text-slate-900 mt-1">{{ $total }}</p>
        </a>

        <a href="{{ route('admin.admission-applications.index', ['status' => 'pending']) }}"
           class="bg-white border p-4 rounded-2xl transition hover:shadow-md {{ request('status') === 'pending' ? 'border-amber-500 ring-2 ring-amber-500/20' : 'border-slate-200' }}">
            <p class="text-xs font-bold uppercase text-amber-600">পেন্ডিং</p>
            <p class="text-2xl font-black text-amber-600 mt-1">{{ $pending }}</p>
        </a>

        <a href="{{ route('admin.admission-applications.index', ['status' => 'selected_lottery']) }}"
           class="bg-white border p-4 rounded-2xl transition hover:shadow-md {{ request('status') === 'selected_lottery' ? 'border-indigo-500 ring-2 ring-indigo-500/20' : 'border-slate-200' }}">
            <p class="text-xs font-bold uppercase text-indigo-600">লটারি নির্বাচিত</p>
            <p class="text-2xl font-black text-indigo-600 mt-1">{{ $selectedLottery }}</p>
        </a>

        <a href="{{ route('admin.admission-applications.index', ['status' => 'approved']) }}"
           class="bg-white border p-4 rounded-2xl transition hover:shadow-md {{ request('status') === 'approved' ? 'border-emerald-500 ring-2 ring-emerald-500/20' : 'border-slate-200' }}">
            <p class="text-xs font-bold uppercase text-emerald-600">অনুমোদিত</p>
            <p class="text-2xl font-black text-emerald-600 mt-1">{{ $approved }}</p>
        </a>

        <a href="{{ route('admin.admission-applications.index', ['status' => 'confirmed']) }}"
           class="bg-white border p-4 rounded-2xl transition hover:shadow-md {{ request('status') === 'confirmed' ? 'border-blue-500 ring-2 ring-blue-500/20' : 'border-slate-200' }}">
            <p class="text-xs font-bold uppercase text-blue-600">ভর্তি নিশ্চিত</p>
            <p class="text-2xl font-black text-blue-600 mt-1">{{ $confirmed }}</p>
        </a>

        <a href="{{ route('admin.admission-applications.index', ['status' => 'rejected']) }}"
           class="bg-white border p-4 rounded-2xl transition hover:shadow-md {{ request('status') === 'rejected' ? 'border-rose-500 ring-2 ring-rose-500/20' : 'border-slate-200' }}">
            <p class="text-xs font-bold uppercase text-rose-600">বাতিলকৃত</p>
            <p class="text-2xl font-black text-rose-600 mt-1">{{ $rejected }}</p>
        </a>
    </div>

    {{-- Filter Panel --}}
    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
        <form method="GET" action="{{ route('admin.admission-applications.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-4 items-end">
            <div class="lg:col-span-4">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">অনুসন্ধান</label>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="আবেদন নং / শিক্ষার্থীর নাম / মোবাইল / BRN"
                       class="w-full rounded-xl border-slate-300 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="lg:col-span-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">শিক্ষাবর্ষ</label>
                <select name="academic_year" class="w-full rounded-xl border-slate-300 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">সকল বছর</option>
                    @foreach($academicYears as $year)
                        <option value="{{ $year }}" {{ request('academic_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>

            <div class="lg:col-span-3">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">শ্রেণি</label>
                <select name="class" class="w-full rounded-xl border-slate-300 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">সকল শ্রেণি</option>
                    @foreach($classes as $c)
                        <option value="{{ $c }}" {{ request('class') == $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </div>

            <div class="lg:col-span-3 flex items-center gap-2">
                <button type="submit" class="flex-1 py-2.5 px-4 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-sm shadow-sm transition">
                    ফিল্টার করুন
                </button>
                <a href="{{ route('admin.admission-applications.index') }}"
                   class="py-2.5 px-4 rounded-xl border border-slate-300 hover:bg-slate-100 text-slate-700 font-bold text-sm transition">
                    রিসেট
                </a>
            </div>
        </form>
    </div>

    {{-- Applications Table --}}
    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-5 py-4">#</th>
                        <th class="px-5 py-4">ছবি</th>
                        <th class="px-5 py-4">আবেদন নম্বর</th>
                        <th class="px-5 py-4">শিক্ষার্থী ও অভিভাবক</th>
                        <th class="px-5 py-4">শ্রেণি ও বছর</th>
                        <th class="px-5 py-4 text-center">ফি স্ট্যাটাস</th>
                        <th class="px-5 py-4 text-center">লটারি / ভর্তি</th>
                        <th class="px-5 py-4 text-right">অ্যাকশন</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($applications as $application)
                        @php
                            $approvedPayment = $application->payments->where('status', 'approved')->first();
                        @endphp
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="px-5 py-4 text-slate-400 font-mono text-xs">
                                {{ $applications->firstItem() + $loop->index }}
                            </td>

                            <td class="px-5 py-4">
                                @if($application->student_photo)
                                    <img src="{{ asset($application->student_photo) }}" alt=""
                                         class="w-11 h-11 rounded-xl object-cover border border-slate-200 shadow-sm">
                                @else
                                    <div class="w-11 h-11 rounded-xl bg-slate-100 text-slate-400 flex items-center justify-center text-xs font-bold border border-slate-200">
                                        N/A
                                    </div>
                                @endif
                            </td>

                            <td class="px-5 py-4">
                                <a href="{{ route('admin.admission-applications.show', $application) }}" class="font-mono font-bold text-indigo-600 hover:text-indigo-800">
                                    {{ $application->application_no }}
                                </a>
                                <p class="text-[11px] text-slate-400 mt-0.5">
                                    {{ $application->created_at->format('d M, Y') }}
                                </p>
                            </td>

                            <td class="px-5 py-4">
                                <p class="font-bold text-slate-900 leading-tight">
                                    {{ $application->student_name_bn ?? $application->student_name }}
                                </p>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    পিতা: {{ $application->father_name }}
                                </p>
                                <p class="text-xs text-slate-600 font-mono mt-0.5">
                                    📞 {{ $application->guardian_phone }}
                                </p>
                            </td>

                            <td class="px-5 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-800">
                                    {{ $application->class }}
                                </span>
                                @if($application->group_name)
                                    <span class="block text-[11px] text-slate-500 mt-1">বিভাগ: {{ $application->group_name }}</span>
                                @endif
                                <span class="block text-[11px] text-slate-400">শিক্ষাবর্ষ: {{ $application->academic_year ?? date('Y') }}</span>
                            </td>

                            <td class="px-5 py-4 text-center">
                                @if($approvedPayment)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                        <span>✓</span> পরিশোধিত
                                    </span>
                                @elseif($application->payments->count() > 0)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                        যাচাই চলছে
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600">
                                        অপরিশোধিত
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4 text-center">
                                @if($application->is_confirmed)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-black bg-blue-100 text-blue-800">
                                        ভর্তি নিশ্চিত ✓
                                    </span>
                                @elseif($application->status === 'selected_lottery')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-indigo-100 text-indigo-800">
                                        লটারি #{{ $application->lottery_rank }}
                                    </span>
                                @elseif($application->status === 'approved')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">
                                        অনুমোদিত
                                    </span>
                                @elseif($application->status === 'rejected')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-700">
                                        বাতিল
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">
                                        পেন্ডিং
                                    </span>
                                @endif
                            </td>

                            <td class="px-5 py-4 text-right">
                                <div class="inline-flex items-center gap-1.5">
                                    <a href="{{ route('admin.admission-applications.show', $application) }}"
                                       class="px-3 py-1.5 rounded-lg bg-indigo-50 text-indigo-700 text-xs font-bold hover:bg-indigo-100 transition">
                                        বিস্তারিত
                                    </a>
                                    <a href="{{ route('online-admission.pdf', $application->application_no) }}" target="_blank"
                                       class="p-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition" title="আবেদন ফর্ম PDF">
                                        📄
                                    </a>
                                    <a href="{{ route('online-admission.admit-card', $application->application_no) }}" target="_blank"
                                       class="p-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition" title="প্রবেশপত্র PDF">
                                        🪪
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-16 text-center text-slate-400">
                                <div class="text-5xl mb-3">🎓</div>
                                <h3 class="text-base font-bold text-slate-700">কোনো ভর্তি আবেদন পাওয়া যায়নি</h3>
                                <p class="text-xs text-slate-400 mt-1">নতুন অনলাইন আবেদন জমা হলে তা এখানে তালিকাভুক্ত হবে।</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($applications->hasPages())
            <div class="px-5 py-4 border-t border-slate-100 bg-slate-50">
                {{ $applications->links() }}
            </div>
        @endif
    </div>

</div>

@endsection