@extends('backend.layouts.app')

@section('title', 'News & Articles')
@section('page_title', 'News & Articles')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                News & Articles
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Manage press releases, school achievements, campus news, and announcements.
            </p>
        </div>

        <a href="{{ route('admin.news.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Publish News
        </a>
    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-xs overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900">All Published News</h2>
                <p class="text-xs text-slate-400 mt-0.5">Total {{ $news->total() }} news items in database</p>
            </div>
            <span class="text-xs font-semibold px-3 py-1 rounded-full bg-slate-100 text-slate-600">
                Page {{ $news->currentPage() }} of {{ $news->lastPage() }}
            </span>
        </div>

        @if($news->count())
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-3 py-2.5 w-10 text-center">#</th>
                            <th class="px-3 py-2.5 w-14 text-center">ছবি</th>
                            <th class="px-3.5 py-2.5">সংবাদ শিরোনাম ও বিবরণ</th>
                            <th class="px-3 py-2.5 w-28 whitespace-nowrap">প্রকাশের তারিখ</th>
                            <th class="px-3 py-2.5 w-16 text-center whitespace-nowrap">ক্রম</th>
                            <th class="px-3 py-2.5 w-20 text-center whitespace-nowrap">অবস্থা</th>
                            <th class="px-3 py-2.5 w-20 text-right whitespace-nowrap">অ্যাকশন</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @foreach($news as $item)
                            <tr class="hover:bg-slate-50/70 transition">
                                <td class="px-3 py-2.5 text-center font-mono text-slate-400">
                                    {{ $news->firstItem() + $loop->index }}
                                </td>

                                <td class="px-3 py-2.5 text-center">
                                    @if($item->image)
                                        <img src="{{ asset($item->image) }}" alt="{{ $item->title }}" class="w-10 h-10 rounded-lg object-cover border border-slate-200 shadow-xs mx-auto">
                                    @else
                                        <div class="w-10 h-10 rounded-lg bg-slate-100 text-slate-400 flex items-center justify-center text-[10px] font-semibold border border-slate-200 mx-auto">
                                            নেই
                                        </div>
                                    @endif
                                </td>

                                <td class="px-3.5 py-2.5">
                                    <h3 class="font-bold text-slate-900 line-clamp-1 hover:text-emerald-600 transition">
                                        {{ $item->title }}
                                    </h3>
                                    @if($item->short_description)
                                        <p class="text-[11px] text-slate-500 mt-0.5 line-clamp-1">
                                            {{ $item->short_description }}
                                        </p>
                                    @endif
                                </td>

                                <td class="px-3 py-2.5 whitespace-nowrap text-[11px] text-slate-600 font-mono">
                                    @if($item->published_at)
                                        <span>{{ \Carbon\Carbon::parse($item->published_at)->format('d M, Y') }}</span>
                                    @else
                                        <span class="text-slate-400">—</span>
                                    @endif
                                </td>

                                <td class="px-3 py-2.5 text-center whitespace-nowrap font-mono text-slate-500">
                                    {{ $item->sort_order ?? 0 }}
                                </td>

                                <td class="px-3 py-2.5 text-center whitespace-nowrap">
                                    @if($item->status)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                            প্রকাশিত
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-600">
                                            খসড়া
                                        </span>
                                    @endif
                                </td>

                                <td class="px-3 py-2.5 text-right whitespace-nowrap">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="{{ route('admin.news.edit', $item->id) }}" class="p-1.5 rounded-lg text-slate-500 hover:text-emerald-600 hover:bg-emerald-50 transition" title="সম্পাদনা">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>

                                        <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই সংবাদটি মুছে ফেলতে চান?');" class="inline">
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

            @if($news->hasPages())
                <div class="px-6 py-4 border-t border-slate-100">
                    {{ $news->links() }}
                </div>
            @endif
        @else
            {{-- Empty State --}}
            <div class="p-12 text-center">
                <div class="w-16 h-16 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-3xl mx-auto mb-4">
                    📰
                </div>
                <h3 class="text-base font-bold text-slate-900">No News Published Yet</h3>
                <p class="text-xs sm:text-sm text-slate-500 mt-1 mb-6 max-w-sm mx-auto">
                    Publish your first school news, event recap, or press release to keep the website active.
                </p>
                <a href="{{ route('admin.news.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm shadow-sm transition">
                    + Publish News
                </a>
            </div>
        @endif
    </div>

</div>
@endsection