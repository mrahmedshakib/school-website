<footer class="bg-slate-950 text-slate-300"
        style="font-family: 'Noto Sans Bengali', sans-serif;">

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
                             class="w-12 h-12 rounded-xl object-contain bg-white p-1 transition-transform duration-300 group-hover:scale-105 shadow-sm">
                    @else
                        <div class="w-11 h-11 rounded-xl bg-white
                                    flex items-center justify-center
                                    transition-transform duration-300
                                    group-hover:scale-105">
                            <span class="text-slate-950 font-bold text-lg">
                                B
                            </span>
                        </div>
                    @endif

                    {{-- Brand --}}
                    <div>

                        <div class="text-white font-bold text-base leading-tight">
                            {{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'আমাদের বিদ্যালয়' }}
                        </div>

                        @if(isset($websiteSetting) && $websiteSetting->tagline)
                            <div class="text-xs text-slate-400 mt-1">
                                {{ $websiteSetting->tagline }}
                            </div>
                        @endif

                    </div>

                </a>

                @if(isset($websiteSetting) && $websiteSetting->footer_text)
                    <p class="mt-5 text-sm leading-7 text-slate-400">
                        {{ $websiteSetting->footer_text }}
                    </p>
                @endif

            </div>


            {{-- =================================================
                QUICK LINKS
            ================================================== --}}
            <div>

                <h3 class="text-white font-semibold text-lg">
                    গুরুত্বপূর্ণ লিংক
                </h3>

                <ul class="mt-5 space-y-3">

                    <li>
                        <a href="{{ route('about') }}"
                           class="text-sm text-slate-400
                                  hover:text-white transition">
                            আমাদের কথা
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('mission-vision') }}"
                           class="text-sm text-slate-400
                                  hover:text-white transition">
                            লক্ষ্য ও উদ্দেশ্য
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('leadership') }}"
                           class="text-sm text-slate-400
                                  hover:text-white transition">
                            নেতৃত্ব
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('administration') }}"
                           class="text-sm text-slate-400
                                  hover:text-white transition">
                            প্রশাসন
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('notice') }}"
                           class="text-sm text-slate-400
                                  hover:text-white transition">
                            নোটিশ
                        </a>
                    </li>

                </ul>

            </div>


            {{-- =================================================
                ACADEMIC
            ================================================== --}}
            <div>

                <h3 class="text-white font-semibold text-lg">
                    একাডেমিক
                </h3>

                <ul class="mt-5 space-y-3">

                    <li>
                        <a href="{{ route('syllabus') }}"
                           class="text-sm text-slate-400
                                  hover:text-white transition">
                            সিলেবাস
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('class-routine') }}"
                           class="text-sm text-slate-400
                                  hover:text-white transition">
                            ক্লাস রুটিন
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('exam-routine') }}"
                           class="text-sm text-slate-400
                                  hover:text-white transition">
                            পরীক্ষার রুটিন
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('subjects') }}"
                           class="text-sm text-slate-400
                                  hover:text-white transition">
                            বিষয়সমূহ
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('results') }}"
                           class="text-sm text-slate-400
                                  hover:text-white transition">
                            ফলাফল
                        </a>
                    </li>

                </ul>

            </div>


            {{-- =================================================
                CONTACT
            ================================================== --}}
            <div>

                <h3 class="text-white font-semibold text-lg">
                    যোগাযোগ করুন
                </h3>

                <div class="mt-5 space-y-5 text-sm">

                    {{-- Address --}}
                    @if(isset($websiteSetting) && $websiteSetting->address)
                        <div>
                            <p class="text-slate-500">
                                ঠিকানা
                            </p>
                            <p class="mt-1 text-slate-300 leading-6">
                                {!! nl2br(e($websiteSetting->address)) !!}
                            </p>
                        </div>
                    @endif

                    {{-- Phone --}}
                    @if(isset($websiteSetting) && ($websiteSetting->phone || $websiteSetting->mobile))
                        <div>
                            <p class="text-slate-500">
                                ফোন / মোবাইল
                            </p>
                            @if($websiteSetting->phone)
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $websiteSetting->phone) }}"
                                   class="mt-1 block text-slate-300 hover:text-white transition">
                                    ☎ {{ $websiteSetting->phone }}
                                </a>
                            @endif
                            @if($websiteSetting->mobile)
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $websiteSetting->mobile) }}"
                                   class="mt-1 block text-slate-300 hover:text-white transition">
                                    📱 {{ $websiteSetting->mobile }}
                                </a>
                            @endif
                        </div>
                    @endif

                    {{-- Email --}}
                    @if(isset($websiteSetting) && $websiteSetting->email)
                        <div>
                            <p class="text-slate-500">
                                ই-মেইল
                            </p>
                            <a href="mailto:{{ $websiteSetting->email }}"
                               class="mt-1 inline-block text-slate-300 hover:text-white transition break-all">
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
    <div class="border-t border-white/10">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8
                    py-6 flex flex-col md:flex-row
                    items-center justify-between gap-4">

            {{-- Copyright --}}
            <p class="text-sm text-slate-500 text-center md:text-left">
                © {{ date('Y') }} {{ $websiteSetting->school_name_bn ?? $websiteSetting->school_name ?? 'আমাদের বিদ্যালয়' }}। সর্বস্বত্ব সংরক্ষিত।
            </p>


            {{-- Bottom Links --}}
            <div class="flex items-center gap-5">

                <a href="{{ route('contact') }}"
                   class="text-sm text-slate-500
                          hover:text-white transition">
                    যোগাযোগ
                </a>

                <a href="{{ route('admission') }}"
                   class="text-sm text-slate-500
                          hover:text-white transition">
                    ভর্তি
                </a>

            </div>

        </div>

    </div>

</footer>