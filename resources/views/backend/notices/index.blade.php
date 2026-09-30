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
        </a>
    </div>
    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif
    {{-- Error Message --}}
    @if(session('error'))
        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif
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
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                            #
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                            Notice
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                            Date
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                            File
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-gray-500">
                            Status
                        </th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($notices as $notice)
                        <tr class="transition hover:bg-gray-50">
                            {{-- Number --}}
                            <td class="px-6 py-5 whitespace-nowrap">
                                <span class="text-sm font-semibold text-gray-500">
                                    {{ $notices->firstItem() + $loop->index }}
                                </span>
                            </td>
                            {{-- Notice --}}
                            <td class="px-6 py-5">
                                <div class="max-w-md">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="inline-flex px-2.5 py-0.5 rounded-full text-xs font-semibold bg-teal-50 text-teal-700 border border-teal-200">
                                            {{ $notice->category ?? 'General' }}
                                        </span>
                                    </div>
                                    <p class="font-semibold text-gray-900">
                                        {{ $notice->title_bn ?: $notice->title }}
                                    </p>
                                    @if($notice->title_en)
                                        <p class="text-xs text-gray-500 font-medium">
                                            {{ $notice->title_en }}
                                        </p>
                                    @endif
                                    @if($notice->description || $notice->description_bn)
                                        <p class="mt-1 line-clamp-2 text-xs text-gray-400">
                                            {{ $notice->description_bn ?: $notice->description }}
                                        </p>
                                    @endif
                                </div>
                            </td>
                            {{-- Date --}}
                            <td class="px-6 py-5 whitespace-nowrap">
                                @if($notice->notice_date)
                                    <span class="text-sm text-gray-700">
                                        {{ $notice->notice_date->format('d M Y') }}
                                    </span>
                                @else
                                    <span class="text-sm text-gray-400">
                                        —
                                    </span>
                                @endif
                            </td>
                            {{-- File --}}
                            <td class="px-6 py-5 whitespace-nowrap">
                                @if($notice->file)
                                    <a
                                        href="{{ asset($notice->file) }}"
                                        target="_blank"
                                        class="inline-flex items-center gap-2 rounded-lg bg-gray-100 px-3 py-2 text-xs font-semibold text-gray-700 transition hover:bg-gray-200"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-4 w-4"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="2">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        View File
                                    </a>
                                @else
                                    <span class="text-sm text-gray-400">
                                        No file
                                    </span>
                                @endif
                            </td>
                            {{-- Status --}}
                            <td class="px-6 py-5 whitespace-nowrap">
                                <form
                                    action="{{ route('admin.notices.toggle-status', ['id' => $notice->id]) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('PATCH')
                                    <button
                                        type="submit"
                                        class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold transition {{ $notice->status ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-red-100 text-red-700 hover:bg-red-200' }}"
                                    >
                                        {{ $notice->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            {{-- Actions --}}
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="flex justify-end gap-2">
                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('admin.notices.edit', ['id' => $notice->id]) }}"
                                        class="inline-flex items-center justify-center rounded-lg bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700 transition hover:bg-blue-100"
                                    >
                                        Edit
                                    </a>
                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('admin.notices.destroy', ['id' => $notice->id]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this notice?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="inline-flex items-center justify-center rounded-lg bg-red-50 px-3 py-2 text-xs font-semibold text-red-700 transition hover:bg-red-100"
                                        >
                                            Delete
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
