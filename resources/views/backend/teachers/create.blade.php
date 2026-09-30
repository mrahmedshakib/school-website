@extends('backend.layouts.app')

@section('title', 'Add Teacher / Staff')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Add Teacher / Staff</h1>
            <p class="text-sm text-gray-500 mt-1">
                Add a new teacher or staff member to the website.
            </p>
        </div>
        <a href="{{ route('admin.teachers.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-semibold rounded-xl hover:bg-gray-200 transition">
            ← Back to List
        </a>
    </div>

    @if($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">
            <h3 class="font-bold text-red-800 mb-2">Please fix the following errors:</h3>
            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 sm:p-8">
        <form
            action="{{ route('admin.teachers.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="space-y-6">

                {{-- Type --}}
                <div>
                    <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">
                        Member Type <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="type"
                        name="type"
                        required
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-teal-600 focus:ring-2 focus:ring-teal-600/10 outline-none"
                    >
                        <option value="teacher" {{ old('type', 'teacher') == 'teacher' ? 'selected' : '' }}>
                            👨‍🏫 Teacher (শিক্ষক)
                        </option>
                        <option value="staff" {{ old('type') == 'staff' ? 'selected' : '' }}>
                            👨‍💼 Staff (কর্মচারী)
                        </option>
                    </select>
                </div>

                {{-- Bilingual Names --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="name_bn" class="block text-sm font-semibold text-gray-700 mb-2">
                            Name (Bangla) <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="name_bn"
                            name="name_bn"
                            value="{{ old('name_bn') }}"
                            required
                            placeholder="নাম বাংলায় লিখুন"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-teal-600 focus:ring-2 focus:ring-teal-600/10 outline-none"
                        >
                    </div>

                    <div>
                        <label for="name_en" class="block text-sm font-semibold text-gray-700 mb-2">
                            Name (English)
                        </label>
                        <input
                            type="text"
                            id="name_en"
                            name="name_en"
                            value="{{ old('name_en') }}"
                            placeholder="Enter name in English"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-teal-600 focus:ring-2 focus:ring-teal-600/10 outline-none"
                        >
                    </div>
                </div>

                {{-- Bilingual Designations --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="designation_bn" class="block text-sm font-semibold text-gray-700 mb-2">
                            Designation (Bangla)
                        </label>
                        <input
                            type="text"
                            id="designation_bn"
                            name="designation_bn"
                            value="{{ old('designation_bn') }}"
                            placeholder="যেমন: সহকারী শিক্ষক / প্রধান সহকারী"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-teal-600 focus:ring-2 focus:ring-teal-600/10 outline-none"
                        >
                    </div>

                    <div>
                        <label for="designation_en" class="block text-sm font-semibold text-gray-700 mb-2">
                            Designation (English)
                        </label>
                        <input
                            type="text"
                            id="designation_en"
                            name="designation_en"
                            value="{{ old('designation_en') }}"
                            placeholder="e.g. Assistant Teacher / Office Assistant"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-teal-600 focus:ring-2 focus:ring-teal-600/10 outline-none"
                        >
                    </div>
                </div>

                {{-- Bilingual Subjects --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="subject_bn" class="block text-sm font-semibold text-gray-700 mb-2">
                            Subject (Bangla)
                        </label>
                        <input
                            type="text"
                            id="subject_bn"
                            name="subject_bn"
                            value="{{ old('subject_bn') }}"
                            placeholder="যেমন: গণিত / বাংলা"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-teal-600 focus:ring-2 focus:ring-teal-600/10 outline-none"
                        >
                    </div>

                    <div>
                        <label for="subject_en" class="block text-sm font-semibold text-gray-700 mb-2">
                            Subject (English)
                        </label>
                        <input
                            type="text"
                            id="subject_en"
                            name="subject_en"
                            value="{{ old('subject_en') }}"
                            placeholder="e.g. Mathematics"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-teal-600 focus:ring-2 focus:ring-teal-600/10 outline-none"
                        >
                    </div>
                </div>

                {{-- Bilingual Qualifications --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="qualification_bn" class="block text-sm font-semibold text-gray-700 mb-2">
                            Qualification (Bangla)
                        </label>
                        <input
                            type="text"
                            id="qualification_bn"
                            name="qualification_bn"
                            value="{{ old('qualification_bn') }}"
                            placeholder="যেমন: এম.এসসি (গণিত), বি.এড"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-teal-600 focus:ring-2 focus:ring-teal-600/10 outline-none"
                        >
                    </div>

                    <div>
                        <label for="qualification_en" class="block text-sm font-semibold text-gray-700 mb-2">
                            Qualification (English)
                        </label>
                        <input
                            type="text"
                            id="qualification_en"
                            name="qualification_en"
                            value="{{ old('qualification_en') }}"
                            placeholder="e.g. M.Sc (Mathematics), B.Ed"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-teal-600 focus:ring-2 focus:ring-teal-600/10 outline-none"
                        >
                    </div>
                </div>

                {{-- Phone & Email --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                            Phone
                        </label>
                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="01XXXXXXXXX"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-teal-600 focus:ring-2 focus:ring-teal-600/10 outline-none"
                        >
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="example@gmail.com"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-teal-600 focus:ring-2 focus:ring-teal-600/10 outline-none"
                        >
                    </div>
                </div>

                {{-- Image & Sort Order --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">
                            Profile Image
                        </label>
                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept="image/jpeg,image/png,image/jpg,image/webp"
                            class="w-full rounded-xl border border-gray-300 px-3 py-2.5 text-sm focus:border-teal-600 focus:ring-2 focus:ring-teal-600/10 outline-none"
                        >
                        <p class="text-xs text-gray-500 mt-1">
                            JPG, JPEG, PNG or WEBP. Maximum 2MB.
                        </p>
                    </div>

                    <div>
                        <label for="sort_order" class="block text-sm font-semibold text-gray-700 mb-2">
                            Sort Order
                        </label>
                        <input
                            type="number"
                            id="sort_order"
                            name="sort_order"
                            value="{{ old('sort_order', 0) }}"
                            min="0"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm focus:border-teal-600 focus:ring-2 focus:ring-teal-600/10 outline-none"
                        >
                        <p class="text-xs text-gray-500 mt-1">
                            Lower number will appear first.
                        </p>
                    </div>
                </div>

                {{-- Status --}}
                <div>
                    <label class="inline-flex items-center gap-3 cursor-pointer">
                        <input
                            type="checkbox"
                            name="status"
                            value="1"
                            {{ old('status', 1) ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-gray-300 text-teal-600 focus:ring-teal-500"
                        >
                        <span class="text-sm font-semibold text-gray-700">
                            Active
                        </span>
                    </label>
                </div>

            </div>

            {{-- Buttons --}}
            <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                <a
                    href="{{ route('admin.teachers.index') }}"
                    class="px-5 py-2.5 rounded-xl bg-gray-100 text-gray-700 text-sm font-semibold hover:bg-gray-200 transition"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-[#0F766E] text-white text-sm font-semibold hover:bg-[#0b625d] transition shadow-md shadow-[#0F766E]/20"
                >
                    Save Member
                </button>
            </div>
        </form>
    </div>
</div>
@endsection