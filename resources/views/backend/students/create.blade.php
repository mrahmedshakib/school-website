@extends('backend.layouts.app')
@section('title', 'Enroll Student')
@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Enroll New Student</h1>
            <p class="text-sm text-gray-500">Provide student information in Bangla and English.</p>
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
        <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Student Name (Bangla) *</label>
                    <input type="text" name="name_bn" value="{{ old('name_bn') }}" required class="w-full text-sm rounded-xl border-gray-300 p-3" placeholder="যেমন: তাসনিমা রহমান">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Student Name (English)</label>
                    <input type="text" name="name_en" value="{{ old('name_en') }}" class="w-full text-sm rounded-xl border-gray-300 p-3" placeholder="e.g. Tasnima Rahman">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Student ID</label>
                    <input type="text" name="student_id" value="{{ old('student_id') }}" class="w-full text-sm rounded-xl border-gray-300 p-3" placeholder="ST-2026-005">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Class *</label>
                    <input type="text" name="class" value="{{ old('class') }}" required class="w-full text-sm rounded-xl border-gray-300 p-3" placeholder="Class 6">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Section</label>
                    <input type="text" name="section" value="{{ old('section') }}" class="w-full text-sm rounded-xl border-gray-300 p-3" placeholder="A">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Roll No. *</label>
                    <input type="text" name="roll_no" value="{{ old('roll_no') }}" required class="w-full text-sm rounded-xl border-gray-300 p-3" placeholder="05">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Gender *</label>
                    <select name="gender" class="w-full text-sm rounded-xl border-gray-300 p-3">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Academic Year</label>
                    <input type="text" name="academic_year" value="{{ old('academic_year', date('Y')) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Blood Group</label>
                    <input type="text" name="blood_group" value="{{ old('blood_group') }}" class="w-full text-sm rounded-xl border-gray-300 p-3" placeholder="A+, B+, O+">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Guardian Name (Bangla)</label>
                    <input type="text" name="guardian_name_bn" value="{{ old('guardian_name_bn') }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Guardian Name (English)</label>
                    <input type="text" name="guardian_name_en" value="{{ old('guardian_name_en') }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Guardian Phone</label>
                    <input type="text" name="guardian_phone" value="{{ old('guardian_phone') }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Student Photo</label>
                <input type="file" name="photo" accept="image/*" class="w-full text-sm rounded-xl border border-gray-300 p-2">
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="status" id="status" value="1" {{ old('status', 1) ? 'checked' : '' }} class="rounded text-blue-600">
                <label for="status" class="text-sm font-semibold text-gray-700">Active Student</label>
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl text-sm transition">
                    Enroll Student
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
