@extends('frontend.layouts.app')

@section('title', app()->getLocale() === 'en' ? 'Video Gallery | ' . ($websiteSetting->site_title ?? 'School') : 'ভিডিও গ্যালারি | ' . ($websiteSetting->site_title ?? 'বিদ্যালয়'))

@section('content')
<section class="bg-gradient-to-b from-blue-50/50 via-slate-50 to-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb & Title --}}
        <div class="mb-8">
            <nav class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">{{ app()->getLocale() === 'en' ? 'Home' : 'হোম' }}</a>
                <span>/</span>
                <span class="text-blue-600">{{ app()->getLocale() === 'en' ? 'Video Gallery' : 'ভিডিও গ্যালারি' }}</span>
            </nav>
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                        🎬 {{ app()->getLocale() === 'en' ? 'Campus Media & Events' : 'বিদ্যালয়ের প্রামাণ্যচিত্র ও অনুষ্ঠান' }}
                    </span>
                    <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
                        {{ app()->getLocale() === 'en' ? 'Campus Video Gallery' : 'ভিডিও গ্যালারি ও অনুষ্ঠানমালা' }}
                    </h1>
                    <p class="mt-2 text-slate-600 max-w-2xl text-sm sm:text-base">
                        {{ app()->getLocale() === 'en' ? 'Watch memorable moments, annual sports, cultural events and academic highlights of our institution.' : 'বিদ্যালয়ের বার্ষিক ক্রীড়া, সাংস্কৃতিক সন্ধ্যা, জাতীয় দিবস উদযাপন ও ডকুমেন্টারি ভিডিও দেখুন।' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Videos Grid --}}
        @if($videos->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($videos as $video)
                    @php
                        $videoId = $video->video_id;
                        if (!$videoId && $video->youtube_url) {
                            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video->youtube_url, $matches)) {
                                $videoId = $matches[1];
                            }
                        }
                        $thumb = $video->thumbnail ? asset($video->thumbnail) : ($videoId ? "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg" : null);
                    @endphp

                    <div class="group bg-white rounded-3xl overflow-hidden border border-slate-200/90 hover:border-red-300 hover:shadow-xl transition-all duration-300 flex flex-col justify-between">
                        <div>
                            {{-- Video Thumbnail with Play Button --}}
                            <div class="relative aspect-video bg-slate-900 overflow-hidden cursor-pointer" onclick="openVideoModal('{{ $videoId }}', '{{ addslashes($video->title) }}')">
                                @if($thumb)
                                    <img src="{{ $thumb }}" alt="{{ $video->title }}" class="w-full h-full object-cover group-hover:scale-105 group-hover:opacity-80 transition duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-slate-800 text-white text-4xl">
                                        ▶️
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/10 transition flex items-center justify-center">
                                    <div class="w-14 h-14 rounded-full bg-red-600 text-white flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                        <svg class="w-6 h-6 ml-0.5 fill-current" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                    </div>
                                </div>

                                @if($video->category)
                                    <div class="absolute top-3 left-3">
                                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-xs font-semibold bg-black/70 text-white backdrop-blur-md">
                                            {{ $video->category }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <div class="p-6">
                                <h3 class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-red-600 transition mb-2">
                                    {{ $video->title }}
                                </h3>

                                @if($video->description)
                                    <p class="text-xs text-slate-500 leading-relaxed line-clamp-2">
                                        {{ $video->description }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="p-6 pt-0 border-t border-slate-100 flex items-center justify-between gap-3 mt-auto">
                            <span class="text-xs text-slate-400">
                                {{ $video->created_at ? $video->created_at->format('d M, Y') : '' }}
                            </span>
                            <button type="button" onclick="openVideoModal('{{ $videoId }}', '{{ addslashes($video->title) }}')" class="inline-flex items-center gap-1.5 text-xs font-bold text-red-600 hover:text-red-700 transition">
                                <span>{{ app()->getLocale() === 'en' ? 'Watch Video' : 'ভিডিও দেখুন' }}</span>
                                <span>▶</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $videos->links() }}
            </div>
        @else
            <div class="bg-white rounded-2xl p-12 text-center border border-slate-200 shadow-sm">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-2xl text-slate-400 mb-4">
                    🎬
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1">
                    {{ app()->getLocale() === 'en' ? 'No videos uploaded yet' : 'এখনো কোনো ভিডিও সংযুক্ত করা হয়নি' }}
                </h3>
                <p class="text-sm text-slate-500">
                    {{ app()->getLocale() === 'en' ? 'Event videos will be posted here soon.' : 'অনুষ্ঠানের ভিডিও শীঘ্রই এখানে প্রকাশ করা হবে।' }}
                </p>
            </div>
        @endif
    </div>
</section>

{{-- Video Lightbox Modal --}}
<div id="videoModal" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="relative w-full max-w-4xl bg-slate-900 rounded-3xl overflow-hidden shadow-2xl border border-slate-700">
        <div class="flex items-center justify-between p-4 bg-slate-950 text-white border-b border-slate-800">
            <h3 id="modalVideoTitle" class="text-sm sm:text-base font-bold truncate pr-4 text-slate-200"></h3>
            <button type="button" onclick="closeVideoModal()" class="w-9 h-9 rounded-full bg-slate-800 hover:bg-slate-700 flex items-center justify-center text-slate-300 hover:text-white transition">
                ✕
            </button>
        </div>
        <div class="relative aspect-video w-full bg-black">
            <iframe id="modalVideoIframe" class="w-full h-full" src="" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>

<script>
    function openVideoModal(videoId, title) {
        if (!videoId) return;
        document.getElementById('modalVideoTitle').innerText = title;
        document.getElementById('modalVideoIframe').src = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1';
        document.getElementById('videoModal').classList.remove('hidden');
    }

    function closeVideoModal() {
        document.getElementById('modalVideoIframe').src = '';
        document.getElementById('videoModal').classList.add('hidden');
    }

    document.getElementById('videoModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeVideoModal();
        }
    });
</script>
@endsection
