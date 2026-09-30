@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'en' ? 'School Publications | ' . ($websiteSetting->site_title ?? 'School') : 'প্রকাশনাসমূহ | ' . ($websiteSetting->site_title ?? 'বিদ্যালয়'))

@section('content')
<section class="bg-gradient-to-b from-blue-50/50 via-slate-50 to-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb & Title --}}
        <div class="mb-8">
            <nav class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">{{ app()->getLocale() === 'en' ? 'Home' : 'হোম' }}</a>
                <span>/</span>
                <span class="text-blue-600">{{ app()->getLocale() === 'en' ? 'Publications' : 'প্রকাশনা' }}</span>
            </nav>
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-teal-100 text-teal-800">
                        📑 {{ app()->getLocale() === 'en' ? 'Academic & Institutional Publications' : 'প্রাতিষ্ঠানিক ও শিক্ষামূলক প্রকাশনা' }}
                    </span>
                    <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        {{ app()->getLocale() === 'en' ? 'Official Publications & Newsletters' : 'বার্ষিক প্রতিবেদন ও নিয়মিত প্রকাশনা' }}
                    </h1>
                    <p class="mt-2 text-slate-600 max-w-2xl text-sm sm:text-base">
                        {{ app()->getLocale() === 'en' ? 'Access annual academic reports, research bulletins, wall magazines and official newsletters.' : 'বিদ্যালয়ের বার্ষিক একাডেমিক প্রতিবেদন, দেয়াল পত্রিকা, স্মরণিকা এবং নিউজলেটারসমূহ পিডিএফ ফরম্যাটে পড়ুন ও ডাউনলোড করুন।' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Publications Grid --}}
        @if($publications->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($publications as $item)
                    <div class="group bg-white rounded-3xl overflow-hidden border border-slate-200/90 hover:border-teal-300 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                        <div>
                            {{-- Cover Image --}}
                            <div class="relative aspect-[4/3] bg-slate-100 overflow-hidden">
                                @if($item->cover_image)
                                    <img src="{{ asset($item->cover_image) }}" alt="Cover" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-teal-50 to-blue-50 text-teal-500">
                                        <span class="text-5xl mb-2">📑</span>
                                        <span class="text-xs font-semibold">{{ app()->getLocale() === 'en' ? 'Institutional Publication' : 'বিদ্যালয় প্রকাশনা' }}</span>
                                    </div>
                                @endif
                                <div class="absolute top-3 right-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-black/60 text-white backdrop-blur-md">
                                        {{ $item->publish_date ? $item->publish_date->format('Y') : date('Y') }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-teal-600 transition mb-2">
                                    {{ $item->title }}
                                </h3>

                                @if($item->description)
                                    <p class="text-xs text-slate-500 leading-relaxed line-clamp-3 mb-4">
                                        {{ $item->description }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="p-6 pt-0 border-t border-slate-100 flex items-center justify-between gap-3 mt-auto">
                            <span class="text-xs text-slate-400">
                                {{ $item->publish_date ? $item->publish_date->format('d M, Y') : '' }}
                            </span>
                            @if($item->file_path)
                                <a href="{{ asset($item->file_path) }}" target="_blank" download class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-teal-600 hover:bg-teal-700 text-white text-xs font-semibold transition shadow-sm">
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

            <div class="mt-8">
                {{ $publications->links() }}
            </div>
        @else
            <div class="bg-white rounded-2xl p-12 text-center border border-slate-200 shadow-sm">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-2xl text-slate-400 mb-4">
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
