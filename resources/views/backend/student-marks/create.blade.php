@extends('backend.layouts.app')
@section('title', 'Add Student Marksheet')
@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Add Student Marksheet</h1>
            <p class="text-sm text-gray-500">Enter student marks and grades for public online result search.</p>
        </div>
        <a href="{{ route('admin.student-marks.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2.5 rounded-xl text-sm transition">Back</a>
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
        <form action="{{ route('admin.student-marks.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Student Name (Bangla) *</label>
                    <input type="text" name="student_name_bn" value="{{ old('student_name_bn') }}" required class="w-full text-sm rounded-xl border-gray-300 p-3" placeholder="যেমন: মো: আরিফুল ইসলাম">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Student Name (English)</label>
                    <input type="text" name="student_name_en" value="{{ old('student_name_en') }}" class="w-full text-sm rounded-xl border-gray-300 p-3" placeholder="e.g. Md. Ariful Islam">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Roll No. *</label>
                    <input type="text" name="roll_no" value="{{ old('roll_no') }}" required class="w-full text-sm rounded-xl border-gray-300 p-3" placeholder="101">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Student ID</label>
                    <input type="text" name="student_id" value="{{ old('student_id') }}" class="w-full text-sm rounded-xl border-gray-300 p-3" placeholder="ST-2026-001">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Class *</label>
                    <input type="text" name="class" value="{{ old('class') }}" required class="w-full text-sm rounded-xl border-gray-300 p-3" placeholder="Class 10">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Section</label>
                    <input type="text" name="section" value="{{ old('section') }}" class="w-full text-sm rounded-xl border-gray-300 p-3" placeholder="A">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Exam Name (Bangla) *</label>
                    <input type="text" name="exam_name_bn" value="{{ old('exam_name_bn') }}" required class="w-full text-sm rounded-xl border-gray-300 p-3" placeholder="বার্ষিক পরীক্ষা ২০২৫">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Exam Name (English)</label>
                    <input type="text" name="exam_name_en" value="{{ old('exam_name_en') }}" class="w-full text-sm rounded-xl border-gray-300 p-3" placeholder="Annual Examination 2025">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Academic Year</label>
                    <input type="text" name="academic_year" value="{{ old('academic_year', date('Y')) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">GPA (e.g. 5.00) *</label>
                    <input type="number" step="0.01" name="gpa" value="{{ old('gpa', '5.00') }}" required class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Letter Grade *</label>
                    <input type="text" name="grade" value="{{ old('grade', 'A+') }}" required class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Total Marks *</label>
                    <input type="number" name="total_marks" value="{{ old('total_marks', 910) }}" required class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Result Status *</label>
                    <select name="result_status" class="w-full text-sm rounded-xl border-gray-300 p-3">
                        <option value="PASSED">PASSED</option>
                        <option value="FAILED">FAILED</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Subject Marks Details (JSON Format)</label>
                <textarea name="marks_details_json" rows="5" class="w-full font-mono text-xs rounded-xl border-gray-300 p-3" placeholder='[{"subject":"বাংলা","marks":88,"grade":"A+","point":5.0},{"subject":"English","marks":92,"grade":"A+","point":5.0}]'>{{ old('marks_details_json', '[{"subject":"বাংলা","marks":88,"grade":"A+","point":5.0},{"subject":"ইংরেজি","marks":92,"grade":"A+","point":5.0},{"subject":"গণিত","marks":98,"grade":"A+","point":5.0},{"subject":"বিজ্ঞান","marks":90,"grade":"A+","point":5.0}]') }}</textarea>
                <p class="text-xs text-gray-400 mt-1">Specify array of objects containing subject, marks, grade, and point.</p>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Remarks</label>
                <input type="text" name="remarks" value="{{ old('remarks', 'Excellent performance') }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-xl text-sm transition">
                    Save Marksheet
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
