@extends('backend.layouts.app')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard Overview')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">

    {{-- =========================================================
        WELCOME HERO BANNER
    ========================================================== --}}
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-slate-950 via-slate-900 to-emerald-950 text-white p-6 sm:p-8 lg:p-10 shadow-xl border border-emerald-500/20">
        {{-- Subtle background glowing orbs --}}
        <div class="absolute -right-16 -top-16 w-80 h-80 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute right-1/3 -bottom-16 w-72 h-72 rounded-full bg-teal-500/10 blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div class="space-y-2.5 max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    {{ $websiteSetting?->school_name ?? 'School Management Portal' }}
                </div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight text-white leading-tight">
                    Welcome back, {{ auth()->user()->name ?? 'Administrator' }}! 👋
                </h1>
                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                    Here is the real-time operational overview of your school website, online admission applications, academic records, and visitor traffic.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3 shrink-0">
                <div class="px-4 py-3 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 shadow-sm text-left">
                    <p class="text-[10px] uppercase tracking-wider text-emerald-300 font-bold">Today's Date</p>
                    <p class="text-sm font-extrabold text-white mt-0.5">{{ now()->format('l, d M Y') }}</p>
                </div>
                <a href="{{ route('admin.settings.edit') }}"
                   class="px-5 py-3 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs sm:text-sm font-bold transition shadow-lg shadow-emerald-950/40 inline-flex items-center gap-2 active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Website Settings</span>
                </a>
            </div>
        </div>
    </div>

    {{-- =========================================================
        PRIMARY STAT CARDS (4 Cards Grid)
    ========================================================== --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        {{-- Students --}}
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs hover:shadow-xl hover:-translate-y-1 transition duration-200 group">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-xl group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                </div>
                <span class="text-xs font-bold text-blue-700 bg-blue-50 px-2.5 py-1 rounded-full">Academic</span>
            </div>
            <p class="text-xs font-medium text-slate-500 mt-4">Enrolled Students / শিক্ষার্থী</p>
            <h3 class="text-3xl font-black text-slate-900 mt-1">@bnDigit($totalStudents)</h3>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-400 font-medium">Total Enrolled</span>
                <a href="{{ route('admin.students.index') }}" class="font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1 group-hover:translate-x-0.5 transition-transform">Manage →</a>
            </div>
        </div>

        {{-- Teachers --}}
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs hover:shadow-xl hover:-translate-y-1 transition duration-200 group">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xl group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-full">Faculty</span>
            </div>
            <p class="text-xs font-medium text-slate-500 mt-4">Teachers & Staff / শিক্ষক-কর্মচারী</p>
            <h3 class="text-3xl font-black text-slate-900 mt-1">@bnDigit($totalTeachers)</h3>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-400 font-medium">Total Staff</span>
                <a href="{{ route('admin.teachers.index') }}" class="font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1 group-hover:translate-x-0.5 transition-transform">Manage →</a>
            </div>
        </div>

        {{-- Applications --}}
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs hover:shadow-xl hover:-translate-y-1 transition duration-200 group">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-xl group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                @if($pendingApplications > 0)
                    <span class="text-xs font-bold text-amber-800 bg-amber-100 px-2.5 py-1 rounded-full animate-pulse">@bnDigit($pendingApplications) Pending</span>
                @else
                    <span class="text-xs font-bold text-slate-600 bg-slate-100 px-2.5 py-1 rounded-full">Admission</span>
                @endif
            </div>
            <p class="text-xs font-medium text-slate-500 mt-4">Online Applications / আবেদন</p>
            <h3 class="text-3xl font-black text-slate-900 mt-1">@bnDigit($totalApplications)</h3>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-400 font-medium">Total Applicants</span>
                <a href="{{ route('admin.admission-applications.index') }}" class="font-bold text-amber-600 hover:text-amber-700 flex items-center gap-1 group-hover:translate-x-0.5 transition-transform">View All →</a>
            </div>
        </div>

        {{-- Total Visitors --}}
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs hover:shadow-xl hover:-translate-y-1 transition duration-200 group">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center font-bold text-xl group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <span class="text-xs font-bold text-purple-700 bg-purple-50 px-2.5 py-1 rounded-full">Traffic</span>
            </div>
            <p class="text-xs font-medium text-slate-500 mt-4">Total Visitors / ভিজিটর</p>
            <h3 class="text-3xl font-black text-slate-900 mt-1">@bnDigit($totalVisitors)</h3>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-400 font-medium">Today: @bnDigit($todayVisitors)</span>
                <span class="font-semibold text-purple-600">Active</span>
            </div>
        </div>

    </div>

    {{-- =========================================================
        CONTENT MODULE STATS (4 Secondary Cards)
    ========================================================== --}}
    <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        {{-- Notices --}}
        <a href="{{ route('admin.notices.index') }}" class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-emerald-300 hover:shadow-md transition group">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xl shrink-0 group-hover:scale-105 transition-transform">📢</div>
                <div>
                    <p class="text-xs text-slate-500 font-medium">Notices / নোটিশ</p>
                    <p class="text-xl font-black text-slate-900 group-hover:text-emerald-600 transition-colors mt-0.5">@bnDigit($totalNotices)</p>
                </div>
            </div>
        </a>

        {{-- News --}}
        <a href="{{ route('admin.news.index') }}" class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-teal-300 hover:shadow-md transition group">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center font-bold text-xl shrink-0 group-hover:scale-105 transition-transform">📰</div>
                <div>
                    <p class="text-xs text-slate-500 font-medium">News / সংবাদ</p>
                    <p class="text-xl font-black text-slate-900 group-hover:text-teal-600 transition-colors mt-0.5">@bnDigit($totalNews)</p>
                </div>
            </div>
        </a>

        {{-- Events --}}
        <a href="{{ route('admin.events.index') }}" class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-indigo-300 hover:shadow-md transition group">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-xl shrink-0 group-hover:scale-105 transition-transform">📅</div>
                <div>
                    <p class="text-xs text-slate-500 font-medium">Events / ইভেন্ট</p>
                    <p class="text-xl font-black text-slate-900 group-hover:text-indigo-600 transition-colors mt-0.5">@bnDigit($totalEvents)</p>
                </div>
            </div>
        </a>

        {{-- Photo Gallery --}}
        <a href="{{ route('admin.galleries.index') }}" class="p-5 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-rose-300 hover:shadow-md transition group">
            <div class="flex items-center gap-3.5">
                <div class="w-11 h-11 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold text-xl shrink-0 group-hover:scale-105 transition-transform">🖼️</div>
                <div>
                    <p class="text-xs text-slate-500 font-medium">Gallery / ছবি</p>
                    <p class="text-xl font-black text-slate-900 group-hover:text-rose-600 transition-colors mt-0.5">@bnDigit($totalGalleryImages)</p>
                </div>
            </div>
        </a>
    </div>

    {{-- =========================================================
        QUICK ACTIONS BAR
    ========================================================== --}}
    <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs">
        <h2 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            Quick Actions / দ্রুত সেবা
        </h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3.5">
            <a href="{{ route('admin.notices.create') }}" class="flex flex-col items-center justify-center p-4 rounded-2xl bg-slate-50 hover:bg-emerald-50/80 hover:text-emerald-700 text-slate-700 border border-slate-200/60 hover:border-emerald-200 transition text-center group active:scale-95">
                <span class="text-2xl mb-1.5 group-hover:scale-110 transition-transform">📢</span>
                <span class="text-xs font-bold">Add Notice</span>
            </a>

            <a href="{{ route('admin.news.create') }}" class="flex flex-col items-center justify-center p-4 rounded-2xl bg-slate-50 hover:bg-teal-50/80 hover:text-teal-700 text-slate-700 border border-slate-200/60 hover:border-teal-200 transition text-center group active:scale-95">
                <span class="text-2xl mb-1.5 group-hover:scale-110 transition-transform">📰</span>
                <span class="text-xs font-bold">Add News</span>
            </a>

            <a href="{{ route('admin.events.create') }}" class="flex flex-col items-center justify-center p-4 rounded-2xl bg-slate-50 hover:bg-indigo-50/80 hover:text-indigo-700 text-slate-700 border border-slate-200/60 hover:border-indigo-200 transition text-center group active:scale-95">
                <span class="text-2xl mb-1.5 group-hover:scale-110 transition-transform">📅</span>
                <span class="text-xs font-bold">Add Event</span>
            </a>

            <a href="{{ route('admin.students.create') }}" class="flex flex-col items-center justify-center p-4 rounded-2xl bg-slate-50 hover:bg-blue-50/80 hover:text-blue-700 text-slate-700 border border-slate-200/60 hover:border-blue-200 transition text-center group active:scale-95">
                <span class="text-2xl mb-1.5 group-hover:scale-110 transition-transform">👨‍🎓</span>
                <span class="text-xs font-bold">Add Student</span>
            </a>

            <a href="{{ route('admin.admission-lottery.index') }}" class="flex flex-col items-center justify-center p-4 rounded-2xl bg-slate-50 hover:bg-amber-50/80 hover:text-amber-700 text-slate-700 border border-slate-200/60 hover:border-amber-200 transition text-center group active:scale-95">
                <span class="text-2xl mb-1.5 group-hover:scale-110 transition-transform">🎲</span>
                <span class="text-xs font-bold">Lottery Draw</span>
            </a>

            <a href="{{ route('admin.settings.edit') }}" class="flex flex-col items-center justify-center p-4 rounded-2xl bg-slate-50 hover:bg-purple-50/80 hover:text-purple-700 text-slate-700 border border-slate-200/60 hover:border-purple-200 transition text-center group active:scale-95">
                <span class="text-2xl mb-1.5 group-hover:scale-110 transition-transform">⚙️</span>
                <span class="text-xs font-bold">Edit Settings</span>
            </a>
        </div>
    </div>

    {{-- =========================================================
        TWO COLUMNS: RECENT NOTICES & RECENT APPLICATIONS
    ========================================================== --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Recent Notices --}}
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div>
                        <h2 class="text-base font-bold text-slate-900">Recent Notices / সাম্প্রতিক নোটিশ</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Latest announcements published</p>
                    </div>
                    <a href="{{ route('admin.notices.index') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition">View All →</a>
                </div>

                <div class="divide-y divide-slate-100 mt-2">
                    @forelse($recentNotices as $notice)
                        <div class="py-3.5 flex items-start justify-between gap-3 group">
                            <div class="min-w-0">
                                <h4 class="text-sm font-semibold text-slate-800 group-hover:text-emerald-600 transition truncate">
                                    {{ $notice->title }}
                                </h4>
                                <div class="flex items-center gap-2 mt-1 text-xs text-slate-400">
                                    <span>📅 {{ $notice->notice_date ? \Carbon\Carbon::parse($notice->notice_date)->format('d M Y') : 'N/A' }}</span>
                                    <span>•</span>
                                    <span class="{{ $notice->status ? 'text-emerald-600 font-medium' : 'text-slate-400' }}">
                                        {{ $notice->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>
                            <a href="{{ route('admin.notices.edit', $notice->id) }}" class="text-xs font-semibold px-2.5 py-1.5 rounded-lg bg-slate-100 text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 transition shrink-0">
                                Edit
                            </a>
                        </div>
                    @empty
                        <div class="py-8 text-center text-slate-400 text-xs">No notices found.</div>
                    @endforelse
                </div>
            </div>
            <div class="pt-4 border-t border-slate-100 text-center">
                <a href="{{ route('admin.notices.create') }}" class="text-xs font-bold text-emerald-600 hover:underline inline-flex items-center gap-1">
                    + Publish New Notice
                </a>
            </div>
        </div>

        {{-- Recent Applications --}}
        <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                    <div>
                        <h2 class="text-base font-bold text-slate-900">Recent Applications / অনলাইন আবেদন</h2>
                        <p class="text-xs text-slate-400 mt-0.5">Latest admission applicants</p>
                    </div>
                    <a href="{{ route('admin.admission-applications.index') }}" class="text-xs font-bold text-amber-600 hover:text-amber-700 transition">View All →</a>
                </div>

                <div class="divide-y divide-slate-100 mt-2">
                    @forelse($recentApplications as $app)
                        <div class="py-3.5 flex items-start justify-between gap-3 group">
                            <div class="min-w-0">
                                <h4 class="text-sm font-semibold text-slate-800 group-hover:text-amber-600 transition truncate">
                                    {{ $app->student_name_en ?? $app->student_name_bn ?? 'Applicant' }}
                                </h4>
                                <div class="flex items-center gap-2 mt-1 text-xs text-slate-400">
                                    <span>Class: <strong class="text-slate-700">{{ $app->applied_class ?? 'N/A' }}</strong></span>
                                    <span>•</span>
                                    <span>ID: {{ $app->application_no ?? $app->id }}</span>
                                </div>
                            </div>
                            <span class="text-[11px] font-bold px-2.5 py-1 rounded-full shrink-0 {{ $app->status == 'approved' ? 'bg-emerald-100 text-emerald-700' : ($app->status == 'rejected' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-700') }}">
                                {{ ucfirst($app->status ?? 'pending') }}
                            </span>
                        </div>
                    @empty
                        <div class="py-8 text-center text-slate-400 text-xs">No online applications yet.</div>
                    @endforelse
                </div>
            </div>
            <div class="pt-4 border-t border-slate-100 text-center">
                <a href="{{ route('admin.admission-applications.index') }}" class="text-xs font-bold text-amber-600 hover:underline inline-flex items-center gap-1">
                    Manage All Applications →
                </a>
            </div>
        </div>

    </div>

    {{-- =========================================================
        7-DAY VISITOR TRAFFIC CHART
    ========================================================== --}}
    <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-base font-bold text-slate-900">Website Traffic (Last 7 Days)</h2>
                <p class="text-xs text-slate-400 mt-0.5">Daily visitor count for the past week</p>
            </div>
            <span class="text-xs font-bold px-3 py-1 rounded-full bg-slate-100 text-slate-700">
                Total Today: @bnDigit($todayVisitors)
            </span>
        </div>

        @php
            $maxVis = max(1, $visitorChart->max('visitors'));
        @endphp
        <div class="grid grid-cols-7 gap-2 sm:gap-4 items-end h-48 pt-6 pb-2 border-b border-slate-100">
            @foreach($visitorChart as $bar)
                @php
                    $pct = max(8, round(($bar['visitors'] / $maxVis) * 100));
                @endphp
                <div class="flex flex-col items-center h-full justify-end group">
                    <span class="text-[10px] sm:text-xs font-bold text-slate-600 mb-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        @bnDigit($bar['visitors'])
                    </span>
                    <div class="w-full max-w-[40px] rounded-t-xl bg-gradient-to-t from-emerald-600 to-teal-400 group-hover:from-emerald-500 group-hover:to-teal-300 transition-all duration-300 shadow-sm" style="height: {{ $pct }}%;"></div>
                    <span class="text-[10px] sm:text-xs text-slate-400 mt-2 font-medium truncate">
                        {{ $bar['date'] }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection