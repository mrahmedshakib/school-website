{{-- =========================================================
    HEADER + NAVIGATION + NOTICE TICKER
========================================================= --}}

<header class="bg-white border-b border-slate-200">

    {{-- ================= HEADER ================= --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative min-h-[135px] flex items-center justify-center">

            {{-- Logo --}}
            <a href="{{ route('home') }}"
            class="absolute left-0 flex items-center justify-center">

                @if(isset($websiteSetting) && $websiteSetting->logo)
                    <img
                        src="{{ asset($websiteSetting->logo) }}"
                        alt="School Logo"
                        class="w-24 h-24 sm:w-28 sm:h-28 lg:w-32 lg:h-32
                            rounded-full object-cover
                            border-2 border-slate-200 shadow-sm"
                    >
                @else
                    <div class="w-24 h-24 sm:w-28 sm:h-28 lg:w-32 lg:h-32
                                rounded-full bg-slate-900 text-white
                                flex items-center justify-center
                                text-4xl sm:text-5xl font-bold
                                border-2 border-slate-200 shadow-sm">
                        S
                    </div>
                @endif

            </a>


            {{-- Center School Information --}}
            <div class="text-center px-32 sm:px-40">

                {{-- Bangla Name --}}
                <a href="{{ route('home') }}"
                class="block text-2xl sm:text-3xl lg:text-4xl
                        font-extrabold text-slate-900
                        leading-tight hover:text-blue-700 transition">

                    {{ $websiteSetting->school_name_bn
                        ?? $websiteSetting->school_name
                        ?? 'আমাদের বিদ্যালয়' }}

                </a>


                {{-- English Name --}}
                <a href="{{ route('home') }}"
                class="block mt-1 text-lg sm:text-xl lg:text-2xl
                        font-bold text-slate-700
                        leading-tight hover:text-blue-700 transition">

                    {{ $websiteSetting->school_name
                        ?? 'Our School' }}

                </a>


                {{-- Tagline --}}
                <p class="mt-2 text-sm sm:text-base text-slate-500">
                    {{ $websiteSetting->tagline
                        ?? 'শিক্ষা • শৃঙ্খলা • সাফল্য' }}
                </p>

            </div>

            {{-- ================= HEADER LANGUAGE TOGGLE ================= --}}
            <div class="absolute right-0 top-1/2 -translate-y-1/2 hidden md:flex items-center gap-2">
                @php $currentLocale = app()->getLocale(); @endphp
                <div class="inline-flex p-1 rounded-2xl bg-slate-100 border border-slate-200 shadow-sm">
                    <a href="{{ route('locale.switch', 'bn') }}"
                       class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ $currentLocale === 'bn' ? 'bg-indigo-600 text-white shadow' : 'text-slate-600 hover:text-slate-900' }}">
                        <span>🇧🇩</span>
                        <span>বাংলা</span>
                    </a>
                    <a href="{{ route('locale.switch', 'en') }}"
                       class="px-3.5 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1.5 {{ $currentLocale === 'en' ? 'bg-indigo-600 text-white shadow' : 'text-slate-600 hover:text-slate-900' }}">
                        <span>🇬🇧</span>
                        <span>English</span>
                    </a>
                </div>
            </div>

        </div>
    </div>


    {{-- ================= NAVIGATION ================= --}}
    <div class="border-t border-slate-200 bg-white">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Mobile Menu Button --}}
            <div class="lg:hidden py-3 flex items-center justify-between">

                <div class="flex items-center gap-2.5">
                    <span class="font-bold text-slate-800 text-sm">
                        {{ app()->getLocale() === 'en' ? 'MENU' : 'মেনু' }}
                    </span>
                    {{-- Quick Mobile Language Switcher --}}
                    @php $mobileLocale = app()->getLocale(); @endphp
                    <a href="{{ route('locale.switch', $mobileLocale === 'bn' ? 'en' : 'bn') }}"
                       class="px-2.5 py-1 rounded-lg bg-indigo-50 border border-indigo-200 text-xs font-extrabold text-indigo-700 flex items-center gap-1 shadow-sm active:scale-95">
                        <span>{{ $mobileLocale === 'bn' ? '🇬🇧 EN' : '🇧🇩 বাংলা' }}</span>
                    </a>
                </div>

                <button
                    id="mobile-menu-button"
                    type="button"
                    class="w-10 h-10 rounded-lg border border-slate-300
                           flex items-center justify-center
                           hover:bg-slate-100 transition"
                    aria-label="Open menu"
                >

                    {{-- Open --}}
                    <svg
                        id="menu-open-icon"
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>

                    {{-- Close --}}
                    <svg
                        id="menu-close-icon"
                        class="w-6 h-6 hidden"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>

                </button>

            </div>


            {{-- ================= DESKTOP MENU ================= --}}
            <nav class="hidden lg:flex items-center justify-center">

                <div class="flex items-center">

                    {{-- Home --}}
                    <a
                        href="{{ route('home') }}"
                        class="px-4 py-4 text-sm font-semibold text-slate-700
                               hover:text-blue-700 transition"
                    >
                        হোম
                    </a>


                    {{-- প্রতিষ্ঠান --}}
                    <div class="desktop-dropdown">

                        <button
                            type="button"
                            class="px-4 py-4 text-sm font-semibold text-slate-700
                                   hover:text-blue-700 transition flex items-center gap-1"
                        >
                            প্রতিষ্ঠান

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>

                        </button>

                        <div class="desktop-dropdown-menu absolute left-0 top-full z-50
                                    w-56 bg-white border border-slate-200
                                    rounded-b-lg shadow-xl">

                            <a href="{{ route('about') }}"
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                                আমাদের কথা
                            </a>

                            <a href="{{ route('mission-vision') }}"
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                                লক্ষ্য ও উদ্দেশ্য
                            </a>

                            <a href="{{ route('leadership') }}"
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                                নেতৃত্ব
                            </a>

                            <a href="{{ route('administration') }}"
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                                প্রশাসন
                            </a>

                        </div>

                    </div>


                    {{-- একাডেমিক --}}
                    <div class="desktop-dropdown">

                        <button
                            type="button"
                            class="px-4 py-4 text-sm font-semibold text-slate-700
                                   hover:text-blue-700 transition flex items-center gap-1"
                        >
                            একাডেমিক

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>

                        </button>

                        <div class="desktop-dropdown-menu absolute left-0 top-full z-50
                                    w-56 bg-white border border-slate-200
                                    rounded-b-lg shadow-xl">

                            <a href="{{ route('notice') }}"
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                                নোটিশ
                            </a>

                            <a href="{{ route('syllabus') }}"
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                                সিলেবাস
                            </a>

                            <a href="{{ route('class-routine') }}"
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                                ক্লাস রুটিন
                            </a>

                            <a href="{{ route('exam-routine') }}"
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                                পরীক্ষার রুটিন
                            </a>

                            <a href="{{ route('subjects') }}"
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                                বিষয়সমূহ
                            </a>

                            <a href="{{ route('results') }}"
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                                ফলাফল
                            </a>

                        </div>

                    </div>


                    {{-- শিক্ষক ও শিক্ষার্থী --}}
                    <div class="desktop-dropdown">

                        <button
                            type="button"
                            class="px-4 py-4 text-sm font-semibold text-slate-700
                                   hover:text-blue-700 transition flex items-center gap-1"
                        >
                            শিক্ষক ও শিক্ষার্থী

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>

                        </button>

                        <div class="desktop-dropdown-menu absolute left-0 top-full z-50
                                    w-60 bg-white border border-slate-200
                                    rounded-b-lg shadow-xl">

                            <a href="{{ route('teachers') }}"
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                                শিক্ষক
                            </a>

                            <a href="{{ route('staff') }}"
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                                কর্মচারী
                            </a>

                            <a href="{{ route('students') }}"
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                                শিক্ষার্থী
                            </a>

                            <a href="{{ route('student-list') }}"
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                                শিক্ষার্থী তালিকা
                            </a>

                            <a href="{{ route('result') }}"
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                                ফলাফল অনুসন্ধান
                            </a>

                        </div>

                    </div>


                    {{-- প্রকাশনা --}}
                    <div class="desktop-dropdown">

                        <button
                            type="button"
                            class="px-4 py-4 text-sm font-semibold text-slate-700
                                   hover:text-blue-700 transition flex items-center gap-1"
                        >
                            প্রকাশনা

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>

                        </button>

                        <div class="desktop-dropdown-menu absolute left-0 top-full z-50
                                    w-52 bg-white border border-slate-200
                                    rounded-b-lg shadow-xl">

                            <a href="{{ route('magazine') }}"
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                                ম্যাগাজিন
                            </a>

                            <a href="{{ route('publications') }}"
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                                প্রকাশনা
                            </a>

                        </div>

                    </div>


                    {{-- Gallery --}}
                    <div class="desktop-dropdown">

                        <button
                            type="button"
                            class="px-4 py-4 text-sm font-semibold text-slate-700
                                   hover:text-blue-700 transition flex items-center gap-1"
                        >
                            গ্যালারি

                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>

                        </button>

                        <div class="desktop-dropdown-menu absolute left-0 top-full z-50
                                    w-48 bg-white border border-slate-200
                                    rounded-b-lg shadow-xl">

                            <a href="{{ route('gallery') }}"
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                                ছবি
                            </a>

                            <a href="{{ route('video-gallery') }}"
                               class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100">
                                ভিডিও
                            </a>

                        </div>

                    </div>


                    {{-- Contact --}}
                    <a
                        href="{{ route('contact') }}"
                        class="px-4 py-4 text-sm font-semibold text-slate-700
                               hover:text-blue-700 transition"
                    >
                        যোগাযোগ
                    </a>


                    {{-- Admission Dropdown --}}
                    <div class="desktop-dropdown">
                        <button
                            type="button"
                            class="px-4 py-4 text-sm font-bold text-blue-700
                                   hover:text-blue-900 transition flex items-center gap-1.5"
                        >
                            <span>ভর্তি</span>
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-black bg-blue-100 text-blue-700 uppercase">
                                New
                            </span>
                            <svg
                                class="w-4 h-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 9l-7 7-7-7"
                                />
                            </svg>
                        </button>

                        <div class="desktop-dropdown-menu absolute right-0 top-full z-50
                                    w-64 bg-white border border-slate-200
                                    rounded-b-2xl shadow-xl py-1.5 divide-y divide-slate-100">
                            <div class="py-1">
                                <a href="{{ route('admission') }}"
                                   class="block px-4 py-2.5 text-xs text-slate-700 hover:bg-slate-50 font-medium">
                                    📢 {{ __('ভর্তি বিজ্ঞপ্তি ও নির্দেশাবলী') }}
                                </a>
                                <a href="{{ route('online-admission') }}"
                                   class="block px-4 py-2.5 text-xs text-blue-700 hover:bg-blue-50 font-bold">
                                    📝 {{ __('অনলাইনে আবেদন ফরম') }}
                                </a>
                                <a href="{{ route('admission-fee') }}"
                                   class="block px-4 py-2.5 text-xs text-slate-700 hover:bg-slate-50 font-medium">
                                    💳 {{ __('ভর্তি ফি পরিশোধ (SSLCOMMERZ/MFS)') }}
                                </a>
                            </div>
                            <div class="py-1">
                                <a href="{{ route('online-admission.download') }}"
                                   class="block px-4 py-2.5 text-xs text-indigo-700 hover:bg-indigo-50 font-semibold">
                                    📥 {{ __('আবেদন ও প্রবেশপত্র রি-ডাউনলোড') }}
                                </a>
                                <a href="{{ route('admission.lottery') }}"
                                   class="block px-4 py-2.5 text-xs text-emerald-700 hover:bg-emerald-50 font-semibold">
                                    🏆 {{ __('ডিজিটাল লটারি ও রেজাল্ট') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Quick Language Toggle in Navbar --}}
                    @php $navLocale = app()->getLocale(); @endphp
                    <a href="{{ route('locale.switch', $navLocale === 'bn' ? 'en' : 'bn') }}"
                       class="ml-3 px-3 py-1.5 rounded-full border border-indigo-200 bg-indigo-50/70 hover:bg-indigo-100 text-indigo-700 text-xs font-black transition flex items-center gap-1 shadow-sm active:scale-95"
                       title="{{ $navLocale === 'bn' ? 'Switch to English' : 'বাংলায় দেখুন' }}">
                        <span>🌐</span>
                        <span>{{ $navLocale === 'bn' ? 'EN' : 'বাং' }}</span>
                    </a>

                </div>

            </nav>


            {{-- ================= MOBILE MENU ================= --}}
            <div
                id="mobile-menu"
                class="hidden lg:hidden border-t border-slate-200 pb-4"
            >

                <a href="{{ route('home') }}"
                   class="block py-3 border-b border-slate-100 font-semibold">
                    হোম
                </a>


                {{-- Mobile Institution --}}
                <div>

                    <button
                        type="button"
                        data-mobile-dropdown="institution"
                        class="w-full flex items-center justify-between py-3
                               border-b border-slate-100 font-semibold"
                    >
                        <span>প্রতিষ্ঠান</span>

                        <svg
                            class="w-4 h-4 transition-transform"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>
                    </button>

                    <div id="mobile-dropdown-institution" class="hidden pl-4">

                        <a href="{{ route('about') }}" class="block py-2 text-sm text-slate-600">
                            আমাদের কথা
                        </a>

                        <a href="{{ route('mission-vision') }}" class="block py-2 text-sm text-slate-600">
                            লক্ষ্য ও উদ্দেশ্য
                        </a>

                        <a href="{{ route('leadership') }}" class="block py-2 text-sm text-slate-600">
                            নেতৃত্ব
                        </a>

                        <a href="{{ route('administration') }}" class="block py-2 text-sm text-slate-600">
                            প্রশাসন
                        </a>

                    </div>

                </div>


                {{-- Mobile Academic --}}
                <div>

                    <button
                        type="button"
                        data-mobile-dropdown="academic"
                        class="w-full flex items-center justify-between py-3
                               border-b border-slate-100 font-semibold"
                    >
                        <span>একাডেমিক</span>

                        <svg
                            class="w-4 h-4 transition-transform"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>
                    </button>

                    <div id="mobile-dropdown-academic" class="hidden pl-4">

                        <a href="{{ route('notice') }}" class="block py-2 text-sm text-slate-600">
                            নোটিশ
                        </a>

                        <a href="{{ route('syllabus') }}" class="block py-2 text-sm text-slate-600">
                            সিলেবাস
                        </a>

                        <a href="{{ route('class-routine') }}" class="block py-2 text-sm text-slate-600">
                            ক্লাস রুটিন
                        </a>

                        <a href="{{ route('exam-routine') }}" class="block py-2 text-sm text-slate-600">
                            পরীক্ষার রুটিন
                        </a>

                        <a href="{{ route('subjects') }}" class="block py-2 text-sm text-slate-600">
                            বিষয়সমূহ
                        </a>

                        <a href="{{ route('results') }}" class="block py-2 text-sm text-slate-600">
                            ফলাফল
                        </a>

                    </div>

                </div>


                {{-- Mobile Teacher & Student --}}
                <div>

                    <button
                        type="button"
                        data-mobile-dropdown="people"
                        class="w-full flex items-center justify-between py-3
                               border-b border-slate-100 font-semibold"
                    >
                        <span>শিক্ষক ও শিক্ষার্থী</span>

                        <svg
                            class="w-4 h-4 transition-transform"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>
                    </button>

                    <div id="mobile-dropdown-people" class="hidden pl-4">

                        <a href="{{ route('teachers') }}" class="block py-2 text-sm text-slate-600">
                            শিক্ষক
                        </a>

                        <a href="{{ route('staff') }}" class="block py-2 text-sm text-slate-600">
                            কর্মচারী
                        </a>

                        <a href="{{ route('students') }}" class="block py-2 text-sm text-slate-600">
                            শিক্ষার্থী
                        </a>

                        <a href="{{ route('student-list') }}" class="block py-2 text-sm text-slate-600">
                            শিক্ষার্থী তালিকা
                        </a>

                        <a href="{{ route('result') }}" class="block py-2 text-sm text-slate-600">
                            ফলাফল অনুসন্ধান
                        </a>

                    </div>

                </div>


                {{-- Mobile Publication --}}
                <div>

                    <button
                        type="button"
                        data-mobile-dropdown="publication"
                        class="w-full flex items-center justify-between py-3
                               border-b border-slate-100 font-semibold"
                    >
                        <span>প্রকাশনা</span>

                        <svg
                            class="w-4 h-4 transition-transform"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>
                    </button>

                    <div id="mobile-dropdown-publication" class="hidden pl-4">

                        <a href="{{ route('magazine') }}" class="block py-2 text-sm text-slate-600">
                            ম্যাগাজিন
                        </a>

                        <a href="{{ route('publications') }}" class="block py-2 text-sm text-slate-600">
                            প্রকাশনা
                        </a>

                    </div>

                </div>


                {{-- Mobile Gallery --}}
                <div>

                    <button
                        type="button"
                        data-mobile-dropdown="gallery"
                        class="w-full flex items-center justify-between py-3
                               border-b border-slate-100 font-semibold"
                    >
                        <span>গ্যালারি</span>

                        <svg
                            class="w-4 h-4 transition-transform"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>

                    </button>

                    <div id="mobile-dropdown-gallery" class="hidden pl-4">

                        <a href="{{ route('gallery') }}" class="block py-2 text-sm text-slate-600">
                            ছবি
                        </a>

                        <a href="{{ route('video-gallery') }}" class="block py-2 text-sm text-slate-600">
                            ভিডিও
                        </a>

                    </div>

                </div>


                <a href="{{ route('contact') }}"
                   class="block py-3 border-b border-slate-100 font-semibold">
                    যোগাযোগ
                </a>

                {{-- Mobile Admission --}}
                <div>
                    <button
                        type="button"
                        data-mobile-dropdown="admission"
                        class="w-full flex items-center justify-between py-3
                               border-b border-slate-100 font-bold text-blue-700"
                    >
                        <span class="flex items-center gap-2">
                            <span>ভর্তি</span>
                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-black bg-blue-100 text-blue-700 uppercase">New</span>
                        </span>

                        <svg
                            class="w-4 h-4 transition-transform"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>
                    </button>

                    <div id="mobile-dropdown-admission" class="hidden pl-4">
                        <a href="{{ route('admission') }}" class="block py-2 text-sm text-slate-700">
                            📢 {{ __('ভর্তি বিজ্ঞপ্তি ও নির্দেশাবলী') }}
                        </a>
                        <a href="{{ route('online-admission') }}" class="block py-2 text-sm font-bold text-blue-700">
                            📝 {{ __('অনলাইনে আবেদন ফরম') }}
                        </a>
                        <a href="{{ route('admission-fee') }}" class="block py-2 text-sm text-slate-700">
                            💳 {{ __('ভর্তি ফি পরিশোধ (SSLCOMMERZ/MFS)') }}
                        </a>
                        <a href="{{ route('online-admission.download') }}" class="block py-2 text-sm font-semibold text-indigo-700">
                            📥 {{ __('আবেদন ও প্রবেশপত্র রি-ডাউনলোড') }}
                        </a>
                        <a href="{{ route('admission.lottery') }}" class="block py-2 text-sm font-semibold text-emerald-700">
                            🏆 {{ __('ডিজিটাল লটারি ও রেজাল্ট') }}
                        </a>
                    </div>
                </div>

                {{-- Mobile Language Selection Bar --}}
                <div class="mt-4 pt-4 border-t border-slate-200">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">ভাষা নির্বাচন / Select Language</p>
                    <div class="grid grid-cols-2 gap-2">
                        @php $mLocale = app()->getLocale(); @endphp
                        <a href="{{ route('locale.switch', 'bn') }}"
                           class="py-2.5 px-3 rounded-xl text-center text-xs font-bold transition flex items-center justify-center gap-1.5 {{ $mLocale === 'bn' ? 'bg-indigo-600 text-white shadow' : 'bg-slate-100 text-slate-700' }}">
                            <span>🇧🇩</span>
                            <span>বাংলা</span>
                        </a>
                        <a href="{{ route('locale.switch', 'en') }}"
                           class="py-2.5 px-3 rounded-xl text-center text-xs font-bold transition flex items-center justify-center gap-1.5 {{ $mLocale === 'en' ? 'bg-indigo-600 text-white shadow' : 'bg-slate-100 text-slate-700' }}">
                            <span>🇬🇧</span>
                            <span>English</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>

</header>


{{-- =========================================================
    LATEST NOTICE TICKER
========================================================= --}}

<section class="bg-slate-900 text-white overflow-hidden">
    <div class="max-w-7xl mx-auto flex items-stretch">

        {{-- Label --}}
        <div class="shrink-0 bg-red-600 px-4 sm:px-6 flex items-center gap-2
                    text-sm sm:text-base font-semibold relative z-10 shadow-lg">
            <span class="text-lg">🔔</span>
            <span>সর্বশেষ নোটিশ</span>
        </div>

        {{-- Ticker --}}
        <div class="relative overflow-hidden flex-1 min-w-0">

            @if(isset($latestNotices) && $latestNotices->count() > 0)

                <div class="notice-track">

                    {{-- First Set --}}
                    <div class="notice-content">
                        @foreach($latestNotices as $item)
                            <a href="{{ route('notice') }}"
                               class="notice-item">
                                <span>{{ $item->title }}</span>

                                @if($item->notice_date)
                                    <span class="text-xs text-slate-400">
                                        {{ $item->notice_date->format('d-m-Y') }}
                                    </span>
                                @endif
                            </a>

                            <span class="notice-separator">•</span>
                        @endforeach
                    </div>

                    {{-- Duplicate Set for Seamless Loop --}}
                    <div class="notice-content" aria-hidden="true">
                        @foreach($latestNotices as $item)
                            <a href="{{ route('notice') }}"
                               class="notice-item">
                                <span>{{ $item->title }}</span>

                                @if($item->notice_date)
                                    <span class="text-xs text-slate-400">
                                        {{ $item->notice_date->format('d-m-Y') }}
                                    </span>
                                @endif
                            </a>

                            <span class="notice-separator">•</span>
                        @endforeach
                    </div>

                </div>

            @else

                <div class="min-h-[48px] flex items-center px-6
                            text-sm sm:text-base text-slate-400">
                    বর্তমানে কোনো নতুন নোটিশ প্রকাশিত হয়নি।
                </div>

            @endif

        </div>
    </div>
</section>
<style>
    .notice-track {
        display: flex;
        width: max-content;
        min-height: 48px;
        align-items: center;

        animation: noticeScroll 50s linear infinite;

        will-change: transform;
    }

    .notice-content {
        display: flex;
        align-items: center;
        flex-shrink: 0;
    }

    .notice-item {
        display: inline-flex;
        align-items: center;
        gap: 12px;

        padding: 12px 20px;

        white-space: nowrap;

        font-size: 14px;
        color: #ffffff;

        transition: color 0.2s ease;
    }

    .notice-item:hover {
        color: #fde047;
    }

    .notice-separator {
        color: #64748b;
        padding: 0 5px;
    }

    @keyframes noticeScroll {

        from {
            transform: translateX(0);
        }

        to {
            transform: translateX(-50%);
        }

    }

    /* Mobile */
    @media (max-width: 640px) {

        .notice-track {
            animation-duration: 40s;
        }

        .notice-item {
            padding: 12px 14px;
            font-size: 13px;
        }

    }
</style>


{{-- =========================================================
    NAVBAR CSS
========================================================= --}}

<style>

    /* Desktop Dropdown */

    .desktop-dropdown {
        position: relative;
    }

    .desktop-dropdown-menu {
        visibility: hidden;
        opacity: 0;
        transform: translateY(8px);
        transition: all 0.2s ease;
        pointer-events: none;
    }

    .desktop-dropdown:hover .desktop-dropdown-menu {
        visibility: visible;
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }


    /* Mobile Dropdown */

    .mobile-submenu {
        transition: all 0.2s ease;
    }


    /* Notice Marquee */

    @keyframes school-marquee {

        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }

    }

    .school-marquee {
        animation: school-marquee 25s linear infinite;
    }

    .school-marquee:hover {
        animation-play-state: paused;
    }

</style>


{{-- =========================================================
    MOBILE MENU JS
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const menuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    const openIcon = document.getElementById('menu-open-icon');
    const closeIcon = document.getElementById('menu-close-icon');


    /* Mobile Main Menu */

    if (menuButton && mobileMenu) {

        menuButton.addEventListener('click', function () {

            const isHidden = mobileMenu.classList.contains('hidden');

            mobileMenu.classList.toggle('hidden');

            if (isHidden) {

                openIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');

            } else {

                openIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');

            }

        });

    }


    /* Mobile Dropdown */

    document
        .querySelectorAll('[data-mobile-dropdown]')
        .forEach(function (button) {

            button.addEventListener('click', function () {

                const name = this.dataset.mobileDropdown;

                const dropdown =
                    document.getElementById(
                        'mobile-dropdown-' + name
                    );

                if (!dropdown) {
                    return;
                }

                dropdown.classList.toggle('hidden');

                const icon = this.querySelector('svg');

                if (icon) {
                    icon.classList.toggle('rotate-180');
                }

            });

        });


    /* Close menu after clicking link */

    document
        .querySelectorAll('#mobile-menu a')
        .forEach(function (link) {

            link.addEventListener('click', function () {

                mobileMenu.classList.add('hidden');

                if (openIcon) {
                    openIcon.classList.remove('hidden');
                }

                if (closeIcon) {
                    closeIcon.classList.add('hidden');
                }

            });

        });

});

</script>