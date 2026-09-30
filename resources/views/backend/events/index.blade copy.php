@extends('backend.layouts.app')

@section('title', 'Events')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Events
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Manage school events and upcoming programs.
            </p>
        </div>

        <a href="{{ route('admin.events.create') }}"
           class="inline-flex items-center justify-center gap-2
                  px-5 py-2.5 rounded-lg
                  bg-indigo-600 text-white
                  text-sm font-semibold
                  hover:bg-indigo-700 transition">
            <span class="text-lg">+</span>
            Add Event
        </a>
    </div>

    {{-- Success --}}
    @if(session('success'))
        <div class="mb-6 rounded-xl border border-emerald-200
                    bg-emerald-50 px-4 py-3 text-sm
                    text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error --}}
    @if($errors->any())
        <div class="mb-6 rounded-xl border border-red-200
                    bg-red-50 p-4">

            <p class="font-semibold text-red-800 mb-2">
                Please fix the following errors:
            </p>

            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white rounded-2xl border border-slate-200
                shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>
                        <th class="px-5 py-4 text-left font-semibold text-slate-600">
                            #
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-slate-600">
                            Event
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-slate-600">
                            Date
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-slate-600">
                            Time
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-slate-600">
                            Location
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-slate-600">
                            Order
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-slate-600">
                            Status
                        </th>

                        <th class="px-5 py-4 text-right font-semibold text-slate-600">
                            Action
                        </th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($events as $event)

                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-5 py-4 text-slate-500">
                                {{ $events->firstItem() + $loop->index }}
                            </td>

                            {{-- Event --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center gap-4">

                                    @if($event->image)

                                        <img
                                            src="{{ asset($event->image) }}"
                                            alt="{{ $event->title }}"
                                            class="w-16 h-16 rounded-xl object-cover
                                                   border border-slate-200"
                                        >

                                    @else

                                        <div class="w-16 h-16 rounded-xl
                                                    bg-indigo-50
                                                    flex items-center justify-center
                                                    text-2xl">
                                            📅
                                        </div>

                                    @endif

                                    <div>
                                        <h3 class="font-semibold text-slate-900">
                                            {{ $event->title }}
                                        </h3>

                                        @if($event->description)
                                            <p class="mt-1 text-xs text-slate-500 max-w-sm">
                                                {{ \Illuminate\Support\Str::limit($event->description, 70) }}
                                            </p>
                                        @endif
                                    </div>

                                </div>

                            </td>

                            {{-- Date --}}
                            <td class="px-5 py-4 text-slate-600 whitespace-nowrap">

                                @if($event->event_date)
                                    {{ $event->event_date->format('d M Y') }}
                                @else
                                    —
                                @endif

                            </td>

                            {{-- Time --}}
                            <td class="px-5 py-4 text-slate-600 whitespace-nowrap">
                                {{ $event->event_time ?: '—' }}
                            </td>

                            {{-- Location --}}
                            <td class="px-5 py-4 text-slate-600">
                                {{ $event->location ?: '—' }}
                            </td>

                            {{-- Order --}}
                            <td class="px-5 py-4 text-slate-600">
                                {{ $event->sort_order }}
                            </td>

                            {{-- Status --}}
                            <td class="px-5 py-4">

                                @if($event->status)

                                    <span class="inline-flex items-center
                                                 px-2.5 py-1 rounded-full
                                                 bg-emerald-50
                                                 text-emerald-700
                                                 text-xs font-semibold">
                                        Active
                                    </span>

                                @else

                                    <span class="inline-flex items-center
                                                 px-2.5 py-1 rounded-full
                                                 bg-slate-100
                                                 text-slate-600
                                                 text-xs font-semibold">
                                        Inactive
                                    </span>

                                @endif

                            </td>

                            {{-- Action --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    <a
                                        href="{{ route('admin.events.edit', $event) }}"
                                        class="inline-flex items-center
                                               px-3 py-2 rounded-lg
                                               bg-indigo-50 text-indigo-700
                                               text-xs font-semibold
                                               hover:bg-indigo-100 transition"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.events.destroy', $event) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this event?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center
                                                   px-3 py-2 rounded-lg
                                                   bg-red-50 text-red-700
                                                   text-xs font-semibold
                                                   hover:bg-red-100 transition"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="px-5 py-16 text-center">

                                <div class="text-5xl mb-4">
                                    📅
                                </div>

                                <h3 class="font-semibold text-slate-800">
                                    No events found
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Add your first school event.
                                </p>

                                <a
                                    href="{{ route('admin.events.create') }}"
                                    class="inline-flex mt-5 px-4 py-2.5
                                           rounded-lg bg-indigo-600
                                           text-white text-sm font-semibold
                                           hover:bg-indigo-700 transition"
                                >
                                    Add Event
                                </a>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        @if($events->hasPages())

            <div class="border-t border-slate-200 px-5 py-4">
                {{ $events->links() }}
            </div>

        @endif

    </div>

</div>
@endsection