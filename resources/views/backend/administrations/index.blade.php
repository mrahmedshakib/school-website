@extends('backend.layouts.app')
@section('title', 'Administration')
@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                Administration
            </h1>
            <p class="mt-2 text-sm text-gray-500">
                Manage school administration members.
            </p>
        </div>
        <a
            href="{{ route('admin.administrations.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800"
        >
            <span class="text-lg leading-none">+</span>
            <span>Add Administration</span>
        </a>
    </div>
    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif
    {{-- Error Message --}}
    @if(session('error'))
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif
    {{-- Stats --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3 mb-8">
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-gray-500">
                Total
            </p>
            <p class="mt-1 text-2xl font-bold text-gray-900">
                {{ $totalAdministrations }}
            </p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-gray-500">
                Active
            </p>
            <p class="mt-1 text-2xl font-bold text-green-600">
                {{ $activeAdministrations }}
            </p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-gray-500">
                Inactive
            </p>
            <p class="mt-1 text-2xl font-bold text-red-600">
                {{ $inactiveAdministrations }}
            </p>
        </div>
    </div>
    {{-- Table Card --}}
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="border-b border-gray-200 bg-gray-50">
                    <tr>
                        <th class="w-20 px-5 py-4 text-left text-xs font-bold uppercase tracking-wide text-gray-500">
                            Image
                        </th>
                        <th class="min-w-[220px] px-5 py-4 text-left text-xs font-bold uppercase tracking-wide text-gray-500">
                            Name
                        </th>
                        <th class="min-w-[180px] px-5 py-4 text-left text-xs font-bold uppercase tracking-wide text-gray-500">
                            Designation
                        </th>
                        <th class="min-w-[150px] px-5 py-4 text-left text-xs font-bold uppercase tracking-wide text-gray-500">
                            Contact
                        </th>
                        <th class="w-24 px-5 py-4 text-center text-xs font-bold uppercase tracking-wide text-gray-500">
                            Order
                        </th>
                        <th class="w-28 px-5 py-4 text-center text-xs font-bold uppercase tracking-wide text-gray-500">
                            Status
                        </th>
                        <th class="w-40 px-5 py-4 text-right text-xs font-bold uppercase tracking-wide text-gray-500">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($administrations as $administration)
                        <tr class="transition hover:bg-gray-50">
                            {{-- Image --}}
                            <td class="px-5 py-4 align-middle">
                                @if($administration->image)
                                    <img
                                        src="{{ asset('storage/' . $administration->image) }}"
                                        alt="{{ $administration->name }}"
                                        class="h-12 w-12 rounded-full border border-gray-200 object-cover"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-100 text-gray-400">
                                        <span class="text-lg">👤</span>
                                    </div>
                                @endif
                            </td>
                            {{-- Name --}}
                            <td class="px-5 py-4 align-middle">
                                <div class="font-semibold leading-5 text-gray-900">
                                    {{ $administration->name }}
                                </div>
                                @if($administration->email)
                                    <div class="mt-1 text-xs leading-4 text-gray-500">
                                        {{ $administration->email }}
                                    </div>
                                @endif
                            </td>
                            {{-- Designation --}}
                            <td class="px-5 py-4 align-middle">
                                <span class="text-gray-600">
                                    {{ $administration->designation }}
                                </span>
                            </td>
                            {{-- Contact --}}
                            <td class="px-5 py-4 align-middle">
                                @if($administration->phone)
                                    <span class="text-gray-700">
                                        {{ $administration->phone }}
                                    </span>
                                @else
                                    <span class="text-gray-400">
                                        —
                                    </span>
                                @endif
                            </td>
                            {{-- Sort Order --}}
                            <td class="px-5 py-4 text-center align-middle">
                                <span class="inline-flex min-w-8 items-center justify-center rounded-md bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-600">
                                    {{ $administration->sort_order }}
                                </span>
                            </td>
                            {{-- Status --}}
                            <td class="px-5 py-4 text-center align-middle">
                                <form
                                    action="{{ route('admin.administrations.toggle-status', $administration->id) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('PATCH')
                                    <button
                                        type="submit"
                                        class="inline-flex min-w-[78px] items-center justify-center rounded-full px-3 py-1.5 text-xs font-bold transition {{ $administration->status ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-red-100 text-red-700 hover:bg-red-200' }}"
                                    >
                                        {{ $administration->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            {{-- Actions --}}
                            <td class="px-5 py-4 text-right align-middle">
                                <div class="flex items-center justify-end gap-2">
                                    <a
                                        href="{{ route('admin.administrations.edit', $administration->id) }}"
                                        class="inline-flex items-center justify-center rounded-lg bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-700 transition hover:bg-blue-100"
                                    >
                                        Edit
                                    </a>
                                    <form
                                        action="{{ route('admin.administrations.destroy', $administration->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this administration member?');"
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
                            <td colspan="7" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100">
                                        <span class="text-2xl">👔</span>
                                    </div>
                                    <h3 class="mt-4 text-base font-bold text-gray-900">
                                        No Administration Found
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Add your first administration member.
                                    </p>
                                    <a
                                        href="{{ route('admin.administrations.create') }}"
                                        class="mt-5 inline-flex items-center justify-center rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800"
                                    >
                                        Add Administration
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Pagination --}}
        @if($administrations->hasPages())
            <div class="border-t border-gray-200 px-5 py-4">
                {{ $administrations->links() }}
            </div>
        @endif
    </div>
</div>
@endsection