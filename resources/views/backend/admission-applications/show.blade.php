@extends('backend.layouts.app')

@section('title', 'ভর্তি আবেদন বিবরণ: ' . $admissionApplication->application_no)

@section('content')

<div class="space-y-6">

    {{-- Top Action Bar --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
        <div>
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-indigo-50 text-indigo-700">
                    {{ $admissionApplication->academic_year ?? date('Y') }} শিক্ষাবর্ষ
                </span>
                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">
                    {{ $admissionApplication->class }}
                </span>
            </div>
            <h1 class="text-2xl font-black text-slate-900 mt-2 font-mono">
                {{ $admissionApplication->application_no }}
            </h1>
            <p class="text-xs text-slate-500 mt-0.5">
                আবেদন দাখিল: {{ $admissionApplication->created_at->format('d M, Y h:i A') }}
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <a href="{{ route('admin.admission-applications.index') }}"
               class="px-4 py-2.5 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 text-sm font-semibold transition">
                ← ফিরে যান
            </a>

            <a href="{{ route('online-admission.pdf', $admissionApplication->application_no) }}" target="_blank"
               class="px-4 py-2.5 rounded-xl bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-sm font-bold transition flex items-center gap-1.5">
                <span>📄</span> আবেদন ফরম PDF
            </a>

            <a href="{{ route('online-admission.admit-card', $admissionApplication->application_no) }}" target="_blank"
               class="px-4 py-2.5 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-700 text-sm font-bold transition flex items-center gap-1.5">
                <span>🪪</span> প্রবেশপত্র
            </a>

            <a href="{{ route('online-admission.receipt', $admissionApplication->application_no) }}" target="_blank"
               class="px-4 py-2.5 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-sm font-bold transition flex items-center gap-1.5">
                <span>🧾</span> মানি রিসিট
            </a>

            @if(!$admissionApplication->is_confirmed)
                <form action="{{ route('admin.admission-lottery.confirm', $admissionApplication->id) }}" method="POST" onsubmit="return confirm('এই শিক্ষার্থীর ভর্তি নিশ্চিত করতে চান?');">
                    @csrf
                    <button type="submit" class="px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold shadow-md shadow-emerald-600/20 transition flex items-center gap-1.5">
                        <span>✓</span> ভর্তি নিশ্চিত করুন
                    </button>
                </form>
            @endif
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3 shadow-sm">
            <span class="text-xl">✅</span>
            <div class="font-medium text-sm">{{ session('success') }}</div>
        </div>
    @endif

    {{-- Main Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left 2 Columns: Detailed Info --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Student Summary Card --}}
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                    @if($admissionApplication->student_photo)
                        <img src="{{ asset($admissionApplication->student_photo) }}" alt="Student Photo"
                             class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl object-cover border-2 border-indigo-200 shadow-md">
                    @else
                        <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl bg-slate-100 border-2 border-dashed border-slate-300 flex items-center justify-center text-slate-400 font-bold">
                            ছবি নেই
                        </div>
                    @endif

                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-2">
                            <h2 class="text-2xl font-black text-slate-900">
                                {{ $admissionApplication->student_name_bn ?? $admissionApplication->student_name }}
                            </h2>
                            @if($admissionApplication->is_confirmed)
                                <span class="px-3 py-1 rounded-full text-xs font-black bg-blue-100 text-blue-800">
                                    ✓ ভর্তি নিশ্চিতকৃত
                                </span>
                            @endif
                        </div>
                        <p class="text-slate-600 font-semibold text-sm mt-0.5">
                            {{ $admissionApplication->student_name_en }}
                        </p>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 mt-3 text-xs">
                            <div class="p-2 rounded-lg bg-slate-50 border border-slate-100">
                                <span class="text-slate-400 block">ভর্তি শ্রেণি</span>
                                <span class="font-bold text-slate-800">{{ $admissionApplication->class }}</span>
                            </div>
                            <div class="p-2 rounded-lg bg-slate-50 border border-slate-100">
                                <span class="text-slate-400 block">বিভাগ / শাখা</span>
                                <span class="font-bold text-slate-800">{{ $admissionApplication->group_name ?? 'সাধারণ' }}</span>
                            </div>
                            <div class="p-2 rounded-lg bg-slate-50 border border-slate-100">
                                <span class="text-slate-400 block">রক্তের গ্রুপ</span>
                                <span class="font-bold text-rose-600">{{ $admissionApplication->blood_group ?? 'অজানা' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Personal & Academic Details --}}
            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                <div class="px-6 py-4 bg-slate-50 border-b border-slate-200">
                    <h3 class="font-bold text-slate-900 flex items-center gap-2">
                        <span>👤</span> শিক্ষার্থীর ব্যক্তিগত তথ্য
                    </h3>
                </div>

                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
                    <div>
                        <span class="text-xs text-slate-400 block">জন্ম তারিখ</span>
                        <span class="font-semibold text-slate-800">
                            {{ optional($admissionApplication->date_of_birth)->format('d F, Y') }}
                        </span>
                    </div>

                    <div>
                        <span class="text-xs text-slate-400 block">লিঙ্গ</span>
                        <span class="font-semibold text-slate-800 capitalize">
                            {{ $admissionApplication->gender === 'male' ? 'ছাত্র (Male)' : ($admissionApplication->gender === 'female' ? 'ছাত্রী (Female)' : 'অন্যান্য') }}
                        </span>
                    </div>

                    <div>
                        <span class="text-xs text-slate-400 block">ধর্ম</span>
                        <span class="font-semibold text-slate-800">{{ $admissionApplication->religion ?? 'N/A' }}</span>
                    </div>

                    <div>
                        <span class="text-xs text-slate-400 block">জাতীয়তা</span>
                        <span class="font-semibold text-slate-800">{{ $admissionApplication->nationality ?? 'Bangladeshi' }}</span>
                    </div>

                    <div class="sm:col-span-2">
                        <span class="text-xs text-slate-400 block">জন্ম নিবন্ধন নম্বর (BRN - ১৭ ডিজিট)</span>
                        <span class="font-mono font-bold text-indigo-700 text-sm">
                            {{ $admissionApplication->birth_reg_no ?? 'তথ্য দেওয়া হয়নি' }}
                        </span>
                    </div>

                    <div class="sm:col-span-3">
                        <span class="text-xs text-slate-400 block">পূর্ববর্তী শিক্ষা প্রতিষ্ঠান</span>
                        <span class="font-semibold text-slate-800">
                            {{ $admissionApplication->previous_school ?? 'নাই / প্রযোজ্য নয়' }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Parents Information --}}
            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                <div class="px-6 py-4 bg-slate-50 border-b border-slate-200">
                    <h3 class="font-bold text-slate-900 flex items-center gap-2">
                        <span>👨‍👩‍👧</span> পিতা ও মাতার তথ্য
                    </h3>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 text-sm divide-y md:divide-y-0 md:divide-x divide-slate-100">
                    {{-- Father --}}
                    <div class="space-y-3">
                        <h4 class="font-bold text-indigo-900 text-sm pb-1 border-b border-indigo-100">পিতার বিবরণ</h4>
                        <div>
                            <span class="text-xs text-slate-400 block">নাম (বাংলা)</span>
                            <span class="font-semibold text-slate-900">{{ $admissionApplication->father_name }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-400 block">নাম (ইংরেজি)</span>
                            <span class="font-semibold text-slate-700">{{ $admissionApplication->father_name_en ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-400 block">জাতীয় পরিচয়পত্র (NID)</span>
                            <span class="font-mono font-medium text-slate-800">{{ $admissionApplication->father_nid ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-400 block">শিক্ষাগত যোগ্যতা</span>
                            <span class="font-medium text-slate-800">{{ $admissionApplication->father_education ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-400 block">পেশা ও বার্ষিক আয়</span>
                            <span class="font-medium text-slate-800">{{ $admissionApplication->father_occupation_info ?? 'N/A' }}</span>
                        </div>
                    </div>

                    {{-- Mother --}}
                    <div class="space-y-3 md:pl-6 pt-4 md:pt-0">
                        <h4 class="font-bold text-pink-900 text-sm pb-1 border-b border-pink-100">মাতার বিবরণ</h4>
                        <div>
                            <span class="text-xs text-slate-400 block">নাম (বাংলা)</span>
                            <span class="font-semibold text-slate-900">{{ $admissionApplication->mother_name }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-400 block">নাম (ইংরেজি)</span>
                            <span class="font-semibold text-slate-700">{{ $admissionApplication->mother_name_en ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-400 block">জাতীয় পরিচয়পত্র (NID)</span>
                            <span class="font-mono font-medium text-slate-800">{{ $admissionApplication->mother_nid ?? 'N/A' }}</span>
                        </div>
                        <div>
                            <span class="text-xs text-slate-400 block">শিক্ষাগত যোগ্যতা</span>
                            <span class="font-medium text-slate-800">{{ $admissionApplication->mother_education ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Addresses & Guardian Details --}}
            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                <div class="px-6 py-4 bg-slate-50 border-b border-slate-200">
                    <h3 class="font-bold text-slate-900 flex items-center gap-2">
                        <span>📍</span> ঠিকানা, অভিভাবক ও যোগাযোগ
                    </h3>
                </div>

                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-5 text-sm">
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">বর্তমান ঠিকানা</span>
                        <p class="font-medium text-slate-800 whitespace-pre-line">{{ $admissionApplication->present_address ?? $admissionApplication->address }}</p>
                    </div>

                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider block mb-1">স্থায়ী ঠিকানা</span>
                        <p class="font-medium text-slate-800 whitespace-pre-line">{{ $admissionApplication->permanent_address ?? $admissionApplication->address }}</p>
                    </div>

                    <div>
                        <span class="text-xs text-slate-400 block">অভিভাবকের মোবাইল (SMS যোগাযোগ)</span>
                        <span class="font-mono font-bold text-slate-900 text-base">📞 {{ $admissionApplication->guardian_phone }}</span>
                    </div>

                    <div>
                        <span class="text-xs text-slate-400 block">বিকল্প মোবাইল / WhatsApp</span>
                        <span class="font-mono font-medium text-slate-800">📱 {{ $admissionApplication->contact_mobile ?? 'N/A' }}</span>
                    </div>

                    <div>
                        <span class="text-xs text-slate-400 block">ইমেইল ঠিকানা</span>
                        <span class="font-medium text-slate-800">{{ $admissionApplication->email ?? 'নাই' }}</span>
                    </div>

                    <div>
                        <span class="text-xs text-slate-400 block">অভিভাবকের তথ্য (যদি পিতা/মাতা ব্যতীত)</span>
                        <span class="font-medium text-slate-800">{{ $admissionApplication->guardian_info ?? 'পিতা/মাতা স্বয়ং অভিভাবক' }}</span>
                    </div>

                    <div class="md:col-span-2">
                        <span class="text-xs text-slate-400 block">এই বিদ্যালয়ে অধ্যয়নরত ভাই/বোনের তথ্য (যদি থাকে)</span>
                        <span class="font-medium text-slate-800">{{ $admissionApplication->other_children_info ?? 'নাই' }}</span>
                    </div>
                </div>
            </div>

            {{-- Attached Documents --}}
            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                <div class="px-6 py-4 bg-slate-50 border-b border-slate-200">
                    <h3 class="font-bold text-slate-900 flex items-center gap-2">
                        <span>📎</span> সংযুক্ত নথিপত্র (Documents)
                    </h3>
                </div>

                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 rounded-xl border border-slate-200 flex items-center gap-4">
                        <span class="text-3xl">🖼️</span>
                        <div class="flex-1">
                            <h4 class="font-bold text-slate-900 text-sm">শিক্ষার্থীর ছবি</h4>
                            <p class="text-xs text-slate-400">পাসপোর্ট সাইজ ছবি</p>
                            @if($admissionApplication->student_photo)
                                <a href="{{ asset($admissionApplication->student_photo) }}" target="_blank"
                                   class="text-xs font-bold text-indigo-600 hover:underline mt-1 inline-block">
                                    ছবি দেখুন / ডাউনলোড ↗
                                </a>
                            @else
                                <span class="text-xs text-rose-500 font-medium">ছবি আপলোড হয়নি</span>
                            @endif
                        </div>
                    </div>

                    <div class="p-4 rounded-xl border border-slate-200 flex items-center gap-4">
                        <span class="text-3xl">📜</span>
                        <div class="flex-1">
                            <h4 class="font-bold text-slate-900 text-sm">জন্ম নিবন্ধন সনদ</h4>
                            <p class="text-xs text-slate-400">ডিজিটাল জন্ম নিবন্ধন কপি</p>
                            @if($admissionApplication->birth_certificate)
                                <a href="{{ asset($admissionApplication->birth_certificate) }}" target="_blank"
                                   class="text-xs font-bold text-indigo-600 hover:underline mt-1 inline-block">
                                    সনদ দেখুন / ডাউনলোড ↗
                                </a>
                            @else
                                <span class="text-xs text-slate-400">সংযুক্ত নেই</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Payment Transactions History --}}
            <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                <div class="px-6 py-4 bg-slate-50 border-b border-slate-200 flex items-center justify-between">
                    <h3 class="font-bold text-slate-900 flex items-center gap-2">
                        <span>💳</span> ভর্তি ফি পরিশোধের বিবরণ
                    </h3>
                    <span class="text-xs font-bold px-2.5 py-0.5 rounded-full bg-slate-200 text-slate-700">
                        মোট পেমেন্ট: {{ $admissionApplication->payments->count() }}
                    </span>
                </div>

                @if($admissionApplication->payments->isNotEmpty())
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs text-slate-600">
                            <thead class="bg-slate-50 font-bold uppercase tracking-wider text-slate-400 border-b border-slate-100">
                                <tr>
                                    <th class="px-4 py-3">পেমেন্ট নং</th>
                                    <th class="px-4 py-3">মাধ্যম</th>
                                    <th class="px-4 py-3">ট্রানজেকশন আইডি</th>
                                    <th class="px-4 py-3">পরিমাণ</th>
                                    <th class="px-4 py-3 text-center">স্ট্যাটাস</th>
                                    <th class="px-4 py-3 text-right">তারিখ</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($admissionApplication->payments as $payment)
                                    <tr>
                                        <td class="px-4 py-3 font-mono font-bold text-slate-900">{{ $payment->payment_no }}</td>
                                        <td class="px-4 py-3 uppercase font-semibold text-indigo-700">{{ $payment->payment_method }}</td>
                                        <td class="px-4 py-3 font-mono">{{ $payment->transaction_id ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 font-bold text-slate-900">৳ {{ number_format($payment->amount, 2) }}</td>
                                        <td class="px-4 py-3 text-center">
                                            @if($payment->status === 'approved')
                                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">অনুমোদিত</span>
                                            @elseif($payment->status === 'rejected')
                                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800">বাতিল</span>
                                            @else
                                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">পেন্ডিং</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-right text-slate-400">{{ $payment->created_at->format('d M Y, h:i A') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-6 text-center text-slate-400 text-sm">
                        এখনও কোনো পেমেন্ট রেকর্ড পাওয়া যায়নি।
                    </div>
                @endif
            </div>

        </div>

        {{-- Right Column: Admin Actions & Status --}}
        <div class="space-y-6">

            {{-- Digital Lottery & Confirmation Card --}}
            <div class="bg-gradient-to-br from-indigo-900 to-blue-900 text-white p-6 rounded-2xl shadow-lg">
                <span class="text-xs font-bold uppercase tracking-wider text-indigo-200">লটারি ও ভর্তি অবস্থা</span>
                <div class="mt-4 space-y-3">
                    <div class="flex items-center justify-between pb-2 border-b border-indigo-700/50">
                        <span class="text-sm text-indigo-200">লটারি ড্র:</span>
                        @if($admissionApplication->is_lottery_selected)
                            <span class="font-extrabold text-emerald-300">নির্বাচিত (মেধা #{{ $admissionApplication->lottery_rank }})</span>
                        @elseif($admissionApplication->lottery_quota === 'waiting')
                            <span class="font-extrabold text-amber-300">অপেক্ষমাণ (ক্রম #{{ $admissionApplication->lottery_rank }})</span>
                        @else
                            <span class="text-indigo-300 text-xs">ড্র এখনও হয়নি</span>
                        @endif
                    </div>

                    @if($admissionApplication->lottery_quota)
                        <div class="flex items-center justify-between pb-2 border-b border-indigo-700/50">
                            <span class="text-sm text-indigo-200">বরাদ্দকৃত কোটা:</span>
                            <span class="font-bold uppercase text-white">{{ $admissionApplication->lottery_quota }}</span>
                        </div>
                    @endif

                    <div class="flex items-center justify-between pb-2 border-b border-indigo-700/50">
                        <span class="text-sm text-indigo-200">চূড়ান্ত ভর্তি:</span>
                        @if($admissionApplication->is_confirmed)
                            <span class="font-black text-emerald-300">✓ নিশ্চিতকৃত</span>
                        @else
                            <span class="font-medium text-amber-200 text-xs">অপেক্ষমাণ</span>
                        @endif
                    </div>

                    @if($admissionApplication->confirmed_at)
                        <div class="text-[11px] text-indigo-200 text-right">
                            নিশ্চিতকরণ তারিখ: {{ $admissionApplication->confirmed_at->format('d M Y, h:i A') }}
                        </div>
                    @endif
                </div>

                @if(!$admissionApplication->is_confirmed)
                    <form action="{{ route('admin.admission-lottery.confirm', $admissionApplication->id) }}" method="POST" class="mt-5" onsubmit="return confirm('এই শিক্ষার্থীর ভর্তি চূড়ান্ত নিশ্চিত করতে চান?');">
                        @csrf
                        <button type="submit" class="w-full py-3 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold text-sm shadow-md transition">
                            ✓ এক-ক্লিকে ভর্তি চূড়ান্ত নিশ্চিত করুন
                        </button>
                    </form>
                @endif
            </div>

            {{-- Status Management Form --}}
            <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                <h3 class="font-bold text-slate-900 pb-3 border-b border-slate-100 flex items-center gap-2">
                    <span>⚙️</span> স্ট্যাটাস আপডেট
                </h3>

                <form action="{{ route('admin.admission-applications.status', $admissionApplication) }}" method="POST" class="mt-4 space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                            আবেদনের স্ট্যাটাস
                        </label>
                        <select name="status" class="w-full rounded-xl border-slate-300 text-sm font-semibold focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="pending" {{ $admissionApplication->status === 'pending' ? 'selected' : '' }}>পেন্ডিং (Pending)</option>
                            <option value="payment_pending" {{ $admissionApplication->status === 'payment_pending' ? 'selected' : '' }}>পেমেন্ট অপেক্ষমাণ (Payment Pending)</option>
                            <option value="selected_lottery" {{ $admissionApplication->status === 'selected_lottery' ? 'selected' : '' }}>লটারিতে নির্বাচিত (Selected in Lottery)</option>
                            <option value="approved" {{ $admissionApplication->status === 'approved' ? 'selected' : '' }}>অনুমোদিত / কনফার্মড (Approved)</option>
                            <option value="rejected" {{ $admissionApplication->status === 'rejected' ? 'selected' : '' }}>বাতিল (Rejected)</option>
                        </select>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="confirm_admission" value="1" id="confirm_adm"
                               {{ $admissionApplication->is_confirmed ? 'checked' : '' }}
                               class="w-4 h-4 rounded text-indigo-600 border-slate-300 focus:ring-indigo-500">
                        <label for="confirm_adm" class="text-xs font-bold text-slate-700">
                            চূড়ান্ত ভর্তি নিশ্চিত হিসাবে চিহ্নিত করুন
                        </label>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1">
                            অ্যাডমিন নোট (ঐচ্ছিক)
                        </label>
                        <textarea name="admin_note" rows="3" class="w-full rounded-xl border-slate-300 text-xs focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                  placeholder="যাচাইকরণ নোট বা মন্তব্যের বিবরণ...">{{ old('admin_note', $admissionApplication->admin_note) }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-sm shadow-md transition">
                        স্ট্যাটাস সংরক্ষণ করুন
                    </button>
                </form>
            </div>

            {{-- Delete Application --}}
            <div class="bg-rose-50 border border-rose-200 rounded-2xl p-6 shadow-sm">
                <h4 class="font-bold text-rose-800 text-sm">আবেদন মুছে ফেলুন</h4>
                <p class="text-xs text-rose-600 mt-1">
                    সতর্কতা: একবার আবেদন মুছে ফেললে তা পুনরুদ্ধার করা যাবে না।
                </p>

                <form action="{{ route('admin.admission-applications.destroy', $admissionApplication) }}" method="POST" class="mt-4" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই আবেদনটি মুছে ফেলতে চান?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs transition">
                        আবেদন ডিলিট করুন
                    </button>
                </form>
            </div>

        </div>

    </div>

</div>

@endsection