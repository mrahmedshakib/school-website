@extends('backend.layouts.app')

@section('title', 'Gallery')

@section('content')

<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    {{-- =========================================================
        HEADER
    ========================================================= --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">
                Gallery
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage school gallery images.
            </p>
        </div>

        <a
            href="{{ route('admin.galleries.create') }}"
            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-emerald-600 text-white rounded-xl font-semibold text-sm hover:bg-emerald-700 transition shadow-sm"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4"
                />
            </svg>

            Add Gallery
        </a>

    </div>


    {{-- =========================================================
        ERROR MESSAGE
    ========================================================= --}}
    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl border border-red-200 bg-red-50">

            <div class="flex items-center gap-2 text-red-700 font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 8v4m0 4h.01M10.29 3.86l-7.82 13.5A2 2 0 004.2 20h15.6a2 2 0 001.73-2.64l-7.82-13.5a2 2 0 00-3.42 0z"
                    />
                </svg>

                Please fix the following errors:
            </div>

            <ul class="mt-2 ml-7 list-disc text-sm text-red-600">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif


    {{-- =========================================================
        GALLERY TABLE
    ========================================================= --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        {{-- Table Header --}}
        <div class="px-5 sm:px-6 py-4 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <div>
                <h2 class="text-lg font-bold text-slate-900">
                    Gallery Images
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Total:
                    <span class="font-semibold text-slate-700">
                        {{ $galleries->total() }}
                    </span>
                </p>
            </div>

        </div>


        @if($galleries->count())

            {{-- Desktop Table --}}
            <div class="overflow-x-auto">

                <table class="w-full text-xs">

                    <thead class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold uppercase tracking-wider text-slate-500">

                        <tr>

                            <th class="px-3 py-2.5 text-left w-10">
                                #
                            </th>

                            <th class="px-3 py-2.5 text-left w-16">
                                Image
                            </th>

                            <th class="px-3 py-2.5 text-left">
                                Title
                            </th>

                            <th class="px-3 py-2.5 text-left">
                                Description
                            </th>

                            <th class="px-3 py-2.5 text-center w-16">
                                Order
                            </th>

                            <th class="px-3 py-2.5 text-center w-24">
                                Status
                            </th>

                            <th class="px-3 py-2.5 text-right w-20">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100 text-slate-700">

                        @foreach($galleries as $gallery)

                            <tr class="hover:bg-slate-50 transition">

                                {{-- Number --}}
                                <td class="px-3 py-2.5 font-mono text-slate-400">
                                    {{ $galleries->firstItem() + $loop->index }}
                                </td>


                                {{-- Image --}}
                                <td class="px-3 py-2.5">

                                    @if($gallery->image)

                                        <a
                                            href="{{ asset($gallery->image) }}"
                                            target="_blank"
                                        >
                                            <img
                                                src="{{ asset($gallery->image) }}"
                                                alt="{{ $gallery->title ?? 'Gallery Image' }}"
                                                class="w-12 h-9 object-cover rounded-lg border border-slate-200 hover:opacity-80 transition"
                                            >
                                        </a>

                                    @else

                                        <div class="w-12 h-9 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center text-[10px] text-slate-400">
                                            No Img
                                        </div>

                                    @endif

                                </td>


                                {{-- Title --}}
                                <td class="px-3 py-2.5">

                                    @if($gallery->title)

                                        <p class="font-bold text-slate-900 line-clamp-1">
                                            {{ $gallery->title }}
                                        </p>

                                    @else

                                        <span class="text-slate-400">
                                            No title
                                        </span>

                                    @endif

                                </td>


                                {{-- Description --}}
                                <td class="px-3 py-2.5">

                                    @if($gallery->description)

                                        <p class="text-slate-500 line-clamp-1 text-[11px]">
                                            {{ $gallery->description }}
                                        </p>

                                    @else

                                        <span class="text-slate-400">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Sort Order --}}
                                <td class="px-3 py-2.5 text-center">

                                    <span class="inline-flex items-center justify-center min-w-6 px-1.5 py-0.5 rounded bg-slate-100 text-slate-700 font-semibold text-[11px]">
                                        {{ $gallery->sort_order }}
                                    </span>

                                </td>


                                {{-- Status --}}
                                <td class="px-3 py-2.5 text-center whitespace-nowrap">

                                    @if($gallery->status)

                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-[11px] font-bold border border-emerald-200">

                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                            Active

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-600 text-[11px] font-bold border border-slate-200">

                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>

                                            Inactive

                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td class="px-3 py-2.5 text-right whitespace-nowrap">

                                    <div class="flex items-center justify-end gap-1">

                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('admin.galleries.edit', $gallery) }}"
                                            class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white transition"
                                            title="Edit"
                                        >

                                            <svg
                                                class="w-3.5 h-3.5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-8.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 7.5-7.5z"
                                                />
                                            </svg>

                                        </a>


                                        {{-- Delete --}}
                                        <form
                                            action="{{ route('admin.galleries.destroy', $gallery) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this gallery image?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition"
                                                title="Delete"
                                            >

                                                <svg
                                                    class="w-3.5 h-3.5"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-8V4a1 1 0 00-1-1h-3a1 1 0 00-1 1v3m-4 0h14"
                                                    />
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


            {{-- Pagination --}}
            @if($galleries->hasPages())

                <div class="px-5 sm:px-6 py-4 border-t border-slate-200">

                    {{ $galleries->links() }}

                </div>

            @endif

        @else

            {{-- Empty State --}}
            <div class="py-20 px-5 text-center">

                <div class="w-20 h-20 mx-auto rounded-2xl bg-slate-100 flex items-center justify-center">

                    <svg
                        class="w-10 h-10 text-slate-400"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.5"
                            d="M4 16l4-4a3 3 0 014 0l4 4m-2-2l1-1a3 3 0 014 0l1 1M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                        />
                    </svg>

                </div>

                <h3 class="mt-5 text-lg font-bold text-slate-900">
                    No gallery images found
                </h3>

                <p class="mt-2 text-sm text-slate-500">
                    Start by adding your first gallery image.
                </p>

                <a
                    href="{{ route('admin.galleries.create') }}"
                    class="inline-flex items-center gap-2 mt-6 px-5 py-2.5 bg-indigo-600 text-white rounded-lg font-semibold text-sm hover:bg-indigo-700 transition"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 4v16m8-8H4"
                        />
                    </svg>

                    Add Gallery
                </a>

            </div>

        @endif

    </div>

</div>

@endsection