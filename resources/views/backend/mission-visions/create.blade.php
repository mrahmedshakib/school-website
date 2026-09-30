@extends('backend.layouts.app')
@section('title', 'Add Mission & Vision')
@section('content')

<div class="max-w-5xl mx-auto py-8">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">
            Add Mission & Vision
        </h1>

        <p class="mt-2 text-gray-500">
            Manage your school's mission and vision.
        </p>
    </div>


    @if ($errors->any())
        <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
            <ul class="list-disc list-inside text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form
        action="{{ route('admin.mission-visions.store') }}"
        method="POST"
        class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8"
    >

        @csrf


        {{-- Mission --}}
        <div class="mb-8">

            <h2 class="text-xl font-bold text-gray-900 mb-5">
                Mission
            </h2>

            <div class="mb-5">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Mission Title
                </label>

                <input
                    type="text"
                    name="mission_title"
                    value="{{ old('mission_title', 'আমাদের মিশন') }}"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    required
                >

            </div>


            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Mission Description
                </label>

                <textarea
                    name="mission_description"
                    rows="6"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    required
                >{{ old('mission_description') }}</textarea>

            </div>

        </div>


        {{-- Vision --}}
        <div class="mb-8">

            <h2 class="text-xl font-bold text-gray-900 mb-5">
                Vision
            </h2>

            <div class="mb-5">

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Vision Title
                </label>

                <input
                    type="text"
                    name="vision_title"
                    value="{{ old('vision_title', 'আমাদের ভিশন') }}"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    required
                >

            </div>


            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Vision Description
                </label>

                <textarea
                    name="vision_description"
                    rows="6"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    required
                >{{ old('vision_description') }}</textarea>

            </div>

        </div>


        {{-- Status --}}
        <div class="mb-8">

            <label class="block text-sm font-semibold text-gray-700 mb-2">
                Status
            </label>

            <select
                name="status"
                class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
            >
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>

        </div>


        <div class="flex justify-end gap-3">

            <a
                href="{{ route('admin.mission-visions.index') }}"
                class="px-6 py-3 rounded-lg bg-gray-100 text-gray-700 font-semibold hover:bg-gray-200"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="px-6 py-3 rounded-lg bg-gray-900 text-white font-semibold hover:bg-blue-700"
            >
                Save Mission & Vision
            </button>

        </div>

    </form>

</div>

@endsection