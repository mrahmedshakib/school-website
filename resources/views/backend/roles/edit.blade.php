@extends('backend.layouts.app')

@section('title', 'Edit Role: ' . $role->name)
@section('page_title', 'Edit Role / রোল ও পারমিশন সম্পাদনা')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
        <div>
            <h1 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                <span>রোল ও পারমিশন সম্পাদনা: <span class="text-emerald-700">{{ $role->name }}</span></span>
            </h1>
            <p class="text-xs text-slate-500 mt-1">
                রোলের তথ্য ও পারমিশন পরিবর্তন করুন।
            </p>
        </div>

        <a href="{{ route('admin.roles.index') }}"
           class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>তালিকায় ফিরে যান</span>
        </a>
    </div>

    {{-- Form --}}
    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Role Basic Info Card --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-xs space-y-4">
            <h2 class="text-sm font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-teal-500"></span>
                <span>রোলের সাধারণ তথ্য (Role Details)</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Role Name --}}
                <div>
                    <label for="name" class="block text-xs font-bold text-slate-700 mb-1.5">
                        রোলের নাম (Role Name) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $role->name) }}" required
                           placeholder="যেমন: Accountant / হিসাবরক্ষক"
                           class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 text-xs text-slate-800 outline-none">
                    @error('name')
                        <p class="text-rose-600 text-[11px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Role Slug --}}
                <div>
                    <label for="slug" class="block text-xs font-bold text-slate-700 mb-1.5">
                        ইউনিক স্লাগ (Unique Slug) <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $role->slug) }}" required
                           {{ $role->is_system ? 'readonly' : '' }}
                           class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 text-xs font-mono text-slate-800 outline-none {{ $role->is_system ? 'bg-slate-100 cursor-not-allowed text-slate-500' : '' }}">
                    @if($role->is_system)
                        <p class="text-[10px] text-amber-600 mt-1">⚠️ সিস্টেম রোলের স্লাগ পরিবর্তনযোগ্য নয়।</p>
                    @endif
                    @error('slug')
                        <p class="text-rose-600 text-[11px] mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Role Description --}}
                <div class="md:col-span-2">
                    <label for="description" class="block text-xs font-bold text-slate-700 mb-1.5">
                        বিবরণ / দায়িত্ব (Description)
                    </label>
                    <textarea id="description" name="description" rows="2"
                              placeholder="এই রোলের দায়িত্ব ও পরিধি সম্পর্কে সংক্ষিপ্ত বিবরণ লিখুন..."
                              class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 text-xs text-slate-800 outline-none">{{ old('description', $role->description) }}</textarea>
                    @error('description')
                        <p class="text-rose-600 text-[11px] mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Permissions Matrix Card --}}
        <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-xs space-y-5">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-slate-100 pb-4">
                <div>
                    <h2 class="text-sm font-bold text-slate-900 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>পারমিশন ম্যাট্রিক্স (Permissions Assignment)</span>
                    </h2>
                    <p class="text-xs text-slate-500 mt-0.5">এই রোলের ব্যবহারকারীরা যেসব মডিউলে কাজ করতে পারবে তা টিক দিন।</p>
                </div>

                <button type="button" onclick="toggleAllPermissions(this)"
                        class="px-3.5 py-1.5 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-bold text-xs border border-emerald-200 transition cursor-pointer self-start sm:self-auto">
                    সবগুলো নির্বাচন / বাতিল (Select All)
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @foreach($permissionsGrouped as $groupName => $groupPermissions)
                <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50 space-y-3">
                    <div class="flex items-center justify-between pb-2 border-b border-slate-200">
                        <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                            <span>{{ $groupName }}</span>
                        </h3>

                        <button type="button" onclick="toggleGroupPermissions('group-{{ Str::slug($groupName) }}')"
                                class="text-[11px] text-emerald-700 hover:text-emerald-900 font-semibold cursor-pointer">
                            গ্রুপ সিলেক্ট
                        </button>
                    </div>

                    <div class="space-y-2.5 pt-1" id="group-{{ Str::slug($groupName) }}">
                        @foreach($groupPermissions as $permission)
                        <label class="flex items-start gap-2.5 cursor-pointer text-xs group">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                   {{ in_array($permission->id, old('permissions', $assignedPermissionIds)) ? 'checked' : '' }}
                                   class="perm-checkbox mt-0.5 w-4 h-4 rounded text-emerald-600 border-slate-300 focus:ring-emerald-500 accent-emerald-600">
                            <div>
                                <span class="font-semibold text-slate-800 group-hover:text-emerald-700 transition block">
                                    {{ $permission->name }}
                                </span>
                                @if($permission->description)
                                    <span class="text-[10px] text-slate-400 block leading-tight">{{ $permission->description }}</span>
                                @endif
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Submit Buttons --}}
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('admin.roles.index') }}"
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

<script>
    function toggleAllPermissions(btn) {
        const checkboxes = document.querySelectorAll('.perm-checkbox');
        const anyUnchecked = Array.from(checkboxes).some(cb => !cb.checked);
        checkboxes.forEach(cb => cb.checked = anyUnchecked);
    }

    function toggleGroupPermissions(groupId) {
        const container = document.getElementById(groupId);
        if (!container) return;
        const checkboxes = container.querySelectorAll('.perm-checkbox');
        const anyUnchecked = Array.from(checkboxes).some(cb => !cb.checked);
        checkboxes.forEach(cb => cb.checked = anyUnchecked);
    }
</script>
@endsection
