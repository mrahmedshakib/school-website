@extends('frontend.layouts.app')

@section('title', 'যোগাযোগ - ' . ($websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'বিদ্যালয়'))

@section('meta_description')
{{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name }} এর সাথে যোগাযোগের ঠিকানা, ফোন নম্বর, এবং অবস্থান।
@endsection

@section('content')

{{-- Header --}}
<section class="bg-slate-900 py-16 sm:py-20 text-white text-center">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <span class="inline-block px-4 py-1.5 rounded-full bg-white/10 text-emerald-400 text-sm font-semibold tracking-wide mb-4">
            আমাদের সাথে যোগাযোগ
        </span>
        <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight">
            যোগাযোগ করুন
        </h1>
        <p class="mt-4 text-base sm:text-lg text-white/80 max-w-2xl mx-auto">
            যেকোনো তথ্য, ভর্তি সংক্রান্ত জিজ্ঞাসা বা পরামর্শের জন্য আমাদের সাথে সরাসরি যোগাযোগ করতে পারেন।
        </p>
    </div>
</section>

{{-- Main Content --}}
<section class="py-16 sm:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Success/Error Alerts --}}
        @if(session('success'))
            <div class="mb-8 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center gap-3">
                <span class="text-2xl">✓</span>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-8">

            {{-- Contact Cards --}}
            <div class="space-y-6">

                {{-- Address --}}
                @if(isset($websiteSetting) && $websiteSetting->address)
                    <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl mb-4">
                            📍
                        </div>
                        <h2 class="text-lg font-bold text-slate-900">বিদ্যালয়ের ঠিকানা</h2>
                        <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                            {!! nl2br(e($websiteSetting->address)) !!}
                        </p>
                    </div>
                @endif

                {{-- Phone & Mobile --}}
                @if(isset($websiteSetting) && ($websiteSetting->phone || $websiteSetting->mobile))
                    <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm">
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl mb-4">
                            ☎️
                        </div>
                        <h2 class="text-lg font-bold text-slate-900">ফোন ও মোবাইল</h2>
                        <div class="mt-2 space-y-1 text-sm text-slate-600">
                            @if($websiteSetting->phone)
                                <p>ফোন: <a href="tel:{{ preg_replace('/[^0-9+]/', '', $websiteSetting->phone) }}" class="text-emerald-700 font-semibold hover:underline">{{ $websiteSetting->phone }}</a></p>
                            @endif
                            @if($websiteSetting->mobile)
                                <p>মোবাইল: <a href="tel:{{ preg_replace('/[^0-9+]/', '', $websiteSetting->mobile) }}" class="text-emerald-700 font-semibold hover:underline">{{ $websiteSetting->mobile }}</a></p>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Email & Social --}}
                @if(isset($websiteSetting) && ($websiteSetting->email || $websiteSetting->facebook))
                    <div class="p-6 bg-white rounded-2xl border border-slate-200 shadow-sm">
                        <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center text-2xl mb-4">
                            ✉️
                        </div>
                        <h2 class="text-lg font-bold text-slate-900">ই-মেইল ও সোশ্যাল</h2>
                        <div class="mt-2 space-y-2 text-sm text-slate-600">
                            @if($websiteSetting->email)
                                <p>ই-মেইল: <a href="mailto:{{ $websiteSetting->email }}" class="text-purple-700 font-semibold hover:underline break-all">{{ $websiteSetting->email }}</a></p>
                            @endif
                            @if($websiteSetting->facebook)
                                <p>ফেসবুক: <a href="{{ $websiteSetting->facebook }}" target="_blank" rel="noopener noreferrer" class="text-blue-600 font-semibold hover:underline">অফিসিয়াল ফেসবুক পেজ</a></p>
                            @endif
                        </div>
                    </div>
                @endif

            </div>

            {{-- Contact Form --}}
            <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm p-8 sm:p-10">
                <h2 class="text-2xl font-bold text-slate-900 mb-2">বার্তা পাঠান</h2>
                <p class="text-sm text-slate-500 mb-8">যেকোনো প্রশ্ন বা সহায়তার জন্য নিচের ফর্মটি পূরণ করে পাঠান।</p>

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">আপনার নাম *</label>
                            <input type="text" id="name" name="name" required value="{{ old('name') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                   placeholder="নাম লিখুন">
                            @if(isset($errors) && $errors->has('name')) <span class="text-xs text-red-500 mt-1">{{ $errors->first('name') }}</span> @endif
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-semibold text-slate-700 mb-2">ফোন নম্বর *</label>
                            <input type="text" id="phone" name="phone" required value="{{ old('phone') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                   placeholder="মোবাইল নম্বর">
                            @if(isset($errors) && $errors->has('phone')) <span class="text-xs text-red-500 mt-1">{{ $errors->first('phone') }}</span> @endif
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">ই-মেইল (ঐচ্ছিক)</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                   placeholder="email@example.com">
                            @if(isset($errors) && $errors->has('email')) <span class="text-xs text-red-500 mt-1">{{ $errors->first('email') }}</span> @endif
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-semibold text-slate-700 mb-2">বিষয়</label>
                            <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                   placeholder="বিষয়ের নাম">
                            @if(isset($errors) && $errors->has('subject')) <span class="text-xs text-red-500 mt-1">{{ $errors->first('subject') }}</span> @endif
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-semibold text-slate-700 mb-2">বার্তা লিখুন *</label>
                        <textarea id="message" name="message" rows="5" required
                                  class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                  placeholder="আপনার বার্তা বিস্তারিত লিখুন...">{{ old('message') }}</textarea>
                        @if(isset($errors) && $errors->has('message')) <span class="text-xs text-red-500 mt-1">{{ $errors->first('message') }}</span> @endif
                    </div>

                    <button type="submit"
                            class="inline-flex items-center justify-center px-8 py-3.5 rounded-xl bg-slate-900 text-white font-bold hover:bg-blue-700 transition duration-300 shadow-md">
                        বার্তা পাঠান →
                    </button>
                </form>
            </div>

        </div>

    </div>
</section>

@endsection
