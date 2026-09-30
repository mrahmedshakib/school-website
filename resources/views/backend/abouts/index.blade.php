@extends('backend.layouts.app')

@section('title', 'About School')

@section('page_title', 'About School')

@section('content')

<div class="max-w-7xl mx-auto">


{{-- =========================================================
    PAGE HEADER
========================================================== --}}
<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-900">
            About School
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Manage your school's about section.
        </p>
    </div>

    <a
        href="{{ route('admin.abouts.create') }}"
        class="inline-flex items-center justify-center gap-2
               rounded-lg bg-indigo-600 px-4 py-2.5
               text-sm font-semibold text-white
               shadow-sm transition
               hover:bg-indigo-700
               focus:outline-none focus:ring-2
               focus:ring-indigo-500 focus:ring-offset-2"
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

        Add About

    </a>

</div>


{{-- =========================================================
    ABOUT CARD
========================================================== --}}
<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

    {{-- Card Header --}}
    <div
        class="px-5 py-4
               border-b border-gray-200
               flex items-center justify-between"
    >

        <div>

            <h2 class="text-base font-semibold text-gray-900">
                About Sections
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Manage the information displayed on your website.
            </p>

        </div>

        <div
            class="w-10 h-10 rounded-lg
                   bg-indigo-50
                   flex items-center justify-center"
        >

            <svg
                class="w-5 h-5 text-indigo-600"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M13 16h-1v-4h-1m1-8h.01M12 20a8 8 0 100-16 8 8 0 000 16z"
                />
            </svg>

        </div>

    </div>


    {{-- =====================================================
        TABLE
    ====================================================== --}}
    @if($abouts->count())

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-50 border-b border-gray-200">

                    <tr>

                        <th
                            class="px-5 py-3
                                   text-xs font-semibold
                                   uppercase tracking-wider
                                   text-gray-500"
                        >
                            #
                        </th>

                        <th
                            class="px-5 py-3
                                   text-xs font-semibold
                                   uppercase tracking-wider
                                   text-gray-500"
                        >
                            Image
                        </th>

                        <th
                            class="px-5 py-3
                                   text-xs font-semibold
                                   uppercase tracking-wider
                                   text-gray-500"
                        >
                            Title
                        </th>

                        <th
                            class="px-5 py-3
                                   text-xs font-semibold
                                   uppercase tracking-wider
                                   text-gray-500"
                        >
                            Button
                        </th>

                        <th
                            class="px-5 py-3
                                   text-xs font-semibold
                                   uppercase tracking-wider
                                   text-gray-500"
                        >
                            Status
                        </th>

                        <th
                            class="px-5 py-3
                                   text-right
                                   text-xs font-semibold
                                   uppercase tracking-wider
                                   text-gray-500"
                        >
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @foreach($abouts as $about)

                        <tr class="hover:bg-gray-50 transition">

                            {{-- Number --}}
                            <td class="px-5 py-4 text-gray-500">
                                {{ $loop->iteration }}
                            </td>


                            {{-- Image --}}
                            <td class="px-5 py-4">

                                @if($about->image)

                                    <img
                                        src="{{ asset($about->image) }}"
                                        alt="{{ $about->title }}"
                                        class="w-16 h-12
                                               rounded-lg
                                               object-cover
                                               border border-gray-200"
                                    >

                                @else

                                    <div
                                        class="w-16 h-12
                                               rounded-lg
                                               bg-gray-100
                                               border border-gray-200
                                               flex items-center justify-center"
                                    >

                                        <svg
                                            class="w-6 h-6 text-gray-400"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            />
                                        </svg>

                                    </div>

                                @endif

                            </td>


                            {{-- Title --}}
                            <td class="px-5 py-4">

                                <div class="font-semibold text-gray-900">
                                    {{ $about->title }}
                                </div>

                                <div class="text-xs text-gray-500 mt-1 max-w-md">

                                    {{ \Illuminate\Support\Str::limit(
                                        strip_tags($about->description),
                                        100
                                    ) }}

                                </div>

                            </td>


                            {{-- Button --}}
                            <td class="px-5 py-4">

                                @if($about->button_text)

                                    <div class="flex flex-col gap-1">

                                        <span
                                            class="inline-flex w-fit items-center
                                                   rounded-full
                                                   bg-blue-50
                                                   px-2.5 py-1
                                                   text-xs font-medium
                                                   text-blue-700"
                                        >
                                            {{ $about->button_text }}
                                        </span>

                                        @if($about->button_url)

                                            <span
                                                class="max-w-[180px]
                                                       truncate
                                                       text-xs
                                                       text-gray-400"
                                                title="{{ $about->button_url }}"
                                            >
                                                {{ $about->button_url }}
                                            </span>

                                        @endif

                                    </div>

                                @else

                                    <span class="text-gray-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- =================================================
                                STATUS TOGGLE
                            ================================================== --}}
                            <td class="px-5 py-4">

                                <form
                                    action="{{ route('admin.abouts.toggle-status', $about->id) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('PATCH')

                                    @if($about->status)

                                        <button
                                            type="submit"
                                            class="inline-flex items-center gap-1.5
                                                   rounded-full
                                                   bg-green-50
                                                   px-2.5 py-1
                                                   text-xs font-semibold
                                                   text-green-700
                                                   transition
                                                   hover:bg-green-100"
                                            title="Click to make inactive"
                                        >

                                            <span
                                                class="w-1.5 h-1.5
                                                       rounded-full
                                                       bg-green-500"
                                            ></span>

                                            Active

                                        </button>

                                    @else

                                        <button
                                            type="submit"
                                            class="inline-flex items-center gap-1.5
                                                   rounded-full
                                                   bg-gray-100
                                                   px-2.5 py-1
                                                   text-xs font-semibold
                                                   text-gray-600
                                                   transition
                                                   hover:bg-gray-200"
                                            title="Click to make active"
                                        >

                                            <span
                                                class="w-1.5 h-1.5
                                                       rounded-full
                                                       bg-gray-400"
                                            ></span>

                                            Inactive

                                        </button>

                                    @endif

                                </form>

                            </td>


                            {{-- =================================================
                                ACTIONS
                            ================================================== --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('admin.abouts.edit', $about->id) }}"
                                        class="inline-flex items-center justify-center
                                               w-9 h-9
                                               rounded-lg
                                               border border-gray-200
                                               text-gray-600
                                               transition
                                               hover:bg-indigo-50
                                               hover:text-indigo-600
                                               hover:border-indigo-200"
                                        title="Edit"
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
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-7.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 7.5-7.5z"
                                            />
                                        </svg>

                                    </a>


                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('admin.abouts.destroy', $about->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this About section?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="inline-flex items-center justify-center
                                                   w-9 h-9
                                                   rounded-lg
                                                   border border-gray-200
                                                   text-gray-600
                                                   transition
                                                   hover:bg-red-50
                                                   hover:text-red-600
                                                   hover:border-red-200"
                                            title="Delete"
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
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"
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
        @if(method_exists($abouts, 'links'))

            <div class="border-t border-gray-200 px-5 py-4">
                {{ $abouts->links() }}
            </div>

        @endif


    @else

        {{-- =================================================
            EMPTY STATE
        ================================================== --}}
        <div class="px-6 py-16 text-center">

            <div
                class="mx-auto w-16 h-16
                       rounded-2xl
                       bg-indigo-50
                       flex items-center justify-center
                       mb-5"
            >

                <svg
                    class="w-8 h-8 text-indigo-500"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M13 16h-1v-4h-1m1-8h.01M12 20a8 8 0 100-16 8 8 0 000 16z"
                    />
                </svg>

            </div>


            <h3 class="text-lg font-semibold text-gray-900">
                No About Section Found
            </h3>

            <p class="mt-2 text-sm text-gray-500">
                You haven't added any About section yet.
            </p>


            <div class="mt-6">

                <a
                    href="{{ route('admin.abouts.create') }}"
                    class="inline-flex items-center gap-2
                           rounded-lg
                           bg-indigo-600
                           px-4 py-2.5
                           text-sm font-semibold
                           text-white
                           transition
                           hover:bg-indigo-700"
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

                    Add About

                </a>

            </div>

        </div>

    @endif

</div>


</div>

@endsection
