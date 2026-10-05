@extends('backend.layouts.app')

@section('title', 'Events & Programs')
@section('page_title', 'Events & Programs')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                Events & Programs
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Manage upcoming academic seminars, sports tournaments, cultural functions, and celebrations.
            </p>
        </div>

        <a href="{{ route('admin.events.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add New Event
        </a>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900">All Scheduled Events</h2>
                <p class="text-xs text-slate-400 mt-0.5">Total {{ $events->total() }} events recorded</p>
            </div>
            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-slate-100 text-slate-600">
                Page {{ $events->currentPage() }} of {{ $events->lastPage() }}
            </span>
        </div>

        @if($events->count())
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-3 py-2.5 w-10 text-center">#</th>
                            <th class="px-3 py-2.5 w-14 text-center">ব্যানার</th>
                            <th class="px-3.5 py-2.5">ইভেন্টের নাম ও বিবরণ</th>
                            <th class="px-3 py-2.5 w-32 whitespace-nowrap">তারিখ ও সময়</th>
                            <th class="px-3 py-2.5 w-28 whitespace-nowrap">স্থান</th>
                            <th class="px-3 py-2.5 w-20 text-center whitespace-nowrap">অবস্থা</th>
                            <th class="px-3 py-2.5 w-20 text-right whitespace-nowrap">অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @foreach($events as $event)
                            <tr class="hover:bg-slate-50/70 transition">
                                <td class="px-3 py-2.5 text-center font-mono text-slate-400">
                                    {{ $events->firstItem() + $loop->index }}
                                </td>

                                <td class="px-3 py-2.5 text-center">
                                    @if($event->image)
                                        <img src="{{ asset($event->image) }}" alt="{{ $event->title }}" class="w-10 h-10 rounded-lg object-cover border border-slate-200 shadow-xs mx-auto">
                                    @else
                                        <div class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm border border-emerald-100 mx-auto">
                                            📅
                                        </div>
                                    @endif
                                </td>

                                <td class="px-3.5 py-2.5">
                                    <h3 class="font-bold text-slate-900 line-clamp-1 hover:text-emerald-600 transition">
                                        {{ $event->title }}
                                    </h3>
                                    @if($event->description)
                                        <p class="text-[11px] text-slate-500 mt-0.5 line-clamp-1">
                                            {{ strip_tags($event->description) }}
                                        </p>
                                    @endif
                                </td>

                                <td class="px-3 py-2.5 whitespace-nowrap">
                                    <div class="font-bold text-slate-800 text-[11px] font-mono">
                                        {{ \Carbon\Carbon::parse($event->event_date)->format('d M, Y') }}
                                    </div>
                                    @if($event->event_time)
                                        <p class="text-[10px] text-slate-400 mt-0.5">
                                            ⏰ {{ $event->event_time }}
                                        </p>
                                    @endif
                                </td>

                                <td class="px-3 py-2.5 whitespace-nowrap text-[11px] text-slate-600">
                                    <span class="truncate max-w-[120px] block" title="{{ $event->location ?? 'ক্যাম্পাস' }}">
                                        📍 {{ $event->location ?? 'ক্যাম্পাস' }}
                                    </span>
                                </td>

                                <td class="px-3 py-2.5 text-center whitespace-nowrap">
                                    @if($event->status)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                            সক্রিয়
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-600">
                                            নিষ্ক্রিয়
                                        </span>
                                    @endif
                                </td>

                                <td class="px-3 py-2.5 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.events.edit', $event->id) }}" class="p-1.5 rounded-lg text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 transition" title="সম্পাদনা">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই ইভেন্টটি মুছে ফেলতে চান?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition" title="মুছুন">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($events->hasPages())
                <div class="px-6 py-4 border-t border-slate-100">
                    {{ $events->links() }}
                </div>
            @endif
        @else
            {{-- Empty State --}}
            <div class="p-12 text-center">
                <div class="w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-3xl mx-auto mb-4">
                    📅
                </div>
                <h3 class="text-base font-bold text-slate-900">No Events Added Yet</h3>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 mb-6 max-w-sm mx-auto">
                    Create your first school event or upcoming seminar to show on the website events calendar.
                </p>
                <a href="{{ route('admin.events.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                    + Add Event
                </a>
            </div>
        @endif
    </div>

</div>
@endsection