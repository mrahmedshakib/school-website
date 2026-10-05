@extends('backend.layouts.app')

@section('title', 'Mission & Vision')
@section('page_title', 'Mission & Vision')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                Mission & Vision
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Manage your school's official institutional mission, vision, and core philosophy.
            </p>
        </div>

        @if(!$missionVision)
            <a href="{{ route('admin.mission-visions.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create Mission & Vision
            </a>
        @else
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.mission-visions.edit', $missionVision->id) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Content
                </a>
                <a href="{{ route('admin.mission-visions.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-sm transition">
                    + Add New
                </a>
            </div>
        @endif
    </div>

    @if($missionVision)
        {{-- Status & Meta Overview Bar --}}
        <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="text-sm font-semibold text-slate-700">Display Status:</span>
                <form action="{{ route('admin.mission-visions.toggle-status', $missionVision->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    @if($missionVision->status)
                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 hover:bg-emerald-200 transition" title="Click to toggle inactive">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Active on Public Site
                        </button>
                    @else
                        <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600 hover:bg-slate-200 transition" title="Click to toggle active">
                            <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                            Inactive (Hidden)
                        </button>
                    @endif
                </form>
            </div>

            <div class="flex items-center gap-2 text-xs text-slate-400">
                <span>Last updated: {{ $missionVision->updated_at ? $missionVision->updated_at->format('d M Y, h:i A') : 'N/A' }}</span>
                <span>•</span>
                <form action="{{ route('admin.mission-visions.destroy', $missionVision->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Mission & Vision entry?');" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-rose-600 hover:text-rose-700 font-semibold">Delete</button>
                </form>
            </div>
        </div>

        {{-- Mission & Vision Visual Presentation Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Mission Card --}}
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-2xl font-bold">
                            🎯
                        </div>
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-3 py-1 rounded-full">
                            Our Mission
                        </span>
                    </div>

                    <h3 class="text-xl font-extrabold text-slate-900 tracking-tight mb-3">
                        {{ $missionVision->mission_title }}
                    </h3>

                    <div class="text-slate-600 text-sm leading-relaxed whitespace-pre-line">
                        {{ $missionVision->mission_description }}
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100 text-xs text-slate-400">
                    Shown in homepage & about section
                </div>
            </div>

            {{-- Vision Card --}}
            <div class="bg-white rounded-3xl p-7 border border-slate-200/80 shadow-xs hover:shadow-md transition flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-5">
                        <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-700 flex items-center justify-center text-2xl font-bold">
                            🔭
                        </div>
                        <span class="text-xs font-bold uppercase tracking-wider text-teal-700 bg-teal-50 px-3 py-1 rounded-full">
                            Our Vision
                        </span>
                    </div>

                    <h3 class="text-xl font-extrabold text-slate-900 tracking-tight mb-3">
                        {{ $missionVision->vision_title }}
                    </h3>

                    <div class="text-slate-600 text-sm leading-relaxed whitespace-pre-line">
                        {{ $missionVision->vision_description }}
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-100 text-xs text-slate-400">
                    Shown in homepage & about section
                </div>
            </div>

        </div>

    @else
        {{-- Empty State --}}
        <div class="bg-white rounded-3xl p-12 text-center border border-slate-200/80 shadow-xs max-w-lg mx-auto">
            <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-3xl mx-auto mb-4">
                🎯
            </div>
            <h3 class="text-lg font-bold text-slate-900">No Mission & Vision Configured</h3>
            <p class="text-sm text-slate-500 mt-2 mb-6">
                Define your school's core mission statement and forward vision for students, parents, and visitors.
            </p>
            <a href="{{ route('admin.mission-visions.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                Create Mission & Vision
            </a>
        </div>
    @endif

</div>
@endsection
