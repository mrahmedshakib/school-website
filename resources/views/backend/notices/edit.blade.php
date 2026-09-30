@extends('backend.layouts.app')
@section('title', 'Edit Notice')
@section('content')

<div class="max-w-5xl mx-auto py-6 sm:py-8">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-8">

        <div>
            <h1 class="text-2xl sm:text-3xl font-black text-[#123B5D]">
                Edit Notice
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Update notice information and attached file.
            </p>
        </div>

        <a
            href="{{ route('admin.notices.index') }}"
            class="inline-flex items-center justify-center gap-2
                   px-5 py-2.5 rounded-xl
                   bg-white border border-gray-200
                   text-gray-700 font-semibold
                   hover:bg-gray-50 transition"
        >
            ← Back to Notices
        </a>

    </div>


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}
    @if ($errors->any())
        <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">

            <div class="flex items-start gap-3">

                <div class="text-xl">
                    ⚠️
                </div>

                <div>
                    <h3 class="font-bold text-red-700">
                        Please fix the following errors:
                    </h3>

                    <ul class="mt-2 list-disc list-inside text-sm text-red-600 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>

        </div>
    @endif


    {{-- =========================================================
        FORM CARD
    ========================================================== --}}
    <div class="bg-white rounded-3xl border border-gray-100
                shadow-[0_15px_50px_rgba(15,118,110,0.08)]
                overflow-hidden">

        {{-- Card Header --}}
        <div class="px-6 sm:px-8 py-6 bg-[#F7F8F4] border-b border-gray-100">

            <div class="flex items-center gap-4">

                <div class="w-12 h-12 rounded-2xl
                            bg-[#0F766E] text-white
                            flex items-center justify-center
                            text-xl shadow-lg">
                    📢
                </div>

                <div>
                    <h2 class="text-lg font-bold text-[#123B5D]">
                        Notice Information
                    </h2>

                    <p class="text-sm text-gray-500">
                        Modify the notice details below.
                    </p>
                </div>

            </div>

        </div>


        {{-- Form --}}
        <form
            action="{{ route('admin.notices.update', ['id' => $notice->id]) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf
            @method('PUT')


            <div class="p-6 sm:p-8 space-y-7">

                {{-- Bilingual Titles --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title_bn" class="block text-sm font-bold text-gray-700 mb-2">
                            Notice Title (Bangla) <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            name="title_bn"
                            id="title_bn"
                            value="{{ old('title_bn', $notice->title_bn ?? $notice->title) }}"
                            required
                            placeholder="নোটিশের শিরোনাম লিখুন"
                            class="w-full rounded-xl border border-gray-200 px-4 py-3.5 text-sm text-gray-800 outline-none transition focus:border-[#0F766E] focus:ring-4 focus:ring-[#0F766E]/10"
                        >
                    </div>

                    <div>
                        <label for="title_en" class="block text-sm font-bold text-gray-700 mb-2">
                            Notice Title (English)
                        </label>
                        <input
                            type="text"
                            name="title_en"
                            id="title_en"
                            value="{{ old('title_en', $notice->title_en) }}"
                            placeholder="Enter notice title in English"
                            class="w-full rounded-xl border border-gray-200 px-4 py-3.5 text-sm text-gray-800 outline-none transition focus:border-[#0F766E] focus:ring-4 focus:ring-[#0F766E]/10"
                        >
                    </div>
                </div>

                {{-- Category --}}
                <div>
                    <label for="category" class="block text-sm font-bold text-gray-700 mb-2">
                        Notice Category
                    </label>
                    <select name="category" id="category" class="w-full rounded-xl border border-gray-200 px-4 py-3.5 text-sm text-gray-800 outline-none transition focus:border-[#0F766E] focus:ring-4 focus:ring-[#0F766E]/10">
                        <option value="Academic" {{ old('category', $notice->category ?? 'Academic') == 'Academic' ? 'selected' : '' }}>Academic</option>
                        <option value="Admission" {{ old('category', $notice->category) == 'Admission' ? 'selected' : '' }}>Admission</option>
                        <option value="Exam" {{ old('category', $notice->category) == 'Exam' ? 'selected' : '' }}>Exam</option>
                        <option value="General" {{ old('category', $notice->category) == 'General' ? 'selected' : '' }}>General</option>
                    </select>
                </div>

                {{-- Bilingual Descriptions --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="description_bn" class="block text-sm font-bold text-gray-700 mb-2">
                            Description (Bangla)
                        </label>
                        <textarea
                            name="description_bn"
                            id="description_bn"
                            rows="6"
                            placeholder="নোটিশের বিস্তারিত বিবরণ..."
                            class="w-full rounded-xl border border-gray-200 px-4 py-3.5 text-sm text-gray-800 outline-none resize-y transition focus:border-[#0F766E] focus:ring-4 focus:ring-[#0F766E]/10"
                        >{{ old('description_bn', $notice->description_bn ?? $notice->description) }}</textarea>
                    </div>

                    <div>
                        <label for="description_en" class="block text-sm font-bold text-gray-700 mb-2">
                            Description (English)
                        </label>
                        <textarea
                            name="description_en"
                            id="description_en"
                            rows="6"
                            placeholder="Notice details in English..."
                            class="w-full rounded-xl border border-gray-200 px-4 py-3.5 text-sm text-gray-800 outline-none resize-y transition focus:border-[#0F766E] focus:ring-4 focus:ring-[#0F766E]/10"
                        >{{ old('description_en', $notice->description_en) }}</textarea>
                    </div>
                </div>


                {{-- =================================================
                    CURRENT FILE
                ================================================== --}}
                @if ($notice->file)

                    <div>

                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Current Attachment
                        </label>

                        <div class="flex flex-col sm:flex-row sm:items-center
                                    justify-between gap-4
                                    rounded-2xl border border-gray-200
                                    bg-gray-50 p-4">

                            <div class="flex items-center gap-3">

                                <div class="w-11 h-11 rounded-xl
                                            bg-[#0F766E]/10
                                            text-[#0F766E]
                                            flex items-center justify-center
                                            text-lg">
                                    📎
                                </div>

                                <div>
                                    <p class="text-sm font-semibold text-gray-800">
                                        Current attachment
                                    </p>

                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ basename($notice->file) }}
                                    </p>
                                </div>

                            </div>

                            <a
                                href="{{ asset($notice->file) }}"
                                target="_blank"
                                class="inline-flex items-center justify-center
                                       px-4 py-2 rounded-xl
                                       bg-white border border-gray-200
                                       text-[#0F766E] text-sm font-bold
                                       hover:bg-[#0F766E] hover:text-white
                                       transition"
                            >
                                View File
                            </a>

                        </div>

                    </div>

                @endif


                {{-- =================================================
                    NEW FILE
                ================================================== --}}
                <div>

                    <label
                        for="file"
                        class="block text-sm font-bold text-gray-700 mb-2"
                    >
                        Replace Attachment
                    </label>

                    <input
                        type="file"
                        name="file"
                        id="file"
                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.webp"
                        class="block w-full rounded-xl border border-gray-200
                               bg-white text-sm text-gray-600
                               file:mr-4 file:py-3 file:px-5
                               file:rounded-xl file:border-0
                               file:bg-[#0F766E]
                               file:text-white
                               file:font-semibold
                               hover:file:bg-[#0b625d]
                               cursor-pointer"
                    >

                    <p class="mt-2 text-xs text-gray-400">
                        Leave empty to keep the current file.
                        Maximum size: 5MB.
                    </p>

                </div>

            </div>


            {{-- =================================================
                FOOTER ACTIONS
            ================================================== --}}
            <div class="px-6 sm:px-8 py-5
                        bg-gray-50 border-t border-gray-100
                        flex flex-col-reverse sm:flex-row
                        sm:items-center sm:justify-end gap-3">

                <a
                    href="{{ route('admin.notices.index') }}"
                    class="w-full sm:w-auto
                           inline-flex items-center justify-center
                           px-6 py-3 rounded-xl
                           bg-white border border-gray-200
                           text-gray-700 font-semibold
                           hover:bg-gray-100 transition"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="w-full sm:w-auto
                           inline-flex items-center justify-center
                           px-7 py-3 rounded-xl
                           bg-[#0F766E] text-white
                           font-bold
                           shadow-lg shadow-[#0F766E]/20
                           hover:bg-[#0b625d]
                           hover:-translate-y-0.5
                           transition"
                >
                    Update Notice
                </button>

            </div>

        </form>

    </div>

</div>

@endsection