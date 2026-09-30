<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
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
            font-family: 'Kalpurush', 'Figtree', sans-serif;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 text-gray-900">
<div class="min-h-screen flex">

    {{-- MOBILE OVERLAY --}}
    <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"></div>

    {{-- SIDEBAR --}}
    <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-50 w-64 bg-slate-900 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 flex flex-col">

        {{-- Logo / Brand --}}
        <div class="h-16 flex items-center px-5 border-b border-slate-700">
            <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center font-bold text-lg">
                S
            </div>
            <div class="ml-3">
                <h1 class="font-bold text-lg leading-tight">School Admin</h1>
                <p class="text-xs text-slate-400">Website Management</p>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto px-3 py-5">

            {{-- Main --}}
            <p class="px-3 mb-2 text-xs font-semibold uppercase tracking-wider text-slate-500">
                Main
            </p>

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0h6"/>
                </svg>
                Dashboard
            </a>

            {{-- Website --}}
            <p class="px-3 mt-6 mb-2 text-xs font-semibold uppercase tracking-wider text-slate-500">
                Website Management
            </p>

            {{-- Website Settings --}}
            <a href="{{ route('admin.settings.edit') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.settings.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Website Settings
            </a>

            {{-- Slider --}}
            <a href="{{ route('admin.sliders.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.sliders.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">🖼️</span>
                Slider / Banner
            </a>

            {{-- About --}}
            <a href="{{ route('admin.abouts.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.abouts.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">🏫</span>
                About School
            </a>

            {{-- Administration --}}
            <a href="{{ route('admin.administrations.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.administrations.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">👔</span>
                <span>Administration</span>
            </a>

            {{-- Teachers & Staff --}}
            <a href="{{ route('admin.teachers.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.teachers.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">👨‍🏫</span>
                Teachers & Staff
            </a>

            {{-- Content --}}
            <p class="px-3 mt-6 mb-2 text-xs font-semibold uppercase tracking-wider text-slate-500">
                Content
            </p>

            {{-- Notices --}}
            <a href="{{ route('admin.notices.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.notices.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">📢</span>
                Notices
            </a>

            {{-- News --}}
            <a href="{{ route('admin.news.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white">
                <span class="text-lg">📰</span>
                News
            </a>

            {{-- Events --}}
            <a href="{{ route('admin.events.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white">
                <span class="text-lg">📅</span>
                Events
            </a>

            {{-- Gallery --}}
            <a href="{{ route('admin.galleries.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white">
                <span class="text-lg">🖼️</span>
                Photo Gallery
            </a>

            {{-- Video Gallery --}}
            <a href="{{ route('admin.video-galleries.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.video-galleries.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">🎬</span>
                Video Gallery
            </a>

            {{-- Publications --}}
            <a href="{{ route('admin.publications.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.publications.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">📰</span>
                Magazines & Publications
            </a>

            {{-- Academic Management --}}
            <p class="px-3 mt-6 mb-2 text-xs font-semibold uppercase tracking-wider text-slate-500">
                Academic & Records
            </p>

            {{-- Syllabuses --}}
            <a href="{{ route('admin.syllabuses.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.syllabuses.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">📚</span>
                Syllabuses
            </a>

            {{-- Class Routines --}}
            <a href="{{ route('admin.class-routines.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.class-routines.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">⏰</span>
                Class Routines
            </a>

            {{-- Exam Routines --}}
            <a href="{{ route('admin.exam-routines.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.exam-routines.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">📝</span>
                Exam Routines
            </a>

            {{-- Academic Subjects --}}
            <a href="{{ route('admin.subjects.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.subjects.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">📖</span>
                Subjects
            </a>

            {{-- Exam Results (Gazette) --}}
            <a href="{{ route('admin.exam-results.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.exam-results.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">🏆</span>
                Result Gazettes
            </a>

            {{-- Student Marks --}}
            <a href="{{ route('admin.student-marks.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.student-marks.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">📊</span>
                Student Marksheets
            </a>

            {{-- Enrolled Students --}}
            <a href="{{ route('admin.students.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.students.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">👨‍🎓</span>
                Enrolled Students
            </a>

            {{-- Resources --}}
            <p class="px-3 mt-6 mb-2 text-xs font-semibold uppercase tracking-wider text-slate-500">
                Resources
            </p>

            {{-- Downloads --}}
            <a href="{{ Route::has('admin.downloads.index') ? route('admin.downloads.index') : '#' }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white">
                <span class="text-lg">📥</span>
                Downloads
            </a>

            {{-- Admission --}}
            <a href="{{ route('admin.admissions.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white">
                <span class="text-lg">📝</span>
                Admission
            </a>
            <a
                href="{{ route('admin.admission-applications.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium transition
                {{ request()->routeIs('admin.admission-applications.*')
                    ? 'bg-indigo-600 text-white'
                    : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
            >

                <span class="text-lg">
                    🎓
                </span>

                Online Applications

            </a>
            <a
                href="{{ route('admin.admission-payments.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 mb-1
                    rounded-lg text-sm font-medium transition
                    {{ request()->routeIs('admin.admission-payments.*')
                            ? 'bg-indigo-600 text-white'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
            >

                <span class="text-lg">💳</span>

                Admission Payments

            </a>
            <a
                href="{{ route('admin.admission-lottery.index') }}"
                class="flex items-center gap-3 px-3 py-2.5 mb-1
                    rounded-lg text-sm font-medium transition
                    {{ request()->routeIs('admin.admission-lottery.*')
                            ? 'bg-indigo-600 text-white'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
            >

                <span class="text-lg">🎲</span>

                Digital Lottery Draw

            </a>

            {{-- Important Links --}}
            <a href="{{ Route::has('admin.important-links.index') ? route('admin.important-links.index') : '#' }}"
               class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white">
                <span class="text-lg">🔗</span>
                Important Links
            </a>

            {{-- Communication --}}
            <p class="px-3 mt-6 mb-2 text-xs font-semibold uppercase tracking-wider text-slate-500">
                Communication
            </p>

            {{-- Messages --}}
            <a href="{{ Route::has('admin.contact-messages.index') ? route('admin.contact-messages.index') : '#' }}"
            class="flex items-center gap-3 px-3 py-2.5 mb-1 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.contact-messages.*') ? 'bg-indigo-600 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                <span class="text-lg">✉️</span>
                Contact Messages
            </a>
        </nav>

        {{-- Sidebar Footer --}}
        <div class="border-t border-slate-700 p-4">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full bg-indigo-600 flex items-center justify-center font-semibold">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium truncate">
                        {{ auth()->user()->name ?? 'Admin' }}
                    </p>
                    <p class="text-xs text-slate-400">Administrator</p>
                </div>
            </div>
        </div>
    </aside>

    {{-- MAIN AREA --}}
    <div class="flex-1 min-w-0">

        {{-- Header --}}
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 sm:px-6 sticky top-0 z-30">
            <div class="flex items-center gap-3">

                {{-- Mobile Menu --}}
                <button type="button" onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <div>
                    <h2 class="text-lg font-semibold text-gray-800">
                        @yield('page_title', 'Dashboard')
                    </h2>
                </div>
            </div>

            {{-- Right --}}
            <div class="flex items-center gap-4">
                <span class="hidden sm:block text-sm text-gray-600">
                    {{ auth()->user()->name ?? 'Admin' }}
                </span>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-red-600 hover:text-red-700">
                        Logout
                    </button>
                </form>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="p-4 sm:p-6 lg:p-8">

            {{-- Success --}}
            @if(session('success'))
                <div class="mb-6 rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error --}}
            @if(session('error'))
                <div class="mb-6 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

{{-- SIDEBAR SCRIPT --}}
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