@extends('frontend.layouts.app')

@section('title', $websiteSetting->meta_title ?? $websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? '')
@section('meta_description', $websiteSetting->meta_description ?? '')
@section('meta_keywords', $websiteSetting->meta_keywords ?? '')

@section('content')
{{-- =========================================================
    HERO SLIDER
========================================================= --}}


{{-- ============================================================
    HOME SLIDER
============================================================ --}}
<section class="relative w-full overflow-hidden bg-slate-900">

    @if($sliders->count() > 0)

        <div
            id="school-slider"
            class="relative w-full h-[240px] sm:h-[320px] lg:h-[400px]"
        >

            {{-- ==================================================
                SLIDES
            =================================================== --}}

            @foreach($sliders as $index => $slider)

                <div
                    class="hero-slide absolute inset-0
                           transition-opacity duration-700
                           {{ $index === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}"
                    data-slide="{{ $index }}"
                >

                    {{-- Background Image --}}
                    <img
                        src="{{ asset($slider->image) }}"
                        alt="{{ $slider->title }}"
                        class="absolute inset-0 w-full h-full object-cover"
                    >

                    {{-- Dark Overlay --}}
                    <div
                        class="absolute inset-0
                               bg-gradient-to-r
                               from-black/80
                               via-black/55
                               to-black/20"
                    ></div>


                    {{-- ==================================================
                        SLIDE CONTENT
                    =================================================== --}}

                    <div
                        class="relative z-20
                               h-full
                               max-w-7xl
                               mx-auto
                               px-6
                               sm:px-8
                               lg:px-12
                               flex
                               items-center"
                    >

                        <div class="max-w-3xl text-white">

                            {{-- Subtitle / Badge --}}
                            @if($slider->subtitle)

                                <div
                                    class="inline-flex
                                           items-center
                                           px-4
                                           py-2
                                           mb-5
                                           rounded-full
                                           bg-white/10
                                           border
                                           border-white/20
                                           backdrop-blur-md
                                           text-sm
                                           sm:text-base
                                           font-semibold
                                           tracking-wide"
                                >

                                    <span
                                        class="w-2
                                               h-2
                                               mr-2
                                               rounded-full
                                               bg-accent-400"
                                    ></span>

                                    {{ $slider->subtitle }}

                                </div>

                            @endif


                            {{-- Title --}}
                            @if($slider->title)

                                <h1
                                    class="text-3xl
                                           sm:text-5xl
                                           lg:text-6xl
                                           font-black
                                           leading-tight
                                           tracking-tight
                                           mb-5"
                                >
                                    {{ $slider->title }}
                                </h1>

                            @endif


                            {{-- Description --}}
                            @if($slider->description)

                                <p
                                    class="max-w-2xl
                                           text-base
                                           sm:text-lg
                                           lg:text-xl
                                           leading-relaxed
                                           text-white/85
                                           mb-7"
                                >
                                    {{ $slider->description }}
                                </p>

                            @endif


                            {{-- Button --}}
                            @if($slider->button_text && $slider->button_url)

                                <a
                                    href="{{ $slider->button_url }}"
                                    class="inline-flex
                                           items-center
                                           gap-2
                                           px-6
                                           py-3.5
                                           rounded-xl
                                           bg-white
                                           text-slate-900
                                           font-bold
                                           shadow-lg
                                           transition-all
                                           duration-300
                                           hover:bg-accent-500
                                           hover:text-slate-950
                                           hover:-translate-y-1"
                                >

                                    {{ $slider->button_text }}

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="currentColor"
                                        class="w-5 h-5"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"
                                        />
                                    </svg>

                                </a>

                            @endif

                        </div>

                    </div>

                </div>

            @endforeach


            {{-- ==================================================
                PREVIOUS / NEXT BUTTON
            =================================================== --}}

            @if($sliders->count() > 1)

                {{-- Previous --}}
                <button
                    id="slider-prev"
                    type="button"
                    aria-label="Previous slide"
                    class="absolute
                           left-4
                           sm:left-6
                           top-1/2
                           -translate-y-1/2
                           z-30
                           w-11
                           h-11
                           sm:w-12
                           sm:h-12
                           rounded-full
                           bg-white/10
                           hover:bg-white/20
                           border
                           border-white/20
                           backdrop-blur-md
                           text-white
                           flex
                           items-center
                           justify-center
                           transition-all
                           duration-300
                           hover:scale-110"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="w-5 h-5 sm:w-6 sm:h-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15.75 19.5 8.25 12l7.5-7.5"
                        />
                    </svg>

                </button>


                {{-- Next --}}
                <button
                    id="slider-next"
                    type="button"
                    aria-label="Next slide"
                    class="absolute
                           right-4
                           sm:right-6
                           top-1/2
                           -translate-y-1/2
                           z-30
                           w-11
                           h-11
                           sm:w-12
                           sm:h-12
                           rounded-full
                           bg-white/10
                           hover:bg-white/20
                           border
                           border-white/20
                           backdrop-blur-md
                           text-white
                           flex
                           items-center
                           justify-center
                           transition-all
                           duration-300
                           hover:scale-110"
                >

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="w-5 h-5 sm:w-6 sm:h-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m8.25 4.5 7.5 7.5-7.5 7.5"
                        />
                    </svg>

                </button>

            @endif


            {{-- ==================================================
                DYNAMIC DOTS
            =================================================== --}}

            @if($sliders->count() > 1)

                <div
                    id="slider-dots"
                    class="absolute
                           bottom-6
                           sm:bottom-8
                           left-1/2
                           -translate-x-1/2
                           z-30
                           flex
                           items-center
                           gap-2"
                >

                    @foreach($sliders as $index => $slider)

                        <button
                            type="button"
                            data-slide="{{ $index }}"
                            aria-label="Go to slide {{ $index + 1 }}"
                            class="slider-dot
                                   h-2
                                   rounded-full
                                   transition-all
                                   duration-300
                                   {{ $index === 0
                                        ? 'w-8 bg-white'
                                        : 'w-2 bg-white/50 hover:bg-white/80' }}"
                        ></button>

                    @endforeach

                </div>

            @endif

        </div>

    @else

        {{-- ==================================================
            FALLBACK
        =================================================== --}}

        <div
            class="relative
                   w-full
                   h-[320px]
                   sm:h-[420px]
                   lg:h-[560px]
                   flex
                   items-center
                   justify-center
                   bg-slate-800"
        >

            <div class="text-center text-white px-6">

                <h1
                    class="text-3xl
                           sm:text-5xl
                           font-black
                           mb-4"
                >
                    {{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'আমাদের বিদ্যালয়' }}
                </h1>

                <p class="text-lg text-white/70">
                    {{ $websiteSetting->tagline ?? 'মানসম্মত ও আধুনিক শিক্ষার অনন্য ঠিকানা' }}
                </p>

            </div>

        </div>

    @endif

</section>

{{-- ============================================================
    SLIDER JAVASCRIPT
============================================================ --}}
@if($sliders->count() > 1)
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const slides = document.querySelectorAll('.hero-slide');
            const dots = document.querySelectorAll('.slider-dot');

            const prevButton = document.getElementById('slider-prev');
            const nextButton = document.getElementById('slider-next');

            const slider = document.getElementById('school-slider');

            if (!slides.length) {
                return;
            }


            let currentSlide = 0;
            let autoSlide = null;


            // ==========================================================
            // SHOW SLIDE
            // ==========================================================

            function showSlide(index) {

                if (index >= slides.length) {
                    index = 0;
                }

                if (index < 0) {
                    index = slides.length - 1;
                }

                currentSlide = index;


                // Slides
                slides.forEach(function (slide, i) {

                    if (i === currentSlide) {

                        slide.classList.remove('opacity-0');
                        slide.classList.add('opacity-100');

                        slide.classList.remove('z-0');
                        slide.classList.add('z-10');

                    } else {

                        slide.classList.remove('opacity-100');
                        slide.classList.add('opacity-0');

                        slide.classList.remove('z-10');
                        slide.classList.add('z-0');

                    }

                });


                // Dots
                dots.forEach(function (dot, i) {

                    if (i === currentSlide) {

                        dot.classList.remove(
                            'w-2',
                            'bg-white/50'
                        );

                        dot.classList.add(
                            'w-8',
                            'bg-white'
                        );

                    } else {

                        dot.classList.remove(
                            'w-8',
                            'bg-white'
                        );

                        dot.classList.add(
                            'w-2',
                            'bg-white/50'
                        );

                    }

                });

            }


            // ==========================================================
            // NEXT
            // ==========================================================

            function nextSlide() {

                showSlide(currentSlide + 1);

            }


            // ==========================================================
            // PREVIOUS
            // ==========================================================

            function previousSlide() {

                showSlide(currentSlide - 1);

            }


            // ==========================================================
            // AUTOPLAY
            // ==========================================================

            function startAutoSlide() {

                stopAutoSlide();

                autoSlide = setInterval(function () {

                    nextSlide();

                }, 5000);

            }


            function stopAutoSlide() {

                if (autoSlide !== null) {

                    clearInterval(autoSlide);

                    autoSlide = null;

                }

            }


            // ==========================================================
            // NEXT BUTTON
            // ==========================================================

            if (nextButton) {

                nextButton.addEventListener('click', function () {

                    nextSlide();

                    startAutoSlide();

                });

            }


            // ==========================================================
            // PREVIOUS BUTTON
            // ==========================================================

            if (prevButton) {

                prevButton.addEventListener('click', function () {

                    previousSlide();

                    startAutoSlide();

                });

            }


            // ==========================================================
            // DOTS
            // ==========================================================

            dots.forEach(function (dot, index) {

                dot.addEventListener('click', function () {

                    showSlide(index);

                    startAutoSlide();

                });

            });


            // ==========================================================
            // PAUSE ON HOVER
            // ==========================================================

            if (slider) {

                slider.addEventListener('mouseenter', function () {

                    stopAutoSlide();

                });


                slider.addEventListener('mouseleave', function () {

                    startAutoSlide();

                });

            }


            // ==========================================================
            // INITIALIZE
            // ==========================================================

            showSlide(0);

            startAutoSlide();

        });
    </script>
@endif

{{-- =========================================================
    ABOUT
========================================================= --}}
@if($about)
    <section class="py-16 sm:py-20 bg-white">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">

                {{-- LEFT CONTENT --}}
                <div>

                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-50 text-brand-700 border border-brand-100">
                        আমাদের সম্পর্কে
                    </span>

                    {{-- Dynamic Title --}}
                    <h2
                        class="mt-3 text-3xl sm:text-4xl
                            font-extrabold text-slate-900
                            leading-tight"
                    >
                        {!! nl2br(e($about->title)) !!}
                    </h2>

                    {{-- Dynamic Description --}}
                    <p class="mt-5 text-slate-600 leading-8">
                        {!! nl2br(e($about->description)) !!}
                    </p>

                    {{-- Dynamic Button --}}
                    @if($about->button_text)

                        <a
                            href="{{ $about->button_url ?: route('about') }}"
                            class="inline-flex mt-7 px-6 py-3
                                bg-brand-700 text-white rounded-xl
                                font-bold hover:bg-brand-800 shadow-md shadow-brand-700/20
                                transition"
                        >
                            {{ $about->button_text }}
                        </a>

                    @endif

                </div>


                {{-- RIGHT IMAGE --}}
                <div class="rounded-2xl overflow-hidden shadow-xl">

                    @if($about->image)

                        <img
                            src="{{ asset($about->image) }}"
                            alt="{{ $about->title }}"
                            class="w-full h-[350px] object-cover"
                        >

                    @else

                        <div
                            class="w-full h-[350px]
                                bg-brand-50/50 border border-brand-100
                                flex items-center justify-center"
                        >
                            <div class="text-center">

                                <div class="text-6xl mb-3">
                                    🏫
                                </div>

                                <p class="text-slate-500 font-medium">
                                    আমাদের বিদ্যালয়
                                </p>

                            </div>
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </section>
@endif

{{-- =========================================================
    MISSION & VISION
========================================================= --}}
@if(isset($missionVision) && $missionVision)
<section class="py-16 sm:py-20 bg-slate-50">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center max-w-2xl mx-auto">

            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-50 text-brand-700 border border-brand-100">
                আমাদের লক্ষ্য ও উদ্দেশ্য
            </span>

            <h2
                class="mt-3 text-3xl sm:text-4xl
                       font-extrabold text-slate-900"
            >
                মিশন ও ভিশন
            </h2>

        </div>


        <div class="grid md:grid-cols-2 gap-6 mt-10">

            <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 hover:shadow-md hover:border-brand-200 transition">

                <div
                    class="w-14 h-14 rounded-xl bg-brand-50 border border-brand-100 text-brand-700
                           flex items-center justify-center
                           text-2xl mb-5"
                >
                    🎯
                </div>

                <h3 class="text-2xl font-bold text-slate-900">
                    {{ $missionVision->mission_title ?? 'আমাদের মিশন' }}
                </h3>

                <p class="mt-4 text-slate-600 leading-7">
                    {!! nl2br(e($missionVision->mission_description)) !!}
                </p>

            </div>


            <div class="bg-white rounded-2xl p-8 shadow-sm border border-slate-200 hover:shadow-md hover:border-accent-200 transition">

                <div
                    class="w-14 h-14 rounded-xl bg-accent-50 border border-accent-100 text-accent-700
                           flex items-center justify-center
                           text-2xl mb-5"
                >
                    💡
                </div>

                <h3 class="text-2xl font-bold text-slate-900">
                    {{ $missionVision->vision_title ?? 'আমাদের ভিশন' }}
                </h3>

                <p class="mt-4 text-slate-600 leading-7">
                    {!! nl2br(e($missionVision->vision_description)) !!}
                </p>

            </div>

        </div>

    </div>

</section>
@endif

{{-- =========================================================
    QUICK INFORMATION
========================================================= --}}
<section class="py-16 sm:py-20 bg-white">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="text-center">

            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-50 text-brand-700 border border-brand-100">
                {{ app()->getLocale() === 'en' ? 'Quick Statistics' : 'গুরুত্বপূর্ণ তথ্য' }}
            </span>

            <h2
                class="mt-3 text-3xl sm:text-4xl
                       font-extrabold text-slate-900"
            >
                {{ app()->getLocale() === 'en' ? 'At a Glance' : 'এক নজরে' }}
            </h2>

        </div>


        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-10">

            <div class="p-6 rounded-2xl bg-white border border-brand-100/80 shadow-sm hover:shadow-md hover:border-brand-300 transition text-center group">

                <div class="text-3xl sm:text-4xl font-black text-brand-700 group-hover:text-brand-600 transition">
                    @bnDigit($totalTeachers)+
                </div>

                <p class="mt-2 text-slate-600 font-semibold text-sm">
                    {{ app()->getLocale() === 'en' ? 'Honorable Teachers' : 'অভিজ্ঞ শিক্ষকবৃন্দ' }}
                </p>

            </div>


            <div class="p-6 rounded-2xl bg-white border border-brand-100/80 shadow-sm hover:shadow-md hover:border-brand-300 transition text-center group">

                <div class="text-3xl sm:text-4xl font-black text-brand-700 group-hover:text-brand-600 transition">
                    @bnDigit($totalStudents)+
                </div>

                <p class="mt-2 text-slate-600 font-semibold text-sm">
                    {{ app()->getLocale() === 'en' ? 'Active Students' : 'নিয়মিত শিক্ষার্থী' }}
                </p>

            </div>


            <div class="p-6 rounded-2xl bg-white border border-brand-100/80 shadow-sm hover:shadow-md hover:border-brand-300 transition text-center group">

                <div class="text-3xl sm:text-4xl font-black text-brand-700 group-hover:text-brand-600 transition">
                    @bnDigit($totalClasses)
                </div>

                <p class="mt-2 text-slate-600 font-semibold text-sm">
                    {{ app()->getLocale() === 'en' ? 'Academic Classes' : 'একাডেমিক শ্রেণি' }}
                </p>

            </div>


            <div class="p-6 rounded-2xl bg-white border border-brand-100/80 shadow-sm hover:shadow-md hover:border-brand-300 transition text-center group">

                <div class="text-3xl sm:text-4xl font-black text-brand-700 group-hover:text-brand-600 transition">
                    @bnDigit($totalStaff)+
                </div>

                <p class="mt-2 text-slate-600 font-semibold text-sm">
                    {{ app()->getLocale() === 'en' ? 'Supporting Staff' : 'কর্মকর্তা ও কর্মচারী' }}
                </p>

            </div>

        </div>

    </div>

</section>

{{-- =========================================================
    ADMINISTRATION SECTION
========================================================= --}}
@if(isset($administrations) && $administrations->count())

    <section class="py-16 bg-gray-50">

        <div class="max-w-7xl mx-auto px-4">

            <div class="text-center mb-10">

                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
                    {{ app()->getLocale() === 'en' ? 'Our Administration' : 'আমাদের পরিচালনা পর্ষদ' }}
                </h2>

                <p class="mt-3 text-gray-600">
                    {{ app()->getLocale() === 'en' ? 'Meet our dedicated administration and governing body.' : 'আমাদের নিবেদিতপ্রাণ পরিচালনা পর্ষদ ও প্রশাসনিক কর্মকর্তা।' }}
                </p>

            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach($administrations as $administration)

                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm
                                border border-gray-200
                                hover:shadow-lg transition">

                        {{-- Image --}}
                        <div class="h-60 bg-gray-100">

                            @if($administration->image)

                                <img
                                    src="{{ asset('storage/' . $administration->image) }}"
                                    alt="{{ $administration->name }}"
                                    class="w-full h-full object-cover"
                                >

                            @else

                                <div class="w-full h-full flex items-center justify-center">
                                    <div class="w-24 h-24 rounded-full bg-white
                                                border border-gray-200
                                                flex items-center justify-center
                                                text-4xl">
                                        👤
                                    </div>
                                </div>

                            @endif

                        </div>

                        {{-- Content --}}
                        <div class="p-6">

                            <h3 class="text-xl font-bold text-gray-900">
                                {{ $administration->name }}
                            </h3>

                            <p class="mt-1 text-sm font-semibold text-gray-600">
                                {{ $administration->designation }}
                            </p>

                            @if($administration->phone)
                                <p class="mt-4 text-sm text-gray-600">
                                    ☎ {{ $administration->phone }}
                                </p>
                            @endif

                            @if($administration->email)
                                <p class="mt-2 text-sm text-gray-600 break-all">
                                    ✉ {{ $administration->email }}
                                </p>
                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

            <div class="text-center mt-10">

                <a
                    href="{{ route('administration') }}"
                    class="inline-flex items-center gap-2
                           px-6 py-3 rounded-xl
                           bg-brand-700 text-white
                           font-bold shadow-md shadow-brand-700/20
                           hover:bg-brand-800 transition"
                >
                    {{ app()->getLocale() === 'en' ? 'View All Administration' : 'সকল পরিচালনা পর্ষদ' }}
                    →
                </a>

            </div>

        </div>

    </section>

@endif

{{-- =========================================================
    TEACHERS
========================================================= --}}
<section class="py-16 sm:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-50 text-brand-700 border border-brand-100">
                    আমাদের শিক্ষক
                </span>
                <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-slate-900">
                    অভিজ্ঞ শিক্ষকবৃন্দ
                </h2>
            </div>
            <a href="{{ route('teachers') }}" class="font-bold text-brand-700 hover:text-brand-900 transition">
                সকল শিক্ষক →
            </a>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-10">
            @forelse($teachers as $teacher)
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-md hover:border-brand-200 transition">
                    @if($teacher->image)
                        <img
                            src="{{ asset($teacher->image) }}"
                            alt="{{ $teacher->name }}"
                            class="w-full h-64 object-cover"
                        >
                    @else
                        <div class="w-full h-64 bg-slate-100 flex items-center justify-center">
                            <span class="text-6xl">👨‍🏫</span>
                        </div>
                    @endif

                    <div class="p-5">
                        <h3 class="font-bold text-lg text-slate-900">
                            {{ $teacher->name }}
                        </h3>

                        @if($teacher->designation)
                            <p class="mt-1 text-sm text-brand-700 font-semibold">
                                {{ $teacher->designation }}
                            </p>
                        @endif

                        @if($teacher->subject)
                            <p class="mt-1 text-sm text-slate-500">
                                {{ $teacher->subject }}
                            </p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="sm:col-span-2 lg:col-span-4 py-12 text-center">
                    <div class="text-5xl mb-3">👨‍🏫</div>
                    <p class="text-slate-500">
                        বর্তমানে কোনো শিক্ষক তথ্য পাওয়া যায়নি।
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- =========================================================
    STAFF
========================================================= --}}
<section class="py-16 sm:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
            <div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-50 text-brand-700 border border-brand-100">
                    আমাদের কর্মচারীবৃন্দ
                </span>

                <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-slate-900">
                    অফিস ও সহায়ক কর্মীবৃন্দ
                </h2>
            </div>

            <a
                href="{{ route('staff') }}"
                class="font-bold text-brand-700 hover:text-brand-900 transition"
            >
                সকল কর্মচারী →
            </a>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-10">
            @forelse($staff as $member)
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-md hover:border-brand-200 transition">
                    @if($member->image)
                        <img
                            src="{{ asset($member->image) }}"
                            alt="{{ $member->name }}"
                            class="w-full h-64 object-cover"
                        >
                    @else
                        <div class="w-full h-64 bg-slate-100 flex items-center justify-center">
                            <span class="text-6xl">👨‍💼</span>
                        </div>
                    @endif

                    <div class="p-5">
                        <h3 class="font-bold text-lg text-slate-900">
                            {{ $member->name }}
                        </h3>

                        @if($member->designation)
                            <p class="mt-1 text-sm text-brand-700 font-semibold">
                                {{ $member->designation }}
                            </p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="sm:col-span-2 lg:col-span-4 py-12 text-center">
                    <div class="text-5xl mb-3">👨‍💼</div>

                    <p class="text-slate-500">
                        বর্তমানে কোনো কর্মচারীর তথ্য পাওয়া যায়নি।
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- =========================================================
    GALLERY
========================================================= --}}
<section class="py-16 sm:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-brand-50 text-brand-700 border border-brand-100">
                আমাদের কার্যক্রম
            </span>
            <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-slate-900">
                ফটো গ্যালারি
            </h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-10">
            @forelse($galleries as $gallery)
                <a href="{{ route('gallery') }}" class="group block overflow-hidden rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition">
                    @if($gallery->image)
                        <img
                            src="{{ asset($gallery->image) }}"
                            alt="{{ $gallery->title ?? 'Gallery' }}"
                            class="w-full h-48 sm:h-56 object-cover group-hover:scale-105 transition duration-500"
                        >
                    @else
                        <div class="w-full h-48 sm:h-56 bg-slate-100 flex items-center justify-center">
                            <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4-4a3 3 0 014 0l4 4m-2-2l1-1a3 3 0 014 0l1 1M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2zm4-9h.01"/>
                            </svg>
                        </div>
                    @endif
                </a>
            @empty
                <div class="col-span-2 md:col-span-4 text-center py-12">
                    <p class="text-slate-500">
                        বর্তমানে কোনো ছবি পাওয়া যায়নি।
                    </p>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-8">
            <a
                href="{{ route('gallery') }}"
                class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-brand-200 text-brand-700 rounded-xl font-bold hover:bg-brand-50 shadow-sm transition"
            >
                সম্পূর্ণ গ্যালারি দেখুন →
            </a>
        </div>
    </div>
</section>

{{-- =========================================================
    ADMISSION CTA
========================================================= --}}
<section class="py-16 sm:py-20 bg-gradient-to-br from-brand-950 via-brand-900 to-slate-950 text-white relative overflow-hidden">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 text-center">
        @if($admissions->count())
            @php
                $admission = $admissions->first();
            @endphp

            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold">
                {{ $admission->title }}
            </h2>

            @if($admission->description)
                <p class="mt-5 text-white/80 text-base sm:text-lg max-w-3xl mx-auto">
                    {{ Str::limit(strip_tags($admission->description), 250) }}
                </p>
            @endif

            @if($admission->application_url)
                <a
                    href="{{ $admission->application_url }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex mt-8 px-7 py-3.5 bg-accent-500 hover:bg-accent-400 text-slate-950 rounded-xl font-bold shadow-lg shadow-accent-500/25 transition duration-300 hover:scale-105"
                >
                    ভর্তি আবেদন করুন
                </a>
            @else
                <a
                    href="{{ route('admission') }}"
                    class="inline-flex mt-8 px-7 py-3.5 bg-accent-500 hover:bg-accent-400 text-slate-950 rounded-xl font-bold shadow-lg shadow-accent-500/25 transition duration-300 hover:scale-105"
                >
                    ভর্তি সংক্রান্ত তথ্য
                </a>
            @endif
        @else
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold">
                আপনার সন্তানের উজ্জ্বল ভবিষ্যতের
                <br class="hidden sm:block">
                জন্য আজই ভর্তি করুন
            </h2>

            <p class="mt-5 text-white/80 text-base sm:text-lg">
                মানসম্মত শিক্ষা ও সুন্দর পরিবেশে আপনার সন্তানের
                ভবিষ্যৎ গড়ে তুলতে আমাদের সাথে থাকুন।
            </p>

            <a
                href="{{ route('admission') }}"
                class="inline-flex mt-8 px-7 py-3.5 bg-accent-500 hover:bg-accent-400 text-slate-950 rounded-xl font-bold shadow-lg shadow-accent-500/25 transition duration-300 hover:scale-105"
            >
                ভর্তি সংক্রান্ত তথ্য
            </a>
        @endif
    </div>
</section>

{{-- =========================================================
    CONTACT
========================================================= --}}
<section class="py-16 sm:py-20 bg-white">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid md:grid-cols-3 gap-6">

            <div class="p-7 rounded-2xl bg-white border border-slate-200 hover:border-brand-200 hover:shadow-md transition">

                <div class="w-12 h-12 rounded-xl bg-brand-50 border border-brand-100 text-brand-700 flex items-center justify-center text-2xl">
                    📍
                </div>

                <h3 class="mt-4 font-bold text-lg text-slate-900">
                    ঠিকানা
                </h3>

                <p class="mt-2 text-slate-600 leading-6">
                    {{ $websiteSetting->address ?? 'বিদ্যালয়ের ঠিকানা' }}
                </p>

            </div>


            <div class="p-7 rounded-2xl bg-white border border-slate-200 hover:border-brand-200 hover:shadow-md transition">

                <div class="w-12 h-12 rounded-xl bg-brand-50 border border-brand-100 text-brand-700 flex items-center justify-center text-2xl">
                    ☎️
                </div>

                <h3 class="mt-4 font-bold text-lg text-slate-900">
                    যোগাযোগ
                </h3>

                <p class="mt-2 text-slate-600">
                    @if(isset($websiteSetting) && $websiteSetting->phone)
                        <span>ফোন: {{ $websiteSetting->phone }}</span>
                    @endif
                    @if(isset($websiteSetting) && $websiteSetting->mobile)
                        <br><span>মোবাইল: {{ $websiteSetting->mobile }}</span>
                    @endif
                </p>

            </div>


            <div class="p-7 rounded-2xl bg-white border border-slate-200 hover:border-brand-200 hover:shadow-md transition">

                <div class="w-12 h-12 rounded-xl bg-brand-50 border border-brand-100 text-brand-700 flex items-center justify-center text-2xl">
                    ✉️
                </div>

                <h3 class="mt-4 font-bold text-lg text-slate-900">
                    ই-মেইল
                </h3>

                <p class="mt-2 text-slate-600 break-all">
                    {{ $websiteSetting->email ?? '' }}
                </p>

            </div>

        </div>

    </div>

</section>

@endsection