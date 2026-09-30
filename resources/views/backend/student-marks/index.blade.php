@extends('backend.layouts.app')
@section('title', 'Student Marksheets')
@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Student Marksheets & Individual Results</h1>
            <p class="mt-2 text-sm text-gray-500">Manage individual searchable student exam marks and grades.</p>
        </div>
        <a href="{{ route('admin.student-marks.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add Student Marksheet
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-200 px-6 py-5 flex justify-between items-center">
            <div>
                <h2 class="text-lg font-bold text-gray-900">Student Marksheets List</h2>
                <p class="mt-1 text-sm text-gray-500">Records searchable from public result portal.</p>
            </div>
            <form method="GET" action="{{ route('admin.student-marks.index') }}" class="flex gap-2">
                <select name="class" class="text-sm rounded-xl border-gray-300 p-2" onchange="this.form.submit()">
                    <option value="">All Classes</option>
                    @foreach($classes as $c)
                        <option value="{{ $c }}" {{ request('class') == $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Roll or Name..." class="text-sm rounded-xl border-gray-300 p-2">
                <button type="submit" class="bg-gray-100 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-gray-200">Search</button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-xs font-bold uppercase tracking-wider text-gray-500">
                    <tr>
                        <th class="px-6 py-4 text-left">Roll</th>
                        <th class="px-6 py-4 text-left">Student Name</th>
                        <th class="px-6 py-4 text-left">Class & Section</th>
                        <th class="px-6 py-4 text-left">Exam Name</th>
                        <th class="px-6 py-4 text-center">GPA</th>
                        <th class="px-6 py-4 text-center">Grade</th>
                        <th class="px-6 py-4 text-center">Total Marks</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($marks as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-mono font-bold text-indigo-700">{{ $item->roll_no }}</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900 block">{{ $item->student_name_bn }}</span>
                                <span class="text-xs text-gray-500 block">{{ $item->student_name_en }}</span>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ $item->class }} {{ $item->section ? '(' . $item->section . ')' : '' }}
                            </td>
                            <td class="px-6 py-4 text-xs font-medium text-gray-700">
                                {{ $item->exam_name_bn ?? $item->exam_name_en }} ({{ $item->academic_year }})
                            </td>
                            <td class="px-6 py-4 text-center font-black text-indigo-700">{{ number_format($item->gpa, 2) }}</td>
                            <td class="px-6 py-4 text-center font-bold text-gray-800">{{ $item->grade }}</td>
                            <td class="px-6 py-4 text-center font-bold text-gray-900">{{ $item->total_marks }}</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2.5 py-0.5 text-xs font-bold rounded-full {{ $item->result_status == 'PASSED' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $item->result_status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.student-marks.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-xs">Edit</a>
                                <form method="POST" action="{{ route('admin.student-marks.destroy', $item->id) }}" class="inline-block" onsubmit="return confirm('Delete this mark record?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-xs">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-8 text-center text-gray-400">No student marks recorded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $marks->links() }}
        </div>
    </div>
</div>
@endsection
