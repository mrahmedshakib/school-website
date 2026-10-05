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
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
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
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
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
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
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
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
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
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
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
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
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
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
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
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
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
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
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
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
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
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
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
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
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
                    class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
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
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
                    >

                </div>


                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Meta Description
                    </label>

                    <textarea
                        name="meta_description"
                        rows="4"
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
                    >{{ old('meta_description', $setting?->meta_description) }}</textarea>

                </div>


                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Meta Keywords
                    </label>

                    <textarea
                        name="meta_keywords"
                        rows="3"
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
                    >{{ old('meta_keywords', $setting?->meta_keywords) }}</textarea>

                </div>

            </div>

        </div>


        {{-- Developer Profile & Contact Information (Super Admin Only) --}}
        @if(auth()->user()->isSuperAdmin())
        <div class="bg-white rounded-2xl shadow-sm border border-emerald-200 overflow-hidden">

            <div class="px-6 py-5 bg-gradient-to-r from-emerald-50 via-teal-50 to-white border-b border-emerald-100 flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        Developer Information & Contact Profile (ডেভেলপার তথ্য ও প্রোফাইল)
                    </h2>
                    <p class="text-sm text-slate-500 mt-0.5">
                        ফুটার ও যোগাযোগ মডালে প্রদর্শিত ডেভেলপারের তথ্য ও লিঙ্কসমূহ ডাটাবেস থেকে নিয়ন্ত্রণ করুন।
                    </p>
                </div>
                <span class="hidden sm:inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200">
                    Live Dynamic DB
                </span>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Developer Name (Bangla) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Developer Name (বাংলা নাম)
                    </label>
                    <input
                        type="text"
                        name="developer_name"
                        value="{{ old('developer_name', $setting?->developer_name) }}"
                        placeholder="ইমতিয়াজ আহমেদ"
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
                    >
                    @error('developer_name')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Developer Name (English) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Developer Name (English)
                    </label>
                    <input
                        type="text"
                        name="developer_name_en"
                        value="{{ old('developer_name_en', $setting?->developer_name_en) }}"
                        placeholder="Imtiaz Ahmed"
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
                    >
                    @error('developer_name_en')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Username / Handle --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Username / Handle
                    </label>
                    <input
                        type="text"
                        name="developer_username"
                        value="{{ old('developer_username', $setting?->developer_username) }}"
                        placeholder="mrahmedshakib"
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
                    >
                    @error('developer_username')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Designation / Role --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Designation / Role
                    </label>
                    <input
                        type="text"
                        name="developer_role"
                        value="{{ old('developer_role', $setting?->developer_role) }}"
                        placeholder="Full-Stack Web & Software Engineer"
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
                    >
                    @error('developer_role')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Organization --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Organization / Workplace
                    </label>
                    <input
                        type="text"
                        name="developer_organization"
                        value="{{ old('developer_organization', $setting?->developer_organization) }}"
                        placeholder="Mysoftheaven (BD) LTD. • Dhaka"
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
                    >
                    @error('developer_organization')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Developer Email --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Developer Email
                    </label>
                    <input
                        type="email"
                        name="developer_email"
                        value="{{ old('developer_email', $setting?->developer_email) }}"
                        placeholder="ahmedshakib37@gmail.com"
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
                    >
                    @error('developer_email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Developer Phone / WhatsApp --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        WhatsApp Number
                    </label>
                    <input
                        type="text"
                        name="developer_whatsapp"
                        value="{{ old('developer_whatsapp', $setting?->developer_whatsapp) }}"
                        placeholder="01767056733"
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
                    >
                    @error('developer_whatsapp')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Photo URL --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Profile Photo URL
                    </label>
                    <input
                        type="text"
                        name="developer_photo"
                        value="{{ old('developer_photo', $setting?->developer_photo) }}"
                        placeholder="https://avatars.githubusercontent.com/u/36819643?v=4"
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
                    >
                    @error('developer_photo')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Portfolio URL --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Portfolio Website URL
                    </label>
                    <input
                        type="url"
                        name="developer_portfolio"
                        value="{{ old('developer_portfolio', $setting?->developer_portfolio) }}"
                        placeholder="https://mrahmedshakib.github.io/"
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
                    >
                    @error('developer_portfolio')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- LinkedIn URL --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        LinkedIn Profile URL
                    </label>
                    <input
                        type="url"
                        name="developer_linkedin"
                        value="{{ old('developer_linkedin', $setting?->developer_linkedin) }}"
                        placeholder="https://www.linkedin.com/in/mrahmedshakib/"
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
                    >
                    @error('developer_linkedin')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- GitHub URL --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        GitHub Profile URL
                    </label>
                    <input
                        type="url"
                        name="developer_github"
                        value="{{ old('developer_github', $setting?->developer_github) }}"
                        placeholder="https://github.com/mrahmedshakib"
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
                    >
                    @error('developer_github')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- WhatsApp Preset Message --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        WhatsApp Preset Message (হোয়াটসঅ্যাপে ক্লিক করলে যে বার্তা যাবে)
                    </label>
                    <textarea
                        name="developer_whatsapp_message"
                        rows="2"
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
                    >{{ old('developer_whatsapp_message', $setting?->developer_whatsapp_message) }}</textarea>
                    @error('developer_whatsapp_message')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Contact Prompt Note --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Contact Note in Modal (মডালে যোগাযোগের ওপরের লেখা)
                    </label>
                    <textarea
                        name="developer_contact_note"
                        rows="2"
                        class="w-full rounded-xl border-gray-300 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
                    >{{ old('developer_contact_note', $setting?->developer_contact_note) }}</textarea>
                    @error('developer_contact_note')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

        </div>
        @endif


        {{-- Submit --}}
        <div class="flex justify-end">

            <button
                type="submit"
                class="inline-flex items-center px-7 py-3 rounded-xl
                       bg-emerald-600 text-white font-bold text-sm
                       hover:bg-emerald-700
                       focus:outline-none focus:ring-2
                       focus:ring-emerald-600 focus:ring-offset-2
                       shadow-md shadow-emerald-900/20
                       transition"
            >
                Save Settings
            </button>

        </div>

    </form>

</div>

@endsection