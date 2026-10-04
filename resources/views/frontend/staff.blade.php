@extends('frontend.layouts.app')

@section('title', (app()->getLocale() === 'en' ? 'Employees & Staff | ' : 'কর্মচারীবৃন্দ | ') . ($websiteSetting->site_title ?? ($websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'বিদ্যালয়')))

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
            <span class="text-brand-300">{{ app()->getLocale() === 'en' ? 'Staff' : 'কর্মচারী' }}</span>
        </nav>

        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-800/60 border border-brand-700/60 text-brand-200 text-xs font-bold tracking-wide mb-4 shadow-sm">
            🤝 {{ app()->getLocale() === 'en' ? 'Administrative & Supporting Staff' : 'সহায়ক ও প্রশাসনিক কর্মকর্তা-কর্মচারী' }}
        </span>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white">
            {{ app()->getLocale() === 'en' ? 'Administrative & Support Staff' : 'আমাদের সম্মানিত কর্মচারীবৃন্দ' }}
        </h1>

        <p class="mt-4 text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
            {{ app()->getLocale() === 'en' ? 'Dedicated support team ensuring smooth campus operations, administrative services and student care.' : 'বিদ্যালয়ের সুষ্ঠু ব্যবস্থাপনা, অফিস পরিচালনা ও শিক্ষার্থীদের নিরাপত্তায় নিবেদিত কর্মচারীবৃন্দ।' }}
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
            <form method="GET" action="{{ route('staff') }}" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ app()->getLocale() === 'en' ? 'Search by name or designation...' : 'নাম বা পদবী দিয়ে খুঁজুন...' }}" class="w-full text-sm rounded-xl border-slate-300 focus:border-brand-500 focus:ring-brand-500 bg-slate-50/70 p-3 pl-10">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        🔍
                    </div>
                </div>
                <button type="submit" class="bg-brand-700 hover:bg-brand-800 text-white font-semibold py-3 px-6 rounded-xl text-sm transition flex items-center justify-center gap-2 shadow-sm">
                    {{ app()->getLocale() === 'en' ? 'Search' : 'অনুসন্ধান' }}
                </button>
                @if(request('search'))
                    <a href="{{ route('staff') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium py-3 px-4 rounded-xl text-sm transition flex items-center justify-center">
                        {{ app()->getLocale() === 'en' ? 'Reset' : 'রিসেট' }}
                    </a>
                @endif
            </form>
        </div>

        {{-- Staff Cards Grid --}}
        @if($staff->count() > 0)
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($staff as $member)
                    <div class="group bg-white rounded-3xl border border-slate-200/90 overflow-hidden shadow-sm hover:border-brand-300 hover:shadow-2xl transition-all duration-300 flex flex-col justify-between">
                        <div>
                            {{-- Image --}}
                            <div class="relative aspect-[3/4] bg-slate-100 overflow-hidden">
                                @if($member->image)
                                    <img src="{{ asset($member->image) }}" alt="{{ $member->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-gradient-to-b from-brand-50/50 to-slate-100">
                                        <svg class="h-20 w-20 text-brand-300" fill="none" stroke="currentColor" stroke-width="1.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 20.25a7.5 7.5 0 0115 0"/></svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Information --}}
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-brand-700 transition">
                                    {{ $member->name }}
                                </h3>

                                @if($member->designation)
                                    <p class="mt-1 text-xs font-bold text-brand-700">
                                        {{ $member->designation }}
                                    </p>
                                @endif

                                <div class="mt-4 pt-3 border-t border-slate-100 space-y-1.5 text-xs text-slate-600">
                                    @if($member->phone)
                                        <p class="flex items-center gap-2 truncate">
                                            <span class="text-brand-600">📞</span>
                                            <a href="tel:{{ $member->phone }}" class="hover:underline font-medium">{{ $member->phone }}</a>
                                        </p>
                                    @endif
                                    @if($member->email)
                                        <p class="flex items-center gap-2 truncate">
                                            <span class="text-brand-600">✉️</span>
                                            <a href="mailto:{{ $member->email }}" class="hover:underline truncate">{{ $member->email }}</a>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $staff->links() }}
            </div>
        @else
            <div class="bg-white rounded-3xl p-12 text-center border border-slate-200 shadow-sm max-w-xl mx-auto">
                <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center mx-auto text-3xl mb-4 text-brand-600">
                    🤝
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1">
                    {{ app()->getLocale() === 'en' ? 'No staff found' : 'কোনো কর্মচারী পাওয়া যায়নি' }}
                </h3>
                <p class="text-sm text-slate-500">
                    {{ app()->getLocale() === 'en' ? 'Try searching with a different keyword.' : 'অন্য নাম বা পদবী দিয়ে পুনরায় খুঁজুন।' }}
                </p>
            </div>
        @endif
    </div>
</section>
@endsection