@extends('backend.layouts.app')

@section('title', 'Add About')

@section('content')

<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">


{{-- Header --}}
<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between mb-8">

    <div>
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
            Add About
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Create a new About section for your website.
        </p>
    </div>

    <a
        href="{{ route('admin.abouts.index') }}"
        class="inline-flex items-center justify-center gap-2 rounded-xl
               bg-gray-100 px-5 py-3 text-sm font-semibold text-gray-700
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

        Back to Abouts
    </a>

</div>


{{-- Validation Errors --}}
@if ($errors->any())
    <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">

        <h3 class="font-semibold text-red-800">
            Please fix the following errors:
        </h3>

        <ul class="mt-2 list-disc pl-5 space-y-1 text-sm text-red-700">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>
@endif


{{-- Form Card --}}
<div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

    {{-- Card Header --}}
    <div class="border-b border-gray-200 px-6 py-5 sm:px-8">

        <h2 class="text-lg font-bold text-gray-900">
            About Information
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Add the content that will appear in the About section.
        </p>

    </div>


    <form
        action="{{ route('admin.abouts.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        <div class="space-y-7 px-6 py-7 sm:px-8">

            {{-- Title --}}
            <div>
                <label
                    for="title"
                    class="mb-2 block text-sm font-semibold text-gray-700"
                >
                    Title
                </label>

                <input
                    type="text"
                    name="title"
                    id="title"
                    value="{{ old('title') }}"
                    placeholder="Enter about title"
                    class="w-full rounded-xl border border-gray-300 bg-white
                           px-4 py-3 text-sm text-gray-900 outline-none
                           placeholder:text-gray-400
                           focus:border-gray-900
                           focus:ring-2 focus:ring-gray-900/10"
                >

                @error('title')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>


            {{-- Description --}}
            <div>
                <label
                    for="description"
                    class="mb-2 block text-sm font-semibold text-gray-700"
                >
                    Description
                </label>

                <textarea
                    name="description"
                    id="description"
                    rows="8"
                    placeholder="Enter about description"
                    class="w-full rounded-xl border border-gray-300 bg-white
                           px-4 py-3 text-sm text-gray-900 outline-none
                           placeholder:text-gray-400
                           focus:border-gray-900
                           focus:ring-2 focus:ring-gray-900/10"
                >{{ old('description') }}</textarea>

                @error('description')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>


            {{-- Image --}}
            <div>
                <label
                    for="image"
                    class="mb-2 block text-sm font-semibold text-gray-700"
                >
                    Image
                </label>

                <div class="rounded-xl border-2 border-dashed border-gray-300
                            bg-gray-50 p-6">

                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept="image/jpeg,image/png,image/jpg,image/webp"
                        class="block w-full text-sm text-gray-600
                               file:mr-4 file:rounded-lg
                               file:border-0 file:bg-gray-900
                               file:px-4 file:py-2
                               file:text-sm file:font-semibold
                               file:text-white
                               hover:file:bg-gray-800"
                    >

                    <p class="mt-3 text-xs text-gray-500">
                        JPG, JPEG, PNG or WEBP
                    </p>

                </div>

                @error('image')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>


            {{-- Button Fields --}}
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                {{-- Button Text --}}
                <div>
                    <label
                        for="button_text"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Button Text
                    </label>

                    <input
                        type="text"
                        name="button_text"
                        id="button_text"
                        value="{{ old('button_text') }}"
                        placeholder="e.g. Learn More"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               placeholder:text-gray-400
                               focus:border-gray-900
                               focus:ring-2 focus:ring-gray-900/10"
                    >

                    @error('button_text')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>


                {{-- Button URL --}}
                <div>
                    <label
                        for="button_url"
                        class="mb-2 block text-sm font-semibold text-gray-700"
                    >
                        Button URL
                    </label>

                    <input
                        type="text"
                        name="button_url"
                        id="button_url"
                        value="{{ old('button_url') }}"
                        placeholder="e.g. /contact or https://example.com"
                        class="w-full rounded-xl border border-gray-300 bg-white
                               px-4 py-3 text-sm text-gray-900 outline-none
                               placeholder:text-gray-400
                               focus:border-gray-900
                               focus:ring-2 focus:ring-gray-900/10"
                    >

                    @error('button_url')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

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
                    class="w-full rounded-xl border border-gray-300 bg-white
                           px-4 py-3 text-sm text-gray-900 outline-none
                           focus:border-gray-900
                           focus:ring-2 focus:ring-gray-900/10"
                >
                    <option value="1"
                        {{ old('status', 1) == 1 ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="0"
                        {{ old('status') === '0' ? 'selected' : '' }}>
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


        {{-- Form Footer --}}
        <div class="flex flex-col-reverse gap-3 border-t border-gray-200
                    bg-gray-50 px-6 py-5
                    sm:flex-row sm:justify-end sm:px-8">

            <a
                href="{{ route('admin.abouts.index') }}"
                class="inline-flex items-center justify-center rounded-xl
                       border border-gray-300 bg-white px-6 py-3
                       text-sm font-semibold text-gray-700
                       transition hover:bg-gray-100"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 rounded-xl
                       bg-emerald-600 px-6 py-3 text-sm font-semibold text-white
                       shadow-sm transition hover:bg-emerald-700
                       focus:outline-none focus:ring-2
                       focus:ring-emerald-600 focus:ring-offset-2"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-5 w-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 4v16m8-8H4"/>
                </svg>

                Create About
            </button>

        </div>

    </form>

</div>


</div>

@endsection
