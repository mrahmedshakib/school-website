@extends('backend.layouts.app')
@section('title', 'Notices')
@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                Notices
            </h1>
            <p class="mt-2 text-sm text-gray-500">
                Manage all school notices from here.
            </p>
        </div>
        <a
            href="{{ route('admin.notices.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#0F766E] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#0d665f]"
        >
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-5 w-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M12 4v16m8-8H4"/>
            </svg>
            Add Notice
    </div>
    {{-- Table Card --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        {{-- Card Header --}}
        <div class="border-b border-gray-200 px-6 py-5">
            <h2 class="text-lg font-bold text-gray-900">
                Notice List
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                All active and inactive notices.
            </p>
        </div>
        {{-- Desktop Table --}}
        <div class="hidden overflow-x-auto md:block">
            <table class="w-full divide-y divide-gray-200 text-xs">
                <thead class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-3 py-2.5 w-12 text-center">#</th>
                        <th class="px-3.5 py-2.5">নোটিশ শিরোনাম ও বিষয়</th>
                        <th class="px-3 py-2.5 w-28 whitespace-nowrap">তারিখ</th>
                        <th class="px-3 py-2.5 w-24 text-center whitespace-nowrap">ফাইল</th>
                        <th class="px-3 py-2.5 w-20 text-center whitespace-nowrap">অবস্থা</th>
                        <th class="px-3 py-2.5 w-24 text-right whitespace-nowrap">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white text-xs">
                    @forelse($notices as $notice)
                        <tr class="transition hover:bg-slate-50">
                            {{-- Number --}}
                            <td class="px-3 py-2.5 text-center text-slate-400 font-mono">
                                {{ $notices->firstItem() + $loop->index }}
                            </td>
                            {{-- Notice --}}
                            <td class="px-3.5 py-2.5">
                                <div class="flex items-center gap-1.5 mb-0.5">
                                    <span class="inline-flex px-2 py-0.2 rounded text-[10px] font-bold bg-teal-50 text-teal-700 border border-teal-200">
                                        {{ $notice->category ?? 'সাধারণ' }}
                                    </span>
                                </div>
                                <p class="font-bold text-slate-900 leading-snug line-clamp-1">
                                    {{ $notice->title_bn ?: $notice->title }}
                                </p>
                                @if($notice->title_en)
                                    <p class="text-[11px] text-slate-400 font-normal truncate">
                                        {{ $notice->title_en }}
                                    </p>
                                @endif
                            </td>
                            {{-- Date --}}
                            <td class="px-3 py-2.5 whitespace-nowrap text-slate-600 font-mono text-[11px]">
                                @if($notice->notice_date)
                                    {{ $notice->notice_date->format('d M, Y') }}
                                @else
                                    <span class="text-slate-400">—</span>
                                @endif
                            </td>
                            {{-- File --}}
                            <td class="px-3 py-2.5 text-center whitespace-nowrap">
                                @if($notice->file)
                                    <a href="{{ asset($notice->file) }}" target="_blank"
                                       class="inline-flex items-center gap-1 rounded-lg bg-emerald-50 px-2 py-1 text-[11px] font-bold text-emerald-700 hover:bg-emerald-100 transition">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        পিডিএফ
                                    </a>
                                @else
                                    <span class="text-[11px] text-slate-300">নেই</span>
                                @endif
                            </td>
                            {{-- Status --}}
                            <td class="px-3 py-2.5 text-center whitespace-nowrap">
                                <form action="{{ route('admin.notices.toggle-status', ['id' => $notice->id]) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="inline-flex items-center rounded-full px-2 py-0.5 text-[10px] font-bold transition {{ $notice->status ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-rose-100 text-rose-800 hover:bg-rose-200' }}">
                                        {{ $notice->status ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                                    </button>
                                </form>
                            </td>
                            {{-- Actions --}}
                            <td class="px-3 py-2.5 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.notices.edit', ['id' => $notice->id]) }}"
                                       title="সম্পাদনা করুন"
                                       class="p-1.5 rounded-lg text-slate-500 hover:text-emerald-700 hover:bg-emerald-50 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.notices.destroy', ['id' => $notice->id]) }}"
                                          method="POST"
                                          onsubmit="return confirm('আপনি কি নিশ্চিত যে এই নোটিশটি মুছে ফেলতে চান?')"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="মুছে ফেলুন"
                                                class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-7 w-7 text-gray-400"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="2">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2h-1V5a2 2 0 00-2-2H8a2 2 0 00-2 2v2H5a2 2 0 00-2 2v2"/>
                                        </svg>
                                    </div>
                                    <h3 class="mt-4 text-base font-bold text-gray-900">
                                        No notices found
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Start by creating your first notice.
                                    </p>
                                    <a
                                        href="{{ route('admin.notices.create') }}"
                                        class="mt-5 rounded-xl bg-[#0F766E] px-5 py-3 text-sm font-semibold text-white hover:bg-[#0d665f]"
                                    >
                                        Add Notice
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Mobile Cards --}}
        <div class="divide-y divide-gray-100 md:hidden">
            @forelse($notices as $notice)
                <div class="p-5">
                    <div class="flex items-start justify-between gap-4">
                        <div class="min-w-0">
                            <h3 class="font-bold text-gray-900">
                                {{ $notice->title }}
                            </h3>
                            @if($notice->description)
                                <p class="mt-2 line-clamp-3 text-sm text-gray-500">
                                    {{ $notice->description }}
                                </p>
                            @endif
                        </div>
                        <span class="shrink-0 rounded-full px-3 py-1 text-xs font-bold {{ $notice->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $notice->status ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="mt-4 flex flex-wrap items-center gap-2">
                        @if($notice->notice_date)
                            <span class="rounded-lg bg-gray-100 px-3 py-2 text-xs text-gray-600">
                                {{ $notice->notice_date->format('d M Y') }}
                            </span>
                        @endif
                        @if($notice->file)
                            <a
                                href="{{ asset($notice->file) }}"
                                target="_blank"
                                class="rounded-lg bg-gray-100 px-3 py-2 text-xs font-semibold text-gray-700"
                            >
                                View File
                            </a>
                        @endif
                    </div>
                    <div class="mt-4 flex gap-2">
                        <a
                            href="{{ route('admin.notices.edit', ['id' => $notice->id]) }}"
                            class="flex-1 rounded-lg bg-blue-50 px-4 py-2.5 text-center text-xs font-semibold text-blue-700"
                        >
                            Edit
                        </a>
                        <form
                            action="{{ route('admin.notices.toggle-status', ['id' => $notice->id]) }}"
                            method="POST"
                            class="flex-1"
                        >
                            @csrf
                            @method('PATCH')
                            <button
                                type="submit"
                                class="w-full rounded-lg bg-gray-100 px-4 py-2.5 text-xs font-semibold text-gray-700"
                            >
                                Toggle Status
                            </button>
                        </form>
                        <form
                            action="{{ route('admin.notices.destroy', ['id' => $notice->id]) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this notice?')"
                        >
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="rounded-lg bg-red-50 px-4 py-2.5 text-xs font-semibold text-red-700"
                            >
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="px-5 py-16 text-center">
                    <h3 class="font-bold text-gray-900">
                        No notices found
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Start by creating your first notice.
                    </p>
                </div>
            @endforelse
        </div>
        {{-- Pagination --}}
        @if($notices->hasPages())
            <div class="px-5 py-4 border-t border-gray-200">
                {{ $notices->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
