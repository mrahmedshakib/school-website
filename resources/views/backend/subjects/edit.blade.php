@extends('backend.layouts.app')
@section('title', 'Edit Academic Subject')
@section('content')
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Edit Academic Subject</h1>
            <p class="text-sm text-gray-500">Update subject details and marks distribution in Bangla & English.</p>
        </div>
        <a href="{{ route('admin.subjects.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2.5 rounded-xl text-sm transition">Back</a>
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
        <form action="{{ route('admin.subjects.update', $subject->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Subject Name (Bangla) *</label>
                    <input type="text" name="name_bn" value="{{ old('name_bn', $subject->name_bn) }}" required class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Subject Name (English)</label>
                    <input type="text" name="name_en" value="{{ old('name_en', $subject->name_en) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Subject Code</label>
                    <input type="text" name="code" value="{{ old('code', $subject->code) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Class *</label>
                    <input type="text" name="class" value="{{ old('class', $subject->class) }}" required class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Group</label>
                    <select name="group_name" class="w-full text-sm rounded-xl border-gray-300 p-3">
                        <option value="General" {{ $subject->group_name == 'General' ? 'selected' : '' }}>General</option>
                        <option value="Science" {{ $subject->group_name == 'Science' ? 'selected' : '' }}>Science</option>
                        <option value="Commerce" {{ $subject->group_name == 'Commerce' ? 'selected' : '' }}>Commerce</option>
                        <option value="Humanities" {{ $subject->group_name == 'Humanities' ? 'selected' : '' }}>Humanities</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Subject Type</label>
                    <select name="type" class="w-full text-sm rounded-xl border-gray-300 p-3">
                        <option value="Compulsory" {{ $subject->type == 'Compulsory' ? 'selected' : '' }}>Compulsory</option>
                        <option value="Elective" {{ $subject->type == 'Elective' ? 'selected' : '' }}>Elective</option>
                        <option value="Optional" {{ $subject->type == 'Optional' ? 'selected' : '' }}>Optional</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Total Marks *</label>
                    <input type="number" name="total_marks" value="{{ old('total_marks', $subject->total_marks) }}" required class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Theory Marks</label>
                    <input type="number" name="theory_marks" value="{{ old('theory_marks', $subject->theory_marks) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Practical Marks</label>
                    <input type="number" name="practical_marks" value="{{ old('practical_marks', $subject->practical_marks) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-2">Viva Marks</label>
                    <input type="number" name="viva_marks" value="{{ old('viva_marks', $subject->viva_marks) }}" class="w-full text-sm rounded-xl border-gray-300 p-3">
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" name="status" id="status" value="1" {{ old('status', $subject->status) ? 'checked' : '' }} class="rounded text-indigo-600">
                <label for="status" class="text-sm font-semibold text-gray-700">Active (Visible on public website)</label>
            </div>

            <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-xl text-sm transition">
                    Update Subject
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
