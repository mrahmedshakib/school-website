@extends('backend.layouts.app')

@section('title', 'Edit User: ' . $user->name)
@section('page_title', 'Edit User / ব্যবহারকারী তথ্য সম্পাদনা')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
        <div>
            <h1 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                <span>ব্যবহারকারী তথ্য সম্পাদনা: <span class="text-emerald-700">{{ $user->name }}</span></span>
            </h1>
            <p class="text-xs text-slate-500 mt-1">
                ব্যবহারকারীর তথ্য, নির্ধারিত রোল অথবা পাসওয়ার্ড পরিবর্তন করুন।
            </p>
        </div>

        <a href="{{ route('admin.users.index') }}"
           class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>তালিকায় ফিরে যান</span>
        </a>
    </div>

    {{-- Form --}}
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="bg-white rounded-2xl border border-slate-200 p-6 shadow-xs space-y-5">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            {{-- Full Name --}}
            <div>
                <label for="name" class="block text-xs font-bold text-slate-700 mb-1.5">
                    সম্পূর্ণ নাম (Full Name) <span class="text-rose-500">*</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                       placeholder="ব্যবহারকারীর পুরো নাম"
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 text-xs text-slate-800 outline-none">
                @error('name')
                    <p class="text-rose-600 text-[11px] mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email Address --}}
            <div>
                <label for="email" class="block text-xs font-bold text-slate-700 mb-1.5">
                    ইমেইল এড্রেস (Email Address) <span class="text-rose-500">*</span>
                </label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                       placeholder="user@school.com"
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 text-xs text-slate-800 outline-none">
                @error('email')
                    <p class="text-rose-600 text-[11px] mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Phone Number --}}
            <div>
                <label for="phone" class="block text-xs font-bold text-slate-700 mb-1.5">
                    ফোন নম্বর (Phone Number)
                </label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                       placeholder="017xxxxxxxx"
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 text-xs text-slate-800 outline-none">
                @error('phone')
                    <p class="text-rose-600 text-[11px] mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Role Selection --}}
            <div>
                <label for="role_id" class="block text-xs font-bold text-slate-700 mb-1.5">
                    নির্ধারিত রোল (Assigned Role) <span class="text-rose-500">*</span>
                </label>
                <select id="role_id" name="role_id" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 text-xs text-slate-800 outline-none bg-white">
                    <option value="">রোল নির্বাচন করুন...</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                            {{ $role->name }} ({{ $role->slug }})
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                    <p class="text-rose-600 text-[11px] mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password (Optional) --}}
            <div class="md:col-span-2">
                <label for="password" class="block text-xs font-bold text-slate-700 mb-1.5">
                    পাসওয়ার্ড পরিবর্তন (নতুন পাসওয়ার্ড দিতে চাইলে লিখুন, অন্যথায় ফাঁকা রাখুন)
                </label>
                <input type="password" id="password" name="password"
                       placeholder="পাসওয়ার্ড অপরিবর্তিত রাখতে ফাঁকা রাখুন..."
                       class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 text-xs text-slate-800 outline-none">
                @error('password')
                    <p class="text-rose-600 text-[11px] mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Account Status --}}
            <div class="md:col-span-2 pt-2">
                @if($user->id === auth()->id())
                    <div class="p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-xs text-emerald-800 font-semibold flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>আপনি নিজের সক্রিয় অ্যাকাউন্ট সম্পাদন করছেন (নিজ অ্যাকাউন্ট নিষ্ক্রিয় করা প্রযোজ্য নয়)।</span>
                    </div>
                    <input type="hidden" name="status" value="1">
                @else
                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="status" value="1" {{ old('status', $user->status) ? 'checked' : '' }}
                               class="w-4 h-4 rounded text-emerald-600 border-slate-300 focus:ring-emerald-500 accent-emerald-600">
                        <span class="text-xs font-bold text-slate-800">
                            অ্যাকাউন্ট সক্রিয় রাখুন (Active Status)
                        </span>
                    </label>
                    <p class="text-[11px] text-slate-400 mt-1 pl-6">টিক চিহ্ন তুলে দিলে এই ব্যবহারকারী সিস্টেমে লগইন করতে পারবে না।</p>
                @endif
            </div>

        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
            <a href="{{ route('admin.users.index') }}"
               class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs transition">
                বাতিল করুন
            </a>
            <button type="submit"
                    class="px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition">
                পরিবর্তন সংরক্ষণ করুন
            </button>
        </div>

    </form>

</div>
@endsection
