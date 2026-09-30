@extends('backend.layouts.app')
@section('title', 'Coming Soon')
@section('content')

<section class="min-h-[80vh] bg-white flex items-center justify-center overflow-hidden relative">

    {{-- Background Decoration --}}
    <div class="absolute -top-32 -right-32 w-80 h-80 bg-blue-100 rounded-full blur-3xl opacity-60"></div>
    <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-indigo-100 rounded-full blur-3xl opacity-60"></div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center py-20">

        {{-- Icon --}}
        <div class="mx-auto mb-8 w-20 h-20 rounded-2xl bg-blue-50
                    flex items-center justify-center
                    border border-blue-100 shadow-sm">

            <svg class="w-10 h-10 text-blue-600"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.8"
                      d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"/>

            </svg>
        </div>

        {{-- Badge --}}
        <span class="inline-flex items-center gap-2
                     px-4 py-2 rounded-full
                     bg-blue-50 text-blue-700
                     text-sm font-semibold
                     border border-blue-100">

            <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>

            Something New Is Coming
        </span>

        {{-- Heading --}}
        <h1 class="mt-7 text-4xl sm:text-5xl lg:text-6xl
                   font-extrabold tracking-tight text-slate-900">

            Coming
            <span class="text-blue-600">Soon</span>
        </h1>

        {{-- Description --}}
        <p class="mt-6 max-w-2xl mx-auto
                  text-base sm:text-lg
                  leading-8 text-slate-500">

            আমরা নতুন কিছু নিয়ে কাজ করছি।
            এই পেজটি খুব শীঘ্রই আরও সুন্দর ও প্রয়োজনীয় তথ্য
            নিয়ে আপনার জন্য প্রস্তুত হবে।
        </p>

        {{-- Status Cards --}}
        <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-2xl mx-auto">

            <div class="rounded-2xl border border-slate-200
                        bg-white p-5 shadow-sm">

                <div class="text-2xl font-bold text-slate-900">
                    01
                </div>

                <p class="mt-1 text-sm text-slate-500">
                    New Content
                </p>

            </div>

            <div class="rounded-2xl border border-slate-200
                        bg-white p-5 shadow-sm">

                <div class="text-2xl font-bold text-slate-900">
                    02
                </div>

                <p class="mt-1 text-sm text-slate-500">
                    Better Experience
                </p>

            </div>

            <div class="rounded-2xl border border-slate-200
                        bg-white p-5 shadow-sm">

                <div class="text-2xl font-bold text-slate-900">
                    03
                </div>

                <p class="mt-1 text-sm text-slate-500">
                    Coming Soon
                </p>

            </div>

        </div>

        {{-- Progress --}}
        <div class="max-w-xl mx-auto mt-10">

            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-slate-600">
                    Development Progress
                </span>

                <span class="text-sm font-semibold text-blue-600">
                    75%
                </span>
            </div>

            <div class="h-2.5 bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full w-3/4 bg-blue-600 rounded-full"></div>
            </div>

        </div>

        {{-- Back Button --}}
        <div class="mt-10">

            <a href="{{ route('admin.dashboard') }}"
               class="inline-flex items-center gap-2
                      px-6 py-3 rounded-xl
                      bg-slate-900 text-white
                      text-sm font-semibold
                      shadow-lg shadow-slate-200
                      hover:bg-blue-600
                      transition duration-300">

                <svg class="w-4 h-4"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>

                </svg>

                Back to Homepage

            </a>

        </div>

    </div>

</section>

@endsection