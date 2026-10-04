@extends('frontend.layouts.app')

@section('title', (app()->getLocale() === 'en' ? 'Students & Demographics | ' : 'শিক্ষার্থী ও পরিসংখ্যান | ') . ($websiteSetting->site_title ?? ($websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'বিদ্যালয়')))

@section('content')

{{-- =========================================================
    PAGE HEADER (HERO)
========================================================= --}}
<section class="relative overflow-hidden bg-gradient-to-br from-brand-950 via-brand-900 to-slate-950 py-16 sm:py-20 text-white text-center">
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col items-center z-10">
        {{-- Breadcrumb --}}
        <nav class="flex items-center justify-center gap-2 text-xs font-semibold uppercase tracking-wider text-slate-400 mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition">{{ app()->getLocale() === 'en' ? 'Home' : 'হোম' }}</a>
            <span>/</span>
            <span class="text-brand-300">{{ app()->getLocale() === 'en' ? 'Students' : 'শিক্ষার্থী' }}</span>
        </nav>

        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-800/60 border border-brand-700/60 text-brand-200 text-xs font-bold tracking-wide mb-4 shadow-sm">
            👨‍🎓 {{ app()->getLocale() === 'en' ? 'Student Body & Strength' : 'শিক্ষার্থী তথ্য ও পরিসংখ্যান' }}
        </span>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white">
            {{ app()->getLocale() === 'en' ? 'Students Demographics & Campus Life' : 'আমাদের শিক্ষার্থী ও ক্যাম্পাস জীবন' }}
        </h1>

        <p class="mt-4 text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
            {{ app()->getLocale() === 'en' ? 'Overview of current student population, class-wise distribution, gender ratio, and student activities.' : 'বিদ্যালয়ের বর্তমান শিক্ষার্থীর সংখ্যা, শ্রেণিভিত্তিক পরিসংখ্যান, ছাত্র-ছাত্রী অনুপাত ও শিক্ষার্থী কার্যক্রম।' }}
        </p>

        <div class="mt-6 flex flex-wrap items-center justify-center gap-4">
            <a href="{{ route('student-list') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-accent-500 hover:bg-accent-600 text-slate-950 font-black text-sm shadow-lg hover:shadow-accent-500/30 transition transform hover:-translate-y-0.5">
                <span>📋</span>
                <span>{{ app()->getLocale() === 'en' ? 'View Student Directory' : 'সম্পূর্ণ শিক্ষার্থী তালিকা' }}</span>
                <span>→</span>
            </a>
        </div>
    </div>
</section>

{{-- =========================================================
    MAIN CONTENT
========================================================= --}}
<section class="py-12 sm:py-16 bg-slate-50 min-h-[60vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Stat Summary Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm hover:shadow-md transition flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-brand-50 flex items-center justify-center text-3xl text-brand-700 shadow-xs">
                    👨‍🎓
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ app()->getLocale() === 'en' ? 'Total Students' : 'সর্বমোট শিক্ষার্থী' }}</span>
                    <h3 class="text-3xl font-black text-slate-900 mt-0.5">{{ $totalStudents }}</h3>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm hover:shadow-md transition flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-sky-50 flex items-center justify-center text-3xl text-sky-600 shadow-xs">
                    👦
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ app()->getLocale() === 'en' ? 'Male Students' : 'ছাত্র সংখ্যা' }}</span>
                    <h3 class="text-3xl font-black text-slate-900 mt-0.5">{{ $boysCount }}</h3>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm hover:shadow-md transition flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-rose-50 flex items-center justify-center text-3xl text-rose-600 shadow-xs">
                    👧
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ app()->getLocale() === 'en' ? 'Female Students' : 'ছাত্রী সংখ্যা' }}</span>
                    <h3 class="text-3xl font-black text-slate-900 mt-0.5">{{ $girlsCount }}</h3>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm hover:shadow-md transition flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center text-3xl text-emerald-600 shadow-xs">
                    🏫
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ app()->getLocale() === 'en' ? 'Total Classes' : 'মোট শ্রেণি' }}</span>
                    <h3 class="text-3xl font-black text-slate-900 mt-0.5">{{ $classStats->count() }}</h3>
                </div>
            </div>
        </div>

        {{-- Class-wise Statistics Table --}}
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden mb-12">
            <div class="bg-gradient-to-r from-brand-950 to-brand-850 px-6 py-4 flex items-center justify-between">
                <h3 class="text-lg font-bold text-white tracking-wide flex items-center gap-2">
                    <span>📊</span>
                    <span>{{ app()->getLocale() === 'en' ? 'Class-wise Strength & Gender Ratio' : 'শ্রেণিভিত্তিক শিক্ষার্থীর সংখ্যা ও বিবরণ' }}</span>
                </h3>
                <span class="text-xs font-semibold px-3 py-1 rounded-full bg-white/15 text-white backdrop-blur-sm border border-white/10">
                    {{ app()->getLocale() === 'en' ? 'Academic Year: ' . date('Y') : 'শিক্ষাবর্ষ: ' . date('Y') }}
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50 text-xs font-bold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                            <th class="py-4 px-6">{{ app()->getLocale() === 'en' ? 'Class' : 'শ্রেণি' }}</th>
                            <th class="py-4 px-6 text-center">{{ app()->getLocale() === 'en' ? 'Boys' : 'ছাত্র' }}</th>
                            <th class="py-4 px-6 text-center">{{ app()->getLocale() === 'en' ? 'Girls' : 'ছাত্রী' }}</th>
                            <th class="py-4 px-6 text-center">{{ app()->getLocale() === 'en' ? 'Total Students' : 'সর্বমোট শিক্ষার্থী' }}</th>
                            <th class="py-4 px-6 text-right">{{ app()->getLocale() === 'en' ? 'Action' : 'তালিকা' }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($classStats as $stat)
                            <tr class="hover:bg-brand-50/30 transition">
                                <td class="py-4 px-6 font-bold text-slate-900">
                                    {{ $stat->class }}
                                </td>
                                <td class="py-4 px-6 text-center text-sky-700 font-semibold">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-sky-50 text-sky-800 text-xs font-bold border border-sky-100">
                                        👦 {{ $stat->boys }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center text-rose-700 font-semibold">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full bg-rose-50 text-rose-800 text-xs font-bold border border-rose-100">
                                        👧 {{ $stat->girls }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center font-extrabold text-slate-900">
                                    <span class="inline-block px-3 py-1 rounded-full bg-slate-100 text-slate-900 font-black">
                                        {{ $stat->total }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right">
                                    <a href="{{ route('student-list', ['class' => $stat->class]) }}" class="inline-flex items-center gap-1 text-xs font-bold text-brand-700 hover:text-brand-900 transition">
                                        <span>{{ app()->getLocale() === 'en' ? 'View List' : 'তালিকা দেখুন' }}</span>
                                        <span>→</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-400">
                                    {{ app()->getLocale() === 'en' ? 'No statistics available' : 'তথ্য পাওয়া যায়নি' }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Student Clubs & Facilities Section --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-2xl mb-4">
                    🏅
                </div>
                <h4 class="text-base font-bold text-slate-900 mb-2">
                    {{ app()->getLocale() === 'en' ? 'House System' : 'হাউস পদ্ধতি' }}
                </h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    {{ app()->getLocale() === 'en' ? 'Students are divided into houses for competitive sports, debates, science fairs and cultural activities fostering leadership and teamwork.' : 'শিক্ষার্থীদের নেতৃত্ব, শৃঙ্খলা ও সহমর্মিতা বিকাশে বিভিন্ন হাউসে বিভক্ত করে বার্ষিক ক্রীড়া, বিতর্ক ও সাংস্কৃতিক প্রতিযোগিতা পরিচালিত হয়।' }}
                </p>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 rounded-xl bg-brand-50 text-brand-700 flex items-center justify-center text-2xl mb-4">
                    🔬
                </div>
                <h4 class="text-base font-bold text-slate-900 mb-2">
                    {{ app()->getLocale() === 'en' ? 'Clubs & Societies' : 'ক্লাব ও সহশিক্ষা কার্যক্রম' }}
                </h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    {{ app()->getLocale() === 'en' ? 'Science Club, Debating Society, Language Club, Rover Scouts and Red Crescent allow students to cultivate diverse skills.' : 'বিজ্ঞান ক্লাব, বিতর্ক পরিষদ, ভাষা ক্লাব, রোভার স্কাউট ও রেড ক্রিসেন্ট সোসাইটি শিক্ষার্থীদের সৃজনশীল মেধা বিকাশে সহায়তা করে।' }}
                </p>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl mb-4">
                    👔
                </div>
                <h4 class="text-base font-bold text-slate-900 mb-2">
                    {{ app()->getLocale() === 'en' ? 'Uniform & Code of Conduct' : 'পোশাক ও আচরণবিধি' }}
                </h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    {{ app()->getLocale() === 'en' ? 'Strict compliance with prescribed school uniform, badge, ID card and high ethical discipline is maintained on campus.' : 'বিদ্যালয়ের নির্ধারিত ড্রেসকোড, নির্ধারিত ব্যাজ, আইডি কার্ড পরিধান এবং নৈতিক আচরণবিধি যথাযথভাবে মেনে চলা বাধ্যতামূলক।' }}
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
