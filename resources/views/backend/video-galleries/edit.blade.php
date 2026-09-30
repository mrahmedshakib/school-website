@extends('backend.layouts.app')
@section('title', 'Edit Video')
@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Video Details</h1>
            <p class="text-sm text-gray-500">Update video links, titles and categories in Bangla & English.</p>
        </div>
        <a href="{{ route('admin.video-galleries.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2.5 rounded-xl text-sm transition">Back</a>
    </div>

    @if ($errors->any())
        <div class="mb-6 rounded-2xl bg-red-50 p-4 border border-red-200 text-sm text-red-700">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sm:p-8">
        <form action="{{ route('admin.video-galleries.update', $video->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Video Title (Bangla) *</label>
                    <input type="text" name="title_bn" value="{{ old('title_bn', $video->title_bn) }}" required class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Video Title (English)</label>
                    <input type="text" name="title_en" value="{{ old('title_en', $video->title_en) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-2">YouTube URL / Share Link *</label>
                <input type="url" name="youtube_url" value="{{ old('youtube_url', $video->youtube_url) }}" required class="w-full text-sm rounded-xl border-gray-300 p-3">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Category (Bangla)</label>
                    <input type="text" name="category_bn" value="{{ old('category_bn', $video->category_bn) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Category (English)</label>
                    <input type="text" name="category_en" value="{{ old('category_en', $video->category_en) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $video->sort_order) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Description (Bangla)</label>
                    <textarea name="description_bn" rows="3" class="w-full text-sm rounded-xl border-gray-300 p-3">{{ old('description_bn', $video->description_bn) }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Description (English)</label>
                    <textarea name="description_en" rows="3" class="w-full text-sm rounded-xl border-gray-300 p-3">{{ old('description_en', $video->description_en) }}</textarea>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="status" id="status" value="1" {{ old('status', $video->status) ? 'checked' : '' }} class="rounded text-red-600">
                <label for="status" class="text-sm font-semibold text-gray-700">Active (Visible on public video gallery)</label>
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-xl text-sm transition">
                    Update Video
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
