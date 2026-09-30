@extends('backend.layouts.app')

@section('title', 'Admission')

@section('content')

<div class="max-w-7xl mx-auto py-8 px-4">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Admission
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Manage admission notices, application periods and documents.
            </p>
        </div>

        <a href="{{ route('admin.admissions.create') }}"
           class="inline-flex items-center justify-center gap-2 px-5 py-2.5
                  rounded-lg bg-indigo-600 text-white text-sm font-semibold
                  hover:bg-indigo-700 transition shadow-sm">

            <span class="text-lg">＋</span>
            Add Admission

        </a>

    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}
    @if(session('success'))

        <div class="mb-6 flex items-start gap-3 rounded-lg
                    border border-green-200 bg-green-50 px-4 py-3
                    text-sm text-green-700">

            <span class="text-lg">✓</span>

            <div>
                {{ session('success') }}
            </div>

        </div>

    @endif


    {{-- =========================================================
        VALIDATION / ERROR MESSAGE
    ========================================================== --}}
    @if($errors->any())

        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3">

            <div class="font-semibold text-red-700 mb-2">
                Please fix the following errors:
            </div>

            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
        TABLE
    ========================================================== --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                {{-- =================================================
                    TABLE HEADER
                ================================================== --}}
                <thead class="bg-gray-50 border-b border-gray-200">

                    <tr>

                        <th class="px-5 py-4 text-left font-semibold text-gray-700 whitespace-nowrap">
                            #
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-gray-700 whitespace-nowrap">
                            Image
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-gray-700 min-w-[260px]">
                            Admission
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-gray-700 whitespace-nowrap">
                            Application Period
                        </th>

                        <th class="px-5 py-4 text-center font-semibold text-gray-700 whitespace-nowrap">
                            Documents
                        </th>

                        <th class="px-5 py-4 text-center font-semibold text-gray-700 whitespace-nowrap">
                            Status
                        </th>

                        <th class="px-5 py-4 text-right font-semibold text-gray-700 whitespace-nowrap">
                            Action
                        </th>

                    </tr>

                </thead>


                {{-- =================================================
                    TABLE BODY
                ================================================== --}}
                <tbody class="divide-y divide-gray-100">

                    @forelse($admissions as $admission)

                        <tr class="hover:bg-gray-50 transition">


                            {{-- =====================================
                                NUMBER
                            ====================================== --}}
                            <td class="px-5 py-4 text-gray-500 align-top">

                                {{ $admissions->firstItem() + $loop->index }}

                            </td>


                            {{-- =====================================
                                IMAGE
                            ====================================== --}}
                            <td class="px-5 py-4 align-top">

                                @if($admission->image)

                                    <a href="{{ asset($admission->image) }}"
                                       target="_blank"
                                       rel="noopener noreferrer">

                                        <img
                                            src="{{ asset($admission->image) }}"
                                            alt="{{ $admission->title }}"
                                            class="w-20 h-14 object-cover rounded-lg
                                                   border border-gray-200
                                                   hover:opacity-80 transition"
                                        >

                                    </a>

                                @else

                                    <div class="w-20 h-14 rounded-lg
                                                bg-gray-100
                                                border border-gray-200
                                                flex items-center justify-center
                                                text-gray-400">

                                        <span class="text-xl">🖼️</span>

                                    </div>

                                @endif

                            </td>


                            {{-- =====================================
                                TITLE + DESCRIPTION
                            ====================================== --}}
                            <td class="px-5 py-4 align-top">

                                <div class="font-semibold text-gray-900">
                                    {{ $admission->title }}
                                </div>


                                @if($admission->description)

                                    <div class="text-xs text-gray-500 mt-1
                                                line-clamp-2 max-w-md">

                                        {{ $admission->description }}

                                    </div>

                                @endif


                                {{-- Application URL --}}
                                @if($admission->application_url)

                                    <a href="{{ $admission->application_url }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="inline-flex items-center gap-1 mt-2
                                              text-xs font-medium text-indigo-600
                                              hover:text-indigo-800">

                                        🔗 Application Link

                                    </a>

                                @endif

                            </td>


                            {{-- =====================================
                                APPLICATION PERIOD
                            ====================================== --}}
                            <td class="px-5 py-4 text-gray-600 align-top">

                                @if($admission->application_start || $admission->application_end)

                                    <div class="flex items-center gap-2">

                                        <span class="text-xs text-gray-400">
                                            From
                                        </span>

                                        <span class="font-medium text-gray-700">
                                            {{ $admission->application_start?->format('d M Y') ?? '—' }}
                                        </span>

                                    </div>


                                    <div class="flex items-center gap-2 mt-1">

                                        <span class="text-xs text-gray-400">
                                            To
                                        </span>

                                        <span class="font-medium text-gray-700">
                                            {{ $admission->application_end?->format('d M Y') ?? '—' }}
                                        </span>

                                    </div>

                                @else

                                    <span class="text-gray-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- =====================================
                                DOCUMENTS
                            ====================================== --}}
                            <td class="px-5 py-4 align-top">

                                <div class="flex justify-center items-center gap-2">


                                    {{-- PDF --}}
                                    @if($admission->pdf)

                                        <a href="{{ asset($admission->pdf) }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           title="View PDF"
                                           class="inline-flex items-center justify-center
                                                  w-9 h-9 rounded-lg
                                                  bg-red-50 text-red-600
                                                  hover:bg-red-100 transition">

                                            📄

                                        </a>

                                    @else

                                        <span
                                            title="No PDF"
                                            class="inline-flex items-center justify-center
                                                   w-9 h-9 rounded-lg
                                                   bg-gray-50 text-gray-300">

                                            📄

                                        </span>

                                    @endif


                                    {{-- IMAGE --}}
                                    @if($admission->image)

                                        <a href="{{ asset($admission->image) }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           title="View Image"
                                           class="inline-flex items-center justify-center
                                                  w-9 h-9 rounded-lg
                                                  bg-blue-50 text-blue-600
                                                  hover:bg-blue-100 transition">

                                            🖼️

                                        </a>

                                    @else

                                        <span
                                            title="No Image"
                                            class="inline-flex items-center justify-center
                                                   w-9 h-9 rounded-lg
                                                   bg-gray-50 text-gray-300">

                                            🖼️

                                        </span>

                                    @endif

                                </div>

                            </td>


                            {{-- =====================================
                                STATUS
                            ====================================== --}}
                            <td class="px-5 py-4 text-center align-top">

                                @if($admission->status)

                                    <span class="inline-flex items-center gap-1.5
                                                 px-2.5 py-1 rounded-full
                                                 bg-green-100 text-green-700
                                                 text-xs font-semibold">

                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5
                                                 px-2.5 py-1 rounded-full
                                                 bg-gray-100 text-gray-600
                                                 text-xs font-semibold">

                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- =====================================
                                ACTIONS
                            ====================================== --}}
                            <td class="px-5 py-4 align-top">

                                <div class="flex justify-end items-center gap-2">


                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.admissions.edit', $admission) }}"
                                       title="Edit Admission"
                                       class="inline-flex items-center justify-center
                                              w-9 h-9 rounded-lg
                                              bg-blue-50 text-blue-700
                                              hover:bg-blue-100 transition">

                                        ✏️

                                    </a>


                                    {{-- DELETE --}}
                                    <form
                                        action="{{ route('admin.admissions.destroy', $admission) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this admission information?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Delete Admission"
                                            class="inline-flex items-center justify-center
                                                   w-9 h-9 rounded-lg
                                                   bg-red-50 text-red-700
                                                   hover:bg-red-100 transition"
                                        >

                                            🗑️

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty

                        {{-- =========================================
                            EMPTY STATE
                        ========================================== --}}
                        <tr>

                            <td colspan="7" class="px-5 py-16 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="w-16 h-16 rounded-full
                                                bg-indigo-50
                                                flex items-center justify-center
                                                text-3xl mb-4">

                                        📝

                                    </div>

                                    <h3 class="text-gray-800 font-semibold text-lg">
                                        No admission information found
                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">
                                        Add your first admission notice to get started.
                                    </p>


                                    <a href="{{ route('admin.admissions.create') }}"
                                       class="inline-flex items-center gap-2 mt-5
                                              px-4 py-2.5 rounded-lg
                                              bg-indigo-600 text-white
                                              text-sm font-semibold
                                              hover:bg-indigo-700 transition">

                                        ＋ Add Admission

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =========================================================
            PAGINATION
        ========================================================== --}}
        @if($admissions->hasPages())

            <div class="px-5 py-4 border-t border-gray-200 bg-gray-50">

                {{ $admissions->links() }}

            </div>

        @endif

    </div>

</div>

@endsection