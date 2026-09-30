@extends('backend.layouts.app')
@section('title', 'Academic Subjects')
@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Academic Subjects</h1>
            <p class="mt-2 text-sm text-gray-500">Manage curriculum subjects, mark distributions and codes.</p>
        </div>
        <a href="{{ route('admin.subjects.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add Subject
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
                <h2 class="text-lg font-bold text-gray-900">Subject List</h2>
                <p class="mt-1 text-sm text-gray-500">All registered class subjects.</p>
            </div>
            <form method="GET" action="{{ route('admin.subjects.index') }}" class="flex gap-2">
                <select name="class" class="text-sm rounded-xl border-gray-300 p-2" onchange="this.form.submit()">
                    <option value="">All Classes</option>
                    @foreach($classes as $c)
                        <option value="{{ $c }}" {{ request('class') == $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
                <select name="group_name" class="text-sm rounded-xl border-gray-300 p-2" onchange="this.form.submit()">
                    <option value="">All Groups</option>
                    @foreach($groups as $g)
                        <option value="{{ $g }}" {{ request('group_name') == $g ? 'selected' : '' }}>{{ $g }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-xs font-bold uppercase tracking-wider text-gray-500">
                    <tr>
                        <th class="px-6 py-4 text-left">Code</th>
                        <th class="px-6 py-4 text-left">Name (BN / EN)</th>
                        <th class="px-6 py-4 text-left">Class</th>
                        <th class="px-6 py-4 text-left">Group</th>
                        <th class="px-6 py-4 text-left">Type</th>
                        <th class="px-6 py-4 text-center">Total Marks</th>
                        <th class="px-6 py-4 text-center">Theory / Prac</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($subjects as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-mono font-bold text-indigo-700">{{ $item->code ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900 block">{{ $item->name_bn }}</span>
                                <span class="text-xs text-gray-500 block">{{ $item->name_en }}</span>
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-800">{{ $item->class }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $item->group_name }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 text-xs font-semibold rounded-full {{ $item->type == 'Compulsory' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                                    {{ $item->type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center font-bold text-gray-900">{{ $item->total_marks }}</td>
                            <td class="px-6 py-4 text-center text-xs text-gray-600">{{ $item->theory_marks ?? '-' }} / {{ $item->practical_marks ?? '0' }}</td>
                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('admin.subjects.toggle-status', $item->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2.5 py-1 text-xs font-bold rounded-full {{ $item->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $item->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.subjects.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-xs">Edit</a>
                                <form method="POST" action="{{ route('admin.subjects.destroy', $item->id) }}" class="inline-block" onsubmit="return confirm('Delete this subject?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-xs">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-8 text-center text-gray-400">No subjects found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $subjects->links() }}
        </div>
    </div>
</div>
@endsection
