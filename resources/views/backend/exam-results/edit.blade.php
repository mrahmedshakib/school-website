@extends('backend.layouts.app')
@section('title', 'Edit Exam Result Gazette')
@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Exam Result Gazette</h1>
            <p class="text-sm text-gray-500">Update official result gazette and summary statistics.</p>
        </div>
        <a href="{{ route('admin.exam-results.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2.5 rounded-xl text-sm transition">Back</a>
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
        <form action="{{ route('admin.exam-results.update', $result->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Title (Bangla) *</label>
                    <input type="text" name="title_bn" value="{{ old('title_bn', $result->title_bn) }}" required class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Title (English)</label>
                    <input type="text" name="title_en" value="{{ old('title_en', $result->title_en) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Class</label>
                    <input type="text" name="class" value="{{ old('class', $result->class) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Exam Name (Bangla)</label>
                    <input type="text" name="exam_name_bn" value="{{ old('exam_name_bn', $result->exam_name_bn) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Exam Name (English)</label>
                    <input type="text" name="exam_name_en" value="{{ old('exam_name_en', $result->exam_name_en) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Academic Year</label>
                    <input type="text" name="academic_year" value="{{ old('academic_year', $result->academic_year) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Publish Date</label>
                    <input type="date" name="publish_date" value="{{ old('publish_date', $result->publish_date ? $result->publish_date->format('Y-m-d') : '') }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Total Examinees</label>
                    <input type="number" name="total_students" value="{{ old('total_students', $result->total_students) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Passed Students</label>
                    <input type="number" name="passed_students" value="{{ old('passed_students', $result->passed_students) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Failed Students</label>
                    <input type="number" name="failed_students" value="{{ old('failed_students', $result->failed_students) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">GPA 5.00 Count</label>
                    <input type="number" name="gpa5_count" value="{{ old('gpa5_count', $result->gpa5_count) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Pass Rate (%)</label>
                    <input type="number" step="0.01" name="pass_rate" value="{{ old('pass_rate', $result->pass_rate) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Result Gazette PDF File</label>
                @if($result->file_path)
                    <div class="mb-2">
                        <a href="{{ asset($result->file_path) }}" target="_blank" class="text-xs font-semibold text-violet-600 hover:underline">Current file: {{ $result->file_path }}</a>
                    </div>
                @endif
                <input type="file" name="file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" class="w-full text-sm rounded-xl border border-gray-300 p-2">
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="status" id="status" value="1" {{ old('status', $result->status) ? 'checked' : '' }} class="rounded text-violet-600">
                <label for="status" class="text-sm font-semibold text-gray-700">Active (Visible on public website)</label>
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                <button type="submit" class="bg-violet-600 hover:bg-violet-700 text-white font-bold py-3 px-6 rounded-xl text-sm transition">
                    Update Result Gazette
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
