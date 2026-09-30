@extends('backend.layouts.app')
@section('title', 'Video Gallery')
@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Video Gallery Management</h1>
            <p class="mt-2 text-sm text-gray-500">Manage school video documentaries, events and YouTube videos.</p>
        </div>
        <a href="{{ route('admin.video-galleries.create') }}" class="inline-flex items-center justify-center gap-2 rounded-xl bg-red-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-red-700">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Add New Video
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-200 px-6 py-5">
            <h2 class="text-lg font-bold text-gray-900">Video List</h2>
            <p class="mt-1 text-sm text-gray-500">Videos appearing on the public video gallery page.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-xs font-bold uppercase tracking-wider text-gray-500">
                    <tr>
                        <th class="px-6 py-4 text-left">#</th>
                        <th class="px-6 py-4 text-left">Thumbnail</th>
                        <th class="px-6 py-4 text-left">Title (BN / EN)</th>
                        <th class="px-6 py-4 text-left">Category</th>
                        <th class="px-6 py-4 text-left">YouTube ID</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($videos as $item)
                        @php
                            $thumb = $item->thumbnail ? asset($item->thumbnail) : ($item->video_id ? "https://img.youtube.com/vi/{$item->video_id}/hqdefault.jpg" : null);
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-mono text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                @if($thumb)
                                    <img src="{{ $thumb }}" alt="Thumb" class="w-16 h-10 object-cover rounded-lg border">
                                @else
                                    <div class="w-16 h-10 bg-gray-100 rounded-lg flex items-center justify-center text-xs">▶️</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900 block">{{ $item->title_bn }}</span>
                                <span class="text-xs text-gray-500 block">{{ $item->title_en }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-slate-100 text-slate-700">
                                    {{ $item->category_bn ?? $item->category_en }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-mono text-xs text-gray-600">
                                <a href="{{ $item->youtube_url }}" target="_blank" class="text-red-600 hover:underline">
                                    {{ $item->video_id ?? 'Watch' }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('admin.video-galleries.toggle-status', $item->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2.5 py-1 text-xs font-bold rounded-full {{ $item->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $item->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.video-galleries.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold text-xs">Edit</a>
                                <form method="POST" action="{{ route('admin.video-galleries.destroy', $item->id) }}" class="inline-block" onsubmit="return confirm('Delete this video?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold text-xs">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-gray-400">No videos uploaded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $videos->links() }}
        </div>
    </div>
</div>
@endsection
