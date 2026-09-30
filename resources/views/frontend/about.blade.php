@extends('frontend.layouts.app')

@section('title', $about?->title ?? 'About Us')

@section(
    'meta_description',
    $about?->description
        ? Str::limit(strip_tags($about->description), 160)
        : 'Learn more about our institution, history, education and commitment.'
)

@section(
    'meta_keywords',
    'about school, institution, education, school history'
)

@section('content')


{{-- =========================================================
    PAGE HEADER
========================================================= --}}

<section class="bg-slate-900 py-16 lg:py-20">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="max-w-3xl">

            <span class="text-sm font-semibold uppercase
                         tracking-wider text-slate-300">
                About Us
            </span>

            <h1 class="mt-3 text-4xl md:text-5xl
                       font-bold text-white">

                {{ $about?->title ?? 'About Our Institution' }}

            </h1>

            <p class="mt-5 max-w-2xl leading-8 text-slate-300">

                @if($about?->description)

                    {{ Str::limit(strip_tags($about->description), 180) }}

                @else

                    Learn more about our institution, our values,
                    our educational approach and our commitment
                    to students.

                @endif

            </p>

        </div>

    </div>

</section>



{{-- =========================================================
    ABOUT INTRO
========================================================= --}}

<section class="bg-white py-16 lg:py-20">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid items-center gap-12 lg:grid-cols-2">


            {{-- =================================================
                IMAGE
            ================================================== --}}

            <div class="order-2 lg:order-1">

                @if($about?->image)

                    <div class="overflow-hidden rounded-2xl
                                bg-slate-100
                                shadow-sm">

                        <img
                            src="{{ asset($about->image) }}"
                            alt="{{ $about->title ?? 'About Our Institution' }}"
                            class="w-full
                                   h-[300px]
                                   sm:h-[380px]
                                   lg:h-[460px]
                                   object-cover
                                   transition-transform
                                   duration-500
                                   hover:scale-105"
                        >

                    </div>

                @else

                    {{-- Fallback --}}

                    <div class="min-h-[380px]
                                rounded-2xl
                                bg-slate-100
                                flex
                                items-center
                                justify-center">

                        <div class="text-center">

                            <div class="mx-auto flex h-20 w-20
                                        items-center justify-center
                                        rounded-2xl bg-slate-200">

                                <svg
                                    class="h-10 w-10 text-slate-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 14l9-5-9-5-9 5 9 5z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 14l6.16-3.422A12.083 12.083 0 0118 16.5c0 .93-.18 1.82-.5 2.64M12 14l-6.16-3.422A12.083 12.083 0 006 16.5c0 .93.18 1.82.5 2.64M12 14v7"
                                    />

                                </svg>

                            </div>

                            <p class="mt-4 text-sm text-slate-400">
                                Institution Image
                            </p>

                        </div>

                    </div>

                @endif

            </div>



            {{-- =================================================
                CONTENT
            ================================================== --}}

            <div class="order-1 lg:order-2">

                <span class="text-sm font-semibold uppercase
                             tracking-wider text-slate-500">

                    Who We Are

                </span>


                <h2 class="mt-3 text-3xl md:text-4xl
                           font-bold text-slate-900">

                    {{ $about?->title ?? 'A Place for Learning & Growth' }}

                </h2>


                @if($about?->description)

                    <div class="mt-6
                                leading-8
                                text-slate-600
                                prose
                                prose-slate
                                max-w-none">

                        {!! nl2br(e($about->description)) !!}

                    </div>

                @else

                    <p class="mt-6 leading-8 text-slate-600">

                        Our institution is committed to providing
                        a quality educational environment where
                        students can develop their academic,
                        social and personal skills.

                    </p>

                    <p class="mt-4 leading-8 text-slate-600">

                        We believe that every student has unique
                        potential. Our teachers and staff work
                        together to support students and help them
                        achieve their goals.

                    </p>

                    <p class="mt-4 leading-8 text-slate-600">

                        Through education, discipline, creativity
                        and character development, we aim to prepare
                        students for higher education, professional
                        life and responsible citizenship.

                    </p>

                @endif

            </div>

        </div>

    </div>

</section>



{{-- =========================================================
    OUR STORY
========================================================= --}}

<section class="bg-slate-50 py-16 lg:py-20">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center">

            <span class="text-sm font-semibold uppercase
                         tracking-wider text-slate-500">

                Our Story

            </span>

            <h2 class="mt-3 text-3xl md:text-4xl
                       font-bold text-slate-900">

                Our Journey

            </h2>

        </div>


        <div class="mt-10 space-y-6">


            <div class="rounded-2xl bg-white p-7 shadow-sm">

                <h3 class="text-xl font-bold text-slate-900">
                    Establishment
                </h3>

                <p class="mt-3 leading-7 text-slate-600">

                    Our institution was established with the
                    goal of creating an accessible and quality
                    educational environment for students.

                </p>

            </div>



            <div class="rounded-2xl bg-white p-7 shadow-sm">

                <h3 class="text-xl font-bold text-slate-900">
                    Growth &amp; Development
                </h3>

                <p class="mt-3 leading-7 text-slate-600">

                    Over the years, the institution has continued
                    to improve its academic programs, facilities
                    and educational activities.

                </p>

            </div>



            <div class="rounded-2xl bg-white p-7 shadow-sm">

                <h3 class="text-xl font-bold text-slate-900">
                    Our Commitment
                </h3>

                <p class="mt-3 leading-7 text-slate-600">

                    We remain committed to academic excellence,
                    ethical values, innovation and the overall
                    development of our students.

                </p>

            </div>

        </div>

    </div>

</section>



{{-- =========================================================
    OUR VALUES
========================================================= --}}

<section class="bg-white py-16 lg:py-20">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


        <div class="mx-auto max-w-2xl text-center">

            <span class="text-sm font-semibold uppercase
                         tracking-wider text-slate-500">

                Our Values

            </span>

            <h2 class="mt-3 text-3xl md:text-4xl
                       font-bold text-slate-900">

                What We Believe

            </h2>

        </div>



        <div class="mt-12 grid gap-6
                    sm:grid-cols-2 lg:grid-cols-4">


            <div class="rounded-2xl bg-slate-50 p-7">

                <h3 class="text-xl font-bold text-slate-900">
                    Excellence
                </h3>

                <p class="mt-3 text-sm leading-7 text-slate-600">

                    We strive for excellence in education,
                    learning and student development.

                </p>

            </div>



            <div class="rounded-2xl bg-slate-50 p-7">

                <h3 class="text-xl font-bold text-slate-900">
                    Integrity
                </h3>

                <p class="mt-3 text-sm leading-7 text-slate-600">

                    We encourage honesty, responsibility and
                    strong moral values.

                </p>

            </div>



            <div class="rounded-2xl bg-slate-50 p-7">

                <h3 class="text-xl font-bold text-slate-900">
                    Respect
                </h3>

                <p class="mt-3 text-sm leading-7 text-slate-600">

                    We promote respect, cooperation and
                    understanding among everyone.

                </p>

            </div>



            <div class="rounded-2xl bg-slate-50 p-7">

                <h3 class="text-xl font-bold text-slate-900">
                    Innovation
                </h3>

                <p class="mt-3 text-sm leading-7 text-slate-600">

                    We encourage creativity, curiosity and
                    continuous improvement.

                </p>

            </div>

        </div>

    </div>

</section>



{{-- =========================================================
    CTA
========================================================= --}}

<section class="bg-slate-900 py-16">

    <div class="mx-auto max-w-4xl px-4 text-center
                sm:px-6 lg:px-8">

        <h2 class="text-3xl md:text-4xl
                   font-bold text-white">

            Learn More About Our Institution

        </h2>


        <p class="mt-4 leading-7 text-slate-300">

            Explore our mission, leadership, academic programs
            and other information.

        </p>


        <div class="mt-7 flex flex-wrap
                    justify-center gap-4">


            <a
                href="{{ route('mission-vision') }}"
                class="inline-flex rounded-lg
                       bg-white
                       px-6 py-3
                       font-semibold
                       text-slate-900
                       hover:bg-slate-100
                       transition"
            >

                Mission &amp; Vision

            </a>


            <a
                href="{{ route('leadership') }}"
                class="inline-flex
                       rounded-lg
                       border border-white/30
                       px-6 py-3
                       font-semibold
                       text-white
                       hover:bg-white/10
                       transition"
            >

                Leadership

            </a>

        </div>

    </div>

</section>

@endsection