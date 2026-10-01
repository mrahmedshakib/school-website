<footer class="bg-[#05172d] text-slate-300 relative border-t-4 border-accent-500">

    {{-- =========================================================
        MAIN FOOTER
    ========================================================== --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">

            {{-- =================================================
                ABOUT
            ================================================== --}}
            <div>

                <a href="{{ route('home') }}"
                   class="inline-flex items-center gap-3 group">

                    {{-- Logo --}}
                    @if(isset($websiteSetting) && $websiteSetting->logo)
                        <img src="{{ asset($websiteSetting->logo) }}"
                             alt="{{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name }}"
                             class="w-14 h-14 rounded-2xl object-contain bg-white p-1.5 transition-transform duration-300 group-hover:scale-105 shadow-md shadow-black/20">
                    @else
                        <div class="w-12 h-12 rounded-2xl bg-brand-700
                                    flex items-center justify-center
                                    transition-transform duration-300
                                    group-hover:scale-105 text-white font-bold text-xl shadow-md">
                            B
                        </div>
                    @endif

                    {{-- Brand --}}
                    <div>

                        <div class="text-white font-black text-base leading-tight">
                            {{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'আমাদের বিদ্যালয়' }}
                        </div>

                        @if(isset($websiteSetting) && $websiteSetting->tagline)
                            <div class="text-xs text-accent-400 font-semibold mt-1">
                                {{ $websiteSetting->tagline }}
                            </div>
                        @endif

                    </div>

                </a>

                @if(isset($websiteSetting) && $websiteSetting->footer_text)
                    <p class="mt-5 text-sm leading-7 text-slate-300/80">
                        {{ $websiteSetting->footer_text }}
                    </p>
                @endif

            </div>


            {{-- =================================================
                QUICK LINKS
            ================================================== --}}
            <div>

                <h3 class="text-white font-bold text-lg tracking-wide flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-accent-500"></span>
                    গুরুত্বপূর্ণ লিংক
                </h3>

                <ul class="mt-5 space-y-2.5">

                    <li>
                        <a href="{{ route('about') }}"
                           class="text-sm text-slate-300/80 hover:text-accent-300 transition-colors flex items-center gap-1.5">
                            <span>›</span> আমাদের কথা
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('mission-vision') }}"
                           class="text-sm text-slate-300/80 hover:text-accent-300 transition-colors flex items-center gap-1.5">
                            <span>›</span> লক্ষ্য ও উদ্দেশ্য
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('leadership') }}"
                           class="text-sm text-slate-300/80 hover:text-accent-300 transition-colors flex items-center gap-1.5">
                            <span>›</span> নেতৃত্ব
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('administration') }}"
                           class="text-sm text-slate-300/80 hover:text-accent-300 transition-colors flex items-center gap-1.5">
                            <span>›</span> প্রশাসন
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('notice') }}"
                           class="text-sm text-slate-300/80 hover:text-accent-300 transition-colors flex items-center gap-1.5">
                            <span>›</span> নোটিশ
                        </a>
                    </li>

                </ul>

            </div>


            {{-- =================================================
                ACADEMIC
            ================================================== --}}
            <div>

                <h3 class="text-white font-bold text-lg tracking-wide flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-accent-500"></span>
                    একাডেমিক
                </h3>

                <ul class="mt-5 space-y-2.5">

                    <li>
                        <a href="{{ route('syllabus') }}"
                           class="text-sm text-slate-300/80 hover:text-accent-300 transition-colors flex items-center gap-1.5">
                            <span>›</span> সিলেবাস
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('class-routine') }}"
                           class="text-sm text-slate-300/80 hover:text-accent-300 transition-colors flex items-center gap-1.5">
                            <span>›</span> ক্লাস রুটিন
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('exam-routine') }}"
                           class="text-sm text-slate-300/80 hover:text-accent-300 transition-colors flex items-center gap-1.5">
                            <span>›</span> পরীক্ষার রুটিন
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('subjects') }}"
                           class="text-sm text-slate-300/80 hover:text-accent-300 transition-colors flex items-center gap-1.5">
                            <span>›</span> বিষয়সমূহ
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('results') }}"
                           class="text-sm text-slate-300/80 hover:text-accent-300 transition-colors flex items-center gap-1.5">
                            <span>›</span> ফলাফল
                        </a>
                    </li>

                </ul>

            </div>


            {{-- =================================================
                CONTACT
            ================================================== --}}
            <div>

                <h3 class="text-white font-bold text-lg tracking-wide flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-accent-500"></span>
                    যোগাযোগ করুন
                </h3>

                <div class="mt-5 space-y-4 text-sm">

                    {{-- Address --}}
                    @if(isset($websiteSetting) && $websiteSetting->address)
                        <div>
                            <p class="text-xs uppercase tracking-wider font-bold text-slate-400">
                                ঠিকানা
                            </p>
                            <p class="mt-1 text-slate-200 leading-6">
                                {!! nl2br(e($websiteSetting->address)) !!}
                            </p>
                        </div>
                    @endif

                    {{-- Phone --}}
                    @if(isset($websiteSetting) && ($websiteSetting->phone || $websiteSetting->mobile))
                        <div>
                            <p class="text-xs uppercase tracking-wider font-bold text-slate-400">
                                ফোন / মোবাইল
                            </p>
                            @if($websiteSetting->phone)
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $websiteSetting->phone) }}"
                                   class="mt-1 block text-slate-200 hover:text-accent-300 transition font-medium">
                                    ☎ {{ $websiteSetting->phone }}
                                </a>
                            @endif
                            @if($websiteSetting->mobile)
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $websiteSetting->mobile) }}"
                                   class="mt-1 block text-slate-200 hover:text-accent-300 transition font-medium">
                                    📱 {{ $websiteSetting->mobile }}
                                </a>
                            @endif
                        </div>
                    @endif

                    {{-- Email --}}
                    @if(isset($websiteSetting) && $websiteSetting->email)
                        <div>
                            <p class="text-xs uppercase tracking-wider font-bold text-slate-400">
                                ই-মেইল
                            </p>
                            <a href="mailto:{{ $websiteSetting->email }}"
                               class="mt-1 inline-block text-slate-200 hover:text-accent-300 transition break-all font-medium">
                                ✉ {{ $websiteSetting->email }}
                            </a>
                        </div>
                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        FOOTER BOTTOM
    ========================================================== --}}
    <div class="border-t border-white/10 bg-[#031020]">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col lg:flex-row items-center justify-between gap-4">

            {{-- Copyright --}}
            <p class="text-xs sm:text-sm text-slate-400 text-center lg:text-left">
                © {{ date('Y') }} {{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'আমাদের বিদ্যালয়' }}। সর্বস্বত্ব সংরক্ষিত।
            </p>

            {{-- Developer Credits --}}
            <div class="flex flex-wrap items-center justify-center gap-2 text-xs sm:text-sm text-slate-400">
                <span>Developed by</span>
                <a href="https://mrahmedshakib.github.io/" target="_blank" rel="noopener noreferrer"
                   class="font-bold text-accent-400 hover:text-accent-300 transition underline underline-offset-4 decoration-accent-500/40 hover:decoration-accent-400">
                    Imtiaz Ahmed
                </a>
                <span class="text-slate-600">•</span>
                <a href="https://mrahmedshakib.github.io/" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-white/5 border border-white/10 text-xs text-slate-300 hover:text-white hover:bg-white/10 transition">
                    <svg class="w-3.5 h-3.5 text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span>Portfolio</span>
                </a>
                <a href="https://www.linkedin.com/in/mrahmedshakib/" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-[#0077b5]/15 border border-[#0077b5]/30 text-xs text-blue-200 hover:text-white hover:bg-[#0077b5]/30 transition">
                    <svg class="w-3.5 h-3.5 fill-current text-[#0077b5]" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    <span>LinkedIn</span>
                </a>
            </div>

            {{-- Bottom Links --}}
            <div class="flex items-center gap-5">

                <a href="{{ route('contact') }}"
                   class="text-xs sm:text-sm text-slate-400
                          hover:text-accent-300 transition">
                    যোগাযোগ
                </a>

                <a href="{{ route('admission') }}"
                   class="text-xs sm:text-sm text-slate-400
                          hover:text-accent-300 transition">
                    ভর্তি
                </a>

            </div>

        </div>

    </div>

</footer>