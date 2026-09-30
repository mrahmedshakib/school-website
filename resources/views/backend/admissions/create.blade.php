@extends('backend.layouts.app')

@section('title', 'Add Admission')

@section('content')

<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

        <div>

            <h1 class="text-2xl font-bold text-gray-900">
                Add Admission
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Create a new admission notice and configure online application information.
            </p>

        </div>


        <a
            href="{{ route('admin.admissions.index') }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2.5
                   rounded-lg border border-gray-300
                   text-sm font-semibold text-gray-700
                   hover:bg-gray-50 transition"
        >
            ← Back
        </a>

    </div>


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}
    @if($errors->any())

        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-5">

            <div class="flex items-start gap-3">

                <div class="text-xl">
                    ⚠️
                </div>

                <div>

                    <h3 class="text-sm font-semibold text-red-800">
                        Please fix the following errors:
                    </h3>

                    <ul class="mt-2 list-disc list-inside space-y-1 text-sm text-red-700">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
        MAIN FORM
    ========================================================== --}}
    <form
        action="{{ route('admin.admissions.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm"
    >

        @csrf


        {{-- =====================================================
            BASIC INFORMATION
        ====================================================== --}}
        <div class="p-6">

            {{-- Section Header --}}
            <div class="flex items-center gap-3 mb-6">

                <div
                    class="w-10 h-10 rounded-lg
                           bg-indigo-50 text-indigo-600
                           flex items-center justify-center text-lg"
                >
                    📋
                </div>

                <div>

                    <h2 class="text-base font-semibold text-gray-900">
                        Basic Information
                    </h2>

                    <p class="text-xs text-gray-500 mt-1">
                        Provide the main information about this admission notice.
                    </p>

                </div>

            </div>


            {{-- Fields --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                {{-- Title --}}
                <div class="md:col-span-2">

                    <label
                        for="title"
                        class="block text-sm font-semibold text-gray-700 mb-2"
                    >
                        Admission Title
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        required
                        maxlength="255"
                        placeholder="২০২৬ শিক্ষাবর্ষে ভর্তি বিজ্ঞপ্তি"
                        class="w-full rounded-xl border border-gray-300
                               px-4 py-3 text-sm
                               focus:border-indigo-500
                               focus:ring-indigo-500"
                    >

                    @error('title')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Description --}}
                <div class="md:col-span-2">

                    <label
                        for="description"
                        class="block text-sm font-semibold text-gray-700 mb-2"
                    >
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="ভর্তি সংক্রান্ত বিস্তারিত তথ্য লিখুন..."
                        class="w-full rounded-xl border border-gray-300
                               px-4 py-3 text-sm
                               focus:border-indigo-500
                               focus:ring-indigo-500"
                    >{{ old('description') }}</textarea>

                    @error('description')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>

        </div>


        {{-- =====================================================
            APPLICATION INFORMATION
        ====================================================== --}}
        <div class="border-t border-gray-100 p-6">

            {{-- Section Header --}}
            <div class="flex items-center gap-3 mb-6">

                <div
                    class="w-10 h-10 rounded-lg
                           bg-blue-50 text-blue-600
                           flex items-center justify-center text-lg"
                >
                    📅
                </div>

                <div>

                    <h2 class="text-base font-semibold text-gray-900">
                        Application Information
                    </h2>

                    <p class="text-xs text-gray-500 mt-1">
                        Configure the admission application period and optional external application link.
                    </p>

                </div>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                {{-- Application Start --}}
                <div>

                    <label
                        for="application_start"
                        class="block text-sm font-semibold text-gray-700 mb-2"
                    >
                        Application Start
                    </label>

                    <input
                        type="date"
                        id="application_start"
                        name="application_start"
                        value="{{ old('application_start') }}"
                        class="w-full rounded-xl border border-gray-300
                               px-4 py-3 text-sm
                               focus:border-indigo-500
                               focus:ring-indigo-500"
                    >

                    @error('application_start')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Application End --}}
                <div>

                    <label
                        for="application_end"
                        class="block text-sm font-semibold text-gray-700 mb-2"
                    >
                        Application End
                    </label>

                    <input
                        type="date"
                        id="application_end"
                        name="application_end"
                        value="{{ old('application_end') }}"
                        class="w-full rounded-xl border border-gray-300
                               px-4 py-3 text-sm
                               focus:border-indigo-500
                               focus:ring-indigo-500"
                    >

                    @error('application_end')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- External Application URL --}}
                <div class="md:col-span-2">

                    <label
                        for="application_url"
                        class="block text-sm font-semibold text-gray-700 mb-2"
                    >
                        External Application URL
                        <span class="text-xs font-normal text-gray-400">
                            (Optional)
                        </span>
                    </label>

                    <input
                        type="url"
                        id="application_url"
                        name="application_url"
                        value="{{ old('application_url') }}"
                        maxlength="500"
                        placeholder="https://example.com/application"
                        class="w-full rounded-xl border border-gray-300
                               px-4 py-3 text-sm
                               focus:border-indigo-500
                               focus:ring-indigo-500"
                    >

                    <p class="mt-2 text-xs text-gray-500 leading-5">
                        Use this only if applicants need to apply through
                        another external website. Your own online application
                        form is available through the
                        <strong>“আবেদন করুন”</strong> button.
                    </p>

                    @error('application_url')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>

        </div>


        {{-- =====================================================
            ADMISSION IMAGE
        ====================================================== --}}
        <div class="border-t border-gray-100 p-6">

            <div class="flex items-center gap-3 mb-6">

                <div
                    class="w-10 h-10 rounded-lg
                           bg-purple-50 text-purple-600
                           flex items-center justify-center text-lg"
                >
                    🖼️
                </div>

                <div>

                    <h2 class="text-base font-semibold text-gray-900">
                        Admission Image
                    </h2>

                    <p class="text-xs text-gray-500 mt-1">
                        Upload an image for the admission notice.
                    </p>

                </div>

            </div>


            <label
                for="image"
                class="block text-sm font-semibold text-gray-700 mb-2"
            >
                Admission Image
            </label>

            <input
                type="file"
                id="image"
                name="image"
                accept=".jpg,.jpeg,.png,.webp"
                class="block w-full rounded-xl border border-gray-300
                       px-3 py-3 text-sm text-gray-600
                       file:mr-4 file:rounded-lg
                       file:border-0 file:bg-indigo-50
                       file:px-4 file:py-2
                       file:text-sm file:font-semibold
                       file:text-indigo-700"
            >

            <p class="mt-2 text-xs text-gray-500">
                JPG, JPEG, PNG or WEBP. Maximum size 2MB.
            </p>

            @error('image')

                <p class="mt-1 text-xs text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- =====================================================
            ADMISSION PDF
        ====================================================== --}}
        <div class="border-t border-gray-100 p-6">

            <div class="flex items-center gap-3 mb-6">

                <div
                    class="w-10 h-10 rounded-lg
                           bg-red-50 text-red-600
                           flex items-center justify-center text-lg"
                >
                    📄
                </div>

                <div>

                    <h2 class="text-base font-semibold text-gray-900">
                        Admission PDF
                    </h2>

                    <p class="text-xs text-gray-500 mt-1">
                        Upload the official admission notice PDF.
                    </p>

                </div>

            </div>


            <label
                for="pdf"
                class="block text-sm font-semibold text-gray-700 mb-2"
            >
                Admission Notice PDF
            </label>

            <input
                type="file"
                id="pdf"
                name="pdf"
                accept=".pdf"
                class="block w-full rounded-xl border border-gray-300
                       px-3 py-3 text-sm text-gray-600
                       file:mr-4 file:rounded-lg
                       file:border-0 file:bg-red-50
                       file:px-4 file:py-2
                       file:text-sm file:font-semibold
                       file:text-red-700"
            >

            <p class="mt-2 text-xs text-gray-500">
                PDF only. Maximum size 5MB.
            </p>

            @error('pdf')

                <p class="mt-1 text-xs text-red-600">
                    {{ $message }}
                </p>

            @enderror

        </div>


        {{-- =====================================================
            ONLINE APPLICATION PROCESS
        ====================================================== --}}
        <div class="border-t border-gray-100 bg-white">

            {{-- Header --}}
            <div class="px-6 py-6 border-b border-gray-100">

                <div class="flex items-start gap-4">

                    <div
                        class="flex-shrink-0 w-11 h-11 rounded-xl
                               bg-indigo-50 text-indigo-600
                               flex items-center justify-center text-xl"
                    >
                        📝
                    </div>

                    <div>

                        <h2 class="text-base font-semibold text-gray-900">
                            Online Application Process
                        </h2>

                        <p class="text-sm text-gray-500 mt-1 leading-6">
                            Applicants can follow these steps to complete
                            the online admission application.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Process Steps --}}
            <div class="px-6 py-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                    {{-- STEP 01 --}}
                    <div
                        class="group flex gap-4 rounded-xl
                               border border-gray-200
                               bg-gray-50 p-5
                               hover:border-indigo-200
                               hover:bg-indigo-50/40
                               transition"
                    >

                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full
                                   bg-indigo-600 text-white
                                   flex items-center justify-center
                                   text-sm font-bold"
                        >
                            01
                        </div>

                        <div>

                            <h3 class="text-sm font-semibold text-gray-900">
                                Visit Admission Page
                            </h3>

                            <p class="text-xs text-gray-500 mt-2 leading-6">
                                Visit the school's Admission page and select
                                the
                                <strong class="text-gray-700">
                                    “আবেদন করুন”
                                </strong>
                                button to start the application.
                            </p>

                        </div>

                    </div>


                    {{-- STEP 02 --}}
                    <div
                        class="group flex gap-4 rounded-xl
                               border border-gray-200
                               bg-gray-50 p-5
                               hover:border-indigo-200
                               hover:bg-indigo-50/40
                               transition"
                    >

                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full
                                   bg-indigo-600 text-white
                                   flex items-center justify-center
                                   text-sm font-bold"
                        >
                            02
                        </div>

                        <div>

                            <h3 class="text-sm font-semibold text-gray-900">
                                Fill in Student Information
                            </h3>

                            <p class="text-xs text-gray-500 mt-2 leading-6">
                                Enter the student's name, date of birth,
                                gender, class and previous school information
                                correctly.
                            </p>

                        </div>

                    </div>


                    {{-- STEP 03 --}}
                    <div
                        class="group flex gap-4 rounded-xl
                               border border-gray-200
                               bg-gray-50 p-5
                               hover:border-indigo-200
                               hover:bg-indigo-50/40
                               transition"
                    >

                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full
                                   bg-indigo-600 text-white
                                   flex items-center justify-center
                                   text-sm font-bold"
                        >
                            03
                        </div>

                        <div>

                            <h3 class="text-sm font-semibold text-gray-900">
                                Provide Guardian Information
                            </h3>

                            <p class="text-xs text-gray-500 mt-2 leading-6">
                                Provide father, mother, guardian phone number,
                                email address and complete residential address.
                            </p>

                        </div>

                    </div>


                    {{-- STEP 04 --}}
                    <div
                        class="group flex gap-4 rounded-xl
                               border border-gray-200
                               bg-gray-50 p-5
                               hover:border-indigo-200
                               hover:bg-indigo-50/40
                               transition"
                    >

                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full
                                   bg-indigo-600 text-white
                                   flex items-center justify-center
                                   text-sm font-bold"
                        >
                            04
                        </div>

                        <div>

                            <h3 class="text-sm font-semibold text-gray-900">
                                Upload Required Documents
                            </h3>

                            <p class="text-xs text-gray-500 mt-2 leading-6">
                                Upload the student's recent photograph and
                                required birth certificate or supporting
                                documents.
                            </p>

                        </div>

                    </div>


                    {{-- STEP 05 --}}
                    <div
                        class="group flex gap-4 rounded-xl
                               border border-gray-200
                               bg-gray-50 p-5
                               hover:border-indigo-200
                               hover:bg-indigo-50/40
                               transition"
                    >

                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full
                                   bg-indigo-600 text-white
                                   flex items-center justify-center
                                   text-sm font-bold"
                        >
                            05
                        </div>

                        <div>

                            <h3 class="text-sm font-semibold text-gray-900">
                                Review & Submit Application
                            </h3>

                            <p class="text-xs text-gray-500 mt-2 leading-6">
                                Review all information carefully and click
                                <strong class="text-gray-700">
                                    “আবেদন জমা দিন”
                                </strong>
                                to submit the application.
                            </p>

                        </div>

                    </div>


                    {{-- STEP 06 --}}
                    <div
                        class="group flex gap-4 rounded-xl
                               border border-green-200
                               bg-green-50 p-5
                               hover:border-green-300
                               transition"
                    >

                        <div
                            class="flex-shrink-0 w-10 h-10 rounded-full
                                   bg-green-600 text-white
                                   flex items-center justify-center
                                   text-sm font-bold"
                        >
                            06
                        </div>

                        <div>

                            <h3 class="text-sm font-semibold text-gray-900">
                                Receive Application Number
                            </h3>

                            <p class="text-xs text-gray-600 mt-2 leading-6">
                                After successful submission, the applicant
                                receives a unique
                                <strong class="text-gray-800">
                                    Application No.
                                </strong>
                                for future reference.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Important --}}
                <div
                    class="mt-6 rounded-xl
                           border border-amber-200
                           bg-amber-50
                           px-5 py-4"
                >

                    <div class="flex items-start gap-3">

                        <div
                            class="flex-shrink-0 w-9 h-9 rounded-lg
                                   bg-amber-100
                                   flex items-center justify-center"
                        >
                            💡
                        </div>

                        <div>

                            <h3 class="text-sm font-semibold text-amber-900">
                                Important Information
                            </h3>

                            <p class="text-xs text-amber-800 mt-1 leading-6">
                                Applicants should carefully review all
                                information before submitting the application.
                                After successful submission, the
                                <strong>Application No.</strong>
                                should be kept safely for future reference,
                                application status checking and further
                                admission procedures.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- Frontend Actions --}}
                <div class="mt-7">

                    <div class="mb-4">

                        <h3 class="text-sm font-semibold text-gray-900">
                            Available Frontend Actions
                        </h3>

                        <p class="text-xs text-gray-500 mt-1">
                            These actions are available to applicants from
                            the frontend Admission page.
                        </p>

                    </div>


                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">


                        {{-- Apply --}}
                        <div
                            class="rounded-xl border border-indigo-200
                                   bg-indigo-50 p-4"
                        >

                            <div class="text-xl">
                                📝
                            </div>

                            <h4 class="text-sm font-semibold text-indigo-900 mt-3">
                                আবেদন করুন
                            </h4>

                            <p class="text-xs text-indigo-700 mt-1 leading-5">
                                Opens the school's online admission
                                application form.
                            </p>

                        </div>


                        {{-- Contact --}}
                        <div
                            class="rounded-xl border border-blue-200
                                   bg-blue-50 p-4"
                        >

                            <div class="text-xl">
                                📞
                            </div>

                            <h4 class="text-sm font-semibold text-blue-900 mt-3">
                                যোগাযোগ করুন
                            </h4>

                            <p class="text-xs text-blue-700 mt-1 leading-5">
                                Takes applicants to the school's contact page.
                            </p>

                        </div>


                        {{-- PDF --}}
                        <div
                            class="rounded-xl border border-red-200
                                   bg-red-50 p-4"
                        >

                            <div class="text-xl">
                                📄
                            </div>

                            <h4 class="text-sm font-semibold text-red-900 mt-3">
                                PDF দেখুন
                            </h4>

                            <p class="text-xs text-red-700 mt-1 leading-5">
                                Opens the admission notice PDF in a new tab.
                            </p>

                        </div>


                        {{-- Download --}}
                        <div
                            class="rounded-xl border border-slate-200
                                   bg-slate-50 p-4"
                        >

                            <div class="text-xl">
                                ⬇
                            </div>

                            <h4 class="text-sm font-semibold text-slate-900 mt-3">
                                Download
                            </h4>

                            <p class="text-xs text-slate-600 mt-1 leading-5">
                                Allows applicants to download the admission PDF.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            DISPLAY SETTINGS
        ====================================================== --}}
        <div class="border-t border-gray-100 p-6">

            <div class="flex items-center gap-3 mb-6">

                <div
                    class="w-10 h-10 rounded-lg
                           bg-slate-100 text-slate-700
                           flex items-center justify-center text-lg"
                >
                    ⚙️
                </div>

                <div>

                    <h2 class="text-base font-semibold text-gray-900">
                        Display Settings
                    </h2>

                    <p class="text-xs text-gray-500 mt-1">
                        Configure the display order and active status.
                    </p>

                </div>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                {{-- Sort Order --}}
                <div>

                    <label
                        for="sort_order"
                        class="block text-sm font-semibold text-gray-700 mb-2"
                    >
                        Sort Order
                    </label>

                    <input
                        type="number"
                        id="sort_order"
                        name="sort_order"
                        value="{{ old('sort_order', 0) }}"
                        min="0"
                        class="w-full rounded-xl border border-gray-300
                               px-4 py-3 text-sm
                               focus:border-indigo-500
                               focus:ring-indigo-500"
                    >

                    <p class="mt-2 text-xs text-gray-500">
                        Lower numbers appear first.
                    </p>

                    @error('sort_order')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Status --}}
                <div>

                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Status
                    </label>

                    <label
                        class="flex items-center gap-3
                               rounded-xl border border-gray-200
                               px-4 py-3 cursor-pointer
                               hover:bg-gray-50"
                    >

                        <input
                            type="checkbox"
                            name="status"
                            value="1"
                            {{ old('status', 1) ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-gray-300
                                   text-indigo-600
                                   focus:ring-indigo-500"
                        >

                        <span>

                            <span class="block text-sm font-semibold text-gray-900">
                                Active
                            </span>

                            <span class="block text-xs text-gray-500 mt-0.5">
                                Show this admission notice on the frontend.
                            </span>

                        </span>

                    </label>

                </div>

            </div>

        </div>


        {{-- =====================================================
            FORM ACTIONS
        ====================================================== --}}
        <div class="border-t border-gray-100 bg-gray-50 px-6 py-5">

            <div class="flex flex-col sm:flex-row sm:justify-end gap-3">

                <a
                    href="{{ route('admin.admissions.index') }}"
                    class="inline-flex items-center justify-center
                           px-6 py-3 rounded-xl
                           border border-gray-300
                           bg-white text-gray-700
                           text-sm font-semibold
                           hover:bg-gray-50 transition"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    class="inline-flex items-center justify-center
                           gap-2 px-7 py-3 rounded-xl
                           bg-indigo-600 text-white
                           text-sm font-semibold
                           hover:bg-indigo-700
                           transition"
                >
                    <span>💾</span>
                    Save Admission
                </button>

            </div>

        </div>

    </form>

</div>

@endsection