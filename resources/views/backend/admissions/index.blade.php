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
                  rounded-xl bg-emerald-600 text-white text-sm font-semibold
                  hover:bg-emerald-700 transition shadow-sm">

            <span class="text-lg">＋</span>
            Add Admission

        </a>

    </div>


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

            <table class="w-full text-xs">

                {{-- =================================================
                    TABLE HEADER
                ================================================== --}}
                <thead class="bg-gray-50 border-b border-gray-200 text-[11px] font-bold uppercase tracking-wider text-gray-500">

                    <tr>

                        <th class="px-3 py-2.5 text-left w-10">
                            #
                        </th>

                        <th class="px-3 py-2.5 text-left w-16">
                            Image
                        </th>

                        <th class="px-3 py-2.5 text-left">
                            Admission
                        </th>

                        <th class="px-3 py-2.5 text-left w-36">
                            Application Period
                        </th>

                        <th class="px-3 py-2.5 text-center w-20">
                            Documents
                        </th>

                        <th class="px-3 py-2.5 text-center w-20">
                            Status
                        </th>

                        <th class="px-3 py-2.5 text-right w-20">
                            Action
                        </th>

                    </tr>

                </thead>


                {{-- =================================================
                    TABLE BODY
                ================================================== --}}
                <tbody class="divide-y divide-gray-100 text-gray-700">

                    @forelse($admissions as $admission)

                        <tr class="hover:bg-gray-50 transition">


                            {{-- =====================================
                                NUMBER
                            ====================================== --}}
                            <td class="px-3 py-2.5 font-mono text-gray-400">

                                {{ $admissions->firstItem() + $loop->index }}

                            </td>


                            {{-- =====================================
                                IMAGE
                            ====================================== --}}
                            <td class="px-3 py-2.5">

                                @if($admission->image)

                                    <a href="{{ asset($admission->image) }}"
                                       target="_blank"
                                       rel="noopener noreferrer">

                                        <img
                                            src="{{ asset($admission->image) }}"
                                            alt="{{ $admission->title }}"
                                            class="w-12 h-9 object-cover rounded-md
                                                   border border-gray-200
                                                   hover:opacity-80 transition"
                                        >

                                    </a>

                                @else

                                    <div class="w-12 h-9 rounded-md
                                                bg-gray-100
                                                border border-gray-200
                                                flex items-center justify-center
                                                text-gray-400 text-[10px]">

                                        🖼️

                                    </div>

                                @endif

                            </td>


                            {{-- =====================================
                                TITLE + DESCRIPTION
                            ====================================== --}}
                            <td class="px-3 py-2.5">

                                <div class="font-bold text-gray-900 line-clamp-1">
                                    {{ $admission->title }}
                                </div>


                                @if($admission->description)

                                    <div class="text-[11px] text-gray-500 mt-0.5
                                                line-clamp-1">

                                        {{ $admission->description }}

                                    </div>

                                @endif


                                {{-- Application URL --}}
                                @if($admission->application_url)

                                    <a href="{{ $admission->application_url }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="inline-flex items-center gap-1 mt-0.5
                                              text-[11px] font-medium text-emerald-600
                                              hover:text-emerald-800">

                                        🔗 Link

                                    </a>

                                @endif

                            </td>


                            {{-- =====================================
                                APPLICATION PERIOD
                            ====================================== --}}
                            <td class="px-3 py-2.5 text-gray-600 whitespace-nowrap">

                                @if($admission->application_start || $admission->application_end)

                                    <div class="text-[11px]">

                                        <span class="text-gray-400">From:</span>
                                        <span class="font-medium text-gray-700">
                                            {{ $admission->application_start?->format('d M y') ?? '—' }}
                                        </span>

                                    </div>


                                    <div class="text-[11px]">

                                        <span class="text-gray-400">To:</span>
                                        <span class="font-medium text-gray-700">
                                            {{ $admission->application_end?->format('d M y') ?? '—' }}
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
                            <td class="px-3 py-2.5 whitespace-nowrap">

                                <div class="flex justify-center items-center gap-1">


                                    {{-- PDF --}}
                                    @if($admission->pdf)

                                        <a href="{{ asset($admission->pdf) }}"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           title="View PDF"
                                           class="inline-flex items-center justify-center
                                                  w-6 h-6 rounded
                                                  bg-red-50 text-red-600
                                                  hover:bg-red-100 transition text-xs">

                                            📄

                                        </a>

                                    @else

                                        <span
                                            title="No PDF"
                                            class="inline-flex items-center justify-center
                                                   w-6 h-6 rounded
                                                   bg-gray-50 text-gray-300 text-xs">

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
                                                  w-6 h-6 rounded
                                                  bg-blue-50 text-blue-600
                                                  hover:bg-blue-100 transition text-xs">

                                            🖼️

                                        </a>

                                    @else

                                        <span
                                            title="No Image"
                                            class="inline-flex items-center justify-center
                                                   w-6 h-6 rounded
                                                   bg-gray-50 text-gray-300 text-xs">

                                            🖼️

                                        </span>

                                    @endif

                                </div>

                            </td>


                            {{-- =====================================
                                STATUS
                            ====================================== --}}
                            <td class="px-3 py-2.5 text-center whitespace-nowrap">

                                @if($admission->status)

                                    <span class="inline-flex items-center gap-1
                                                 px-2 py-0.5 rounded-full
                                                 bg-emerald-50 text-emerald-700 border border-emerald-200
                                                 text-[11px] font-bold">

                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1
                                                 px-2 py-0.5 rounded-full
                                                 bg-gray-100 text-gray-600 border border-gray-200
                                                 text-[11px] font-bold">

                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- =====================================
                                ACTIONS
                            ====================================== --}}
                            <td class="px-3 py-2.5 whitespace-nowrap">

                                <div class="flex justify-end items-center gap-1">


                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.admissions.edit', $admission) }}"
                                       title="Edit Admission"
                                       class="inline-flex items-center justify-center
                                              w-7 h-7 rounded-lg
                                              bg-indigo-50 text-indigo-700
                                              hover:bg-indigo-100 transition">

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
                                                   w-7 h-7 rounded-lg
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