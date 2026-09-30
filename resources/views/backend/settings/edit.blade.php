@extends('backend.layouts.app')

@section('title', 'Website Settings')
@section('page_title', 'Website Settings')

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">
            Website Settings
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Manage your school's basic information, branding, contact details and SEO.
        </p>
    </div>


    <form
        action="{{ route('admin.settings.update') }}"
        method="POST"
        enctype="multipart/form-data"
        class="space-y-6"
    >

        @csrf
        @method('PUT')


        {{-- School Information --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

            <div class="px-6 py-5 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">
                    School Information
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Basic information about your school.
                </p>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- School Name --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        School Name
                    </label>

                    <input
                        type="text"
                        name="school_name"
                        value="{{ old('school_name', $setting?->school_name) }}"
                        placeholder="Example School & College"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >

                    @error('school_name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>


                {{-- Bangla Name --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        School Name (Bangla)
                    </label>

                    <input
                        type="text"
                        name="school_name_bn"
                        value="{{ old('school_name_bn', $setting?->school_name_bn) }}"
                        placeholder="বিদ্যালয়ের নাম"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >

                    @error('school_name_bn')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>


                {{-- Tagline --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tagline
                    </label>

                    <input
                        type="text"
                        name="tagline"
                        value="{{ old('tagline', $setting?->tagline) }}"
                        placeholder="Knowledge • Discipline • Excellence"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >
                </div>

            </div>
        </div>


        {{-- Branding --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

            <div class="px-6 py-5 border-b border-gray-200">

                <h2 class="text-lg font-semibold text-gray-900">
                    Branding
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Upload school logo and favicon.
                </p>

            </div>


            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- Logo --}}
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        School Logo
                    </label>

                    @if($setting?->logo)
                        <div class="mb-4">
                            <img
                                src="{{ asset($setting->logo) }}"
                                alt="School Logo"
                                class="h-24 w-auto object-contain border rounded-xl p-2 bg-gray-50"
                            >
                        </div>
                    @endif

                    <input
                        type="file"
                        name="logo"
                        accept=".jpg,.jpeg,.png,.webp"
                        class="block w-full text-sm text-gray-600
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-lg file:border-0
                        file:bg-indigo-50 file:text-indigo-700
                        hover:file:bg-indigo-100"
                    >

                    <p class="text-xs text-gray-500 mt-2">
                        JPG, PNG or WEBP. Maximum 2MB.
                    </p>

                    @error('logo')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                </div>


                {{-- Favicon --}}
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Favicon
                    </label>

                    @if($setting?->favicon)
                        <div class="mb-4">
                            <img
                                src="{{ asset($setting->favicon) }}"
                                alt="Favicon"
                                class="h-16 w-16 object-contain border rounded-xl p-2 bg-gray-50"
                            >
                        </div>
                    @endif

                    <input
                        type="file"
                        name="favicon"
                        accept=".jpg,.jpeg,.png,.ico,.webp"
                        class="block w-full text-sm text-gray-600
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-lg file:border-0
                        file:bg-indigo-50 file:text-indigo-700
                        hover:file:bg-indigo-100"
                    >

                    <p class="text-xs text-gray-500 mt-2">
                        Maximum 1MB.
                    </p>

                    @error('favicon')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                </div>

            </div>

        </div>


        {{-- Contact Information --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

            <div class="px-6 py-5 border-b border-gray-200">

                <h2 class="text-lg font-semibold text-gray-900">
                    Contact Information
                </h2>

            </div>


            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Address --}}
                <div class="md:col-span-2">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Address
                    </label>

                    <textarea
                        name="address"
                        rows="3"
                        placeholder="School address"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >{{ old('address', $setting?->address) }}</textarea>

                </div>


                {{-- Phone --}}
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Phone
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone', $setting?->phone) }}"
                        placeholder="+880..."
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >

                </div>


                {{-- Mobile --}}
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Mobile
                    </label>

                    <input
                        type="text"
                        name="mobile"
                        value="{{ old('mobile', $setting?->mobile) }}"
                        placeholder="01XXXXXXXXX"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >

                </div>


                {{-- Email --}}
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $setting?->email) }}"
                        placeholder="info@school.com"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >

                </div>


                {{-- Website --}}
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Website
                    </label>

                    <input
                        type="text"
                        name="website"
                        value="{{ old('website', $setting?->website) }}"
                        placeholder="https://example.com"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >

                </div>

            </div>

        </div>


        {{-- Social Media --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

            <div class="px-6 py-5 border-b border-gray-200">

                <h2 class="text-lg font-semibold text-gray-900">
                    Social Media
                </h2>

            </div>


            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Facebook
                    </label>

                    <input
                        type="url"
                        name="facebook"
                        value="{{ old('facebook', $setting?->facebook) }}"
                        placeholder="https://facebook.com/..."
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        YouTube
                    </label>

                    <input
                        type="url"
                        name="youtube"
                        value="{{ old('youtube', $setting?->youtube) }}"
                        placeholder="https://youtube.com/..."
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Twitter / X
                    </label>

                    <input
                        type="url"
                        name="twitter"
                        value="{{ old('twitter', $setting?->twitter) }}"
                        placeholder="https://x.com/..."
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        LinkedIn
                    </label>

                    <input
                        type="url"
                        name="linkedin"
                        value="{{ old('linkedin', $setting?->linkedin) }}"
                        placeholder="https://linkedin.com/..."
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >
                </div>

            </div>

        </div>


        {{-- Footer --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

            <div class="px-6 py-5 border-b border-gray-200">

                <h2 class="text-lg font-semibold text-gray-900">
                    Footer
                </h2>

            </div>

            <div class="p-6">

                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Footer Text
                </label>

                <textarea
                    name="footer_text"
                    rows="4"
                    placeholder="Copyright © {{ date('Y') }} School Name. All Rights Reserved."
                    class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                >{{ old('footer_text', $setting?->footer_text) }}</textarea>

            </div>

        </div>


        {{-- SEO --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200">

            <div class="px-6 py-5 border-b border-gray-200">

                <h2 class="text-lg font-semibold text-gray-900">
                    SEO Settings
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Search engine optimization information.
                </p>

            </div>


            <div class="p-6 space-y-6">

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Meta Title
                    </label>

                    <input
                        type="text"
                        name="meta_title"
                        value="{{ old('meta_title', $setting?->meta_title) }}"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >

                </div>


                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Meta Description
                    </label>

                    <textarea
                        name="meta_description"
                        rows="4"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >{{ old('meta_description', $setting?->meta_description) }}</textarea>

                </div>


                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Meta Keywords
                    </label>

                    <textarea
                        name="meta_keywords"
                        rows="3"
                        class="w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                    >{{ old('meta_keywords', $setting?->meta_keywords) }}</textarea>

                </div>

            </div>

        </div>


        {{-- Submit --}}
        <div class="flex justify-end">

            <button
                type="submit"
                class="inline-flex items-center px-6 py-3 rounded-xl
                       bg-indigo-600 text-white font-semibold
                       hover:bg-indigo-700
                       focus:outline-none focus:ring-2
                       focus:ring-indigo-500 focus:ring-offset-2
                       transition"
            >
                Save Settings
            </button>

        </div>

    </form>

</div>

@endsection