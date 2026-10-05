@extends('backend.layouts.app')

@section('title', 'Users Management')
@section('page_title', 'Users Management / ব্যবহারকারী তালিকা')

@section('content')
<div class="space-y-6">

    {{-- Top Header Section --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl border border-slate-200 shadow-xs">
        <div>
            <h1 class="text-xl font-bold text-slate-900 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                <span>অ্যাডমিন ব্যবহারকারী তালিকা (Admin Users)</span>
            </h1>
            <p class="text-xs text-slate-500 mt-1">
                সিস্টেমে লগইন করতে সক্ষম অ্যাডমিন, শিক্ষক ও কর্মচারীদের অ্যাকাউন্ট এবং তাদের নির্ধারিত রোল পরিচালনা করুন।
            </p>
        </div>

        @if(auth()->user()->hasPermission('users.manage'))
        <a href="{{ route('admin.users.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-sm transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
            </svg>
            <span>নতুন ব্যবহারকারী যুক্ত করুন</span>
        </a>
        @endif
    </div>

    {{-- Filter Bar --}}
    <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-xs">
        <form method="GET" action="{{ route('admin.users.index') }}" class="grid grid-cols-1 sm:grid-cols-4 gap-3">
            {{-- Search input --}}
            <div class="sm:col-span-2">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="নাম, ইমেইল বা ফোন নম্বর দিয়ে খুঁজুন..."
                           class="w-full pl-9 pr-3.5 py-2 rounded-xl border border-slate-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 text-xs text-slate-800 outline-none">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

            {{-- Role Filter --}}
            <div>
                <select name="role_id" onchange="this.form.submit()"
                        class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 text-xs text-slate-700 outline-none">
                    <option value="">সকল রোল (All Roles)</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Status Filter & Clear --}}
            <div class="flex items-center gap-2">
                <select name="status" onchange="this.form.submit()"
                        class="w-full px-3 py-2 rounded-xl border border-slate-300 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 text-xs text-slate-700 outline-none">
                    <option value="">সকল স্ট্যাটাস</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>সক্রিয় (Active)</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>নিষ্ক্রিয় (Inactive)</option>
                </select>

                @if(request()->hasAny(['search', 'role_id', 'status']))
                    <a href="{{ route('admin.users.index') }}" title="ফিল্টার রিসেট"
                       class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 transition shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- Users Compact Table --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-xs text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-[11px] font-bold uppercase tracking-wider text-slate-600">
                        <th class="px-3 py-2.5 text-center w-12">#</th>
                        <th class="px-3 py-2.5">ব্যবহারকারী (User)</th>
                        <th class="px-3 py-2.5">ইমেইল</th>
                        <th class="px-3 py-2.5">ফোন নম্বর</th>
                        <th class="px-3 py-2.5">নির্ধারিত রোল (Role)</th>
                        <th class="px-3 py-2.5 text-center">স্ট্যাটাস</th>
                        <th class="px-3 py-2.5 text-center">তৈরির তারিখ</th>
                        <th class="px-3 py-2.5 text-right w-28">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($users as $user)
                    <tr class="hover:bg-slate-50/70 transition-colors {{ $user->id === auth()->id() ? 'bg-emerald-50/30' : '' }}">
                        <td class="px-3 py-2.5 text-center font-mono text-slate-400">
                            {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                        </td>

                        {{-- User & Avatar --}}
                        <td class="px-3 py-2.5">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white font-bold text-xs flex items-center justify-center shrink-0 shadow-xs">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <div class="font-bold text-slate-900 truncate flex items-center gap-1.5">
                                        <span>{{ $user->name }}</span>
                                        @if($user->id === auth()->id())
                                            <span class="px-1.5 py-0.5 rounded text-[9px] font-bold bg-emerald-100 text-emerald-800">You</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>

                        {{-- Email --}}
                        <td class="px-3 py-2.5 text-slate-600 font-mono text-[11px]">
                            {{ $user->email }}
                        </td>

                        {{-- Phone --}}
                        <td class="px-3 py-2.5 text-slate-600">
                            {{ $user->phone ?: '-' }}
                        </td>

                        {{-- Role Badge --}}
                        <td class="px-3 py-2.5">
                            @if($user->isSuperAdmin())
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-extrabold bg-purple-100 text-purple-800 border border-purple-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-purple-500"></span>
                                    <span>Super Admin</span>
                                </span>
                            @elseif($user->role)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span>{{ $user->role->name }}</span>
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-slate-100 text-slate-500">
                                    No Role
                                </span>
                            @endif
                        </td>

                        {{-- Status & Toggle --}}
                        <td class="px-3 py-2.5 text-center">
                            @if($user->id === auth()->id())
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                    সক্রিয় (Active)
                                </span>
                            @elseif(auth()->user()->hasPermission('users.manage'))
                                <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            title="স্ট্যাটাস পরিবর্তন করতে ক্লিক করুন"
                                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold cursor-pointer transition {{ $user->status ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-slate-200 text-slate-600 hover:bg-slate-300' }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $user->status ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                                        <span>{{ $user->status ? 'Active' : 'Inactive' }}</span>
                                    </button>
                                </form>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold {{ $user->status ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-600' }}">
                                    {{ $user->status ? 'Active' : 'Inactive' }}
                                </span>
                            @endif
                        </td>

                        {{-- Created At --}}
                        <td class="px-3 py-2.5 text-center text-[11px] text-slate-500 font-mono">
                            {{ $user->created_at ? $user->created_at->format('d M, Y') : '-' }}
                        </td>

                        {{-- Actions --}}
                        <td class="px-3 py-2.5 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1.5">
                                @if(auth()->user()->hasPermission('users.manage'))
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                   title="সম্পাদনা করুন"
                                   class="p-1.5 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>

                                @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                      onsubmit="return confirm('আপনি কি নিশ্চিতভাবে এই ব্যবহারকারীকে মুছে ফেলতে চান?');"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            title="মুছে ফেলুন"
                                            class="p-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-700 transition cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                                @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-8 text-center text-xs text-slate-400">
                            কোনো ব্যবহারকারী পাওয়া যায়নি।
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($users->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $users->links() }}
        </div>
        @endif
    </div>

</div>
@endsection
