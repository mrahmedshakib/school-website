@extends('frontend.layouts.app')

@section('title', 'ভর্তি তথ্য')

@section('meta_description')
বিদ্যালয়ের ভর্তি সংক্রান্ত তথ্য, সময়সূচি ও আবেদন প্রক্রিয়া সম্পর্কে বিস্তারিত জানুন।
@endsection

@section('content')
<section class="py-16 sm:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <span class="text-blue-700 font-semibold">
                ভর্তি কার্যক্রম
            </span>
            <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold text-slate-900">
                ভর্তি সংক্রান্ত তথ্য
            </h1>
            <p class="mt-4 text-slate-500 max-w-2xl mx-auto">
                বিদ্যালয়ে ভর্তি সংক্রান্ত সর্বশেষ তথ্য ও আবেদন প্রক্রিয়া।
            </p>
        </div>

        @if($admissions->count())
            <div class="space-y-6">
                @foreach($admissions as $admission)
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                        <div class="grid lg:grid-cols-3">
                            @if($admission->image)
                                <div class="lg:col-span-1">
                                    <img
                                        src="{{ asset($admission->image) }}"
                                        alt="{{ $admission->title }}"
                                        class="w-full h-64 lg:h-full object-cover"
                                    >
                                </div>
                            @endif

                            <div class="{{ $admission->image ? 'lg:col-span-2' : 'lg:col-span-3' }} p-6 sm:p-8">
                                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">
                                    {{ $admission->title }}
                                </h2>

                                @if($admission->description)
                                    <div class="mt-5 text-slate-600 leading-7">
                                        {!! nl2br(e($admission->description)) !!}
                                    </div>
                                @endif

                                <div class="grid sm:grid-cols-2 gap-4 mt-6">
                                    @if($admission->application_start)
                                        <div class="bg-slate-50 rounded-xl p-4">
                                            <p class="text-sm text-slate-500">
                                                আবেদন শুরু
                                            </p>
                                            <p class="mt-1 font-semibold text-slate-900">
                                                {{ $admission->application_start->format('d M Y') }}
                                            </p>
                                        </div>
                                    @endif

                                    @if($admission->application_end)
                                        <div class="bg-slate-50 rounded-xl p-4">
                                            <p class="text-sm text-slate-500">
                                                আবেদন শেষ
                                            </p>
                                            <p class="mt-1 font-semibold text-slate-900">
                                                {{ $admission->application_end->format('d M Y') }}
                                            </p>
                                        </div>
                                    @endif
                                </div>

                                <div class="flex flex-wrap gap-3 mt-7">
                                    @if($admission->application_url)
                                        <a href="{{ $admission->application_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer">
                                            📝 আবেদন করুন
                                        </a>
                                    @endif

                                    <a href="{{ route('contact') }}">
                                        📞 যোগাযোগ করুন
                                    </a>

                                    @if($admission->pdf)
                                        <a href="{{ asset($admission->pdf) }}"
                                        target="_blank"
                                        rel="noopener noreferrer">
                                            📄 PDF দেখুন
                                        </a>

                                        <a href="{{ asset($admission->pdf) }}" download>
                                            ⬇ Download
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-2xl border border-slate-200 py-16 text-center">
                <svg class="w-16 h-16 mx-auto text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h2 class="mt-4 text-xl font-bold text-slate-900">
                    বর্তমানে কোনো ভর্তি বিজ্ঞপ্তি নেই
                </h2>
                <p class="mt-2 text-slate-500">
                    ভর্তি সংক্রান্ত নতুন তথ্য প্রকাশিত হলে এখানে দেখা যাবে।
                </p>
            </div>
        @endif
    </div>
</section>
@endsection