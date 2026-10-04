@extends('frontend.layouts.app')

@section('title', 'নেতৃত্ব ও প্রশাসন - ' . ($websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'বিদ্যালয়'))

@section('meta_description')
{{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name }} এর পরিচালনা পর্ষদ, সভাপতি ও অধ্যক্ষ মহোদয়ের তথ্য ও বাণী।
@endsection

@section('content')

{{-- Header --}}
<section class="relative overflow-hidden bg-gradient-to-br from-brand-950 via-brand-900 to-slate-950 py-16 sm:py-20 text-white text-center">
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 flex flex-col items-center z-10">
        {{-- Breadcrumb --}}
        <nav class="flex items-center justify-center gap-2 text-xs font-semibold uppercase tracking-wider text-slate-400 mb-4">
            <a href="{{ route('home') }}" class="hover:text-white transition">{{ app()->getLocale() === 'en' ? 'Home' : 'হোম' }}</a>
            <span>/</span>
            <span class="text-brand-300">{{ app()->getLocale() === 'en' ? 'Leadership' : 'নেতৃত্ব ও প্রশাসন' }}</span>
        </nav>

        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand-800/60 border border-brand-700/60 text-brand-200 text-xs font-bold tracking-wide mb-4 shadow-sm">
            🏛️ আমাদের নেতৃত্ব
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-white">
            নেতৃত্ব ও পরিচালনা পর্ষদ
        </h1>
        <p class="mt-4 text-base sm:text-lg text-slate-300 max-w-2xl mx-auto">
            সুযোগ্য নেতৃত্ব ও সার্বক্ষণিক দিকনির্দেশনায় আমাদের প্রতিষ্ঠান এগিয়ে চলেছে।
        </p>
    </div>
</section>

{{-- Leadership List --}}
<section class="py-12 sm:py-16 bg-slate-50 min-h-[60vh]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        @forelse($administrations as $admin)

            <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden p-6 sm:p-10 transition duration-300 hover:shadow-xl hover:border-brand-300">

                <div class="grid md:grid-cols-12 gap-8 items-start">

                    {{-- Image & Contact --}}
                    <div class="md:col-span-4 lg:col-span-3 text-center">

                        <div class="w-48 h-56 mx-auto rounded-2xl overflow-hidden bg-slate-100 border-2 border-slate-200 shadow-inner">
                            @if($admin->image)
                                <img
                                    src="{{ asset($admin->image) }}"
                                    alt="{{ $admin->name }}"
                                    class="w-full h-full object-cover object-top"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center text-6xl text-slate-300">
                                    👤
                                </div>
                            @endif
                        </div>

                        <h2 class="mt-4 text-xl font-bold text-slate-900">
                            {{ $admin->name }}
                        </h2>

                        <p class="mt-1 text-sm font-bold text-brand-700">
                            {{ $admin->designation }}
                        </p>

                        @if($admin->phone || $admin->email)
                            <div class="mt-4 pt-4 border-t border-slate-100 text-xs text-slate-600 space-y-1.5">
                                @if($admin->phone)
                                    <p class="flex items-center justify-center gap-1.5">
                                        <span class="text-brand-600">📞</span>
                                        <a href="tel:{{ $admin->phone }}" class="hover:underline font-medium">{{ $admin->phone }}</a>
                                    </p>
                                @endif
                                @if($admin->email)
                                    <p class="flex items-center justify-center gap-1.5">
                                        <span class="text-brand-600">✉️</span>
                                        <a href="mailto:{{ $admin->email }}" class="hover:underline truncate">{{ $admin->email }}</a>
                                    </p>
                                @endif
                            </div>
                        @endif

                    </div>

                    {{-- Message / Description --}}
                    <div class="md:col-span-8 lg:col-span-9">

                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-brand-50 text-brand-700 border border-brand-100 text-xs font-semibold uppercase tracking-wider mb-4">
                            বাণী ও বক্তব্য
                        </div>

                        <h3 class="text-2xl font-black text-slate-900 mb-4">
                            {{ $admin->designation }} মহোদয়ের বাণী
                        </h3>

                        @if($admin->description)
                            <div class="text-slate-600 leading-8 text-base space-y-4 text-justify">
                                {!! nl2br(e($admin->description)) !!}
                            </div>
                        @else
                            <p class="text-slate-400 italic">
                                বাণী শীঘ্রই যুক্ত করা হবে।
                            </p>
                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="text-center py-16 bg-white rounded-3xl border border-slate-200 max-w-xl mx-auto shadow-sm">
                <div class="w-16 h-16 bg-brand-50 rounded-2xl flex items-center justify-center mx-auto text-3xl mb-4 text-brand-600">
                    🏛️
                </div>
                <p class="text-slate-600 text-base font-semibold">বর্তমানে কোনো তথ্য পাওয়া যায়নি।</p>
            </div>

        @endforelse

    </div>
</section>

@endsection
