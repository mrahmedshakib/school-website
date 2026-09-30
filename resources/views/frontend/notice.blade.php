@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Notices & Circulars | ' . ($websiteSetting->site_title ?? 'School') : 'নোটিশ বোর্ড | ' . ($websiteSetting->site_title ?? 'বিদ্যালয়'))

@section('content')
<section class="bg-gradient-to-b from-blue-50/50 via-slate-50 to-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb & Title --}}
        <div class="mb-8">
            <nav class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">{{ app()->getLocale() === 'en' ? 'Home' : 'হোম' }}</a>
                <span>/</span>
                <span class="text-blue-600">{{ app()->getLocale() === 'en' ? 'Notice Board' : 'নোটিশ' }}</span>
            </nav>
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                        🔔 {{ app()->getLocale() === 'en' ? 'Official Announcements' : 'জরুরি বিজ্ঞপ্তি ও আদেশ' }}
                    </span>
                    <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        {{ app()->getLocale() === 'en' ? 'School Notice Board' : 'বিদ্যালয়ের নোটিশ বোর্ড' }}
                    </h1>
                    <p class="mt-2 text-slate-600 max-w-2xl text-sm sm:text-base">
                        {{ app()->getLocale() === 'en' ? 'Find all official academic, exam and admission related announcements here.' : 'বিদ্যালয়ের প্রাতিষ্ঠানিক, একাডেমিক, পরীক্ষা ও ভর্তি সংক্রান্ত সকল নোটিশ এখানে প্রকাশিত হয়।' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Filter & Search Bar --}}
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm mb-8">
            <form method="GET" action="{{ route('notice') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        {{ app()->getLocale() === 'en' ? 'Category' : 'ক্যাটাগরি' }}
                    </label>
                    <select name="category" class="w-full text-sm rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 bg-slate-50 p-2.5">
                        <option value="">{{ app()->getLocale() === 'en' ? 'All Categories' : 'সকল ক্যাটাগরি' }}</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                        {{ app()->getLocale() === 'en' ? 'Search Keyword' : 'অনুসন্ধান' }}
                    </label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ app()->getLocale() === 'en' ? 'Search title or details...' : 'শিরোনাম বা বিবরণ...' }}" class="w-full text-sm rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500 bg-slate-50 p-2.5">
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-xl text-sm transition flex items-center justify-center gap-2 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        {{ app()->getLocale() === 'en' ? 'Filter' : 'ফিল্টার' }}
                    </button>
                    <a href="{{ route('notice') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium py-2.5 px-3 rounded-xl text-sm transition">
                        {{ app()->getLocale() === 'en' ? 'Reset' : 'রিসেট' }}
                    </a>
                </div>
            </form>
        </div>

        {{-- Notice List --}}
        @if($notices->count() > 0)
            <div class="space-y-4">
                @foreach($notices as $notice)
                    <div class="bg-white rounded-2xl border border-slate-200/90 p-6 hover:shadow-md transition duration-200">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                            <div class="flex items-start gap-4">
                                {{-- Date Badge --}}
                                <div class="shrink-0 w-14 h-14 rounded-2xl bg-blue-50 border border-blue-100 text-blue-700 flex flex-col items-center justify-center">
                                    <span class="text-xs font-bold uppercase">{{ $notice->notice_date ? \Carbon\Carbon::parse($notice->notice_date)->format('M') : 'NEW' }}</span>
                                    <span class="text-base font-black">{{ $notice->notice_date ? \Carbon\Carbon::parse($notice->notice_date)->format('d') : '📌' }}</span>
                                </div>

                                {{-- Title & Content --}}
                                <div>
                                    <div class="flex items-center gap-2 mb-1.5">
                                        @if($notice->category)
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                                {{ $notice->category }}
                                            </span>
                                        @endif
                                        <span class="text-xs text-slate-400">
                                            {{ $notice->notice_date ? \Carbon\Carbon::parse($notice->notice_date)->format('Y') : '' }}
                                        </span>
                                    </div>

                                    <h3 class="text-lg font-bold text-slate-900 mb-2">
                                        {{ $notice->title }}
                                    </h3>

                                    @if($notice->description)
                                        <p class="text-sm text-slate-600 leading-relaxed mb-3">
                                            {{ $notice->description }}
                                        </p>
                                    @endif
                                </div>
                            </div>

                            {{-- File Attachment --}}
                            @if($notice->file)
                                <div class="shrink-0 sm:self-center">
                                    <a href="{{ asset($notice->file) }}" target="_blank" download class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-blue-600 text-white text-xs font-semibold transition shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        {{ app()->getLocale() === 'en' ? 'Download Attachment' : 'সংযুক্তি ডাউনলোড' }}
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $notices->links() }}
            </div>
        @else
            <div class="bg-white rounded-2xl p-12 text-center border border-slate-200 shadow-sm">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-2xl text-slate-400 mb-4">
                    🔔
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1">
                    {{ app()->getLocale() === 'en' ? 'No notices found' : 'কোনো নোটিশ পাওয়া যায়নি' }}
                </h3>
                <p class="text-sm text-slate-500">
                    {{ app()->getLocale() === 'en' ? 'Please adjust your search criteria or check back later.' : 'অন্য ক্যাটাগরি বা কিওয়ার্ড দিয়ে চেষ্টা করুন।' }}
                </p>
            </div>
        @endif
    </div>
</section>
@endsection