@extends('frontend.layouts.app')

@section('title', (app()->getLocale() === 'en' ? 'School Publications | ' : 'প্রকাশনাসমূহ | ') . ($websiteSetting->site_title ?? ($websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'বিদ্যালয়')))

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
            <span class="text-brand-300">{{ app()->getLocale() === 'en' ? 'Publications' : 'প্রকাশনা' }}</span>
        </nav>

        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-800/60 border border-brand-700/60 text-brand-200 text-xs font-bold tracking-wide mb-4 shadow-sm">
            📑 {{ app()->getLocale() === 'en' ? 'Academic & Institutional Publications' : 'প্রাতিষ্ঠানিক ও শিক্ষামূলক প্রকাশনা' }}
        </span>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white">
            {{ app()->getLocale() === 'en' ? 'Official Publications & Newsletters' : 'বার্ষিক প্রতিবেদন ও নিয়মিত প্রকাশনা' }}
        </h1>

        <p class="mt-4 text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
            {{ app()->getLocale() === 'en' ? 'Access annual academic reports, research bulletins, wall magazines and official newsletters.' : 'বিদ্যালয়ের বার্ষিক একাডেমিক প্রতিবেদন, দেয়াল পত্রিকা, স্মরণিকা এবং নিউজলেটারসমূহ পিডিএফ ফরম্যাটে পড়ুন ও ডাউনলোড করুন।' }}
        </p>
    </div>
</section>

{{-- =========================================================
    MAIN CONTENT
========================================================= --}}
<section class="py-12 sm:py-16 bg-slate-50 min-h-[60vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Publications Grid --}}
        @if($publications->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($publications as $item)
                    <div class="group bg-white rounded-3xl overflow-hidden border border-slate-200/90 hover:border-brand-300 hover:shadow-2xl transition-all duration-300 flex flex-col justify-between">
                        <div>
                            {{-- Cover Image --}}
                            <div class="relative aspect-[4/3] bg-slate-100 overflow-hidden">
                                @if($item->cover_image)
                                    <img src="{{ asset($item->cover_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-brand-50 to-slate-100 text-brand-600">
                                        <span class="text-5xl mb-2">📑</span>
                                        <span class="text-xs font-bold uppercase tracking-wider text-brand-700">{{ app()->getLocale() === 'en' ? 'Institutional Publication' : 'বিদ্যালয় প্রকাশনা' }}</span>
                                    </div>
                                @endif
                                <div class="absolute top-4 right-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-brand-950/80 text-white backdrop-blur-md shadow-sm">
                                        {{ $item->publish_date ? \Carbon\Carbon::parse($item->publish_date)->format('Y') : date('Y') }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3 class="text-xl font-bold text-slate-900 group-hover:text-brand-700 transition mb-3">
                                    {{ $item->title }}
                                </h3>

                                @if($item->description)
                                    <p class="text-xs text-slate-600 leading-relaxed line-clamp-3 mb-4">
                                        {{ $item->description }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="p-6 pt-4 border-t border-slate-100 flex items-center justify-between gap-3 mt-auto">
                            <span class="text-xs text-slate-400">
                                {{ $item->publish_date ? \Carbon\Carbon::parse($item->publish_date)->format('d M, Y') : '' }}
                            </span>
                            @if($item->file_path)
                                <a href="{{ asset($item->file_path) }}" target="_blank" download class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-700 hover:bg-brand-800 text-white text-xs font-bold transition shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    {{ app()->getLocale() === 'en' ? 'Download PDF' : 'ডাউনলোড পিডিএফ' }}
                                </a>
                            @else
                                <span class="text-xs font-medium text-slate-400 italic">
                                    {{ app()->getLocale() === 'en' ? 'Digital copy pending' : 'ডিজিটাল কপি অপেক্ষমান' }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $publications->links() }}
            </div>
        @else
            <div class="bg-white rounded-3xl p-12 text-center border border-slate-200 shadow-sm max-w-xl mx-auto">
                <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center mx-auto text-3xl mb-4 text-brand-600">
                    📑
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1">
                    {{ app()->getLocale() === 'en' ? 'No publications found' : 'এখনো কোনো প্রকাশনা আপলোড করা হয়নি' }}
                </h3>
                <p class="text-sm text-slate-500">
                    {{ app()->getLocale() === 'en' ? 'New annual reports and publications will be available soon.' : 'নতুন প্রকাশনা খুব শীঘ্রই এখানে আপলোড করা হবে।' }}
                </p>
            </div>
        @endif
    </div>
</section>
@endsection
