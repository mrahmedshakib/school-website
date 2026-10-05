@extends('backend.layouts.app')

@section('title', 'Update Event')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">

        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Update Event
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Update event information.
            </p>
        </div>

        <a
            href="{{ route('admin.events.index') }}"
            class="inline-flex items-center justify-center
                   px-4 py-2.5 rounded-lg
                   bg-slate-100 text-slate-700
                   text-sm font-semibold
                   hover:bg-slate-200 transition"
        >
            ← Back to Events
        </a>

    </div>

    {{-- Errors --}}
    @if($errors->any())

        <div class="mb-6 rounded-xl border border-red-200
                    bg-red-50 p-4">

            <p class="font-semibold text-red-800 mb-2">
                Please fix the following errors:
            </p>

            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif

    {{-- Update Form --}}
    <form
        action="{{ route('admin.events.update', $event) }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white rounded-2xl border border-slate-200 shadow-sm"
    >

        @csrf
        @method('PUT')

        <div class="p-6 sm:p-8 space-y-6">

            {{-- Title --}}
            <div>
                <label for="title"
                       class="block text-sm font-semibold text-slate-700 mb-2">
                    Event Title <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $event->title) }}"
                    required
                    class="w-full rounded-lg border border-slate-300
                           px-4 py-3 text-sm
                           focus:border-emerald-600
                           focus:ring-2 focus:ring-emerald-600/10"
                >

                @error('title')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description"
                       class="block text-sm font-semibold text-slate-700 mb-2">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    class="w-full rounded-lg border border-slate-300
                           px-4 py-3 text-sm
                           focus:border-emerald-600
                           focus:ring-2 focus:ring-emerald-600/10"
                >{{ old('description', $event->description) }}</textarea>

                @error('description')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Date / Time --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <div>
                    <label for="event_date"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        Event Date <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="date"
                        id="event_date"
                        name="event_date"
                        value="{{ old('event_date', optional($event->event_date)->format('Y-m-d')) }}"
                        required
                        class="w-full rounded-lg border border-slate-300
                               px-4 py-3 text-sm
                               focus:border-indigo-500
                               focus:ring-indigo-500"
                    >

                    @error('event_date')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label for="event_time"
                           class="block text-sm font-semibold text-slate-700 mb-2">
                        Event Time
                    </label>

                    <input
                        type="time"
                        id="event_time"
                        name="event_time"
                        value="{{ old('event_time', $event->event_time) }}"
                        class="w-full rounded-lg border border-slate-300
                               px-4 py-3 text-sm
                               focus:border-indigo-500
                               focus:ring-indigo-500"
                    >

                    @error('event_time')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>

            {{-- Location --}}
            <div>
                <label for="location"
                       class="block text-sm font-semibold text-slate-700 mb-2">
                    Location
                </label>

                <input
                    type="text"
                    id="location"
                    name="location"
                    value="{{ old('location', $event->location) }}"
                    class="w-full rounded-lg border border-slate-300
                           px-4 py-3 text-sm
                           focus:border-emerald-600
                           focus:ring-2 focus:ring-emerald-600/10"
                >

                @error('location')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Current Image --}}
            <div>

                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Current Image
                </label>

                @if($event->image)

                    <div class="inline-block overflow-hidden
                                rounded-xl border border-slate-200">

                        <img
                            src="{{ asset($event->image) }}"
                            alt="{{ $event->title }}"
                            class="w-64 h-48 object-cover"
                        >

                    </div>

                @else

                    <div class="w-64 h-48 rounded-xl
                                bg-slate-100
                                flex items-center justify-center
                                text-slate-400">
                        No Image
                    </div>

                @endif

            </div>

            {{-- Replace Image --}}
            <div>

                <label for="image"
                       class="block text-sm font-semibold text-slate-700 mb-2">
                    Replace Image
                </label>

                <input
                    type="file"
                    id="image"
                    name="image"
                    accept=".jpg,.jpeg,.png,.webp"
                    class="w-full rounded-lg border border-slate-300
                           bg-white px-4 py-3 text-sm"
                >

                <p class="mt-1 text-xs text-slate-500">
                    Leave empty to keep the current image.
                    JPG, JPEG, PNG or WEBP. Maximum 2MB.
                </p>

                @error('image')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

                {{-- Preview --}}
                <div id="image-preview-wrapper" class="hidden mt-4">

                    <p class="text-sm font-medium text-slate-600 mb-2">
                        New Image Preview
                    </p>

                    <img
                        id="image-preview"
                        src=""
                        alt="Preview"
                        class="w-64 h-48 object-cover
                               rounded-xl border border-slate-200"
                    >

                </div>

            </div>

            {{-- Sort Order --}}
            <div>

                <label for="sort_order"
                       class="block text-sm font-semibold text-slate-700 mb-2">
                    Sort Order
                </label>

                <input
                    type="number"
                    id="sort_order"
                    name="sort_order"
                    min="0"
                    value="{{ old('sort_order', $event->sort_order ?? 0) }}"
                    class="w-full rounded-lg border border-slate-300
                           px-4 py-3 text-sm
                           focus:border-emerald-600
                           focus:ring-2 focus:ring-emerald-600/10"
                >

                @error('sort_order')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Status --}}
            <div class="flex items-center justify-between
                        rounded-xl border border-slate-200
                        bg-slate-50 p-4">

                <div>

                    <p class="font-semibold text-slate-800">
                        Status
                    </p>

                    <p class="text-sm text-slate-500">
                        Show this event on the website.
                    </p>

                </div>

                <label class="relative inline-flex items-center cursor-pointer">

                    <input
                        type="checkbox"
                        name="status"
                        value="1"
                        class="sr-only peer"
                        {{ old('status', $event->status) ? 'checked' : '' }}
                    >

                    <div class="w-11 h-6 bg-slate-300 rounded-full
                                peer-checked:bg-indigo-600
                                after:content-['']
                                after:absolute
                                after:top-[2px]
                                after:left-[2px]
                                after:bg-white
                                after:border-gray-300
                                after:border
                                after:rounded-full
                                after:h-5 after:w-5
                                after:transition-all
                                peer-checked:after:translate-x-full
                                peer-checked:after:border-white">
                    </div>

                </label>

            </div>

        </div>

        {{-- Update Footer --}}
        <div class="flex flex-col-reverse sm:flex-row
                    sm:justify-between gap-3
                    border-t border-slate-200
                    bg-slate-50
                    px-6 sm:px-8 py-5
                    rounded-b-2xl">

            <a
                href="{{ route('admin.events.index') }}"
                class="inline-flex items-center justify-center
                       px-5 py-2.5 rounded-lg
                       bg-white border border-slate-300
                       text-slate-700 text-sm font-semibold
                       hover:bg-slate-100 transition"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="inline-flex items-center justify-center
                       px-6 py-2.5 rounded-xl
                       bg-emerald-600 text-white
                       text-sm font-semibold
                       hover:bg-emerald-700 transition shadow-sm"
            >
                Update Event
            </button>

        </div>

    </form>

    {{-- Delete Section --}}
    <div class="mt-6 rounded-2xl border border-red-200
                bg-red-50 p-5">

        <div class="flex flex-col sm:flex-row
                    sm:items-center sm:justify-between gap-4">

            <div>

                <h3 class="font-semibold text-red-800">
                    Delete Event
                </h3>

                <p class="text-sm text-red-600 mt-1">
                    This event will be moved to deleted state.
                </p>

            </div>

            <form
                action="{{ route('admin.events.destroy', $event) }}"
                method="POST"
                onsubmit="return confirm('Are you sure you want to delete this event?');"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="inline-flex items-center justify-center
                           px-5 py-2.5 rounded-lg
                           bg-red-600 text-white
                           text-sm font-semibold
                           hover:bg-red-700 transition"
                >
                    Delete Event
                </button>

            </form>

        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const imageInput = document.getElementById('image');
    const previewWrapper = document.getElementById('image-preview-wrapper');
    const preview = document.getElementById('image-preview');

    imageInput.addEventListener('change', function (event) {

        const file = event.target.files[0];

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

});
</script>

@endsection