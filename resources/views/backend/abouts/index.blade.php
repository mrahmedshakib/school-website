@extends('backend.layouts.app')

@section('title', 'About School')
@section('page_title', 'About School')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                About School
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Manage the institutional history, principal's greeting, introduction, and campus profile.
            </p>
        </div>

        <a href="{{ route('admin.abouts.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add About Section
        </a>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900">About Content Sections</h2>
                <p class="text-xs text-slate-400 mt-0.5">Total {{ $abouts->count() }} sections configured</p>
            </div>
            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-slate-100 text-slate-600">
                {{ $abouts->where('status', 1)->count() }} Active
            </span>
        </div>

        @if($abouts->count())
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-3 py-2.5 w-10">#</th>
                            <th class="px-3 py-2.5 w-16">Image</th>
                            <th class="px-3 py-2.5">Section Title & Content</th>
                            <th class="px-3 py-2.5 w-32">Button / Link</th>
                            <th class="px-3 py-2.5 text-center w-24">Status</th>
                            <th class="px-3 py-2.5 text-right w-20">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @foreach($abouts as $about)
                            <tr class="hover:bg-slate-50/70 transition">
                                <td class="px-3 py-2.5 font-mono text-slate-400">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-3 py-2.5">
                                    @if($about->image)
                                        <img src="{{ asset($about->image) }}" alt="{{ $about->title }}" class="w-12 h-9 rounded-lg object-cover border border-slate-200 shadow-xs">
                                    @else
                                        <div class="w-12 h-9 rounded-lg bg-slate-100 text-slate-400 flex items-center justify-center text-[10px] font-semibold border border-slate-200">
                                            No Img
                                        </div>
                                    @endif
                                </td>

                                <td class="px-3 py-2.5">
                                    <h3 class="font-bold text-slate-900 line-clamp-1 hover:text-emerald-600 transition">
                                        {{ $about->title }}
                                    </h3>
                                    <p class="text-[11px] text-slate-500 mt-0.5 line-clamp-1 leading-relaxed">
                                        {{ strip_tags($about->description) }}
                                    </p>
                                </td>

                                <td class="px-3 py-2.5 whitespace-nowrap">
                                    @if($about->button_text)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 font-semibold border border-slate-200 text-[11px]">
                                            {{ $about->button_text }}
                                        </span>
                                        @if($about->button_url)
                                            <p class="text-[10px] text-slate-400 mt-0.5 truncate max-w-[120px]" title="{{ $about->button_url }}">
                                                {{ $about->button_url }}
                                            </p>
                                        @endif
                                    @else
                                        <span class="text-slate-400">—</span>
                                    @endif
                                </td>

                                <td class="px-3 py-2.5 text-center whitespace-nowrap">
                                    <form action="{{ route('admin.abouts.toggle-status', $about->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        @if($about->status)
                                            <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100 transition" title="Click to make inactive">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Active
                                            </button>
                                        @else
                                            <button type="submit" class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-slate-100 text-slate-600 border border-slate-200 hover:bg-slate-200 transition" title="Click to make active">
                                                <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                                Inactive
                                            </button>
                                        @endif
                                    </form>
                                </td>

                                <td class="px-3 py-2.5 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.abouts.edit', $about->id) }}" class="p-1.5 rounded-lg text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 transition" title="Edit">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                        <form action="{{ route('admin.abouts.destroy', $about->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this About section?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition" title="Delete">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            {{-- Empty State --}}
            <div class="p-12 text-center">
                <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-3xl mx-auto mb-4">
                    🏫
                </div>
                <h3 class="text-base font-bold text-slate-900">No About Section Found</h3>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 mb-6 max-w-sm mx-auto">
                    Add detailed information about your school's journey, milestones, and facilities.
                </p>
                <a href="{{ route('admin.abouts.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                    + Add About Section
                </a>
            </div>
        @endif
    </div>

</div>
@endsection
