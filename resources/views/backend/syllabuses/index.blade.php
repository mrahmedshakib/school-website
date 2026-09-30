@extends('backend.layouts.app')
@section('title', 'Academic Syllabuses')
@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                Academic Syllabuses
            </h1>
            <p class="mt-2 text-sm text-gray-500">
                Manage curriculum and syllabuses for all classes (Bilingual: Bangla & English).
            </p>
        </div>
        <a href="{{ route('admin.syllabuses.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add Syllabus
        </a>
    </div>

    {{-- Messages --}}
    @if(session('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Table Card --}}
    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-200 px-6 py-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-lg font-bold text-gray-900">Syllabus List</h2>
                <p class="mt-1 text-sm text-gray-500">All uploaded academic class syllabuses.</p>
            </div>
            <form method="GET" action="{{ route('admin.syllabuses.index') }}" class="flex gap-2 w-full sm:w-auto">
                <select name="class" class="text-sm rounded-xl border-gray-300 p-2" onchange="this.form.submit()">
                    <option value="">All Classes</option>
                    @foreach($classes as $c)
                        <option value="{{ $c }}" {{ request('class') == $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="text-sm rounded-xl border-gray-300 p-2">
                <button type="submit" class="bg-gray-100 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-gray-200">Search</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 text-xs font-bold uppercase tracking-wider text-gray-500">
                    <tr>
                        <th class="px-6 py-4 text-left">#</th>
                        <th class="px-6 py-4 text-left">Class & Year</th>
                        <th class="px-6 py-4 text-left">Title (BN / EN)</th>
                        <th class="px-6 py-4 text-left">Subject</th>
                        <th class="px-6 py-4 text-left">PDF File</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white text-sm">
                    @forelse($syllabuses as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-mono text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900 block">{{ $item->class }}</span>
                                <span class="text-xs text-gray-400">{{ $item->academic_year }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-gray-900 block">{{ $item->title_bn }}</span>
                                <span class="text-xs text-gray-500 block">{{ $item->title_en }}</span>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-700">
                                {{ $item->subject_name_bn ?? $item->subject_name_en ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($item->file_path)
                                    <a href="{{ asset($item->file_path) }}" target="_blank" class="text-indigo-600 hover:underline text-xs font-semibold">View PDF</a>
                                @else
                                    <span class="text-xs text-gray-400">No file</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('admin.syllabuses.toggle-status', $item->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2.5 py-1 text-xs font-bold rounded-full {{ $item->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $item->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.syllabuses.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-xs">Edit</a>
                                <form method="POST" action="{{ route('admin.syllabuses.destroy', $item->id) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this syllabus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-xs">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-400">No syllabuses found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $syllabuses->links() }}
        </div>
    </div>
</div>
@endsection
