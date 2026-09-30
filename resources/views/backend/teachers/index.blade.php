@extends('backend.layouts.app')

@section('title', 'Teachers & Staff')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Teachers & Staff
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Manage teachers and staff members.
            </p>
        </div>

        <a
            href="{{ route('admin.teachers.create') }}"
            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition"
        >
            <span class="text-lg leading-none">+</span>
            Add Teacher / Staff
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3">
            <p class="text-sm font-medium text-green-700">
                {{ session('success') }}
            </p>
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3">
            <p class="text-sm font-medium text-red-700">
                {{ session('error') }}
            </p>
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                {{-- Table Header --}}
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-5 py-4 text-left font-semibold text-gray-700">
                            #
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-gray-700">
                            Image
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-gray-700">
                            Name
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-gray-700">
                            Type
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-gray-700">
                            Designation
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-gray-700">
                            Subject
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-gray-700">
                            Phone
                        </th>

                        <th class="px-5 py-4 text-left font-semibold text-gray-700">
                            Status
                        </th>

                        <th class="px-5 py-4 text-right font-semibold text-gray-700">
                            Action
                        </th>
                    </tr>
                </thead>

                {{-- Table Body --}}
                <tbody class="divide-y divide-gray-100">

                    @forelse($teachers as $teacher)

                        <tr class="hover:bg-gray-50 transition">

                            {{-- Number --}}
                            <td class="px-5 py-4 text-gray-500">
                                {{ $teachers->firstItem() + $loop->index }}
                            </td>

                            {{-- Image --}}
                            <td class="px-5 py-4">
                                @if($teacher->image)

                                    <img
                                        src="{{ asset($teacher->image) }}"
                                        alt="{{ $teacher->name }}"
                                        class="w-12 h-12 rounded-full object-cover border border-gray-200"
                                    >

                                @else

                                    <div class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-xl">
                                        {{ $teacher->type === 'staff' ? '👨‍💼' : '👨‍🏫' }}
                                    </div>

                                @endif
                            </td>

                            {{-- Name --}}
                            <td class="px-5 py-4">
                                <div class="font-semibold text-gray-900">
                                    {{ $teacher->name_bn ?: $teacher->name }}
                                </div>

                                @if($teacher->name_en)
                                    <div class="text-xs text-gray-500">
                                        {{ $teacher->name_en }}
                                    </div>
                                @endif

                                @if($teacher->email)
                                    <div class="text-xs text-gray-400 mt-0.5">
                                        {{ $teacher->email }}
                                    </div>
                                @endif
                            </td>

                            {{-- Type --}}
                            <td class="px-5 py-4">
                                @if($teacher->type === 'teacher')

                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                                        Teacher
                                    </span>

                                @else

                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-semibold">
                                        Staff
                                    </span>

                                @endif
                            </td>

                            {{-- Designation --}}
                            <td class="px-5 py-4 text-gray-600">
                                <div>{{ $teacher->designation_bn ?: $teacher->designation ?: '-' }}</div>
                                @if($teacher->designation_en)
                                    <div class="text-xs text-gray-400">{{ $teacher->designation_en }}</div>
                                @endif
                            </td>

                            {{-- Subject --}}
                            <td class="px-5 py-4 text-gray-600">
                                @if($teacher->type === 'teacher')
                                    {{ $teacher->subject ?: '-' }}
                                @else
                                    -
                                @endif
                            </td>

                            {{-- Phone --}}
                            <td class="px-5 py-4 text-gray-600">
                                {{ $teacher->phone ?: '-' }}
                            </td>

                            {{-- Status --}}
                            <td class="px-5 py-4">
                                @if($teacher->status)

                                    <span class="inline-flex px-2.5 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">
                                        Active
                                    </span>

                                @else

                                    <span class="inline-flex px-2.5 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-semibold">
                                        Inactive
                                    </span>

                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">

                                    <a
                                        href="{{ route('admin.teachers.edit', $teacher->id) }}"
                                        class="px-3 py-1.5 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 text-xs font-medium transition"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('admin.teachers.destroy', $teacher->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this member?');"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="px-3 py-1.5 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 text-xs font-medium transition"
                                        >
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="9" class="px-5 py-12 text-center">

                                <div class="text-4xl mb-3">
                                    👨‍🏫
                                </div>

                                <p class="text-gray-500 font-medium">
                                    No teachers or staff found.
                                </p>

                                <a
                                    href="{{ route('admin.teachers.create') }}"
                                    class="inline-block mt-3 text-sm text-blue-600 hover:text-blue-700"
                                >
                                    Add your first teacher or staff
                                </a>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($teachers->hasPages())
        <div class="mt-4 px-5 py-4 border border-gray-200 rounded-xl bg-white">
            {{ $teachers->links() }}
        </div>
    @endif

</div>
@endsection