@extends('backend.layouts.app')
@section('title', 'Edit Publication or Magazine')
@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Publication / Magazine</h1>
            <p class="text-sm text-gray-500">Update publication details in Bangla and English.</p>
        </div>
        <a href="{{ route('admin.publications.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2.5 rounded-xl text-sm transition">Back</a>
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
        <form action="{{ route('admin.publications.update', $publication->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Title (Bangla) *</label>
                    <input type="text" name="title_bn" value="{{ old('title_bn', $publication->title_bn) }}" required class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Title (English)</label>
                    <input type="text" name="title_en" value="{{ old('title_en', $publication->title_en) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Type *</label>
                    <select name="type" class="w-full text-sm rounded-xl border-gray-300 p-3">
                        <option value="magazine" {{ $publication->type == 'magazine' ? 'selected' : '' }}>Magazine</option>
                        <option value="publication" {{ $publication->type == 'publication' ? 'selected' : '' }}>Publication / Report</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Edition (Bangla)</label>
                    <input type="text" name="edition_bn" value="{{ old('edition_bn', $publication->edition_bn) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Edition (English)</label>
                    <input type="text" name="edition_en" value="{{ old('edition_en', $publication->edition_en) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Academic Year</label>
                    <input type="text" name="academic_year" value="{{ old('academic_year', $publication->academic_year) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Publish Date</label>
                <input type="date" name="publish_date" value="{{ old('publish_date', $publication->publish_date ? $publication->publish_date->format('Y-m-d') : '') }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Description (Bangla)</label>
                    <textarea name="description_bn" rows="3" class="w-full text-sm rounded-xl border-gray-300 p-3">{{ old('description_bn', $publication->description_bn) }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Description (English)</label>
                    <textarea name="description_en" rows="3" class="w-full text-sm rounded-xl border-gray-300 p-3">{{ old('description_en', $publication->description_en) }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Cover Image</label>
                    @if($publication->cover_image)
                        <div class="mb-2">
                            <img src="{{ asset($publication->cover_image) }}" class="w-16 h-20 object-cover rounded-lg border">
                        </div>
                    @endif
                    <input type="file" name="cover_image" accept="image/*" class="w-full text-sm rounded-xl border border-gray-300 p-2">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Publication PDF File</label>
                    @if($publication->file_path)
                        <div class="mb-2">
                            <a href="{{ asset($publication->file_path) }}" target="_blank" class="text-xs font-semibold text-teal-600 hover:underline">Current PDF: {{ $publication->file_path }}</a>
                        </div>
                    @endif
                    <input type="file" name="file" accept=".pdf" class="w-full text-sm rounded-xl border border-gray-300 p-2">
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="status" id="status" value="1" {{ old('status', $publication->status) ? 'checked' : '' }} class="rounded text-emerald-600 focus:ring-emerald-500">
                <label for="status" class="text-sm font-semibold text-gray-700">Active (Visible on public website)</label>
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-6 rounded-xl text-sm transition shadow-sm">
                    Update Publication
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
