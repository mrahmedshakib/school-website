@extends('frontend.layouts.app')
@section('title', 'ভর্তি সংক্রান্ত তথ্য | Admission')
@section('content')

{{-- HERO --}}

<section class="relative overflow-hidden bg-[#061d36] py-12 sm:py-16 text-white">
    <div class="absolute inset-0 bg-gradient-to-br from-[#05172d] via-[#0c3c74] to-[#061d36]"></div>
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-brand-400/10 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 rounded-full bg-blue-500/10 blur-3xl"></div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-500/20 border border-brand-400/30 text-brand-200 text-xs sm:text-sm font-bold uppercase tracking-wider">
            🎓 Admission Information
        </span>
        <h1 class="mt-4 text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white">
            ভর্তি সংক্রান্ত তথ্য
        </h1>
        <p class="mt-3 max-w-2xl mx-auto text-sm sm:text-base text-slate-300 leading-6">
            ভর্তি বিজ্ঞপ্তি, আবেদনের সময়সূচি, প্রয়োজনীয় নির্দেশনা এবং অনলাইনে আবেদন সংক্রান্ত সকল গুরুত্বপূর্ণ তথ্য এখানে পাওয়া যাবে।
        </p>
        <div class="mt-6 flex flex-wrap items-center justify-center gap-3">
            <a href="{{ route('online-admission') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-brand-primary text-white font-bold text-sm shadow-lg shadow-brand-500/20 hover:bg-brand-secondary transition active:scale-95">
                📝 অনলাইনে আবেদন
            </a>
            <a href="#admission-notice" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-white/10 border border-white/20 text-white font-bold text-sm hover:bg-white/15 transition active:scale-95">
                📢 ভর্তি বিজ্ঞপ্তি
            </a>
        </div>
    </div>
</section>

{{-- ADMISSION NOTICE --}}

<section id="admission-notice" class="py-12 sm:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mb-7">
            <span class="text-indigo-600 font-semibold text-sm">📢 Admission Notice</span>
            <h2 class="mt-1 text-3xl sm:text-4xl font-bold text-slate-900">ভর্তি বিজ্ঞপ্তি</h2>
            <p class="mt-2 text-slate-500 leading-6">
                ভর্তি সংক্রান্ত সর্বশেষ বিজ্ঞপ্তি, আবেদন সময়সূচি এবং প্রয়োজনীয় নির্দেশনা এখানে পাওয়া যাবে।
            </p>
        </div>

    @if($admissions->count())
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[950px] text-sm">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-5 py-4 text-left font-semibold text-slate-700 w-16">#</th>
                            <th class="px-5 py-4 text-left font-semibold text-slate-700">ভর্তি বিজ্ঞপ্তি</th>
                            <th class="px-5 py-4 text-left font-semibold text-slate-700">আবেদনের সময়সীমা</th>
                            <th class="px-5 py-4 text-center font-semibold text-slate-700">PDF</th>
                            <th class="px-5 py-4 text-center font-semibold text-slate-700">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($admissions as $key => $admission)
                            <tr class="hover:bg-slate-50/70 transition">
                                <td class="px-5 py-4 align-middle">
                                    <div class="w-9 h-9 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                                        {{ $key + 1 }}
                                    </div>
                                </td>
                                <td class="px-5 py-4 align-middle">
                                    <div class="max-w-lg">
                                        <div class="flex items-center gap-2">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500 shrink-0"></span>
                                            <h3 class="font-bold text-slate-900">
                                                {{ $admission->title }}
                                            </h3>
                                        </div>
                                        @if($admission->description)
                                            <p class="mt-1 text-xs text-slate-500 leading-5">
                                                {{ $admission->description }}
                                            </p>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-5 py-4 align-middle">
                                    @if($admission->application_start || $admission->application_end)
                                        <div class="flex items-center gap-2 text-slate-700">
                                            <span class="text-base">📅</span>
                                            <div>
                                                <p class="text-xs text-slate-400">আবেদনের সময়সীমা</p>
                                                <p class="mt-0.5 font-medium">
                                                    @if($admission->application_start)
                                                        {{ $admission->application_start->format('d M Y') }}
                                                    @endif
                                                    @if($admission->application_start && $admission->application_end)
                                                        <span class="mx-1 text-slate-400">—</span>
                                                    @endif
                                                    @if($admission->application_end)
                                                        {{ $admission->application_end->format('d M Y') }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400">সময় নির্ধারিত নয়</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 align-middle">
                                    @if($admission->pdf)
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ asset($admission->pdf) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 px-3 py-2 rounded-lg border border-red-200 bg-red-50 text-red-600 text-xs font-semibold hover:bg-red-100 transition">
                                                📄 View
                                            </a>
                                            <a href="{{ asset($admission->pdf) }}" download class="inline-flex items-center justify-center w-9 h-9 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100 transition" title="Download PDF">
                                                ⬇
                                            </a>
                                        </div>
                                    @else
                                        <span class="text-xs text-slate-400">N/A</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 align-middle">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('online-admission') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg bg-indigo-600 text-white text-xs font-semibold hover:bg-indigo-700 transition">
                                            📝 Apply
                                        </a>
                                        <a href="{{ route('admission-fee') }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg border border-indigo-200 bg-indigo-50 text-indigo-700 text-xs font-semibold hover:bg-indigo-100 transition">
                                            💳 Fee
                                        </a>
                                        @if($admission->application_url)
                                            <a href="{{ $admission->application_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center w-9 h-9 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-100 transition" title="Application Link">
                                                🔗
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-10 text-center">
            <div class="mx-auto w-14 h-14 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-2xl shadow-sm">
                📢
            </div>
            <h3 class="mt-4 text-lg font-bold text-slate-900">
                বর্তমানে কোনো ভর্তি বিজ্ঞপ্তি নেই
            </h3>
            <p class="mt-1 text-sm text-slate-500">
                ভর্তি সংক্রান্ত নতুন বিজ্ঞপ্তি প্রকাশিত হলে এখানে পাওয়া যাবে।
            </p>
        </div>
    @endif
</div>

</section>

{{-- ADMISSION PROCESS --}}

<section class="py-12 sm:py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mb-7">
            <span class="text-indigo-600 font-semibold text-sm">🎓 Admission Process</span>
            <h2 class="mt-1 text-3xl sm:text-4xl font-bold text-slate-900">ভর্তি প্রক্রিয়া</h2>
            <p class="mt-2 text-slate-500 leading-6">
                শিক্ষার্থী ভর্তির জন্য নিচের ধাপগুলো অনুসরণ করুন।
            </p>
        </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold">01</div>
            <h3 class="mt-4 font-bold text-slate-900">ভর্তি বিজ্ঞপ্তি দেখুন</h3>
            <p class="mt-1.5 text-sm text-slate-500 leading-6">
                ভর্তি সংক্রান্ত বিজ্ঞপ্তি এবং সময়সূচি ভালোভাবে পড়ুন।
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold">02</div>
            <h3 class="mt-4 font-bold text-slate-900">অনলাইনে আবেদন</h3>
            <p class="mt-1.5 text-sm text-slate-500 leading-6">
                প্রয়োজনীয় তথ্য ও documents দিয়ে online admission form পূরণ করুন।
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold">03</div>
            <h3 class="mt-4 font-bold text-slate-900">Application Review</h3>
            <p class="mt-1.5 text-sm text-slate-500 leading-6">
                বিদ্যালয় কর্তৃপক্ষ আপনার আবেদন যাচাই করবে।
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
            <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center font-bold">04</div>
            <h3 class="mt-4 font-bold text-slate-900">ভর্তি ফি প্রদান</h3>
            <p class="mt-1.5 text-sm text-slate-500 leading-6">
                Application approved হলে নির্ধারিত ভর্তি ফি প্রদান করুন।
            </p>
        </div>
    </div>
</div>


</section>

{{-- GUIDELINES --}}

<section class="py-12 sm:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="w-11 h-11 rounded-xl bg-indigo-50 flex items-center justify-center text-xl">
                    📋
                </div>
                <h2 class="mt-4 text-2xl font-bold text-slate-900">প্রয়োজনীয় কাগজপত্র</h2>
                <ul class="mt-4 space-y-2.5 text-sm text-slate-600">
                    <li class="flex gap-3"><span class="text-indigo-600 font-bold">✓</span> শিক্ষার্থীর সাম্প্রতিক ছবি</li>
                    <li class="flex gap-3"><span class="text-indigo-600 font-bold">✓</span> জন্ম নিবন্ধন সনদ</li>
                    <li class="flex gap-3"><span class="text-indigo-600 font-bold">✓</span> পূর্ববর্তী বিদ্যালয়ের তথ্য</li>
                    <li class="flex gap-3"><span class="text-indigo-600 font-bold">✓</span> পিতা/মাতার প্রয়োজনীয় তথ্য</li>
                    <li class="flex gap-3"><span class="text-indigo-600 font-bold">✓</span> সচল মোবাইল নম্বর</li>
                </ul>
            </div>


        <div class="rounded-2xl border border-amber-200 bg-amber-50 p-6">
            <div class="w-11 h-11 rounded-xl bg-white border border-amber-200 flex items-center justify-center text-xl">
                ⚠️
            </div>
            <h2 class="mt-4 text-2xl font-bold text-amber-900">গুরুত্বপূর্ণ নির্দেশনা</h2>
            <ul class="mt-4 space-y-2.5 text-sm text-amber-800 leading-6">
                <li class="flex gap-3"><span>•</span> আবেদন করার আগে ভর্তি বিজ্ঞপ্তি ভালোভাবে পড়ুন।</li>
                <li class="flex gap-3"><span>•</span> সকল তথ্য সঠিকভাবে প্রদান করুন।</li>
                <li class="flex gap-3"><span>•</span> Application No. সংরক্ষণ করুন।</li>
                <li class="flex gap-3"><span>•</span> Application approved হওয়ার পর ভর্তি ফি প্রদান করুন।</li>
                <li class="flex gap-3"><span>•</span> Payment করার পর Transaction ID সংরক্ষণ করুন।</li>
            </ul>
        </div>
    </div>
</div>

</section>

{{-- ADMISSION FEES & PAYMENT METHODS --}}
<section class="py-12 sm:py-16 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mb-8">
            <span class="text-indigo-600 font-bold text-xs uppercase tracking-widest">Fees & Payment</span>
            <h2 class="mt-1 text-3xl font-bold text-slate-900">ভর্তি ফি ও পেমেন্ট মাধ্যম</h2>
            <p class="mt-2 text-slate-500 leading-6">
                অনলাইনে আবেদন সম্পন্ন করার পর নিচের ফি কাঠামো অনুযায়ী SSLCOMMERZ বা মোবাইল ব্যাংকিংয়ের মাধ্যমে ফি পরিশোধ করতে হবে।
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Fee Structure Table -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <h3 class="font-bold text-slate-900 text-lg mb-4 flex items-center gap-2">
                    <span>💵</span> নির্ধারিত ফি তালিকা
                </h3>
                @if(isset($fees) && $fees->count())
                    <div class="divide-y divide-slate-100">
                        @foreach($fees as $fee)
                            <div class="py-3 flex items-center justify-between gap-3">
                                <div>
                                    <p class="font-semibold text-slate-800 text-sm">{{ $fee->name }}</p>
                                    @if($fee->description)
                                        <p class="text-xs text-slate-500 mt-0.5">{{ $fee->description }}</p>
                                    @endif
                                </div>
                                <span class="font-bold text-slate-900">৳{{ number_format((float) $fee->amount, 2) }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-4 text-center text-slate-500 text-sm">
                        ভর্তি আবেদন ফি: <strong>৳500.00</strong>
                    </div>
                @endif
            </div>

            <!-- Payment Methods Channels -->
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <h3 class="font-bold text-slate-900 text-lg mb-4 flex items-center gap-2">
                    <span>💳</span> অনুমোদিত পেমেন্ট চ্যানেল
                </h3>
                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div class="p-3.5 rounded-xl border border-indigo-100 bg-indigo-50/60">
                        <strong class="text-indigo-900 block text-sm">SSLCOMMERZ</strong>
                        <span class="text-slate-500 mt-0.5 block">ভিসা, মাস্টারকার্ড, ইন্টারনেট ব্যাংকিং</span>
                    </div>
                    <div class="p-3.5 rounded-xl border border-pink-100 bg-pink-50/60">
                        <strong class="text-pink-900 block text-sm">বিকাশ (bKash)</strong>
                        <span class="text-slate-500 mt-0.5 block">Send Money / Payment</span>
                    </div>
                    <div class="p-3.5 rounded-xl border border-orange-100 bg-orange-50/60">
                        <strong class="text-orange-900 block text-sm">নগদ (Nagad)</strong>
                        <span class="text-slate-500 mt-0.5 block">Send Money / Payment</span>
                    </div>
                    <div class="p-3.5 rounded-xl border border-purple-100 bg-purple-50/60">
                        <strong class="text-purple-900 block text-sm">রকেট (Rocket)</strong>
                        <span class="text-slate-500 mt-0.5 block">ডাচ-বাংলা মোবাইল ব্যাংকিং</span>
                    </div>
                </div>

                <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-xs text-slate-500">আবেদন সম্পন্ন হলে ফি দিতে পারেন</span>
                    <a href="{{ route('admission-fee') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-indigo-600 hover:text-indigo-800">
                        ভর্তি ফি পোর্টালে যান →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}

<section class="py-12 sm:py-16 bg-slate-950">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center px-4 py-2 rounded-full bg-indigo-500/10 border border-indigo-400/10 text-indigo-200 text-sm font-semibold">
            🎓 Admission 2026
        </span>
        <h2 class="mt-4 text-3xl sm:text-4xl font-bold text-white">
            ভর্তি আবেদন শুরু করতে প্রস্তুত?
        </h2>
        <p class="mt-3 text-slate-300 leading-6 max-w-2xl mx-auto">
            আপনার সন্তানকে মেধা ও নৈতিকতার সমন্বয়ে গড়ে তুলতে আজই অনলাইনে আবেদন সম্পন্ন করুন।
        </p>
        <div class="mt-6 flex flex-wrap justify-center gap-3">
            <a href="{{ route('online-admission') }}" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-500 transition shadow-lg shadow-indigo-600/30">
                📝 অনলাইনে আবেদন করুন
            </a>
            <a href="{{ route('admission-fee') }}" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl bg-white text-slate-900 font-semibold hover:bg-slate-100 transition">
                💳 ভর্তি ফি পরিশোধ (Admission Fee)
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl bg-white/10 border border-white/10 text-white font-semibold hover:bg-white/15 transition">
                📞 যোগাযোগ
            </a>
        </div>
    </div>
</section>

@endsection
