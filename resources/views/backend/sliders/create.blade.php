@extends('backend.layouts.app')

@section('title', 'Add Slider')

@section('content')

<div class="max-w-4xl mx-auto py-8 px-4">

    {{-- Header --}}
    <div class="mb-8">

        <h1 class="text-2xl font-bold text-gray-900">
            Add Slider
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Create a new homepage slider.
        </p>

    </div>


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="mb-6 rounded-lg
                    bg-red-50
                    border border-red-200
                    text-red-700
                    px-4 py-3">

            <ul class="list-disc ml-5 text-sm">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('admin.sliders.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white rounded-xl
               border border-gray-200
               shadow-sm p-6"
    >

        @csrf


        {{-- Subtitle --}}
        <div class="mb-5">

            <label class="block text-sm
                          font-semibold
                          text-gray-700
                          mb-2">

                Subtitle

            </label>

            <input
                type="text"
                name="subtitle"
                value="{{ old('subtitle') }}"
                placeholder="Example: স্বাগতম"
                class="w-full rounded-lg
                       border border-gray-300
                       px-4 py-3
                       focus:ring-2
                       focus:ring-indigo-500
                       focus:border-indigo-500
                       outline-none"
            >

        </div>


        {{-- Title --}}
        <div class="mb-5">

            <label class="block text-sm
                          font-semibold
                          text-gray-700
                          mb-2">

                Title

            </label>

            <input
                type="text"
                name="title"
                value="{{ old('title') }}"
                placeholder="Example: আমাদের বিদ্যালয়ে আপনাকে স্বাগতম"
                class="w-full rounded-lg
                       border border-gray-300
                       px-4 py-3
                       focus:ring-2
                       focus:ring-indigo-500
                       focus:border-indigo-500
                       outline-none"
            >

        </div>


        {{-- Description --}}
        <div class="mb-5">

            <label class="block text-sm
                          font-semibold
                          text-gray-700
                          mb-2">

                Description

            </label>

            <textarea
                name="description"
                rows="4"
                placeholder="Slider description..."
                class="w-full rounded-lg
                       border border-gray-300
                       px-4 py-3
                       focus:ring-2
                       focus:ring-indigo-500
                       focus:border-indigo-500
                       outline-none"
            >{{ old('description') }}</textarea>

        </div>


        {{-- Image --}}
        <div class="mb-5">

            <label class="block text-sm
                          font-semibold
                          text-gray-700
                          mb-2">

                Slider Image
                <span class="text-red-500">*</span>

            </label>

            <input
                type="file"
                name="image"
                accept="image/jpeg,image/png,image/webp"
                required
                class="w-full rounded-lg
                       border border-gray-300
                       px-4 py-3
                       bg-white"
            >

            <p class="text-xs text-gray-500 mt-2">
                JPG, JPEG, PNG or WEBP. Maximum 5MB.
            </p>

        </div>


        {{-- Button Text --}}
        <div class="mb-5">

            <label class="block text-sm
                          font-semibold
                          text-gray-700
                          mb-2">

                Button Text

            </label>

            <input
                type="text"
                name="button_text"
                value="{{ old('button_text') }}"
                placeholder="Example: বিস্তারিত দেখুন"
                class="w-full rounded-lg
                       border border-gray-300
                       px-4 py-3
                       focus:ring-2
                       focus:ring-indigo-500
                       focus:border-indigo-500
                       outline-none"
            >

        </div>


        {{-- Button URL --}}
        <div class="mb-5">

            <label class="block text-sm
                          font-semibold
                          text-gray-700
                          mb-2">

                Button URL

            </label>

            <input
                type="text"
                name="button_url"
                value="{{ old('button_url') }}"
                placeholder="Example: /about"
                class="w-full rounded-lg
                       border border-gray-300
                       px-4 py-3
                       focus:ring-2
                       focus:ring-indigo-500
                       focus:border-indigo-500
                       outline-none"
            >

        </div>


        {{-- Sort Order --}}
        <div class="mb-5">

            <label class="block text-sm
                          font-semibold
                          text-gray-700
                          mb-2">

                Sort Order

            </label>

            <input
                type="number"
                name="sort_order"
                value="{{ old('sort_order', 0) }}"
                min="0"
                class="w-full rounded-lg
                       border border-gray-300
                       px-4 py-3
                       focus:ring-2
                       focus:ring-indigo-500
                       focus:border-indigo-500
                       outline-none"
            >

            <p class="text-xs text-gray-500 mt-2">
                Smaller number will appear first.
            </p>

        </div>


        {{-- Status --}}
        <div class="mb-7">

            <label class="inline-flex items-center gap-3">

                <input
                    type="checkbox"
                    name="status"
                    value="1"
                    checked
                    class="w-5 h-5
                           rounded
                           border-gray-300
                           text-indigo-600
                           focus:ring-indigo-500"
                >

                <span class="text-sm
                             font-semibold
                             text-gray-700">

                    Active Slider

                </span>

            </label>

        </div>


        {{-- Buttons --}}
        <div class="flex
                    flex-col
                    sm:flex-row
                    gap-3">

            <button
                type="submit"
                class="px-6 py-3
                       rounded-lg
                       bg-indigo-600
                       text-white
                       font-semibold
                       hover:bg-indigo-700
                       transition"
            >

                Save Slider

            </button>


            <a
                href="{{ route('admin.sliders.index') }}"
                class="px-6 py-3
                       rounded-lg
                       bg-gray-100
                       text-gray-700
                       font-semibold
                       hover:bg-gray-200
                       transition
                       text-center"
            >

                Cancel

            </a>

        </div>

    </form>

</div>

@endsection