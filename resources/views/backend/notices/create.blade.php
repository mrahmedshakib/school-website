@extends('backend.layouts.app')

@section('title', 'Add Notice')

@section('content')

<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-8">

        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                Add Notice
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Create a new school notice.
            </p>
        </div>

        <a
            href="{{ route('admin.notices.index') }}"
            class="inline-flex items-center justify-center gap-2
                   rounded-xl bg-gray-100 px-5 py-3
                   text-sm font-semibold text-gray-700
                   transition hover:bg-gray-200"
        >
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-5 w-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>

            Back to Notices
        </a>

    </div>


    {{-- Validation Errors --}}
    @if ($errors->any())

        <div class="mb-6 rounded-2xl border border-red-200
                    bg-red-50 p-5">

            <h3 class="font-semibold text-red-800">
                Please fix the following errors:
            </h3>

            <ul class="mt-2 list-disc space-y-1 pl-5
                       text-sm text-red-700">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- Form Card --}}
    <div class="overflow-hidden rounded-2xl
                border border-gray-200
                bg-white shadow-sm">

        {{-- Card Header --}}
        <div class="border-b border-gray-200
                    px-6 py-5 sm:px-8">

            <h2 class="text-lg font-bold text-gray-900">
                Notice Information
            </h2>

            <p class="mt-1 text-sm text-gray-500">
                Fill in the information below to publish a notice.
            </p>

        </div>


        {{-- Form --}}
        <form
            action="{{ route('admin.notices.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <div class="space-y-7 px-6 py-7 sm:px-8">

                {{-- Bilingual Titles --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title_bn" class="mb-2 block text-sm font-semibold text-gray-700">
                            Notice Title (Bangla) <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="title_bn"
                            id="title_bn"
                            value="{{ old('title_bn') }}"
                            placeholder="নোটিশের শিরোনাম লিখুন"
                            required
                            class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none focus:border-[#0F766E] focus:ring-2 focus:ring-[#0F766E]/10"
                        >
                    </div>

                    <div>
                        <label for="title_en" class="mb-2 block text-sm font-semibold text-gray-700">
                            Notice Title (English)
                        </label>
                        <input
                            type="text"
                            name="title_en"
                            id="title_en"
                            value="{{ old('title_en') }}"
                            placeholder="Enter notice title in English"
                            class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none focus:border-[#0F766E] focus:ring-2 focus:ring-[#0F766E]/10"
                        >
                    </div>
                </div>

                {{-- Category --}}
                <div>
                    <label for="category" class="mb-2 block text-sm font-semibold text-gray-700">
                        Notice Category
                    </label>
                    <select name="category" id="category" class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none focus:border-[#0F766E] focus:ring-2 focus:ring-[#0F766E]/10">
                        <option value="Academic" {{ old('category') == 'Academic' ? 'selected' : '' }}>Academic</option>
                        <option value="Admission" {{ old('category') == 'Admission' ? 'selected' : '' }}>Admission</option>
                        <option value="Exam" {{ old('category') == 'Exam' ? 'selected' : '' }}>Exam</option>
                        <option value="General" {{ old('category') == 'General' ? 'selected' : '' }}>General</option>
                    </select>
                </div>

                {{-- Bilingual Descriptions --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="description_bn" class="mb-2 block text-sm font-semibold text-gray-700">
                            Description (Bangla)
                        </label>
                        <textarea
                            name="description_bn"
                            id="description_bn"
                            rows="6"
                            placeholder="নোটিশের বিস্তারিত বিবরণ..."
                            class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none focus:border-[#0F766E] focus:ring-2 focus:ring-[#0F766E]/10"
                        >{{ old('description_bn') }}</textarea>
                    </div>

                    <div>
                        <label for="description_en" class="mb-2 block text-sm font-semibold text-gray-700">
                            Description (English)
                        </label>
                        <textarea
                            name="description_en"
                            id="description_en"
                            rows="6"
                            placeholder="Notice details in English..."
                            class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none focus:border-[#0F766E] focus:ring-2 focus:ring-[#0F766E]/10"
                        >{{ old('description_en') }}</textarea>
                    </div>
                </div>


                {{-- Date + Status --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    {{-- Notice Date --}}
                    <div>

                        <label
                            for="notice_date"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Notice Date
                        </label>

                        <input
                            type="date"
                            name="notice_date"
                            id="notice_date"
                            value="{{ old('notice_date', now()->format('Y-m-d')) }}"
                            class="w-full rounded-xl border border-gray-300
                                   bg-white px-4 py-3 text-sm
                                   text-gray-900 outline-none
                                   focus:border-[#0F766E]
                                   focus:ring-2 focus:ring-[#0F766E]/10"
                        >

                        @error('notice_date')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Status --}}
                    <div>

                        <label
                            for="status"
                            class="mb-2 block text-sm font-semibold text-gray-700"
                        >
                            Status
                        </label>

                        <select
                            name="status"
                            id="status"
                            class="w-full rounded-xl border border-gray-300
                                   bg-white px-4 py-3 text-sm
                                   text-gray-900 outline-none
                                   focus:border-[#0F766E]
                                   focus:ring-2 focus:ring-[#0F766E]/10"
                        >

                            <option
                                value="1"
                                {{ old('status', 1) == 1 ? 'selected' : '' }}
                            >
                                Active
                            </option>

                            <option
                                value="0"
                                {{ old('status') == 0 ? 'selected' : '' }}
                            >
                                Inactive
                            </option>

                        </select>

                        @error('status')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>


                {{-- File Upload --}}
                <div>

                    <label
                        for="file"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Notice File
                    </label>

                    <div class="rounded-xl border-2 border-dashed
                                border-gray-300 bg-gray-50 p-6">

                        <input
                            type="file"
                            name="file"
                            id="file"
                            accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.webp"
                            class="block w-full text-sm text-gray-600
                                   file:mr-4
                                   file:rounded-lg
                                   file:border-0
                                   file:bg-[#0F766E]
                                   file:px-4
                                   file:py-2
                                   file:text-sm
                                   file:font-semibold
                                   file:text-white
                                   hover:file:bg-[#0d665f]"
                        >

                        <div class="mt-3 flex items-center gap-2">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-4 w-4 text-gray-400"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>

                            </svg>

                            <p class="text-xs text-gray-500">
                                PDF, DOC, DOCX, JPG, JPEG, PNG or WEBP.
                                Maximum 5MB.
                            </p>

                        </div>

                    </div>

                    @error('file')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- Footer --}}
            <div class="flex flex-col-reverse gap-3
                        border-t border-gray-200
                        bg-gray-50 px-6 py-5
                        sm:flex-row sm:justify-end sm:px-8">

                <a
                    href="{{ route('admin.notices.index') }}"
                    class="inline-flex items-center justify-center
                           rounded-xl border border-gray-300
                           bg-white px-6 py-3
                           text-sm font-semibold text-gray-700
                           transition hover:bg-gray-100"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2
                           rounded-xl bg-[#0F766E]
                           px-6 py-3 text-sm font-semibold
                           text-white shadow-sm
                           transition hover:bg-[#0d665f]
                           focus:outline-none
                           focus:ring-2 focus:ring-[#0F766E]
                           focus:ring-offset-2"
                >

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M5 13l4 4L19 7"/>

                    </svg>

                    Create Notice

                </button>

            </div>

        </form>

    </div>

</div>

@endsection