@extends('frontend.layouts.app')

@section('title', 'নেতৃত্ব ও প্রশাসন - ' . ($websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'বিদ্যালয়'))

@section('meta_description')
{{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name }} এর পরিচালনা পর্ষদ, সভাপতি ও অধ্যক্ষ মহোদয়ের তথ্য ও বাণী।
@endsection

@section('content')

{{-- Header --}}
<section class="bg-slate-900 py-16 sm:py-20 text-white text-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <span class="inline-block px-4 py-1.5 rounded-full bg-white/10 text-emerald-400 text-sm font-semibold tracking-wide mb-4">
            আমাদের নেতৃত্ব
        </span>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">
            নেতৃত্ব ও পরিচালনা পর্ষদ
        </h1>
        <p class="mt-4 text-base sm:text-lg text-white/80 max-w-2xl mx-auto">
            সুযোগ্য নেতৃত্ব ও সার্বক্ষণিক দিকনির্দেশনায় আমাদের প্রতিষ্ঠান এগিয়ে চলেছে।
        </p>
    </div>
</section>

{{-- Leadership List --}}
<section class="py-16 sm:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        @forelse($administrations as $admin)

            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden p-6 sm:p-10 transition duration-300 hover:shadow-md">

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

                        <p class="mt-1 text-sm font-semibold text-blue-700">
                            {{ $admin->designation }}
                        </p>

                        @if($admin->phone || $admin->email)
                            <div class="mt-4 pt-4 border-t border-slate-100 text-xs text-slate-500 space-y-1">
                                @if($admin->phone)
                                    <p>☎ {{ $admin->phone }}</p>
                                @endif
                                @if($admin->email)
                                    <p class="break-all">✉ {{ $admin->email }}</p>
                                @endif
                            </div>
                        @endif

                    </div>

                    {{-- Message / Description --}}
                    <div class="md:col-span-8 lg:col-span-9">

                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-blue-50 text-blue-700 text-xs font-semibold uppercase tracking-wider mb-4">
                            বাণী ও বক্তব্য
                        </div>

                        <h3 class="text-2xl font-extrabold text-slate-900 mb-4">
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

            <div class="text-center py-16 bg-white rounded-2xl border border-slate-200">
                <p class="text-slate-500 text-lg">বর্তমানে কোনো তথ্য পাওয়া যায়নি।</p>
            </div>

        @endforelse

    </div>
</section>

@endsection
