@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Students & Demographics | ' . ($websiteSetting->site_title ?? 'School') : 'শিক্ষার্থী ও পরিসংখ্যান | ' . ($websiteSetting->site_title ?? 'বিদ্যালয়'))

@section('content')
<section class="bg-gradient-to-b from-blue-50/50 via-slate-50 to-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb & Title --}}
        <div class="mb-8">
            <nav class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">{{ app()->getLocale() === 'en' ? 'Home' : 'হোম' }}</a>
                <span>/</span>
                <span class="text-blue-600">{{ app()->getLocale() === 'en' ? 'Students' : 'শিক্ষার্থী' }}</span>
            </nav>
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-sky-100 text-sky-800">
                        👨‍🎓 {{ app()->getLocale() === 'en' ? 'Student Body & Strength' : 'শিক্ষার্থী তথ্য ও পরিসংখ্যান' }}
                    </span>
                    <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        {{ app()->getLocale() === 'en' ? 'Students Demographics & Campus Life' : 'আমাদের শিক্ষার্থী ও ক্যাম্পাস জীবন' }}
                    </h1>
                    <p class="mt-2 text-slate-600 max-w-2xl text-sm sm:text-base">
                        {{ app()->getLocale() === 'en' ? 'Overview of current student population, class-wise distribution, gender ratio, and student activities.' : 'বিদ্যালয়ের বর্তমান শিক্ষার্থীর সংখ্যা, শ্রেণিভিত্তিক পরিসংখ্যান, ছাত্র-ছাত্রী অনুপাত ও শিক্ষার্থী কার্যক্রম।' }}
                    </p>
                </div>
                <div>
                    <a href="{{ route('student-list') }}" class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm shadow-md hover:shadow-lg transition">
                        <span>📋</span>
                        <span>{{ app()->getLocale() === 'en' ? 'View Student Directory' : 'সম্পূর্ণ শিক্ষার্থী তালিকা' }}</span>
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Stat Summary Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-3xl text-blue-600">
                    👨‍🎓
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ app()->getLocale() === 'en' ? 'Total Students' : 'সর্বমোট শিক্ষার্থী' }}</span>
                    <h3 class="text-2xl font-black text-slate-900 mt-0.5">{{ $totalStudents }}</h3>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-sky-50 flex items-center justify-center text-3xl text-sky-600">
                    👦
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ app()->getLocale() === 'en' ? 'Male Students' : 'ছাত্র সংখ্যা' }}</span>
                    <h3 class="text-2xl font-black text-slate-900 mt-0.5">{{ $boysCount }}</h3>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-pink-50 flex items-center justify-center text-3xl text-pink-600">
                    👧
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ app()->getLocale() === 'en' ? 'Female Students' : 'ছাত্রী সংখ্যা' }}</span>
                    <h3 class="text-2xl font-black text-slate-900 mt-0.5">{{ $girlsCount }}</h3>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center text-3xl text-emerald-600">
                    🏫
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ app()->getLocale() === 'en' ? 'Total Classes' : 'মোট শ্রেণি' }}</span>
                    <h3 class="text-2xl font-black text-slate-900 mt-0.5">{{ $classStats->count() }}</h3>
                </div>
            </div>
        </div>

        {{-- Class-wise Statistics Table --}}
        <div class="bg-white rounded-2xl border border-slate-200/90 shadow-sm overflow-hidden mb-12">
            <div class="bg-gradient-to-r from-slate-900 to-blue-950 px-6 py-4 flex items-center justify-between">
                <h3 class="text-lg font-bold text-white tracking-wide flex items-center gap-2">
                    <span>📊</span>
                    <span>{{ app()->getLocale() === 'en' ? 'Class-wise Strength & Gender Ratio' : 'শ্রেণিভিত্তিক শিক্ষার্থীর সংখ্যা ও বিবরণ' }}</span>
                </h3>
                <span class="text-xs font-semibold px-3 py-1 rounded-full bg-white/20 text-white">
                    {{ app()->getLocale() === 'en' ? 'Academic Year: ' . date('Y') : 'শিক্ষাবর্ষ: ' . date('Y') }}
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-slate-50 text-xs font-bold text-slate-600 uppercase tracking-wider border-b border-slate-200">
                            <th class="py-3.5 px-6">{{ app()->getLocale() === 'en' ? 'Class' : 'শ্রেণি' }}</th>
                            <th class="py-3.5 px-6 text-center">{{ app()->getLocale() === 'en' ? 'Boys' : 'ছাত্র' }}</th>
                            <th class="py-3.5 px-6 text-center">{{ app()->getLocale() === 'en' ? 'Girls' : 'ছাত্রী' }}</th>
                            <th class="py-3.5 px-6 text-center">{{ app()->getLocale() === 'en' ? 'Total Students' : 'সর্বমোট শিক্ষার্থী' }}</th>
                            <th class="py-3.5 px-6 text-right">{{ app()->getLocale() === 'en' ? 'Action' : 'তালিকা' }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($classStats as $stat)
                            <tr class="hover:bg-blue-50/30 transition">
                                <td class="py-3.5 px-6 font-bold text-slate-900">
                                    {{ $stat->class }}
                                </td>
                                <td class="py-3.5 px-6 text-center text-sky-700 font-semibold">
                                    {{ $stat->boys }}
                                </td>
                                <td class="py-3.5 px-6 text-center text-pink-700 font-semibold">
                                    {{ $stat->girls }}
                                </td>
                                <td class="py-3.5 px-6 text-center font-extrabold text-slate-900">
                                    <span class="inline-block px-3 py-0.5 rounded-full bg-slate-100 text-slate-800">
                                        {{ $stat->total }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-6 text-right">
                                    <a href="{{ route('student-list', ['class' => $stat->class]) }}" class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 hover:text-blue-800 transition">
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
            <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-sm">
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

            <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-sm">
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-2xl mb-4">
                    🔬
                </div>
                <h4 class="text-base font-bold text-slate-900 mb-2">
                    {{ app()->getLocale() === 'en' ? 'Clubs & Societies' : 'ক্লাব ও সহশিক্ষা কার্যক্রম' }}
                </h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    {{ app()->getLocale() === 'en' ? 'Science Club, Debating Society, Language Club, Rover Scouts and Red Crescent allow students to cultivate diverse skills.' : 'বিজ্ঞান ক্লাব, বিতর্ক পরিষদ, ভাষা ক্লাব, রোভার স্কাউট ও রেড ক্রিসেন্ট সোসাইটি শিক্ষার্থীদের সৃজনশীল মেধা বিকাশে সহায়তা করে।' }}
                </p>
            </div>

            <div class="bg-white rounded-2xl p-6 border border-slate-200/90 shadow-sm">
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
