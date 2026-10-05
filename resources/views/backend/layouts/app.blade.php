<!DOCTYPE html>
<html lang="bn" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - {{ $websiteSetting?->school_name ?? config('app.name', 'School') }}</title>
    @php
        $faviconUrl = asset('favicon.ico');
        if (!empty($websiteSetting?->favicon)) {
            if (file_exists(public_path($websiteSetting->favicon))) {
                $faviconUrl = asset($websiteSetting->favicon);
            } elseif (file_exists(public_path('storage/' . $websiteSetting->favicon))) {
                $faviconUrl = asset('storage/' . $websiteSetting->favicon);
            }
        }
    @endphp
    <link rel="icon" type="image/x-icon" href="{{ $faviconUrl }}">
    <link rel="shortcut icon" href="{{ $faviconUrl }}">
    @if(!empty($websiteSetting?->logo) && file_exists(public_path($websiteSetting->logo)))
        <link rel="apple-touch-icon" href="{{ asset($websiteSetting->logo) }}">
    @endif

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
            background: rgba(15, 23, 42, 0.6);
        }
        .admin-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(51, 65, 85, 0.8);
            border-radius: 9999px;
        }
        .admin-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(100, 116, 139, 1);
        }
    </style>
    @stack('styles')
</head>
<body class="h-full bg-slate-50 text-slate-800 antialiased selection:bg-emerald-500 selection:text-white">
<div class="min-h-screen flex flex-col lg:flex-row">

    {{-- MOBILE OVERLAY --}}
    <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity"></div>

    {{-- SIDEBAR --}}
    <aside id="sidebar" class="fixed lg:sticky top-0 inset-y-0 left-0 z-50 w-72 h-screen bg-slate-950 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col border-r border-slate-800/80 shadow-2xl lg:shadow-none">

        {{-- Brand / School Logo --}}
        <div class="h-20 px-5 flex items-center justify-between border-b border-slate-800/80 bg-slate-950/80 backdrop-blur-md">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group min-w-0">
                @if(!empty($websiteSetting?->logo) && file_exists(public_path($websiteSetting->logo)))
                    <img src="{{ asset($websiteSetting->logo) }}" alt="Logo" class="w-11 h-11 object-contain rounded-xl p-1 bg-white/10 ring-1 ring-white/10 shrink-0 group-hover:scale-105 transition-transform duration-200">
                @else
                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-700 flex items-center justify-center font-extrabold text-white text-lg shadow-lg shadow-emerald-900/30 shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        </svg>
                    </div>
                @endif
                <div class="min-w-0">
                    <h1 class="font-bold text-sm tracking-tight text-white truncate group-hover:text-emerald-400 transition-colors">
                        {{ $websiteSetting?->school_name ?? 'School Admin' }}
                    </h1>
                    <div class="flex items-center gap-1.5 mt-0.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <p class="text-[11px] font-medium text-slate-400">Control Panel</p>
                    </div>
                </div>
            </a>
            <button type="button" onclick="toggleSidebar()" class="lg:hidden p-1.5 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Navigation Menu --}}
        <nav class="flex-1 overflow-y-auto px-3.5 py-4 space-y-6 admin-scrollbar text-sm">

            {{-- SECTION: MAIN --}}
            <div>
                <p class="px-3 mb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                    Main / ওভারভিউ
                </p>
                <div class="space-y-1">
                    {{-- Dashboard --}}
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0h6"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    {{-- Settings --}}
                    @if(auth()->user()->hasPermission('settings.manage'))
                    <a href="{{ route('admin.settings.edit') }}"
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.settings.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Website Settings</span>
                    </a>
                    @endif
                </div>
            </div>

            {{-- SECTION: INSTITUTE INFO --}}
            @if(auth()->user()->hasPermission('institution.about') || auth()->user()->hasPermission('administration.manage') || auth()->user()->hasPermission('teachers.manage'))
            <div>
                <p class="px-3 mb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                    Institute / প্রতিষ্ঠান পরিচিতি
                </p>
                <div class="space-y-1">
                    @if(auth()->user()->hasPermission('institution.about'))
                    {{-- About School --}}
                    <a href="{{ route('admin.abouts.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.abouts.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        <span>About School</span>
                    </a>

                    {{-- Mission & Vision --}}
                    <a href="{{ route('admin.mission-visions.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.mission-visions.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>Mission & Vision</span>
                    </a>
                    @endif

                    @if(auth()->user()->hasPermission('administration.manage'))
                    {{-- Administration --}}
                    <a href="{{ route('admin.administrations.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.administrations.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span>Administration</span>
                    </a>
                    @endif

                    @if(auth()->user()->hasPermission('teachers.manage'))
                    {{-- Teachers & Staff --}}
                    <a href="{{ route('admin.teachers.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.teachers.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span>Teachers & Staff</span>
                    </a>
                    @endif
                </div>
            </div>
            @endif

            {{-- SECTION: ACADEMIC & STUDENTS --}}
            @if(auth()->user()->hasPermission('academic.students') || auth()->user()->hasPermission('academic.subjects') || auth()->user()->hasPermission('academic.routines') || auth()->user()->hasPermission('academic.syllabuses') || auth()->user()->hasPermission('academic.results'))
            <div>
                <p class="px-3 mb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                    Academic / একাডেমিক ও শিক্ষার্থী
                </p>
                <div class="space-y-1">
                    @if(auth()->user()->hasPermission('academic.students'))
                    {{-- Enrolled Students --}}
                    <a href="{{ route('admin.students.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.students.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Enrolled Students</span>
                    </a>
                    @endif

                    @if(auth()->user()->hasPermission('academic.subjects'))
                    {{-- Subjects --}}
                    <a href="{{ route('admin.subjects.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.subjects.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span>Academic Subjects</span>
                    </a>
                    @endif

                    @if(auth()->user()->hasPermission('academic.routines'))
                    {{-- Class Routines --}}
                    <a href="{{ route('admin.class-routines.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.class-routines.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Class Routines</span>
                    </a>

                    {{-- Exam Routines --}}
                    <a href="{{ route('admin.exam-routines.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.exam-routines.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Exam Routines</span>
                    </a>
                    @endif

                    @if(auth()->user()->hasPermission('academic.syllabuses'))
                    {{-- Syllabuses --}}
                    <a href="{{ route('admin.syllabuses.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.syllabuses.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Syllabuses</span>
                    </a>
                    @endif

                    @if(auth()->user()->hasPermission('academic.results'))
                    {{-- Exam Results (Gazette) --}}
                    <a href="{{ route('admin.exam-results.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.exam-results.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <span>Result Gazettes</span>
                    </a>

                    {{-- Student Marks --}}
                    <a href="{{ route('admin.student-marks.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.student-marks.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        <span>Student Marksheets</span>
                    </a>
                    @endif
                </div>
            </div>
            @endif

            {{-- SECTION: ADMISSIONS HUB --}}
            @if(auth()->user()->hasPermission('admissions.circulars') || auth()->user()->hasPermission('admissions.applications') || auth()->user()->hasPermission('admissions.lottery') || auth()->user()->hasPermission('admissions.payments'))
            <div>
                <p class="px-3 mb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                    Admissions / ভর্তি কার্যক্রম
                </p>
                <div class="space-y-1">
                    @if(auth()->user()->hasPermission('admissions.circulars'))
                    {{-- Circulars --}}
                    <a href="{{ route('admin.admissions.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.admissions.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span>Admission Circulars</span>
                    </a>
                    @endif

                    @if(auth()->user()->hasPermission('admissions.applications'))
                    {{-- Applications --}}
                    <a href="{{ route('admin.admission-applications.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.admission-applications.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Online Applications</span>
                    </a>
                    @endif

                    @if(auth()->user()->hasPermission('admissions.lottery'))
                    {{-- Digital Lottery --}}
                    <a href="{{ route('admin.admission-lottery.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.admission-lottery.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <span>Lottery & Merit Draw</span>
                    </a>
                    @endif

                    @if(auth()->user()->hasPermission('admissions.payments'))
                    {{-- Admission Payments --}}
                    <a href="{{ route('admin.admission-payments.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.admission-payments.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                        <span>Admission Payments</span>
                    </a>
                    @endif
                </div>
            </div>
            @endif

            {{-- SECTION: CONTENT & MEDIA --}}
            @if(auth()->user()->hasPermission('sliders.manage') || auth()->user()->hasPermission('notices.view') || auth()->user()->hasPermission('notices.manage') || auth()->user()->hasPermission('news_events.manage') || auth()->user()->hasPermission('galleries.manage') || auth()->user()->hasPermission('publications.manage'))
            <div>
                <p class="px-3 mb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                    Content & Media / কনটেন্ট ও মিডিয়া
                </p>
                <div class="space-y-1">
                    @if(auth()->user()->hasPermission('sliders.manage'))
                    {{-- Sliders --}}
                    <a href="{{ route('admin.sliders.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.sliders.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Slider & Banners</span>
                    </a>
                    @endif

                    @if(auth()->user()->hasPermission('notices.view') || auth()->user()->hasPermission('notices.manage'))
                    {{-- Notices --}}
                    <a href="{{ route('admin.notices.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.notices.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span>Notice Board</span>
                    </a>
                    @endif

                    @if(auth()->user()->hasPermission('news_events.manage'))
                    {{-- News --}}
                    <a href="{{ route('admin.news.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.news.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        <span>News & Articles</span>
                    </a>

                    {{-- Events --}}
                    <a href="{{ route('admin.events.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.events.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Events & Programs</span>
                    </a>
                    @endif

                    @if(auth()->user()->hasPermission('galleries.manage'))
                    {{-- Photo Gallery --}}
                    <a href="{{ route('admin.galleries.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.galleries.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>Photo Gallery</span>
                    </a>

                    {{-- Video Gallery --}}
                    <a href="{{ route('admin.video-galleries.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.video-galleries.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        <span>Video Gallery</span>
                    </a>
                    @endif

                    @if(auth()->user()->hasPermission('publications.manage'))
                    {{-- Publications --}}
                    <a href="{{ route('admin.publications.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.publications.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <span>Magazines & Publications</span>
                    </a>
                    @endif
                </div>
            </div>
            @endif

            {{-- SECTION: COMMUNICATION & EXTRAS --}}
            @if(auth()->user()->hasPermission('contact_messages.view') || auth()->user()->hasPermission('contact_messages.manage') || auth()->user()->hasPermission('publications.manage') || auth()->user()->hasPermission('settings.manage'))
            <div>
                <p class="px-3 mb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                    Communication / যোগাযোগ
                </p>
                <div class="space-y-1">
                    {{-- Contact Messages --}}
                    @if(auth()->user()->hasPermission('contact_messages.view') || auth()->user()->hasPermission('contact_messages.manage'))
                        @if(Route::has('admin.contact-messages.index'))
                            @php
                                $unreadMsgCount = \App\Models\ContactMessage::where('is_read', 0)->count();
                            @endphp
                            <a href="{{ route('admin.contact-messages.index') }}"
                               class="flex items-center justify-between px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.contact-messages.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span>Contact Messages</span>
                                </div>
                                @if($unreadMsgCount > 0)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-400 text-slate-950 shadow-xs animate-pulse">
                                        {{ $unreadMsgCount }}
                                    </span>
                                @endif
                            </a>
                        @endif
                    @endif

                    {{-- Downloads --}}
                    @if(auth()->user()->hasPermission('publications.manage'))
                        @if(Route::has('admin.downloads.index'))
                            <a href="{{ route('admin.downloads.index') }}"
                               class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.downloads.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                                <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                <span>Downloads</span>
                            </a>
                        @endif
                    @endif

                    {{-- Important Links --}}
                    @if(auth()->user()->hasPermission('settings.manage'))
                        @if(Route::has('admin.important-links.index'))
                            <a href="{{ route('admin.important-links.index') }}"
                               class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.important-links.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                                <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                </svg>
                                <span>Important Links</span>
                            </a>
                        @endif
                    @endif
                </div>
            </div>
            @endif

            {{-- SECTION: ACCESS CONTROL (RBAC) - SUPER ADMIN ONLY --}}
            @if(auth()->user()->isSuperAdmin())
            <div>
                <p class="px-3 mb-2 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                    Access Control / ব্যবহারকারী ও রোল
                </p>
                <div class="space-y-1">
                    {{-- Users --}}
                    <a href="{{ route('admin.users.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.users.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span>Users (ব্যবহারকারী)</span>
                    </a>

                    {{-- Roles & Permissions --}}
                    <a href="{{ route('admin.roles.index') }}"
                       class="flex items-center gap-3 px-3.5 py-2 rounded-xl font-medium transition-all duration-150 {{ request()->routeIs('admin.roles.*') ? 'bg-gradient-to-r from-emerald-600 to-teal-600 text-white shadow-md shadow-emerald-950/40 font-semibold' : 'text-slate-300 hover:bg-slate-900 hover:text-white' }}">
                        <svg class="w-5 h-5 shrink-0 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span>Roles & Permissions (রোল)</span>
                    </a>
                </div>
            </div>
            @endif

        </nav>

        {{-- Sidebar Footer / User Profile --}}
        <div class="p-3.5 border-t border-slate-800/80 bg-slate-950/90 backdrop-blur-sm">
            <div class="flex items-center justify-between gap-3 p-2 rounded-xl bg-slate-900/60 border border-slate-800/50">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-500 to-teal-400 text-white font-bold flex items-center justify-center text-sm shadow-md shrink-0">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-bold text-white truncate">
                            {{ auth()->user()->name ?? 'Administrator' }}
                        </p>
                        <p class="text-[10px] font-medium text-emerald-400 truncate">{{ auth()->user()->roleName() }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Do you want to log out?');">
                    @csrf
                    <button type="submit" title="Logout" class="p-2 rounded-lg text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- MAIN CONTENT AREA --}}
    <div class="flex-1 min-w-0 flex flex-col">

        {{-- Topbar Header --}}
        <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-30 px-4 sm:px-6 lg:px-8 flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-3 sm:gap-4 min-w-0">
                {{-- Mobile Menu Trigger --}}
                <button type="button" onclick="toggleSidebar()" class="lg:hidden p-2.5 rounded-xl text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <div>
                    <h2 class="text-lg sm:text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                        @yield('page_title', 'Dashboard')
                    </h2>
                    <p class="text-xs text-slate-400 hidden sm:block">
                        {{ $websiteSetting?->school_name ?? 'School Management System' }}
                    </p>
                </div>
            </div>

            {{-- Right Actions --}}
            <div class="flex items-center gap-3 sm:gap-4">

                {{-- Visit Live Website Button --}}
                <a href="{{ url('/') }}" target="_blank" class="inline-flex items-center gap-2 px-3 sm:px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200/80 transition-all shadow-xs group">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="hidden sm:inline">Visit Website</span>
                    <span class="sm:hidden">Site</span>
                    <svg class="w-3.5 h-3.5 text-emerald-600 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>

                {{-- Date / Clock indicator --}}
                <div class="hidden md:flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-slate-100/80 border border-slate-200/60 text-xs font-semibold text-slate-600">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ now()->format('d M, Y') }}</span>
                </div>

                {{-- User Profile Chip & Logout --}}
                <div class="flex items-center gap-2 pl-2 border-l border-slate-200">
                    <div class="flex items-center gap-2">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white font-bold flex items-center justify-center text-sm shadow-xs">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </div>
                        <div class="hidden xl:block text-left">
                            <span class="block text-xs font-bold text-slate-800 leading-none">
                                {{ auth()->user()->name ?? 'Admin' }}
                            </span>
                            <span class="block text-[10px] text-emerald-600 font-semibold mt-0.5 truncate max-w-[120px]">
                                {{ auth()->user()->roleName() }}
                            </span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('Do you want to log out?');" class="inline">
                        @csrf
                        <button type="submit" title="Logout" class="p-2 rounded-xl text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>

            </div>
        </header>

        {{-- Page Main Container --}}
        <main class="flex-1 p-4 sm:p-6 lg:p-8">

            {{-- Flash Notification: Success --}}
            @if(session('success'))
                <div id="flash-success" class="mb-6 flex items-start gap-3.5 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 shadow-xs animate-in fade-in slide-in-from-top-2 duration-300">
                    <div class="w-8 h-8 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div class="flex-1 pt-1 min-w-0">
                        <h4 class="text-sm font-bold text-emerald-900">Success</h4>
                        <p class="text-xs sm:text-sm text-emerald-700 mt-0.5 leading-relaxed">{{ session('success') }}</p>
                    </div>
                    <button type="button" onclick="document.getElementById('flash-success').remove()" class="p-1 rounded-lg text-emerald-500 hover:bg-emerald-100 hover:text-emerald-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            {{-- Flash Notification: Error --}}
            @if(session('error'))
                <div id="flash-error" class="mb-6 flex items-start gap-3.5 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 shadow-xs animate-in fade-in slide-in-from-top-2 duration-300">
                    <div class="w-8 h-8 rounded-xl bg-rose-600 text-white flex items-center justify-center shrink-0 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <div class="flex-1 pt-1 min-w-0">
                        <h4 class="text-sm font-bold text-rose-900">Error</h4>
                        <p class="text-xs sm:text-sm text-rose-700 mt-0.5 leading-relaxed">{{ session('error') }}</p>
                    </div>
                    <button type="button" onclick="document.getElementById('flash-error').remove()" class="p-1 rounded-lg text-rose-500 hover:bg-rose-100 hover:text-rose-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="py-4 px-6 border-t border-slate-200/70 bg-white/70 backdrop-blur text-xs text-slate-500 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div>
                &copy; {{ date('Y') }} <span class="font-semibold text-slate-700">{{ $websiteSetting?->school_name ?? 'School' }}</span> Management Portal. All rights reserved.
            </div>
            <div>
                <button type="button" onclick="openDeveloperContactModal()"
                        title="Click to view developer profile & contact"
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-emerald-50 border border-emerald-200/80 text-xs text-slate-700 hover:bg-emerald-100 hover:border-emerald-300 transition cursor-pointer shadow-xs group">
                    <svg class="w-3.5 h-3.5 text-emerald-600 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                    <span>Developed by <strong class="font-bold text-emerald-700 group-hover:text-emerald-800">{{ $websiteSetting?->developer_name_en ?? $websiteSetting?->developer_name ?? 'Imtiaz Ahmed' }}</strong></span>
                </button>
            </div>
        </footer>
    </div>
</div>

@include('components.developer-contact-modal')

{{-- Sidebar Toggle Script --}}
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }
</script>

@stack('scripts')
</body>
</html>