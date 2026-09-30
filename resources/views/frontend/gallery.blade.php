@extends('frontend.layouts.app')

@section('title', 'ফটো গ্যালারি')

@section('meta_description')
বিদ্যালয়ের বিভিন্ন কার্যক্রম, অনুষ্ঠান ও বিশেষ মুহূর্তের ছবি দেখুন।
@endsection

@section('content')
<section class="py-16 sm:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <span class="text-blue-700 font-semibold">
                আমাদের কার্যক্রম
            </span>
            <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold text-slate-900">
                ফটো গ্যালারি
            </h1>
            <p class="mt-4 text-slate-500 max-w-2xl mx-auto">
                বিদ্যালয়ের বিভিন্ন অনুষ্ঠান, কার্যক্রম ও স্মরণীয় মুহূর্তের ছবি।
            </p>
        </div>

        @if($galleries->count())
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                @foreach($galleries as $gallery)
                    <div class="group overflow-hidden rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-md transition">
                        <a href="{{ asset($gallery->image) }}" target="_blank" class="block overflow-hidden">
                            @if($gallery->image)
                                <img
                                    src="{{ asset($gallery->image) }}"
                                    alt="{{ $gallery->title ?? 'Gallery Image' }}"
                                    class="w-full h-52 sm:h-60 object-cover group-hover:scale-105 transition duration-500"
                                >
                            @else
                                <div class="w-full h-52 sm:h-60 bg-slate-100 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4-4a3 3 0 014 0l4 4m-2-2l1-1a3 3 0 014 0l1 1M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2zm4-9h.01"/>
                                    </svg>
                                </div>
                            @endif
                        </a>

                        @if($gallery->title || $gallery->description)
                            <div class="p-4">
                                @if($gallery->title)
                                    <h2 class="font-bold text-slate-900">
                                        {{ $gallery->title }}
                                    </h2>
                                @endif

                                @if($gallery->description)
                                    <p class="mt-1 text-sm text-slate-500">
                                        {{ $gallery->description }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-2xl border border-slate-200 py-16 text-center">
                <svg class="w-16 h-16 mx-auto text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4-4a3 3 0 014 0l4 4m-2-2l1-1a3 3 0 014 0l1 1M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2zm4-9h.01"/>
                </svg>
                <h2 class="mt-4 text-xl font-bold text-slate-900">
                    কোনো ছবি পাওয়া যায়নি
                </h2>
                <p class="mt-2 text-slate-500">
                    বর্তমানে গ্যালারিতে কোনো ছবি প্রকাশিত হয়নি।
                </p>
            </div>
        @endif
    </div>
</section>
@endsection