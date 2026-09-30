@extends('backend.layouts.app')
@section('title', 'Add Class Routine')
@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Add Class Routine</h1>
            <p class="text-sm text-gray-500">Provide routine details in Bangla and English.</p>
        </div>
        <a href="{{ route('admin.class-routines.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2.5 rounded-xl text-sm transition">Back</a>
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
        <form action="{{ route('admin.class-routines.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Title (Bangla) *</label>
                    <input type="text" name="title_bn" value="{{ old('title_bn') }}" required class="w-full text-sm rounded-xl border-gray-300 p-3" placeholder="যেমন: ষষ্ঠ শ্রেণির দৈনিক ক্লাস রুটিন">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Title (English)</label>
                    <input type="text" name="title_en" value="{{ old('title_en') }}" class="w-full text-sm rounded-xl border-gray-300 p-3" placeholder="e.g. Class 6 Daily Routine">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Class *</label>
                    <input type="text" name="class" value="{{ old('class') }}" required class="w-full text-sm rounded-xl border-gray-300 p-3" placeholder="Class 6">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Section</label>
                    <input type="text" name="section" value="{{ old('section') }}" class="w-full text-sm rounded-xl border-gray-300 p-3" placeholder="A / Padma">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Shift</label>
                    <select name="shift" class="w-full text-sm rounded-xl border-gray-300 p-3">
                        <option value="Day">Day</option>
                        <option value="Morning">Morning</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Academic Year</label>
                    <input type="text" name="academic_year" value="{{ old('academic_year', date('Y')) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Routine PDF File</label>
                <input type="file" name="file" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" class="w-full text-sm rounded-xl border border-gray-300 p-2">
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="status" id="status" value="1" {{ old('status', 1) ? 'checked' : '' }} class="rounded text-emerald-600">
                <label for="status" class="text-sm font-semibold text-gray-700">Active (Visible on public website)</label>
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-6 rounded-xl text-sm transition">
                    Save Class Routine
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
