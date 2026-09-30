@extends('frontend.layouts.app')
@section('title', $setting->meta_title ?? '')
@section('meta_description')
    {{ $setting->meta_description ?? '' }}
@endsection

@section('meta_keywords')
    {{ $setting->meta_keywords ?? '' }}
@endsection


@section('content')

{{-- =========================================================
    PAGE HEADER
========================================================= --}}
<section class="relative overflow-hidden bg-slate-900 py-20">

    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-24 -right-24 h-72 w-72 rounded-full bg-white"></div>
        <div class="absolute -bottom-32 -left-20 h-80 w-80 rounded-full bg-white"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="max-w-3xl">

            <p class="mb-4 text-sm font-semibold uppercase tracking-[0.2em] text-slate-300">
                Our Institution
            </p>

            <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-white">
                Administration
            </h1>

            <p class="mt-5 text-base sm:text-lg leading-8 text-slate-300">
                Meet the dedicated administrative team responsible for
                managing and supporting our institution.
            </p>

        </div>

    </div>

</section>



{{-- =========================================================
    BREADCRUMB
========================================================= --}}
<section class="border-b border-gray-200 bg-white">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

        <nav class="flex items-center gap-2 text-sm">

            <a
                href="{{ route('home') }}"
                class="text-gray-500 hover:text-slate-900 transition"
            >
                Home
            </a>

            <span class="text-gray-400">
                /
            </span>

            <span class="font-medium text-gray-900">
                Administration
            </span>

        </nav>

    </div>

</section>



{{-- =========================================================
    ADMINISTRATION SECTION
========================================================= --}}
<section class="bg-gray-50 py-16 sm:py-20">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


        {{-- Section Heading --}}
        <div class="max-w-2xl mx-auto text-center mb-12">

            <span
                class="inline-flex items-center rounded-full
                       bg-slate-100 px-4 py-1.5
                       text-xs font-semibold uppercase
                       tracking-wider text-slate-700"
            >
                Administration
            </span>

            <h2 class="mt-4 text-3xl sm:text-4xl font-bold text-gray-900">
                Our Administration Team
            </h2>

            <p class="mt-4 text-gray-600 leading-7">
                Our administration team works together to ensure
                effective management and a better educational environment.
            </p>

        </div>



        {{-- Administration Cards --}}
        @if($administrations->count())

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

                @foreach($administrations as $administration)

                    <article
                        class="group bg-white rounded-2xl
                               border border-gray-200
                               overflow-hidden
                               shadow-sm
                               hover:shadow-xl
                               hover:-translate-y-1
                               transition-all duration-300"
                    >

                        {{-- Image Area --}}
                        <div class="relative bg-gray-100">

                            @if($administration->image)

                                <img
                                    src="{{ asset('storage/' . $administration->image) }}"
                                    alt="{{ $administration->name }}"
                                    class="w-full h-72 object-cover
                                           group-hover:scale-105
                                           transition-transform duration-500"
                                    loading="lazy"
                                    decoding="async"
                                >

                            @else

                                <div
                                    class="w-full h-72
                                           flex items-center justify-center
                                           bg-slate-100"
                                >

                                    <div
                                        class="w-28 h-28 rounded-full
                                               bg-white
                                               border border-gray-200
                                               flex items-center justify-center
                                               text-5xl"
                                    >
                                        👤
                                    </div>

                                </div>

                            @endif


                            {{-- Status --}}
                            <div class="absolute top-4 right-4">

                                <span
                                    class="inline-flex items-center gap-1.5
                                           rounded-full
                                           bg-white/95
                                           backdrop-blur-sm
                                           px-3 py-1.5
                                           text-xs font-semibold
                                           text-green-700
                                           shadow-sm"
                                >

                                    <span class="h-2 w-2 rounded-full bg-green-500"></span>

                                    Active

                                </span>

                            </div>

                        </div>



                        {{-- Content --}}
                        <div class="p-6">

                            <h3
                                class="text-xl font-bold text-gray-900
                                       group-hover:text-slate-700
                                       transition"
                            >
                                {{ $administration->name }}
                            </h3>


                            <p class="mt-1 text-sm font-semibold text-slate-600">
                                {{ $administration->designation }}
                            </p>



                            {{-- Contact --}}
                            @if($administration->phone || $administration->email)

                                <div class="mt-5 space-y-2.5">

                                    @if($administration->phone)

                                        <div class="flex items-center gap-3 text-sm text-gray-600">

                                            <span
                                                class="flex-shrink-0 w-9 h-9
                                                       rounded-lg bg-gray-100
                                                       flex items-center justify-center"
                                            >
                                                ☎
                                            </span>

                                            <span>
                                                {{ $administration->phone }}
                                            </span>

                                        </div>

                                    @endif


                                    @if($administration->email)

                                        <div class="flex items-center gap-3 text-sm text-gray-600">

                                            <span
                                                class="flex-shrink-0 w-9 h-9
                                                       rounded-lg bg-gray-100
                                                       flex items-center justify-center"
                                            >
                                                ✉
                                            </span>

                                            <span class="break-all">
                                                {{ $administration->email }}
                                            </span>

                                        </div>

                                    @endif

                                </div>

                            @endif



                            {{-- Description --}}
                            @if($administration->description)

                                <div class="mt-5 pt-5 border-t border-gray-100">

                                    <p class="text-sm leading-6 text-gray-500">
                                        {{ $administration->description }}
                                    </p>

                                </div>

                            @endif

                        </div>

                    </article>

                @endforeach

            </div>


        @else

            {{-- Empty State --}}
            <div class="max-w-xl mx-auto text-center py-16">

                <div
                    class="mx-auto w-20 h-20 rounded-full
                           bg-white border border-gray-200
                           flex items-center justify-center
                           text-3xl shadow-sm"
                >
                    👔
                </div>

                <h3 class="mt-5 text-xl font-bold text-gray-900">
                    No Administration Information
                </h3>

                <p class="mt-2 text-gray-500">
                    Administration information is currently unavailable.
                </p>

            </div>

        @endif

    </div>

</section>



{{-- =========================================================
    CALL TO ACTION
========================================================= --}}
<section class="bg-white py-16">

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <div
            class="relative overflow-hidden
                   rounded-3xl bg-slate-900
                   px-6 py-12 sm:px-12
                   text-center"
        >

            <div class="absolute -top-20 -right-20
                        w-56 h-56 rounded-full
                        bg-white/5">
            </div>

            <div class="absolute -bottom-24 -left-20
                        w-64 h-64 rounded-full
                        bg-white/5">
            </div>


            <div class="relative">

                <h2 class="text-2xl sm:text-3xl font-bold text-white">
                    Have a Question?
                </h2>

                <p class="mt-3 max-w-2xl mx-auto
                          text-slate-300 leading-7">
                    Feel free to contact our institution for any
                    information or assistance.
                </p>

                <a
                    href="{{ route('contact') }}"
                    class="inline-flex items-center justify-center
                           mt-7 px-6 py-3
                           rounded-xl
                           bg-white text-slate-900
                           text-sm font-bold
                           hover:bg-gray-100
                           transition"
                >
                    Contact Us
                </a>

            </div>

        </div>

    </div>

</section>

@endsection