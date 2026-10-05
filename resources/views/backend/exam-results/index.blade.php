@extends('backend.layouts.app')
@section('title', 'Exam Result Gazettes')
@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Exam Results & Gazettes</h1>
            <p class="mt-2 text-sm text-gray-500">Manage term examination results and official PDF gazettes.</p>
        </div>
        <a href="{{ route('admin.exam-results.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Publish Result Gazette
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-200 px-6 py-5 flex justify-between items-center">
            <div>
                <h2 class="text-lg font-bold text-gray-900">Gazette List</h2>
                <p class="mt-1 text-sm text-gray-500">Published official examination results.</p>
            </div>
            <form method="GET" action="{{ route('admin.exam-results.index') }}">
                <select name="class" class="text-sm rounded-xl border-gray-300 p-2" onchange="this.form.submit()">
                    <option value="">All Classes</option>
                    @foreach($classes as $c)
                        <option value="{{ $c }}" {{ request('class') == $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200 text-xs">
                <thead class="bg-gray-50 text-[11px] font-bold uppercase tracking-wider text-gray-500">
                    <tr>
                        <th class="px-3 py-2.5 text-left w-10">#</th>
                        <th class="px-3 py-2.5 text-left w-24">Class & Year</th>
                        <th class="px-3 py-2.5 text-left">Title / Exam</th>
                        <th class="px-3 py-2.5 text-center w-16">Total</th>
                        <th class="px-3 py-2.5 text-center w-16">Passed</th>
                        <th class="px-3 py-2.5 text-center w-16">Rate</th>
                        <th class="px-3 py-2.5 text-center w-20">Date</th>
                        <th class="px-3 py-2.5 text-center w-20">Status</th>
                        <th class="px-3 py-2.5 text-right w-20">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white text-slate-700">
                    @forelse($results as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-3 py-2.5 font-mono text-gray-400">{{ $loop->iteration }}</td>
                            <td class="px-3 py-2.5 whitespace-nowrap">
                                <span class="font-bold text-gray-900 block">{{ $item->class }}</span>
                                <span class="text-[11px] text-gray-500">{{ $item->academic_year }}</span>
                            </td>
                            <td class="px-3 py-2.5">
                                <span class="font-bold text-gray-900 block line-clamp-1">{{ $item->title_bn }}</span>
                                <span class="text-[11px] text-violet-700 font-medium block line-clamp-1">{{ $item->exam_name_bn ?? $item->exam_name_en }}</span>
                            </td>
                            <td class="px-3 py-2.5 text-center font-bold text-gray-800 whitespace-nowrap">{{ $item->total_students }}</td>
                            <td class="px-3 py-2.5 text-center font-bold text-emerald-600 whitespace-nowrap">{{ $item->passed_students }}</td>
                            <td class="px-3 py-2.5 text-center font-bold text-violet-700 whitespace-nowrap">{{ $item->pass_rate }}%</td>
                            <td class="px-3 py-2.5 text-center text-[11px] text-gray-500 whitespace-nowrap">{{ $item->publish_date ? $item->publish_date->format('d/m/y') : '-' }}</td>
                            <td class="px-3 py-2.5 text-center whitespace-nowrap">
                                <form method="POST" action="{{ route('admin.exam-results.toggle-status', $item->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2 py-0.5 text-[11px] font-bold rounded-full {{ $item->status ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                                        {{ $item->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-3 py-2.5 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.exam-results.edit', $item->id) }}" class="p-1 rounded bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white transition" title="Edit">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-8.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 7.5-7.5z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.exam-results.destroy', $item->id) }}" class="inline-block" onsubmit="return confirm('Delete this result gazette?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1 rounded bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition" title="Delete">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-8V4a1 1 0 00-1-1h-3a1 1 0 00-1 1v3m-4 0h14"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-3 py-6 text-center text-gray-400">No results found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $results->links() }}
        </div>
    </div>
</div>
@endsection
