{{-- =========================================================
    DEVELOPER PROFILE & CONTACT MODAL (Dynamic From DB) - Light Theme
========================================================== --}}
@php
    $devSetting = $websiteSetting ?? \App\Models\WebsiteSetting::first();
    $devNameBn = $devSetting?->developer_name ?? 'ইমতিয়াজ আহমেদ';
    $devNameEn = $devSetting?->developer_name_en ?? 'Imtiaz Ahmed';
    $devUsername = $devSetting?->developer_username ?? 'mrahmedshakib';
    $devRole = $devSetting?->developer_role ?? 'Full-Stack Web & Software Engineer';
    $devEmail = $devSetting?->developer_email ?? 'ahmedshakib37@gmail.com';
    $devPhone = $devSetting?->developer_phone ?? $devSetting?->developer_whatsapp ?? '01767056733';
    $devPhoto = $devSetting?->developer_photo ?? 'https://avatars.githubusercontent.com/u/36819643?v=4';
    $devPortfolio = $devSetting?->developer_portfolio ?? 'https://mrahmedshakib.github.io/';
    $devLinkedIn = $devSetting?->developer_linkedin ?? 'https://www.linkedin.com/in/mrahmedshakib/';
    $devGitHub = $devSetting?->developer_github ?? 'https://github.com/mrahmedshakib';
    $devWhatsappMsg = $devSetting?->developer_whatsapp_message ?: ('হ্যালো ' . $devNameBn . ', আমি আপনার তৈরিকৃত ওয়েবসাইটটি দেখেছি। নতুন ওয়েবসাইট/সফটওয়্যার নিয়ে কথা বলতে চাই।');
    $devNote = $devSetting?->developer_contact_note ?: 'নতুন ওয়েবসাইট, সফটওয়্যার বা যে কোনো প্রজেক্ট সংক্রান্ত বিষয়ে সরাসরি যোগাযোগ করতে পারেন:';

    // WhatsApp URL
    $cleanPhone = preg_replace('/[^0-9]/', '', (string)$devPhone);
    if (!empty($cleanPhone) && !str_starts_with($cleanPhone, '880') && str_starts_with($cleanPhone, '0')) {
        $cleanPhone = '88' . $cleanPhone;
    }
    $whatsappUrl = 'https://wa.me/' . ($cleanPhone ?: '8801767056733') . '?text=' . rawurlencode($devWhatsappMsg);
@endphp

<div id="developerContactModal"
     class="fixed inset-0 z-50 hidden overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 transition-all duration-200"
     onclick="if(event.target === this) closeDeveloperContactModal();">

    <div class="relative w-full max-w-md bg-white rounded-3xl shadow-2xl border border-slate-200 overflow-hidden transform transition-all duration-200 scale-95 opacity-0 text-slate-800"
         id="devModalCard">

        {{-- Header Section (Light Theme) --}}
        <div class="relative bg-gradient-to-br from-emerald-50/70 via-teal-50/50 to-slate-50 p-6 border-b border-slate-100">
            {{-- Close Button --}}
            <button type="button" onclick="closeDeveloperContactModal()"
                    class="absolute top-4 right-4 w-8 h-8 rounded-full bg-white hover:bg-slate-100 text-slate-400 hover:text-slate-700 flex items-center justify-center transition border border-slate-200 shadow-xs cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            {{-- Avatar & Info --}}
            <div class="flex items-center gap-4">
                <div class="relative shrink-0">
                    <img src="{{ $devPhoto }}"
                         alt="{{ $devNameEn }}"
                         class="w-16 h-16 rounded-2xl object-cover border-2 border-emerald-500 shadow-sm bg-slate-100"
                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($devNameEn) }}&background=10b981&color=fff&size=128'">
                    <span class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full bg-emerald-500 border-2 border-white" title="Active"></span>
                </div>

                <div class="min-w-0 flex-1 pr-4">
                    <h3 class="text-lg font-bold text-slate-900 leading-tight">{{ $devNameBn }}</h3>
                    <p class="text-xs font-semibold text-emerald-700 mt-0.5">
                        {{ $devNameEn }}
                        @if($devUsername)
                            <span class="font-normal text-slate-500">({{ '@' . ltrim($devUsername, '@') }})</span>
                        @endif
                    </p>
                    <p class="text-xs text-slate-600 mt-0.5 font-medium">{{ $devRole }}</p>
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="p-6 space-y-4 text-xs">

            <p class="text-slate-600 text-center leading-relaxed">
                {{ $devNote }}
            </p>

            {{-- WhatsApp Button --}}
            <a href="{{ $whatsappUrl }}"
               target="_blank" rel="noopener noreferrer"
               class="w-full py-3 px-4 rounded-2xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold transition flex items-center justify-center gap-2 shadow-sm cursor-pointer text-sm">
                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                <span>WhatsApp এ চ্যাট করুন</span>
            </a>

            {{-- Email Box with Copy --}}
            @if($devEmail)
            <div class="p-3 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-between gap-2">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-8 h-8 rounded-xl bg-slate-200 text-slate-700 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Email Address</p>
                        <a href="mailto:{{ $devEmail }}" class="font-bold text-slate-800 hover:text-emerald-600 truncate block">
                            {{ $devEmail }}
                        </a>
                    </div>
                </div>
                <button type="button" onclick="copyEmailToClipboard(this)"
                        class="px-2.5 py-1 rounded-lg bg-white border border-slate-200 text-slate-600 hover:text-emerald-700 hover:bg-emerald-50 text-[11px] font-semibold transition cursor-pointer shrink-0">
                    Copy
                </button>
            </div>
            @endif

            {{-- Links Grid (Portfolio, LinkedIn, GitHub) --}}
            <div class="grid grid-cols-3 gap-2 pt-1">
                {{-- Portfolio --}}
                @if($devPortfolio)
                <a href="{{ $devPortfolio }}" target="_blank" rel="noopener noreferrer"
                   class="p-2.5 rounded-xl border border-slate-200 hover:border-emerald-500 hover:bg-emerald-50/50 transition flex flex-col items-center text-center group bg-slate-50/60">
                    <span class="text-lg mb-0.5">🌐</span>
                    <span class="font-bold text-slate-800 group-hover:text-emerald-700">Portfolio</span>
                    <span class="text-[10px] text-slate-400">Website</span>
                </a>
                @endif

                {{-- LinkedIn --}}
                @if($devLinkedIn)
                <a href="{{ $devLinkedIn }}" target="_blank" rel="noopener noreferrer"
                   class="p-2.5 rounded-xl border border-slate-200 hover:border-blue-500 hover:bg-blue-50/50 transition flex flex-col items-center text-center group bg-slate-50/60">
                    <div class="w-5 h-5 flex items-center justify-center mb-0.5">
                        <svg class="w-4 h-4 fill-current text-[#0077b5]" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </div>
                    <span class="font-bold text-slate-800 group-hover:text-blue-700">LinkedIn</span>
                    <span class="text-[10px] text-slate-400">Profile</span>
                </a>
                @endif

                {{-- GitHub --}}
                @if($devGitHub)
                <a href="{{ $devGitHub }}" target="_blank" rel="noopener noreferrer"
                   class="p-2.5 rounded-xl border border-slate-200 hover:border-slate-800 hover:bg-slate-100 transition flex flex-col items-center text-center group bg-slate-50/60">
                    <div class="w-5 h-5 flex items-center justify-center mb-0.5">
                        <svg class="w-4 h-4 fill-current text-slate-800" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                    </div>
                    <span class="font-bold text-slate-800 group-hover:text-slate-900">GitHub</span>
                    <span class="text-[10px] text-slate-400">Projects</span>
                </a>
                @endif
            </div>

        </div>

        {{-- Footer --}}
        <div class="px-6 py-3 bg-slate-50 border-t border-slate-100 text-center text-[11px] text-slate-400">
            Crafted by <span class="font-semibold text-slate-700">{{ $devNameEn }}</span>
        </div>
    </div>
</div>

<script>
    function openDeveloperContactModal() {
        const modal = document.getElementById('developerContactModal');
        const card = document.getElementById('devModalCard');
        if (!modal || !card) return;

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        setTimeout(() => {
            card.classList.remove('scale-95', 'opacity-0');
            card.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeDeveloperContactModal() {
        const modal = document.getElementById('developerContactModal');
        const card = document.getElementById('devModalCard');
        if (!modal || !card) return;

        card.classList.remove('scale-100', 'opacity-100');
        card.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 200);
    }

    function copyEmailToClipboard(btn) {
        const email = '{{ $devEmail }}';
        navigator.clipboard.writeText(email).then(() => {
            const originalText = btn.innerText;
            btn.innerText = 'Copied!';
            btn.classList.add('text-emerald-700', 'bg-emerald-50');
            setTimeout(() => {
                btn.innerText = originalText;
                btn.classList.remove('text-emerald-700', 'bg-emerald-50');
            }, 2000);
        }).catch(() => {
            alert('Email: ' + email);
        });
    }

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeveloperContactModal();
        }
    });
</script>
