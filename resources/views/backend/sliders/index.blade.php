@extends('backend.layouts.app')

@section('title', 'Sliders')

@section('content')

<div class="max-w-7xl mx-auto py-8 px-4">

    {{-- ================= HEADER ================= --}}
    <div class="flex flex-col sm:flex-row
                sm:items-center sm:justify-between
                gap-4 mb-7">

        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                Sliders
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Manage homepage sliders and banners.
            </p>
        </div>


        <a
            href="{{ route('admin.sliders.create') }}"
            class="inline-flex items-center justify-center
                   gap-2 px-5 py-2.5 rounded-lg
                   bg-indigo-600 text-white
                   text-sm font-semibold
                   hover:bg-indigo-700
                   transition shadow-sm"
        >
            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 4v16m8-8H4"
                />
            </svg>

            Add Slider
        </a>

    </div>


    {{-- ================= SUCCESS MESSAGE ================= --}}
    @if(session('success'))

        <div
            class="mb-6 flex items-start gap-3
                   rounded-lg
                   bg-green-50
                   border border-green-200
                   text-green-700
                   px-4 py-3"
        >

            <svg
                class="w-5 h-5 mt-0.5 shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 13l4 4L19 7"
                />
            </svg>

            <span class="text-sm font-medium">
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- ================= ERROR MESSAGE ================= --}}
    @if(session('error'))

        <div
            class="mb-6 flex items-start gap-3
                   rounded-lg
                   bg-red-50
                   border border-red-200
                   text-red-700
                   px-4 py-3"
        >

            <svg
                class="w-5 h-5 mt-0.5 shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>

            <span class="text-sm font-medium">
                {{ session('error') }}
            </span>

        </div>

    @endif


    {{-- ================= SLIDER COUNT ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">

        {{-- Total --}}
        <div
            class="bg-white rounded-xl
                   border border-gray-200
                   shadow-sm p-5"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Total Sliders
                    </p>

                    <h2 class="text-2xl font-bold text-gray-900 mt-1">
                        {{ $sliders->count() }}
                    </h2>

                </div>

                <div
                    class="w-11 h-11 rounded-lg
                           bg-indigo-50
                           flex items-center justify-center"
                >

                    <svg
                        class="w-6 h-6 text-indigo-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 16l4-4 4 4 4-5 4 5M4 6h16"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- Active --}}
        <div
            class="bg-white rounded-xl
                   border border-gray-200
                   shadow-sm p-5"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Active Sliders
                    </p>

                    <h2 class="text-2xl font-bold text-green-600 mt-1">
                        {{ $sliders->where('status', 1)->count() }}
                    </h2>

                </div>

                <div
                    class="w-11 h-11 rounded-lg
                           bg-green-50
                           flex items-center justify-center"
                >

                    <svg
                        class="w-6 h-6 text-green-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                </div>

            </div>

        </div>


        {{-- Inactive --}}
        <div
            class="bg-white rounded-xl
                   border border-gray-200
                   shadow-sm p-5"
        >

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-gray-500">
                        Inactive Sliders
                    </p>

                    <h2 class="text-2xl font-bold text-red-600 mt-1">
                        {{ $sliders->where('status', 0)->count() }}
                    </h2>

                </div>

                <div
                    class="w-11 h-11 rounded-lg
                           bg-red-50
                           flex items-center justify-center"
                >

                    <svg
                        class="w-6 h-6 text-red-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M18 12H6"
                        />
                    </svg>

                </div>

            </div>

        </div>

    </div>


    {{-- ================= TABLE ================= --}}
    <div
        class="bg-white rounded-xl
               shadow-sm
               border border-gray-200
               overflow-hidden"
    >

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                {{-- ================= TABLE HEAD ================= --}}
                <thead class="bg-gray-50 border-b border-gray-200">

                    <tr>

                        <th
                            class="px-5 py-4 text-left
                                   text-xs font-semibold
                                   uppercase tracking-wide
                                   text-gray-500"
                        >
                            Slider
                        </th>


                        <th
                            class="px-5 py-4 text-left
                                   text-xs font-semibold
                                   uppercase tracking-wide
                                   text-gray-500"
                        >
                            Content
                        </th>


                        <th
                            class="px-5 py-4 text-center
                                   text-xs font-semibold
                                   uppercase tracking-wide
                                   text-gray-500"
                        >
                            Order
                        </th>


                        <th
                            class="px-5 py-4 text-center
                                   text-xs font-semibold
                                   uppercase tracking-wide
                                   text-gray-500"
                        >
                            Status
                        </th>


                        <th
                            class="px-5 py-4 text-right
                                   text-xs font-semibold
                                   uppercase tracking-wide
                                   text-gray-500"
                        >
                            Action
                        </th>

                    </tr>

                </thead>


                {{-- ================= TABLE BODY ================= --}}
                <tbody class="divide-y divide-gray-100">

                    @forelse($sliders as $slider)

                        <tr class="hover:bg-gray-50 transition">


                            {{-- ================= IMAGE ================= --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center">

                                    @if(!empty($slider->image))
                                        <img
                                            src="{{ asset($slider->image) }}"
                                            alt="{{ $slider->title ?? 'Slider' }}"
                                            loading="lazy"
                                            decoding="async"
                                            class="w-28 h-16 object-cover rounded-lg border border-gray-200 shadow-sm"
                                        >
                                    @else
                                        <div class="w-28 h-16 rounded-lg border border-gray-200 bg-gray-100 flex items-center justify-center text-gray-400 text-xs">
                                            No Image
                                        </div>
                                    @endif

                                </div>

                            </td>


                            {{-- ================= CONTENT ================= --}}
                            <td class="px-5 py-4">

                                <div class="max-w-md">

                                    {{-- Subtitle --}}
                                    @if($slider->subtitle)

                                        <div
                                            class="text-xs
                                                   font-semibold
                                                   text-indigo-600
                                                   mb-1"
                                        >
                                            {{ $slider->subtitle }}
                                        </div>

                                    @endif


                                    {{-- Title --}}
                                    <div
                                        class="font-semibold
                                               text-gray-900
                                               line-clamp-1"
                                    >
                                        {{ $slider->title ?? 'No title' }}
                                    </div>


                                    {{-- Description --}}
                                    @if($slider->description)

                                        <div
                                            class="text-xs
                                                   text-gray-500
                                                   mt-1
                                                   line-clamp-2"
                                        >
                                            {{ $slider->description }}
                                        </div>

                                    @endif


                                    {{-- Button --}}
                                    @if(
                                        $slider->button_text &&
                                        $slider->button_url
                                    )

                                        <div class="mt-2">

                                            <span
                                                class="inline-flex
                                                       items-center
                                                       px-2 py-1
                                                       rounded
                                                       bg-gray-100
                                                       text-gray-600
                                                       text-xs"
                                            >
                                                Button:
                                                {{ $slider->button_text }}
                                            </span>

                                        </div>

                                    @endif

                                </div>

                            </td>


                            {{-- ================= ORDER ================= --}}
                            <td class="px-5 py-4 text-center">

                                <span
                                    class="inline-flex
                                           items-center
                                           justify-center
                                           min-w-9 h-9
                                           px-2
                                           rounded-lg
                                           bg-gray-100
                                           text-gray-700
                                           font-semibold"
                                >
                                    {{ $slider->sort_order }}
                                </span>

                            </td>


                            {{-- ================= STATUS ================= --}}
                            <td class="px-5 py-4">

                                <div class="flex justify-center">

                                    <form
                                        action="{{ route(
                                            'admin.sliders.toggle-status',
                                            $slider->id
                                        ) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        @method('PATCH')


                                        <button
                                            type="submit"
                                            class="inline-flex
                                                   items-center
                                                   gap-2
                                                   px-3 py-1.5
                                                   rounded-full
                                                   text-xs
                                                   font-semibold
                                                   transition
                                                   {{ $slider->status
                                                        ? 'bg-green-100 text-green-700 hover:bg-green-200'
                                                        : 'bg-red-100 text-red-700 hover:bg-red-200' }}"
                                            title="Click to change status"
                                        >

                                            <span
                                                class="w-2 h-2
                                                       rounded-full
                                                       {{ $slider->status
                                                            ? 'bg-green-500'
                                                            : 'bg-red-500' }}"
                                            ></span>

                                            {{ $slider->status
                                                ? 'Active'
                                                : 'Inactive' }}

                                        </button>

                                    </form>

                                </div>

                            </td>


                            {{-- ================= ACTION ================= --}}
                            <td class="px-5 py-4">

                                <div
                                    class="flex justify-end
                                           items-center gap-2"
                                >

                                    {{-- Edit --}}
                                    <a
                                        href="{{ route(
                                            'admin.sliders.edit',
                                            $slider->id
                                        ) }}"
                                        class="inline-flex
                                               items-center
                                               gap-1.5
                                               px-3 py-2
                                               rounded-lg
                                               bg-blue-50
                                               text-blue-600
                                               text-xs
                                               font-semibold
                                               hover:bg-blue-100
                                               transition"
                                    >

                                        <svg
                                            class="w-4 h-4"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 7.5-7.5z"
                                            />
                                        </svg>

                                        Edit

                                    </a>


                                    {{-- Delete --}}
                                    <form
                                        action="{{ route(
                                            'admin.sliders.destroy',
                                            $slider->id
                                        ) }}"
                                        method="POST"
                                        onsubmit="return confirm(
                                            'Are you sure you want to delete this slider?'
                                        );"
                                    >

                                        @csrf

                                        @method('DELETE')


                                        <button
                                            type="submit"
                                            class="inline-flex
                                                   items-center
                                                   gap-1.5
                                                   px-3 py-2
                                                   rounded-lg
                                                   bg-red-50
                                                   text-red-600
                                                   text-xs
                                                   font-semibold
                                                   hover:bg-red-100
                                                   transition"
                                        >

                                            <svg
                                                class="w-4 h-4"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-3a1 1 0 00-1 1v3m-4 0h14"
                                                />
                                            </svg>

                                            Delete

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty

                        {{-- ================= EMPTY ================= --}}
                        <tr>

                            <td
                                colspan="5"
                                class="px-5 py-16 text-center"
                            >

                                <div
                                    class="flex flex-col
                                           items-center
                                           justify-center"
                                >

                                    <div
                                        class="w-16 h-16
                                               rounded-full
                                               bg-gray-100
                                               flex items-center
                                               justify-center
                                               mb-4"
                                    >

                                        <svg
                                            class="w-8 h-8 text-gray-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M4 16l4-4 4 4 4-5 4 5M4 6h16"
                                            />
                                        </svg>

                                    </div>


                                    <h3
                                        class="text-lg
                                               font-semibold
                                               text-gray-800"
                                    >
                                        No Sliders Found
                                    </h3>


                                    <p
                                        class="text-sm
                                               text-gray-500
                                               mt-1 mb-5"
                                    >
                                        You haven't added any homepage
                                        sliders yet.
                                    </p>


                                    <a
                                        href="{{ route(
                                            'admin.sliders.create'
                                        ) }}"
                                        class="inline-flex
                                               items-center
                                               gap-2
                                               px-5 py-2.5
                                               rounded-lg
                                               bg-indigo-600
                                               text-white
                                               text-sm
                                               font-semibold
                                               hover:bg-indigo-700
                                               transition"
                                    >

                                        <svg
                                            class="w-5 h-5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 4v16m8-8H4"
                                            />
                                        </svg>

                                        Add First Slider

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection