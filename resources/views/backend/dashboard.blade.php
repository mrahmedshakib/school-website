@extends('backend.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

<div class="space-y-8">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

        <div>
            <p class="text-sm font-semibold text-[#0F766E] mb-1">
                School Administration
            </p>

            <h1 class="text-3xl font-black text-[#123B5D]">
                Dashboard
            </h1>

            <p class="text-gray-500 mt-2">
                Welcome back! Here's what's happening on your school website.
            </p>
        </div>

        <div class="flex items-center gap-3">

            <div class="px-4 py-3 rounded-2xl bg-white border border-gray-100 shadow-sm">
                <p class="text-xs text-gray-400">
                    Today
                </p>

                <p class="text-sm font-bold text-gray-700">
                    {{ now()->format('d M Y') }}
                </p>
            </div>

        </div>

    </div>


    {{-- =========================================================
        MAIN STAT CARDS
    ========================================================== --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        {{-- Notices --}}
        <div class="group relative overflow-hidden
                    bg-white rounded-3xl border border-gray-100
                    p-6 shadow-sm
                    hover:shadow-xl hover:-translate-y-1
                    transition duration-300">

            <div class="absolute -right-8 -top-8
                        w-28 h-28 rounded-full
                        bg-[#0F766E]/5
                        group-hover:scale-150 transition duration-500">
            </div>

            <div class="relative">

                <div class="flex items-center justify-between">

                    <div class="w-12 h-12 rounded-2xl
                                bg-[#0F766E]/10
                                flex items-center justify-center
                                text-xl">
                        📢
                    </div>

                    <span class="text-xs font-bold text-[#0F766E]
                                 bg-[#0F766E]/10
                                 px-3 py-1.5 rounded-full">
                        Content
                    </span>

                </div>

                <p class="text-sm font-medium text-gray-500 mt-5">
                    Total Notices
                </p>

                <h2 class="text-4xl font-black text-[#123B5D] mt-1">
                    {{ $totalNotices }}
                </h2>

                <a
                    href="{{ route('admin.notices.index') }}"
                    class="inline-flex items-center gap-1
                           mt-4 text-sm font-bold
                           text-[#0F766E]
                           hover:gap-2 transition-all"
                >
                    Manage Notices →
                </a>

            </div>

        </div>


        {{-- News --}}
        <div class="group relative overflow-hidden
                    bg-white rounded-3xl border border-gray-100
                    p-6 shadow-sm
                    hover:shadow-xl hover:-translate-y-1
                    transition duration-300">

            <div class="absolute -right-8 -top-8
                        w-28 h-28 rounded-full
                        bg-[#123B5D]/5
                        group-hover:scale-150 transition duration-500">
            </div>

            <div class="relative">

                <div class="flex items-center justify-between">

                    <div class="w-12 h-12 rounded-2xl
                                bg-[#123B5D]/10
                                flex items-center justify-center
                                text-xl">
                        📰
                    </div>

                    <span class="text-xs font-bold text-[#123B5D]
                                 bg-[#123B5D]/10
                                 px-3 py-1.5 rounded-full">
                        News
                    </span>

                </div>

                <p class="text-sm font-medium text-gray-500 mt-5">
                    Total News
                </p>

                <h2 class="text-4xl font-black text-[#123B5D] mt-1">
                    {{ $totalNews }}
                </h2>

                <span class="inline-flex items-center gap-1
                             mt-4 text-sm font-semibold
                             text-gray-400">
                    News management coming soon
                </span>

            </div>

        </div>


        {{-- Events --}}
        <div class="group relative overflow-hidden
                    bg-white rounded-3xl border border-gray-100
                    p-6 shadow-sm
                    hover:shadow-xl hover:-translate-y-1
                    transition duration-300">

            <div class="absolute -right-8 -top-8
                        w-28 h-28 rounded-full
                        bg-amber-500/5
                        group-hover:scale-150 transition duration-500">
            </div>

            <div class="relative">

                <div class="flex items-center justify-between">

                    <div class="w-12 h-12 rounded-2xl
                                bg-amber-100
                                flex items-center justify-center
                                text-xl">
                        📅
                    </div>

                    <span class="text-xs font-bold text-amber-600
                                 bg-amber-50
                                 px-3 py-1.5 rounded-full">
                        Events
                    </span>

                </div>

                <p class="text-sm font-medium text-gray-500 mt-5">
                    Total Events
                </p>

                <h2 class="text-4xl font-black text-[#123B5D] mt-1">
                    {{ $totalEvents }}
                </h2>

                <span class="inline-flex items-center gap-1
                             mt-4 text-sm font-semibold
                             text-gray-400">
                    Event management coming soon
                </span>

            </div>

        </div>


        {{-- Gallery --}}
        <div class="group relative overflow-hidden
                    bg-white rounded-3xl border border-gray-100
                    p-6 shadow-sm
                    hover:shadow-xl hover:-translate-y-1
                    transition duration-300">

            <div class="absolute -right-8 -top-8
                        w-28 h-28 rounded-full
                        bg-purple-500/5
                        group-hover:scale-150 transition duration-500">
            </div>

            <div class="relative">

                <div class="flex items-center justify-between">

                    <div class="w-12 h-12 rounded-2xl
                                bg-purple-100
                                flex items-center justify-center
                                text-xl">
                        🖼️
                    </div>

                    <span class="text-xs font-bold text-purple-600
                                 bg-purple-50
                                 px-3 py-1.5 rounded-full">
                        Media
                    </span>

                </div>

                <p class="text-sm font-medium text-gray-500 mt-5">
                    Gallery Images
                </p>

                <h2 class="text-4xl font-black text-[#123B5D] mt-1">
                    {{ $totalGalleryImages }}
                </h2>

                <span class="inline-flex items-center gap-1
                             mt-4 text-sm font-semibold
                             text-gray-400">
                    Gallery management coming soon
                </span>

            </div>

        </div>

    </div>


    {{-- =========================================================
        VISITOR CHART
    ========================================================= --}}
    <div class="bg-white rounded-3xl
                border border-gray-100
                shadow-sm overflow-hidden">

        <div class="px-6 sm:px-7 py-6
                    border-b border-gray-100
                    flex flex-col sm:flex-row
                    sm:items-center sm:justify-between
                    gap-3">

            <div>

                <h2 class="text-xl font-black text-[#123B5D]">
                    Visitor Analytics
                </h2>

                <p class="text-sm text-gray-400 mt-1">
                    Website visitors over the last 7 days.
                </p>

            </div>

            <div class="flex items-center gap-2">

                <span class="w-2.5 h-2.5 rounded-full
                            bg-[#0F766E]">
                </span>

                <span class="text-xs font-semibold text-gray-500">
                    Visitors
                </span>

            </div>

        </div>


        <div class="p-5 sm:p-7">

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

                {{-- Summary --}}
                <div class="lg:col-span-1
                            rounded-2xl
                            bg-[#F7F8F4]
                            p-6">

                    <p class="text-sm text-gray-500">
                        Last 7 Days
                    </p>

                    <h3 class="text-4xl font-black
                            text-[#123B5D] mt-2">

                        {{ number_format($visitorChart->sum('visitors')) }}

                    </h3>

                    <p class="text-xs text-gray-400 mt-2">
                        Total recorded visits
                    </p>

                    <div class="mt-6 pt-5 border-t border-gray-200">

                        <p class="text-sm text-gray-500">
                            Today
                        </p>

                        <p class="text-2xl font-black
                                text-[#0F766E] mt-1">

                            {{ number_format($todayVisitors) }}

                        </p>

                    </div>

                </div>


                {{-- Chart --}}
                <div class="lg:col-span-3">

                    <div class="h-[280px] flex items-end gap-3 sm:gap-5">

                        @php
                            $maxVisitors = max(
                                $visitorChart->max('visitors'),
                                1
                            );
                        @endphp

                        @foreach($visitorChart as $item)

                            @php
                                $height = $item['visitors'] > 0
                                    ? max(
                                        8,
                                        ($item['visitors'] / $maxVisitors) * 100
                                    )
                                    : 4;
                            @endphp

                            <div class="flex-1 h-full
                                        flex flex-col
                                        justify-end
                                        items-center gap-3">

                                {{-- Number --}}
                                <span class="text-xs font-bold text-gray-500">
                                    {{ $item['visitors'] }}
                                </span>

                                {{-- Bar --}}
                                <div
                                    class="w-full max-w-[55px]
                                        rounded-t-xl
                                        bg-[#0F766E]
                                        hover:bg-[#123B5D]
                                        transition-all duration-300"
                                    style="height: {{ $height }}%;"
                                    title="{{ $item['visitors'] }} visitors"
                                >
                                </div>

                                {{-- Date --}}
                                <span class="text-[11px] sm:text-xs
                                            font-semibold text-gray-400
                                            whitespace-nowrap">
                                    {{ $item['date'] }}
                                </span>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- =========================================================
        RECENT NOTICE
    ========================================================== --}}
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-gray-100
                    flex items-center justify-between">

            <div>

                <h2 class="text-lg font-black text-[#123B5D]">
                    Notice Management
                </h2>

                <p class="text-xs text-gray-400 mt-1">
                    Keep your school announcements up to date.
                </p>

            </div>

            <a
                href="{{ route('admin.notices.index') }}"
                class="text-sm font-bold text-[#0F766E]
                       hover:underline"
            >
                View All →
            </a>

        </div>

        <div class="p-6">

            <div class="flex flex-col sm:flex-row
                        sm:items-center sm:justify-between
                        gap-4 rounded-2xl
                        bg-[#F7F8F4]
                        p-5">

                <div class="flex items-center gap-4">

                    <div class="w-11 h-11 rounded-xl
                                bg-[#0F766E]/10
                                flex items-center justify-center">
                        📢
                    </div>

                    <div>
                        <p class="font-bold text-[#123B5D]">
                            {{ $totalNotices }} Active/Available Notices
                        </p>

                        <p class="text-xs text-gray-400 mt-1">
                            Manage notices from the notice section.
                        </p>
                    </div>

                </div>

                <a
                    href="{{ route('admin.notices.index') }}"
                    class="inline-flex items-center justify-center
                           px-5 py-2.5 rounded-xl
                           bg-[#0F766E] text-white
                           text-sm font-bold
                           hover:bg-[#0b625d]
                           transition"
                >
                    Manage Notices
                </a>

            </div>

        </div>

    </div>

</div>

@endsection