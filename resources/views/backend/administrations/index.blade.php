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
            class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700"
        >
            <span class="text-lg leading-none">+</span>
            <span>Add Administration</span>
        </a>
    </div>
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
            <table class="w-full text-xs">
                <thead class="border-b border-slate-200 bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="w-12 px-3 py-2.5 text-center">ছবি</th>
                        <th class="px-3.5 py-2.5 text-left">নাম ও ইমেইল</th>
                        <th class="px-3 py-2.5 text-left">পদবি</th>
                        <th class="w-28 px-3 py-2.5 text-left whitespace-nowrap">যোগাযোগ</th>
                        <th class="w-16 px-3 py-2.5 text-center whitespace-nowrap">ক্রম</th>
                        <th class="w-20 px-3 py-2.5 text-center whitespace-nowrap">অবস্থা</th>
                        <th class="w-20 px-3 py-2.5 text-right whitespace-nowrap">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($administrations as $administration)
                        <tr class="transition hover:bg-slate-50">
                            {{-- Image --}}
                            <td class="px-3 py-2.5 text-center">
                                @if($administration->image)
                                    <img src="{{ asset('storage/' . $administration->image) }}"
                                         alt="{{ $administration->name }}"
                                         class="h-9 w-9 rounded-full border border-slate-200 object-cover mx-auto"
                                         loading="lazy">
                                @else
                                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-50 text-emerald-700 font-bold text-xs mx-auto">
                                        {{ mb_substr($administration->name, 0, 1) }}
                                    </div>
                                @endif
                            </td>
                            {{-- Name --}}
                            <td class="px-3.5 py-2.5">
                                <div class="font-bold text-slate-900 line-clamp-1">
                                    {{ $administration->name }}
                                </div>
                                @if($administration->email)
                                    <div class="text-[11px] text-slate-400 truncate">
                                        {{ $administration->email }}
                                    </div>
                                @endif
                            </td>
                            {{-- Designation --}}
                            <td class="px-3 py-2.5 text-slate-700 font-medium">
                                {{ $administration->designation }}
                            </td>
                            {{-- Contact --}}
                            <td class="px-3 py-2.5 whitespace-nowrap text-slate-600 font-mono text-[11px]">
                                {{ $administration->phone ?: '—' }}
                            </td>
                            {{-- Sort Order --}}
                            <td class="px-3 py-2.5 text-center whitespace-nowrap font-mono text-slate-500">
                                {{ $administration->sort_order }}
                            </td>
                            {{-- Status --}}
                            <td class="px-3 py-2.5 text-center whitespace-nowrap">
                                <form action="{{ route('admin.administrations.toggle-status', $administration->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="inline-flex items-center justify-center rounded-full px-2 py-0.5 text-[10px] font-bold transition {{ $administration->status ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-rose-100 text-rose-800 hover:bg-rose-200' }}">
                                        {{ $administration->status ? 'সক্রিয়' : 'নিষ্ক্রিয়' }}
                                    </button>
                                </form>
                            </td>
                            {{-- Actions --}}
                            <td class="px-3 py-2.5 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.administrations.edit', $administration->id) }}"
                                       title="সম্পাদনা করুন"
                                       class="p-1.5 rounded-lg text-slate-500 hover:text-emerald-700 hover:bg-emerald-50 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.administrations.destroy', $administration->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('আপনি কি নিশ্চিত যে এই সদস্যকে মুছে ফেলতে চান?');"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="মুছে ফেলুন"
                                                class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"/></svg>
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