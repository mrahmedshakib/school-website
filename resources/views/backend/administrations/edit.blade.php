@extends('backend.layouts.app')

@section('title', 'Edit Administration')

@section('content')

<div class="max-w-5xl mx-auto py-8 px-4">

    {{-- Header --}}
    <div class="mb-8">

        <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">

            <a
                href="{{ route('admin.administrations.index') }}"
                class="hover:text-gray-900"
            >
                Administration
            </a>

            <span>/</span>

            <span class="text-gray-700">
                Edit
            </span>

        </div>

        <h1 class="text-2xl font-bold text-gray-900">
            Edit Administration
        </h1>

        <p class="text-sm text-gray-500 mt-1">
            Update administration member information.
        </p>

    </div>


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-4">

            <div class="font-semibold text-red-700 mb-2">
                Please fix the following errors:
            </div>

            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Form --}}
    <form
        action="{{ route('admin.administrations.update', $administration->id) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">


            {{-- Section Header --}}
            <div class="px-6 py-5 border-b border-gray-200">

                <h2 class="text-lg font-semibold text-gray-900">
                    Administration Information
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Update the information below.
                </p>

            </div>


            {{-- Form Fields --}}
            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                    {{-- Name --}}
                    <div>

                        <label
                            for="name"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Name <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $administration->name) }}"
                            required
                            maxlength="255"
                            placeholder="Enter name"
                            class="w-full rounded-lg border border-gray-300
                                   px-4 py-2.5 text-sm
                                   focus:border-slate-500
                                   focus:ring-2 focus:ring-slate-200
                                   outline-none"
                        >

                    </div>


                    {{-- Designation --}}
                    <div>

                        <label
                            for="designation"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Designation <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="designation"
                            name="designation"
                            value="{{ old('designation', $administration->designation) }}"
                            required
                            maxlength="255"
                            placeholder="e.g. Headmaster"
                            class="w-full rounded-lg border border-gray-300
                                   px-4 py-2.5 text-sm
                                   focus:border-slate-500
                                   focus:ring-2 focus:ring-slate-200
                                   outline-none"
                        >

                    </div>


                    {{-- Phone --}}
                    <div>

                        <label
                            for="phone"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Phone
                        </label>

                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="{{ old('phone', $administration->phone) }}"
                            maxlength="50"
                            placeholder="01XXXXXXXXX"
                            class="w-full rounded-lg border border-gray-300
                                   px-4 py-2.5 text-sm
                                   focus:border-slate-500
                                   focus:ring-2 focus:ring-slate-200
                                   outline-none"
                        >

                    </div>


                    {{-- Email --}}
                    <div>

                        <label
                            for="email"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Email
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $administration->email) }}"
                            maxlength="255"
                            placeholder="example@email.com"
                            class="w-full rounded-lg border border-gray-300
                                   px-4 py-2.5 text-sm
                                   focus:border-slate-500
                                   focus:ring-2 focus:ring-slate-200
                                   outline-none"
                        >

                    </div>


                    {{-- Sort Order --}}
                    <div>

                        <label
                            for="sort_order"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Sort Order
                        </label>

                        <input
                            type="number"
                            id="sort_order"
                            name="sort_order"
                            value="{{ old('sort_order', $administration->sort_order) }}"
                            min="0"
                            class="w-full rounded-lg border border-gray-300
                                   px-4 py-2.5 text-sm
                                   focus:border-slate-500
                                   focus:ring-2 focus:ring-slate-200
                                   outline-none"
                        >

                        <p class="text-xs text-gray-400 mt-1">
                            Smaller number will appear first.
                        </p>

                    </div>


                    {{-- Status --}}
                    <div>

                        <label
                            for="status"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="w-full rounded-lg border border-gray-300
                                   px-4 py-2.5 text-sm
                                   focus:border-slate-500
                                   focus:ring-2 focus:ring-slate-200
                                   outline-none"
                        >

                            <option
                                value="1"
                                {{ old('status', $administration->status) == '1' ? 'selected' : '' }}
                            >
                                Active
                            </option>

                            <option
                                value="0"
                                {{ old('status', $administration->status) == '0' ? 'selected' : '' }}
                            >
                                Inactive
                            </option>

                        </select>

                    </div>


                    {{-- Current Image --}}
                    <div class="md:col-span-2">

                        <label
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Current Image
                        </label>

                        @if($administration->image)

                            <div class="mb-4">

                                <img
                                    src="{{ asset('storage/' . $administration->image) }}"
                                    alt="{{ $administration->name }}"
                                    class="w-28 h-28 rounded-xl object-cover
                                           border border-gray-200"
                                >

                            </div>

                        @else

                            <div class="mb-4 w-28 h-28 rounded-xl
                                        bg-gray-100 border border-gray-200
                                        flex items-center justify-center
                                        text-gray-400">

                                👤

                            </div>

                        @endif


                        <label
                            for="image"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Change Image
                        </label>

                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="block w-full text-sm text-gray-600
                                   file:mr-4 file:py-2.5 file:px-4
                                   file:rounded-lg file:border-0
                                   file:bg-slate-100 file:text-slate-700
                                   file:font-medium
                                   hover:file:bg-slate-200"
                        >

                        <p class="text-xs text-gray-400 mt-2">
                            Leave empty to keep the current image.
                            JPG, JPEG, PNG or WEBP. Maximum 2MB.
                        </p>

                    </div>


                    {{-- Description --}}
                    <div class="md:col-span-2">

                        <label
                            for="description"
                            class="block text-sm font-medium text-gray-700 mb-2"
                        >
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            placeholder="Write a short description..."
                            class="w-full rounded-lg border border-gray-300
                                   px-4 py-3 text-sm
                                   focus:border-slate-500
                                   focus:ring-2 focus:ring-slate-200
                                   outline-none resize-y"
                        >{{ old('description', $administration->description) }}</textarea>

                    </div>

                </div>

            </div>


            {{-- Footer --}}
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200
                        flex flex-col sm:flex-row justify-end gap-3">

                <a
                    href="{{ route('admin.administrations.index') }}"
                    class="inline-flex items-center justify-center
                           px-5 py-2.5 rounded-lg
                           border border-gray-300
                           bg-white text-gray-700
                           text-sm font-semibold
                           hover:bg-gray-50"
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
                    Update Administration
                </button>

            </div>

        </div>

    </form>

</div>

@endsection
