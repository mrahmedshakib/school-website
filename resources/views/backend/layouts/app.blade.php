<!DOCTYPE html>
<html lang="bn" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - {{ $websiteSetting?->school_name ?? config('app.name', 'School') }}</title>
    @php
        $faviconIco = asset('favicon.ico');
        $faviconPng = asset('favicon-32x32.png');
        $appleTouch = asset('apple-touch-icon.png');

        if (!empty($websiteSetting?->favicon)) {
            if (file_exists(public_path($websiteSetting->favicon))) {
                $customFav = asset($websiteSetting->favicon);
                if (str_ends_with(strtolower($websiteSetting->favicon), '.ico')) {
                    $faviconIco = $customFav;
                } else {
                    $faviconPng = $customFav;
                }
            } elseif (file_exists(public_path('storage/' . $websiteSetting->favicon))) {
                $customFav = asset('storage/' . $websiteSetting->favicon);
                if (str_ends_with(strtolower($websiteSetting->favicon), '.ico')) {
                    $faviconIco = $customFav;
                } else {
                    $faviconPng = $customFav;
                }
            }
        }
        if (!empty($websiteSetting?->logo) && file_exists(public_path($websiteSetting->logo))) {
            $appleTouch = asset($websiteSetting->logo);
        }

        $unreadMsgCount = \App\Models\ContactMessage::where('is_read', 0)->count();
        $pendingAppCount = \App\Models\AdmissionApplication::where('status', 'pending')->count();

        $isInstituteActive = request()->routeIs('admin.abouts.*') || request()->routeIs('admin.mission-visions.*') || request()->routeIs('admin.administrations.*') || request()->routeIs('admin.teachers.*');
        $isAcademicActive = request()->routeIs('admin.students.*') || request()->routeIs('admin.subjects.*') || request()->routeIs('admin.class-routines.*') || request()->routeIs('admin.exam-routines.*') || request()->routeIs('admin.syllabuses.*') || request()->routeIs('admin.exam-results.*') || request()->routeIs('admin.student-marks.*');
        $isAdmissionsActive = request()->routeIs('admin.admissions.*') || request()->routeIs('admin.admission-applications.*') || request()->routeIs('admin.admission-lottery.*') || request()->routeIs('admin.admission-payments.*');
        $isMediaActive = request()->routeIs('admin.sliders.*') || request()->routeIs('admin.notices.*') || request()->routeIs('admin.news.*') || request()->routeIs('admin.events.*') || request()->routeIs('admin.galleries.*') || request()->routeIs('admin.video-galleries.*') || request()->routeIs('admin.publications.*');
        $isCommActive = request()->routeIs('admin.contact-messages.*');

        $currentSection = 'Overview';
        if ($isInstituteActive) {
            $currentSection = 'Institute';
        } elseif ($isAcademicActive) {
            $currentSection = 'Academic Hub';
        } elseif ($isAdmissionsActive) {
            $currentSection = 'Admissions';
        } elseif ($isMediaActive) {
            $currentSection = 'Content & Media';
        } elseif ($isCommActive) {
            $currentSection = 'Communication';
        } elseif (request()->routeIs('admin.settings.*')) {
            $currentSection = 'Settings';
        }
    @endphp
    <link rel="icon" type="image/x-icon" href="{{ $faviconIco }}">
    <link rel="shortcut icon" href="{{ $faviconIco }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $faviconPng }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ $appleTouch }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @font-face {
            font-family: 'Kalpurush';
            src: url('{{ asset("fonts/Kalpurush/kalpurush.ttf") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
        body, button, input, select, textarea {
            font-family: 'Plus Jakarta Sans', 'Hind Siliguri', 'Kalpurush', sans-serif;
        }
        /* Custom Scrollbar for sidebar */
        .admin-scrollbar::-webkit-scrollbar {
            width: 5px;
        }
        .admin-scrollbar::-webkit-scrollbar-track {
            background: rgba(15, 23, 42, 0.5);
        }
        .admin-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(51, 65, 85, 0.8);
            border-radius: 9999px;
        }
        .admin-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(16, 185, 129, 0.8);
        }
        .nav-item-active {
            background: linear-gradient(135deg, #059669 0%, #0d9488 100%);
            color: #ffffff !important;
            box-shadow: 0 4px 14px -1px rgba(5, 150, 105, 0.4);
            font-weight: 600;
        }
    </style>
    @stack('styles')
</head>
<body class="h-full bg-slate-50 text-slate-800 antialiased selection:bg-emerald-500 selection:text-white">
<div class="min-h-screen flex flex-col lg:flex-row">

    {{-- MOBILE OVERLAY --}}
    <div id="sidebarOverlay"
         onclick="toggleSidebar()"
         class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity">
    </div>

    {{-- SIDEBAR CONTAINER --}}
    <aside id="sidebar"
           class="fixed lg:sticky top-0 inset-y-0 left-0 z-50 w-72 h-screen shrink-0 bg-slate-950 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col border-r border-slate-800/80 shadow-2xl lg:shadow-none select-none">

        {{-- Top Brand / School Logo Header --}}
        <div class="h-20 px-5 flex items-center justify-between border-b border-slate-800/80 bg-slate-950/95 backdrop-blur-md shrink-0">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group min-w-0">
                @if(!empty($websiteSetting?->logo) && file_exists(public_path($websiteSetting->logo)))
                    <div class="w-11 h-11 rounded-2xl p-1 bg-white/10 ring-1 ring-white/10 shrink-0 flex items-center justify-center group-hover:scale-105 transition-transform duration-200">
                        <img src="{{ asset($websiteSetting->logo) }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                @else
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-700 flex items-center justify-center font-black text-white text-lg shadow-lg shadow-emerald-950/40 shrink-0 group-hover:scale-105 transition-transform duration-200">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        </svg>
                    </div>
                @endif
                <div class="min-w-0">
                    <h1 class="font-bold text-sm tracking-tight text-white truncate group-hover:text-emerald-400 transition-colors" title="{{ $websiteSetting?->school_name ?? 'School Management' }}">
                        {{ $websiteSetting?->school_name ?? 'School Admin' }}
                    </h1>
                    <div class="flex items-center gap-1.5 mt-0.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Control Panel</p>
                    </div>
                </div>
            </a>

            {{-- Close button on mobile --}}
            <button type="button"
                    onclick="toggleSidebar()"
                    class="lg:hidden p-2 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Instant Menu Search / Filter --}}
        <div class="px-3.5 pt-3 pb-2 shrink-0">
            <div class="relative">
                <input type="text"
                       id="adminMenuSearch"
                       oninput="filterAdminMenu(this.value)"
                       placeholder="Filter menu / মেনু খুঁজুন..."
                       class="w-full pl-9 pr-7 py-2 bg-slate-900 text-xs text-white placeholder-slate-400 rounded-xl border border-slate-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 focus:outline-hidden transition-all duration-200">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <button type="button"
                        id="clearMenuSearch"
                        onclick="document.getElementById('adminMenuSearch').value=''; filterAdminMenu(''); this.classList.add('hidden');"
                        class="hidden absolute right-2.5 top-2.5 text-slate-400 hover:text-white transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Navigation Menu --}}
        <nav id="adminNavList" class="flex-1 overflow-y-auto px-3.5 py-2 space-y-6 admin-scrollbar text-sm">

            {{-- 1. OVERVIEW & CORE --}}
            <div class="menu-section">
                <p class="section-title px-3 mb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                    Main / ওভারভিউ
                </p>
                <div class="space-y-1">
                    {{-- Dashboard --}}
                    <a href="{{ route('admin.dashboard') }}"
                       data-keywords="dashboard ড্যাশবোর্ড হোম overview"
                       class="menu-link flex items-center justify-between px-3.5 py-2.5 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.dashboard') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0h6"/>
                            </svg>
                            <span>Dashboard</span>
                        </div>
                        @if(request()->routeIs('admin.dashboard'))
                            <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                        @endif
                    </a>

                    {{-- Settings --}}
                    <a href="{{ route('admin.settings.edit') }}"
                       data-keywords="website settings সেটিংস branding logo তথ্য"
                       class="menu-link flex items-center justify-between px-3.5 py-2.5 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.settings.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Website Settings</span>
                        </div>
                        @if(request()->routeIs('admin.settings.*'))
                            <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                        @endif
                    </a>
                </div>
            </div>

            {{-- 2. INSTITUTE --}}
            <div class="menu-section">
                <p class="section-title px-3 mb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                    Institute / প্রতিষ্ঠান পরিচিতি
                </p>
                <div class="space-y-1">
                    <a href="{{ route('admin.abouts.index') }}"
                       data-keywords="about school প্রতিষ্ঠান পরিচিতি মূল তথ্য"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.abouts.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span>About School</span>
                    </a>

                    <a href="{{ route('admin.mission-visions.index') }}"
                       data-keywords="mission vision লক্ষ্য উদ্দেশ্য"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.mission-visions.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>Mission & Vision</span>
                    </a>

                    <a href="{{ route('admin.administrations.index') }}"
                       data-keywords="administration গভর্নিং বডি কমিটি পরিচালনা"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.administrations.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>Administration</span>
                    </a>

                    <a href="{{ route('admin.teachers.index') }}"
                       data-keywords="teachers staff শিক্ষক কর্মচারী অনুষদ"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.teachers.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span>Teachers & Staff</span>
                    </a>
                </div>
            </div>

            {{-- 3. ACADEMIC HUB --}}
            <div class="menu-section">
                <p class="section-title px-3 mb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                    Academic / একাডেমিক ও শিক্ষার্থী
                </p>
                <div class="space-y-1">
                    <a href="{{ route('admin.students.index') }}"
                       data-keywords="students enrolled শিক্ষার্থী ছাত্র ছাত্রী"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.students.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Enrolled Students</span>
                    </a>

                    <a href="{{ route('admin.subjects.index') }}"
                       data-keywords="subjects বিষয় পাঠ্যবই"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.subjects.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span>Academic Subjects</span>
                    </a>

                    <a href="{{ route('admin.class-routines.index') }}"
                       data-keywords="class routines ক্লাস রুটিন সময়সূচি"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.class-routines.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Class Routines</span>
                    </a>

                    <a href="{{ route('admin.exam-routines.index') }}"
                       data-keywords="exam routines পরীক্ষার রুটিন পরীক্ষা"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.exam-routines.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Exam Routines</span>
                    </a>

                    <a href="{{ route('admin.syllabuses.index') }}"
                       data-keywords="syllabuses সিলেবাস পাঠ্যক্রম"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.syllabuses.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Syllabuses</span>
                    </a>

                    <a href="{{ route('admin.exam-results.index') }}"
                       data-keywords="exam results গেজেট ফলাফল রেজাল্ট"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.exam-results.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <span>Result Gazettes</span>
                    </a>

                    <a href="{{ route('admin.student-marks.index') }}"
                       data-keywords="student marks marksheets নম্বরপত্র মার্কশিট"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.student-marks.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span>Student Marksheets</span>
                    </a>
                </div>
            </div>

            {{-- 4. ADMISSIONS --}}
            <div class="menu-section">
                <p class="section-title px-3 mb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                    Admissions / ভর্তি কার্যক্রম
                </p>
                <div class="space-y-1">
                    <a href="{{ route('admin.admissions.index') }}"
                       data-keywords="admission circulars ভর্তি বিজ্ঞপ্তি সার্কুলার"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.admissions.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span>Admission Circulars</span>
                    </a>

                    <a href="{{ route('admin.admission-applications.index') }}"
                       data-keywords="admission applications অনলাইন আবেদন ভর্তি ফরম"
                       class="menu-link flex items-center justify-between px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.admission-applications.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <div class="flex items-center gap-3 min-w-0">
                            <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="truncate">Online Applications</span>
                        </div>
                        @if($pendingAppCount > 0)
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-400 text-slate-950 shrink-0">
                                {{ $pendingAppCount }}
                            </span>
                        @endif
                    </a>

                    <a href="{{ route('admin.admission-lottery.index') }}"
                       data-keywords="lottery merit draw লটারি ড্র মেধা তালিকা"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.admission-lottery.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <span>Lottery & Merit Draw</span>
                    </a>

                    <a href="{{ route('admin.admission-payments.index') }}"
                       data-keywords="admission payments ফি পেমেন্ট টাকা রশিদ"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.admission-payments.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                        <span>Admission Payments</span>
                    </a>
                </div>
            </div>

            {{-- 5. CONTENT & MEDIA --}}
            <div class="menu-section">
                <p class="section-title px-3 mb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                    Content & Media / কনটেন্ট ও মিডিয়া
                </p>
                <div class="space-y-1">
                    <a href="{{ route('admin.sliders.index') }}"
                       data-keywords="sliders banners ব্যানার স্লাইডার ছবি"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.sliders.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Slider & Banners</span>
                    </a>

                    <a href="{{ route('admin.notices.index') }}"
                       data-keywords="notice board নোটিশ বোর্ড ঘোষণা"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.notices.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span>Notice Board</span>
                    </a>

                    <a href="{{ route('admin.news.index') }}"
                       data-keywords="news articles সংবাদ খবর"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.news.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <span>News & Articles</span>
                    </a>

                    <a href="{{ route('admin.events.index') }}"
                       data-keywords="events programs ইভেন্ট অনুষ্ঠান কর্মসূচি"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.events.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Events & Programs</span>
                    </a>

                    <a href="{{ route('admin.galleries.index') }}"
                       data-keywords="photo gallery ছবি গ্যালারি ফটোগ্রাফি"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.galleries.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Photo Gallery</span>
                    </a>

                    <a href="{{ route('admin.video-galleries.index') }}"
                       data-keywords="video gallery ভিডিও গ্যালারি ইউটিউব"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.video-galleries.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        <span>Video Gallery</span>
                    </a>

                    <a href="{{ route('admin.publications.index') }}"
                       data-keywords="publications magazines প্রকাশনা ম্যাগাজিন স্মরণিকা"
                       class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.publications.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span>Magazines & Publications</span>
                    </a>
                </div>
            </div>

            {{-- 6. COMMUNICATION --}}
            <div class="menu-section">
                <p class="section-title px-3 mb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                    Communication / যোগাযোগ
                </p>
                <div class="space-y-1">
                    @if(Route::has('admin.contact-messages.index'))
                        <a href="{{ route('admin.contact-messages.index') }}"
                           data-keywords="contact messages যোগাযোগ বার্তা ইনবক্স এসএমএস"
                           class="menu-link flex items-center justify-between px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.contact-messages.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                            <div class="flex items-center gap-3 min-w-0">
                                <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>Contact Messages</span>
                            </div>
                            @if($unreadMsgCount > 0)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-400 text-slate-950 shrink-0">
                                    {{ $unreadMsgCount }}
                                </span>
                            @endif
                        </a>
                    @endif

                    @if(Route::has('admin.downloads.index'))
                        <a href="{{ route('admin.downloads.index') }}"
                           data-keywords="downloads ডাউনলোড ফাইল ফরম"
                           class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.downloads.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            <span>Downloads</span>
                        </a>
                    @endif

                    @if(Route::has('admin.important-links.index'))
                        <a href="{{ route('admin.important-links.index') }}"
                           data-keywords="important links গুরুত্বপূর্ণ লিংক ওয়েব"
                           class="menu-link flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.important-links.*') ? 'nav-item-active' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                            <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                            </svg>
                            <span>Important Links</span>
                        </a>
                    @endif
                </div>
            </div>

        </nav>

        {{-- Sidebar Footer / User Profile Card --}}
        <div class="p-3.5 border-t border-slate-800/80 bg-slate-950/95 backdrop-blur-sm shrink-0">
            <div class="flex items-center justify-between gap-3 p-2 rounded-2xl bg-slate-900/80 border border-slate-800/80">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-400 text-white font-black flex items-center justify-center text-sm shadow-md shrink-0">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-white truncate">
                            {{ auth()->user()->name ?? 'Administrator' }}
                        </p>
                        <p class="text-[10px] font-semibold text-emerald-400 truncate">
                            {{ auth()->user()->roleName() }}
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Do you want to log out?');">
                    @csrf
                    <button type="submit" title="Logout" class="p-2 rounded-xl text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 transition-colors cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- MAIN CONTENT AREA --}}
    <div class="flex-1 min-w-0 flex flex-col bg-slate-50 min-h-screen">

        {{-- TOPBAR HEADER --}}
        <header class="h-20 bg-white/90 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-30 px-4 sm:px-6 lg:px-8 flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-3.5 sm:gap-4 min-w-0">
                {{-- Mobile Menu Trigger --}}
                <button type="button"
                        onclick="toggleSidebar()"
                        class="lg:hidden p-2.5 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <div class="min-w-0">
                    <div class="hidden sm:flex items-center gap-1.5 text-[11px] font-semibold text-slate-400">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-600 transition-colors">Admin</a>
                        <span>/</span>
                        <span class="text-slate-600 font-bold">{{ $currentSection }}</span>
                    </div>
                    <h2 class="text-lg sm:text-xl font-black text-slate-900 tracking-tight flex items-center gap-2 truncate">
                        @hasSection('page_title')
                            @yield('page_title')
                        @else
                            @yield('title', 'Admin Dashboard')
                        @endif
                    </h2>
                </div>
            </div>

            {{-- Right Actions --}}
            <div class="flex items-center gap-2.5 sm:gap-4 shrink-0">

                {{-- Visit Live Website Button --}}
                <a href="{{ url('/') }}" target="_blank"
                   class="inline-flex items-center gap-2 px-3 sm:px-4 py-2 rounded-xl text-xs sm:text-sm font-bold text-emerald-700 bg-emerald-50 hover:bg-emerald-100/80 border border-emerald-200/80 transition-all shadow-xs group">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="hidden sm:inline">Visit Website</span>
                    <span class="sm:hidden">Site</span>
                    <svg class="w-3.5 h-3.5 text-emerald-600 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>

                {{-- Quick Alerts: Pending Applications Pill --}}
                @if($pendingAppCount > 0)
                    <a href="{{ route('admin.admission-applications.index') }}"
                       class="hidden md:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-amber-50 text-amber-700 hover:bg-amber-100 border border-amber-200/80 text-xs font-bold transition shadow-xs"
                       title="{{ $pendingAppCount }} Pending Applications">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                        <span>{{ $pendingAppCount }} Apps</span>
                    </a>
                @endif

                {{-- Quick Alerts: Unread Messages Pill --}}
                @if($unreadMsgCount > 0)
                    <a href="{{ route('admin.contact-messages.index') }}"
                       class="inline-flex items-center gap-1.5 px-2.5 sm:px-3 py-1.5 rounded-xl bg-teal-50 text-teal-700 hover:bg-teal-100 border border-teal-200/80 text-xs font-bold transition shadow-xs"
                       title="{{ $unreadMsgCount }} New Messages">
                        <svg class="w-3.5 h-3.5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $unreadMsgCount }}</span>
                    </a>
                @endif

                {{-- Date / Clock indicator --}}
                <div class="hidden xl:flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-slate-100/80 border border-slate-200/60 text-xs font-semibold text-slate-600">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ now()->format('d M, Y') }}</span>
                </div>

                {{-- User Profile Chip & Logout --}}
                <div class="flex items-center gap-2.5 pl-2 sm:pl-3 border-l border-slate-200">
                    <div class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white font-bold flex items-center justify-center text-sm shadow-xs">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </div>
                        <div class="hidden md:block text-left">
                            <span class="block text-xs font-bold text-slate-800 leading-tight">
                                {{ auth()->user()->name ?? 'Admin' }}
                            </span>
                            <span class="block text-[10px] text-emerald-600 font-semibold mt-0.5 truncate max-w-[120px]">
                                {{ auth()->user()->roleName() }}
                            </span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Do you want to log out?');" class="inline">
                        @csrf
                        <button type="submit" title="Logout" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>

            </div>
        </header>

        {{-- PAGE MAIN CONTAINER --}}
        <main class="flex-1 p-4 sm:p-6 lg:p-8 min-w-0">

            {{-- Flash Notification: Success --}}
            @if(session('success'))
                <div class="flash-alert mb-6 flex items-start gap-3.5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-950 shadow-xs">
                    <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-sm mt-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-bold text-emerald-900">Success / সফল হয়েছে</h4>
                        <p class="text-xs sm:text-sm text-emerald-800 mt-0.5 leading-relaxed">{{ session('success') }}</p>
                    </div>
                    <button type="button" onclick="this.closest('.flash-alert').remove()" class="p-1 rounded-lg text-emerald-600 hover:bg-emerald-100 transition cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            {{-- Flash Notification: Error --}}
            @if(session('error'))
                <div class="flash-alert mb-6 flex items-start gap-3.5 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-950 shadow-xs">
                    <div class="w-8 h-8 rounded-xl bg-rose-600 text-white flex items-center justify-center shrink-0 shadow-sm mt-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-bold text-rose-900">Error / সতর্কতা</h4>
                        <p class="text-xs sm:text-sm text-rose-800 mt-0.5 leading-relaxed">{{ session('error') }}</p>
                    </div>
                    <button type="button" onclick="this.closest('.flash-alert').remove()" class="p-1 rounded-lg text-rose-600 hover:bg-rose-100 transition cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="py-4 px-6 border-t border-slate-200/70 bg-white/70 backdrop-blur text-xs text-slate-500 flex flex-col sm:flex-row items-center justify-between gap-3 mt-auto">
            <div>
                &copy; {{ date('Y') }} <span class="font-bold text-slate-800">{{ $websiteSetting?->school_name ?? 'School' }}</span> Management Portal. All rights reserved.
            </div>
            <div class="flex items-center gap-3 text-[11px] text-slate-400">
                <span class="inline-flex items-center gap-1.5 text-emerald-600 font-semibold">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    System Active
                </span>
                <span>•</span>
                <span>Control Center</span>
            </div>
        </footer>
    </div>
</div>

{{-- Sidebar Toggle & Menu Filter Script --}}
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        if (sidebar && overlay) {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    }

    function filterAdminMenu(query) {
        query = (query || '').toLowerCase().trim();
        const clearBtn = document.getElementById('clearMenuSearch');
        if (clearBtn) {
            if (query.length > 0) {
                clearBtn.classList.remove('hidden');
            } else {
                clearBtn.classList.add('hidden');
            }
        }

        const sections = document.querySelectorAll('#adminNavList .menu-section');
        sections.forEach(sec => {
            const links = sec.querySelectorAll('.menu-link');
            let visibleCount = 0;
            links.forEach(link => {
                const keywords = (link.getAttribute('data-keywords') || '').toLowerCase();
                const text = link.innerText.toLowerCase();
                if (!query || text.includes(query) || keywords.includes(query)) {
                    link.style.display = '';
                    visibleCount++;
                } else {
                    link.style.display = 'none';
                }
            });

            const title = sec.querySelector('.section-title');
            if (title) {
                title.style.display = (!query || visibleCount > 0) ? '' : 'none';
            }
            sec.style.display = (!query || visibleCount > 0) ? '' : 'none';
        });
    }
</script>

@stack('scripts')
</body>
</html>