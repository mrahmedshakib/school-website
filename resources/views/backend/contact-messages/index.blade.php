@extends('backend.layouts.app')

@section('title', 'যোগাযোগ ও বার্তা ইনবক্স')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight flex items-center gap-2.5">
                <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm shadow-xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </span>
                যোগাযোগ ও বার্তা ইনবক্স
            </h1>
            <p class="text-xs text-slate-500 mt-1">ওয়েবসাইটের যোগাযোগ ফর্ম থেকে আসা সকল বার্তা ও অনুসন্ধান</p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('contact') }}" target="_blank"
               class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 transition shadow-xs">
                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                <span>যোগাযোগ পেজ দেখুন</span>
            </a>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4">
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase text-slate-400">মোট বার্তা</p>
                <p class="text-xl sm:text-2xl font-black text-slate-800 mt-0.5">{{ $totalMessages }}</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
            </div>
        </div>

        <a href="{{ route('admin.contact-messages.index', ['status' => 'unread']) }}"
           class="bg-white p-4 rounded-2xl border transition shadow-xs flex items-center justify-between {{ request('status') === 'unread' ? 'border-amber-400 ring-2 ring-amber-400/20' : 'border-slate-200/80 hover:border-amber-300' }}">
            <div>
                <p class="text-[11px] font-bold uppercase text-amber-600 flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                    নতুন / অপঠিত
                </p>
                <p class="text-xl sm:text-2xl font-black text-amber-600 mt-0.5">{{ $unreadMessages }}</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
            </div>
        </a>

        <a href="{{ route('admin.contact-messages.index', ['status' => 'read']) }}"
           class="bg-white p-4 rounded-2xl border transition shadow-xs flex items-center justify-between {{ request('status') === 'read' ? 'border-emerald-500 ring-2 ring-emerald-500/20' : 'border-slate-200/80 hover:border-emerald-300' }}">
            <div>
                <p class="text-[11px] font-bold uppercase text-emerald-600">পঠিত বার্তা</p>
                <p class="text-xl sm:text-2xl font-black text-emerald-700 mt-0.5">{{ $readMessages }}</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </a>

        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[11px] font-bold uppercase text-indigo-600">আজকের বার্তা</p>
                <p class="text-xl sm:text-2xl font-black text-indigo-700 mt-0.5">{{ $todayMessages }}</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        </div>
    </div>

    {{-- Filter Bar --}}
    <div class="bg-white p-3.5 rounded-2xl border border-slate-200/80 shadow-xs flex flex-col md:flex-row items-center justify-between gap-3">
        <div class="flex items-center gap-1.5 w-full md:w-auto overflow-x-auto pb-1 md:pb-0">
            <a href="{{ route('admin.contact-messages.index') }}"
               class="px-3 py-1.5 rounded-xl text-xs font-bold transition whitespace-nowrap {{ !request('status') ? 'bg-emerald-600 text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                সকল বার্তা ({{ $totalMessages }})
            </a>
            <a href="{{ route('admin.contact-messages.index', ['status' => 'unread']) }}"
               class="px-3 py-1.5 rounded-xl text-xs font-bold transition whitespace-nowrap {{ request('status') === 'unread' ? 'bg-amber-500 text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                অপঠিত ({{ $unreadMessages }})
            </a>
            <a href="{{ route('admin.contact-messages.index', ['status' => 'read']) }}"
               class="px-3 py-1.5 rounded-xl text-xs font-bold transition whitespace-nowrap {{ request('status') === 'read' ? 'bg-emerald-600 text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                পঠিত ({{ $readMessages }})
            </a>
        </div>

        <form method="GET" action="{{ route('admin.contact-messages.index') }}" class="w-full md:w-72 flex items-center gap-2">
            @if(request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif
            <div class="relative w-full">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="নাম, ফোন, বিষয় খুঁজুন..."
                       class="w-full pl-9 pr-3 py-1.5 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                <svg class="w-4 h-4 text-slate-400 absolute left-2.5 top-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            @if(request('search'))
                <a href="{{ route('admin.contact-messages.index', request()->only('status')) }}" class="p-1.5 text-slate-400 hover:text-slate-600 text-xs">মুছুন</a>
            @endif
        </form>
    </div>

    {{-- Messages Table (Compact, No Scrollbar) --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
        <table class="w-full table-auto text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                    <th class="py-2.5 px-3.5 w-12 text-center">ক্রম</th>
                    <th class="py-2.5 px-3.5 w-56">প্রেরক / যোগাযোগ</th>
                    <th class="py-2.5 px-3.5">বিষয় ও বার্তা</th>
                    <th class="py-2.5 px-3.5 w-32 whitespace-nowrap">তারিখ</th>
                    <th class="py-2.5 px-3.5 w-24 text-center whitespace-nowrap">অবস্থা</th>
                    <th class="py-2.5 px-3.5 w-28 text-right whitespace-nowrap">অ্যাকশন</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-xs">
                @forelse($messages as $index => $msg)
                    <tr class="transition hover:bg-slate-50/80 {{ !$msg->is_read ? 'bg-amber-50/30 font-medium' : '' }}">
                        <td class="py-2.5 px-3.5 text-center text-slate-400 font-mono">
                            {{ $messages->firstItem() + $index }}
                        </td>

                        <td class="py-2.5 px-3.5">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-lg {{ !$msg->is_read ? 'bg-amber-100 text-amber-700 font-bold' : 'bg-slate-100 text-slate-600' }} flex items-center justify-center text-xs shrink-0">
                                    {{ mb_substr($msg->name, 0, 1) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="font-bold text-slate-900 truncate">{{ $msg->name }}</p>
                                    <div class="flex items-center gap-1.5 text-[11px] text-slate-500 mt-0.5">
                                        <a href="tel:{{ $msg->phone }}" class="hover:text-emerald-700 font-mono">{{ $msg->phone }}</a>
                                        @if($msg->email)
                                            <span class="text-slate-300">•</span>
                                            <span class="truncate max-w-[120px]" title="{{ $msg->email }}">{{ $msg->email }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="py-2.5 px-3.5">
                            @if($msg->subject)
                                <span class="font-bold text-slate-800">{{ $msg->subject }}</span>
                                <span class="text-slate-400 mx-1">—</span>
                            @endif
                            <span class="text-slate-600 line-clamp-1 break-words">
                                {{ Str::limit($msg->message, 90) }}
                            </span>
                        </td>

                        <td class="py-2.5 px-3.5 whitespace-nowrap text-slate-500 text-[11px]">
                            <p class="font-mono text-slate-700">{{ $msg->created_at->format('d M, Y') }}</p>
                            <p class="text-[10px] text-slate-400">{{ $msg->created_at->format('h:i A') }} ({{ $msg->created_at->diffForHumans() }})</p>
                        </td>

                        <td class="py-2.5 px-3.5 text-center whitespace-nowrap">
                            @if(!$msg->is_read)
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    অপঠিত
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-600">
                                    পঠিত
                                </span>
                            @endif
                        </td>

                        <td class="py-2.5 px-3.5 text-right whitespace-nowrap">
                            <div class="flex items-center justify-end gap-1">
                                {{-- View Details --}}
                                <a href="{{ route('admin.contact-messages.show', $msg->id) }}"
                                   title="বার্তা দেখুন"
                                   class="p-1.5 rounded-lg text-slate-500 hover:text-emerald-700 hover:bg-emerald-50 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>

                                {{-- Toggle Read / Unread --}}
                                <form method="POST" action="{{ route('admin.contact-messages.toggle-read', $msg->id) }}" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            title="{{ $msg->is_read ? 'অপঠিত চিহ্নিত করুন' : 'পঠিত চিহ্নিত করুন' }}"
                                            class="p-1.5 rounded-lg {{ $msg->is_read ? 'text-slate-400 hover:text-amber-600 hover:bg-amber-50' : 'text-amber-600 hover:text-emerald-600 hover:bg-emerald-50' }} transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </button>
                                </form>

                                {{-- Delete --}}
                                <form method="POST" action="{{ route('admin.contact-messages.destroy', $msg->id) }}"
                                      onsubmit="return confirm('আপনি কি নিশ্চিত যে এই বার্তাটি মুছে ফেলতে চান?');"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="মুছে ফেলুন"
                                            class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-slate-400">
                            <div class="max-w-xs mx-auto text-center space-y-2">
                                <svg class="w-10 h-10 mx-auto text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <p class="text-sm font-bold text-slate-700">কোনো বার্তা পাওয়া যায়নি</p>
                                <p class="text-xs text-slate-400">ইনবক্সে বর্তমানে কোনো বার্তা নেই।</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($messages->hasPages())
            <div class="p-3 border-t border-slate-100 bg-slate-50/50">
                {{ $messages->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
