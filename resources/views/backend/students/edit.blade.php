@extends('backend.layouts.app')
@section('title', 'Edit Student')
@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Student</h1>
            <p class="text-sm text-gray-500">Update student information in Bangla and English.</p>
        </div>
        <a href="{{ route('admin.students.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2.5 rounded-xl text-sm transition">Back</a>
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
        <form action="{{ route('admin.students.update', $student->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Student Name (Bangla) *</label>
                    <input type="text" name="name_bn" value="{{ old('name_bn', $student->name_bn) }}" required class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Student Name (English)</label>
                    <input type="text" name="name_en" value="{{ old('name_en', $student->name_en) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Student ID</label>
                    <input type="text" name="student_id" value="{{ old('student_id', $student->student_id) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Class *</label>
                    <input type="text" name="class" value="{{ old('class', $student->class) }}" required class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Section</label>
                    <input type="text" name="section" value="{{ old('section', $student->section) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Roll No. *</label>
                    <input type="text" name="roll_no" value="{{ old('roll_no', $student->roll_no) }}" required class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Gender *</label>
                    <select name="gender" class="w-full text-sm rounded-xl border-gray-300 p-3">
                        <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ $student->gender == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Academic Year</label>
                    <input type="text" name="academic_year" value="{{ old('academic_year', $student->academic_year) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Blood Group</label>
                    <input type="text" name="blood_group" value="{{ old('blood_group', $student->blood_group) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Guardian Name (Bangla)</label>
                    <input type="text" name="guardian_name_bn" value="{{ old('guardian_name_bn', $student->guardian_name_bn) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Guardian Name (English)</label>
                    <input type="text" name="guardian_name_en" value="{{ old('guardian_name_en', $student->guardian_name_en) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Guardian Phone</label>
                    <input type="text" name="guardian_phone" value="{{ old('guardian_phone', $student->guardian_phone) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Student Photo</label>
                @if($student->photo)
                    <div class="mb-2">
                        <img src="{{ asset($student->photo) }}" class="w-16 h-16 rounded-full object-cover">
                    </div>
                @endif
                <input type="file" name="photo" accept="image/*" class="w-full text-sm rounded-xl border border-gray-300 p-2">
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="status" id="status" value="1" {{ old('status', $student->status) ? 'checked' : '' }} class="rounded text-blue-600">
                <label for="status" class="text-sm font-semibold text-gray-700">Active Student</label>
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl text-sm transition">
                    Update Student
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
