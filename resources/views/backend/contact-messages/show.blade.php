@extends('backend.layouts.app')

@section('title', 'বার্তা বিবরণ - ' . $message->name)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- Breadcrumb & Back --}}
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.contact-messages.index') }}"
           class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl text-xs font-semibold text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 transition shadow-xs">
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>ইনবক্সে ফিরে যান</span>
        </a>

        <div class="flex items-center gap-2">
            {{-- Toggle Read --}}
            <form method="POST" action="{{ route('admin.contact-messages.toggle-read', $message->id) }}" class="inline">
                @csrf
                @method('PATCH')
                <button type="submit"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold {{ $message->is_read ? 'text-amber-700 bg-amber-50 border border-amber-200 hover:bg-amber-100' : 'text-emerald-700 bg-emerald-50 border border-emerald-200 hover:bg-emerald-100' }} transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>{{ $message->is_read ? 'অপঠিত হিসেবে চিহ্নিত করুন' : 'পঠিত হিসেবে চিহ্নিত করুন' }}</span>
                </button>
            </form>

            {{-- Delete --}}
            <form method="POST" action="{{ route('admin.contact-messages.destroy', $message->id) }}"
                  onsubmit="return confirm('আপনি কি নিশ্চিত যে এই বার্তাটি মুছে ফেলতে চান?');"
                  class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold text-rose-700 bg-rose-50 border border-rose-200 hover:bg-rose-100 transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    <span>মুছুন</span>
                </button>
            </form>
        </div>
    </div>

    {{-- Main Message Card --}}
    <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
        {{-- Card Header --}}
        <div class="p-6 sm:p-8 bg-gradient-to-r from-slate-50 to-white border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white font-black text-xl flex items-center justify-center shadow-md">
                    {{ mb_substr($message->name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-xl font-extrabold text-slate-900">{{ $message->name }}</h2>
                    <div class="flex flex-wrap items-center gap-2 mt-1 text-xs text-slate-500">
                        <span>{{ $message->created_at->format('d M, Y - h:i A') }}</span>
                        <span>•</span>
                        <span>{{ $message->created_at->diffForHumans() }}</span>
                        @if($message->ip_address)
                            <span>•</span>
                            <span class="font-mono text-[11px] text-slate-400">IP: {{ $message->ip_address }}</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Quick Contact Actions --}}
            <div class="flex items-center gap-2">
                <a href="tel:{{ $message->phone }}"
                   class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-200 hover:bg-emerald-100 transition shadow-xs">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <span>সরাসরি কল ({{ $message->phone }})</span>
                </a>

                @php
                    $cleanPhone = preg_replace('/[^0-9]/', '', $message->phone);
                    if (str_starts_with($cleanPhone, '01')) {
                        $cleanPhone = '88' . $cleanPhone;
                    }
                @endphp
                <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold text-emerald-800 bg-emerald-100 hover:bg-emerald-200 border border-emerald-300 transition shadow-xs">
                    <span>WhatsApp</span>
                </a>

                @if($message->email)
                    <a href="mailto:{{ $message->email }}?subject=Re: {{ rawurlencode($message->subject ?? 'যোগাযোগের প্রেক্ষিতে') }}"
                       class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-xs font-bold text-slate-700 bg-slate-100 hover:bg-slate-200 border border-slate-200 transition shadow-xs">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>ইমেইল</span>
                    </a>
                @endif
            </div>
        </div>

        {{-- Message Body --}}
        <div class="p-6 sm:p-8 space-y-6">
            @if($message->subject)
                <div>
                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-1">বিষয়</span>
                    <h3 class="text-lg font-black text-slate-800 bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                        {{ $message->subject }}
                    </h3>
                </div>
            @endif

            <div>
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-1">বার্তার মূল বিবরণ</span>
                <div class="p-5 rounded-2xl bg-slate-50/70 border border-slate-100 text-sm text-slate-800 leading-relaxed whitespace-pre-line font-normal">
                    {{ $message->message }}
                </div>
            </div>

            {{-- Contact Information Grid --}}
            <div class="grid sm:grid-cols-3 gap-4 pt-4 border-t border-slate-100 text-xs">
                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 font-bold block mb-1">ফোন নম্বর</span>
                    <a href="tel:{{ $message->phone }}" class="font-bold text-emerald-700 hover:underline font-mono text-sm">
                        {{ $message->phone }}
                    </a>
                </div>

                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 font-bold block mb-1">ই-মেইল এড্রেস</span>
                    <span class="font-semibold text-slate-800 break-all">
                        {{ $message->email ?? 'প্রদান করা হয়নি' }}
                    </span>
                </div>

                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                    <span class="text-slate-400 font-bold block mb-1">পাঠানোর সময়</span>
                    <span class="font-semibold text-slate-800">
                        {{ $message->created_at->format('d/m/Y - h:i A') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
