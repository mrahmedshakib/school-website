@extends('backend.layouts.app')
@section('title', 'Class Routines')
@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Class Routines</h1>
            <p class="mt-2 text-sm text-gray-500">Manage daily class schedules and timetable routines.</p>
        </div>
        <a href="{{ route('admin.class-routines.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add Routine
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-200 px-6 py-5 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-lg font-bold text-gray-900">Routine List</h2>
                <p class="mt-1 text-sm text-gray-500">All uploaded class timetables.</p>
            </div>
            <form method="GET" action="{{ route('admin.class-routines.index') }}" class="flex gap-2">
                <select name="class" class="text-sm rounded-xl border-gray-300 p-2" onchange="this.form.submit()">
                    <option value="">All Classes</option>
                    @foreach($classes as $c)
                        <option value="{{ $c }}" {{ request('class') == $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-xs font-bold uppercase tracking-wider text-gray-500">
                    <tr>
                        <th class="px-6 py-4 text-left">#</th>
                        <th class="px-6 py-4 text-left">Class & Shift</th>
                        <th class="px-6 py-4 text-left">Title (BN / EN)</th>
                        <th class="px-6 py-4 text-left">Section</th>
                        <th class="px-6 py-4 text-left">Year</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($routines as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-mono text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900 block">{{ $item->class }}</span>
                                <span class="text-xs font-semibold px-2 py-0.5 rounded bg-blue-50 text-blue-700">{{ $item->shift }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-gray-900 block">{{ $item->title_bn }}</span>
                                <span class="text-xs text-gray-500 block">{{ $item->title_en }}</span>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-700">{{ $item->section ?? 'All' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $item->academic_year }}</td>
                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('admin.class-routines.toggle-status', $item->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2.5 py-1 text-xs font-bold rounded-full {{ $item->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $item->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.class-routines.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-xs">Edit</a>
                                <form method="POST" action="{{ route('admin.class-routines.destroy', $item->id) }}" class="inline-block" onsubmit="return confirm('Delete this routine?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-xs">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-400">No routines found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $routines->links() }}
        </div>
    </div>
</div>
@endsection
