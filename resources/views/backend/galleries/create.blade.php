@extends('backend.layouts.app')

@section('title', 'Add Gallery')

@section('content')

<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">
                Add Gallery
            </h1>
            <p class="mt-1 text-sm text-slate-500">
                Add a new image to the school gallery.
            </p>
        </div>

        <a
            href="{{ route('admin.galleries.index') }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 border border-slate-300 text-slate-700 rounded-lg text-sm font-semibold hover:bg-slate-50 transition"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10 19l-7-7m0 0l7-7m-7 7h18"
                />
            </svg>
            Back to Gallery
        </a>
    </div>

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl border border-red-200 bg-red-50">
            <div class="flex items-center gap-2 text-red-700 font-semibold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 8v4m0 4h.01M10.29 3.86l-7.82 13.5A2 2 0 004.2 20h15.6a2 2 0 001.73-2.64l-7.82-13.5a2 2 0 00-3.42 0z"
                    />
                </svg>
                Please fix the following errors:
            </div>

            <ul class="mt-2 ml-7 list-disc text-sm text-red-600">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-200">
            <h2 class="text-lg font-bold text-slate-900">
                Gallery Information
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Upload an image and provide optional information.
            </p>
        </div>

        <form
            action="{{ route('admin.galleries.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <div class="p-6 space-y-6">

                {{-- Title --}}
                <div>
                    <label
                        for="title"
                        class="block text-sm font-semibold text-slate-700 mb-2"
                    >
                        Title
                    </label>

                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title') }}"
                        placeholder="Example: Annual Sports Day 2026"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    >

                    @error('title')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label
                        for="description"
                        class="block text-sm font-semibold text-slate-700 mb-2"
                    >
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="Write a short description..."
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Image --}}
                <div>
                    <label
                        for="image"
                        class="block text-sm font-semibold text-slate-700 mb-2"
                    >
                        Gallery Image
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept=".jpg,.jpeg,.png,.webp"
                        required
                        class="block w-full text-sm text-slate-600 border border-slate-300 rounded-lg cursor-pointer bg-white focus:outline-none"
                    >

                    <p class="mt-2 text-xs text-slate-500">
                        JPG, JPEG, PNG or WEBP. Maximum size: 2MB.
                    </p>

                    @error('image')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                    {{-- Image Preview --}}
                    <div id="image-preview-wrapper" class="hidden mt-4">
                        <p class="text-sm font-medium text-slate-600 mb-2">
                            Preview
                        </p>

                        <img
                            id="image-preview"
                            src=""
                            alt="Preview"
                            class="w-48 h-32 object-cover rounded-xl border border-slate-200"
                        >
                    </div>
                </div>

                {{-- Sort Order --}}
                <div>
                    <label
                        for="sort_order"
                        class="block text-sm font-semibold text-slate-700 mb-2"
                    >
                        Sort Order
                    </label>

                    <input
                        type="number"
                        id="sort_order"
                        name="sort_order"
                        value="{{ old('sort_order', 0) }}"
                        min="0"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    >

                    <p class="mt-2 text-xs text-slate-500">
                        Lower numbers will appear first.
                    </p>

                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="flex items-center justify-between p-4 rounded-xl bg-slate-50 border border-slate-200">

                    <div>
                        <p class="text-sm font-semibold text-slate-800">
                            Publish Status
                        </p>

                        <p class="text-xs text-slate-500 mt-1">
                            Active gallery images will be visible on the website.
                        </p>
                    </div>

                    <label class="relative inline-flex items-center cursor-pointer">

                        <input
                            type="checkbox"
                            name="status"
                            value="1"
                            class="sr-only peer"
                            {{ old('status', 1) ? 'checked' : '' }}
                        >

                        <div class="w-11 h-6 bg-slate-300 rounded-full peer peer-checked:bg-indigo-600 transition"></div>

                        <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition peer-checked:translate-x-5"></div>

                    </label>

                </div>

            </div>

            {{-- Footer --}}
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex flex-col sm:flex-row sm:justify-end gap-3">

                <a
                    href="{{ route('admin.galleries.index') }}"
                    class="inline-flex items-center justify-center px-5 py-2.5 border border-slate-300 text-slate-700 rounded-lg text-sm font-semibold hover:bg-white transition"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700 transition"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                    Save Gallery
                </button>

            </div>

        </form>

    </div>

</div>

@endsection

@push('scripts')
<script>
    document.getElementById('image')?.addEventListener('change', function (event) {
        const file = event.target.files[0];
        const previewWrapper = document.getElementById('image-preview-wrapper');
        const preview = document.getElementById('image-preview');

        if (!file) {
            previewWrapper.classList.add('hidden');
            preview.src = '';
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            previewWrapper.classList.remove('hidden');
        };

        reader.readAsDataURL(file);
    });
</script>
@endpush