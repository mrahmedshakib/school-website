@extends('frontend.layouts.app')

@section('title', (app()->getLocale() === 'en' ? 'Faculty & Teachers | ' : 'শিক্ষকবৃন্দ | ') . ($websiteSetting->site_title ?? ($websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'বিদ্যালয়')))

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
            <span class="text-brand-300">{{ app()->getLocale() === 'en' ? 'Teachers' : 'শিক্ষকবৃন্দ' }}</span>
        </nav>

        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-800/60 border border-brand-700/60 text-brand-200 text-xs font-bold tracking-wide mb-4 shadow-sm">
            👩‍🏫 {{ app()->getLocale() === 'en' ? 'Our Respected Faculty' : 'শ্রদ্ধেয় শিক্ষক-শিক্ষিকাবৃন্দ' }}
        </span>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white">
            {{ app()->getLocale() === 'en' ? 'Our Honorable Teachers' : 'আমাদের সম্মানিত শিক্ষকবৃন্দ' }}
        </h1>

        <p class="mt-4 text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
            {{ app()->getLocale() === 'en' ? 'Dedicated educators committed to academic excellence, leadership and holistic student development.' : 'শিক্ষার্থীদের জ্ঞান ও নৈতিক উৎকর্ষ সাধনে আমাদের অভিজ্ঞ, নিবেদিত ও দায়িত্ববান শিক্ষক মণ্ডলী।' }}
        </p>
    </div>
</section>

{{-- =========================================================
    MAIN CONTENT
========================================================= --}}
<section class="py-12 sm:py-16 bg-slate-50 min-h-[60vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Search Filter --}}
        <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-200/80 shadow-sm mb-10 max-w-2xl mx-auto">
            <form method="GET" action="{{ route('teachers') }}" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ app()->getLocale() === 'en' ? 'Search by name, subject, or designation...' : 'নাম, বিষয় বা পদবী দিয়ে খুঁজুন...' }}" class="w-full text-sm rounded-xl border-slate-300 focus:border-brand-500 focus:ring-brand-500 bg-slate-50/70 p-3 pl-10">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        🔍
                    </div>
                </div>
                <button type="submit" class="bg-brand-700 hover:bg-brand-800 text-white font-semibold py-3 px-6 rounded-xl text-sm transition flex items-center justify-center gap-2 shadow-sm">
                    {{ app()->getLocale() === 'en' ? 'Search' : 'অনুসন্ধান' }}
                </button>
                @if(request('search'))
                    <a href="{{ route('teachers') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium py-3 px-4 rounded-xl text-sm transition flex items-center justify-center">
                        {{ app()->getLocale() === 'en' ? 'Reset' : 'রিসেট' }}
                    </a>
                @endif
            </form>
        </div>

        {{-- Teacher Cards Grid --}}
        @if($teachers->count() > 0)
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($teachers as $teacher)
                    <div class="group bg-white rounded-3xl border border-slate-200/90 overflow-hidden shadow-sm hover:border-brand-300 hover:shadow-2xl transition-all duration-300 flex flex-col justify-between">
                        <div>
                            {{-- Image --}}
                            <div class="relative aspect-[3/4] bg-slate-100 overflow-hidden">
                                @if($teacher->image)
                                    <img src="{{ asset($teacher->image) }}" alt="{{ $teacher->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-gradient-to-b from-brand-50/50 to-slate-100">
                                        <svg class="h-20 w-20 text-brand-300" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 20.25a7.5 7.5 0 0115 0"/></svg>
                                    </div>
                                @endif
                                @if($teacher->subject)
                                    <div class="absolute bottom-3 left-3 right-3">
                                        <span class="inline-block w-full text-center px-3 py-1.5 rounded-xl text-xs font-bold bg-brand-950/80 text-white backdrop-blur-md truncate shadow-sm">
                                            {{ $teacher->subject }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            {{-- Information --}}
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-brand-700 transition">
                                    {{ $teacher->name }}
                                </h3>

                                @if($teacher->designation)
                                    <p class="mt-1 text-xs font-bold text-brand-700">
                                        {{ $teacher->designation }}
                                    </p>
                                @endif

                                @if($teacher->qualification)
                                    <p class="mt-2 text-xs text-slate-500 italic">
                                        {{ $teacher->qualification }}
                                    </p>
                                @endif

                                <div class="mt-4 pt-3 border-t border-slate-100 space-y-1.5 text-xs text-slate-600">
                                    @if($teacher->phone)
                                        <p class="flex items-center gap-2 truncate">
                                            <span class="text-brand-600">📞</span>
                                            <a href="tel:{{ $teacher->phone }}" class="hover:underline font-medium">{{ $teacher->phone }}</a>
                                        </p>
                                    @endif
                                    @if($teacher->email)
                                        <p class="flex items-center gap-2 truncate">
                                            <span class="text-brand-600">✉️</span>
                                            <a href="mailto:{{ $teacher->email }}" class="hover:underline truncate">{{ $teacher->email }}</a>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $teachers->links() }}
            </div>
        @else
            <div class="bg-white rounded-3xl p-12 text-center border border-slate-200 shadow-sm max-w-xl mx-auto">
                <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center mx-auto text-3xl mb-4 text-brand-600">
                    👩‍🏫
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1">
                    {{ app()->getLocale() === 'en' ? 'No teachers found' : 'কোনো শিক্ষক পাওয়া যায়নি' }}
                </h3>
                <p class="text-sm text-slate-500">
                    {{ app()->getLocale() === 'en' ? 'Try searching with a different term.' : 'অন্য নাম বা বিষয় দিয়ে পুনরায় খুঁজুন।' }}
                </p>
            </div>
        @endif
    </div>
</section>
@endsection