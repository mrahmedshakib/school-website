@extends('backend.layouts.app')

@section('title', 'Roles & Permissions')
@section('page_title', 'Roles & Permissions / রোল ও পারমিশন')

@section('content')
<div class="space-y-6">

    {{-- Top Header Section --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
        <div>
            <h1 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                <span>রোল ও পারমিশন ব্যবস্থাপনা (RBAC)</span>
            </h1>
            <p class="text-xs text-slate-500 mt-1">
                বিভিন্ন প্রশাসনিক দায়িত্ব ও মডিউল অ্যাক্সেস নিয়ন্ত্রণ করতে কাস্টম রোল ও পারমিশন তৈরি এবং পরিচালনা করুন।
            </p>
        </div>

        @if(auth()->user()->hasPermission('roles.manage'))
        <a href="{{ route('admin.roles.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
            </svg>
            <span>নতুন রোল তৈরি করুন</span>
        </a>
        @endif
    </div>

    {{-- Roles Cards Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($roles as $role)
        <div class="bg-white rounded-2xl border border-slate-200 shadow-xs hover:shadow-md transition-all flex flex-col justify-between overflow-hidden group">
            
            {{-- Card Header --}}
            <div class="p-5 border-b border-slate-100">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h3 class="text-base font-bold text-slate-900 group-hover:text-emerald-700 transition">
                                {{ $role->name }}
                            </h3>
                            @if($role->is_system)
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                    System
                                </span>
                            @endif
                        </div>
                        <p class="text-xs font-mono text-slate-400 mt-0.5">
                            slug: <span class="text-slate-600 font-semibold">{{ $role->slug }}</span>
                        </p>
                    </div>

                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 border border-emerald-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                </div>

                <p class="text-xs text-slate-600 mt-3 line-clamp-2 leading-relaxed min-h-[36px]">
                    {{ $role->description ?: 'কোনো বিবরণ দেওয়া হয়নি।' }}
                </p>
            </div>

            {{-- Card Meta / Counts --}}
            <div class="px-5 py-3 bg-slate-50/70 border-b border-slate-100 flex items-center justify-between text-xs">
                <div class="flex items-center gap-1.5 text-slate-600">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span>ব্যবহারকারী: <strong class="text-slate-800">{{ $role->users_count }}</strong> জন</span>
                </div>

                <div class="flex items-center gap-1.5 text-slate-600">
                    <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    <span>
                        @if($role->isSuperAdmin())
                            <span class="font-bold text-emerald-700">All (সবগুলো)</span>
                        @else
                            পারমিশন: <strong class="text-slate-800">{{ $role->permissions_count }}</strong> টি
                        @endif
                    </span>
                </div>
            </div>

            {{-- Card Actions --}}
            <div class="p-3.5 bg-white flex items-center justify-end gap-2">
                @if(auth()->user()->hasPermission('roles.manage'))
                <a href="{{ route('admin.roles.edit', $role->id) }}"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-semibold text-xs transition border border-emerald-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    <span>পারমিশন পরিবর্তন</span>
                </a>

                @if(!$role->is_system)
                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                      onsubmit="return confirm('আপনি কি নিশ্চিতভাবে এই রোলটি মুছে ফেলতে চান?');"
                      class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 font-semibold text-xs transition border border-rose-200 cursor-pointer">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        <span>ডিলিট</span>
                    </button>
                </form>
                @endif
                @endif
            </div>

        </div>
        @endforeach
    </div>

</div>
@endsection
