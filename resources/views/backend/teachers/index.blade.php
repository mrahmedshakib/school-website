@extends('backend.layouts.app')

@section('title', 'Teachers & Staff')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Teachers & Staff
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Manage teachers and staff members.
            </p>
        </div>

        <a
            href="{{ route('admin.teachers.create') }}"
            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 text-white text-sm font-semibold hover:bg-emerald-700 transition shadow-sm"
        >
            <span class="text-lg leading-none">+</span>
            Add Teacher / Staff
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-xs">

                {{-- Table Header --}}
                <thead class="bg-slate-50 border-b border-slate-200 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-3 py-2.5 w-10 text-center">#</th>
                        <th class="px-3 py-2.5 w-12 text-center">ছবি</th>
                        <th class="px-3.5 py-2.5">নাম ও ইমেইল</th>
                        <th class="px-3 py-2.5 w-20 text-center">ধরন</th>
                        <th class="px-3 py-2.5">পদবি ও বিষয়</th>
                        <th class="px-3 py-2.5 w-28 whitespace-nowrap">ফোন</th>
                        <th class="px-3 py-2.5 w-20 text-center whitespace-nowrap">অবস্থা</th>
                        <th class="px-3 py-2.5 w-24 text-right whitespace-nowrap">অ্যাকশন</th>
                    </tr>
                </thead>

                {{-- Table Body --}}
                <tbody class="divide-y divide-slate-100 text-xs">
                    @forelse($teachers as $teacher)
                        <tr class="hover:bg-slate-50 transition">
                            {{-- Number --}}
                            <td class="px-3 py-2.5 text-center text-slate-400 font-mono">
                                {{ $teachers->firstItem() + $loop->index }}
                            </td>

                            {{-- Image --}}
                            <td class="px-3 py-2.5 text-center">
                                @if($teacher->image)
                                    <img src="{{ asset($teacher->image) }}"
                                         alt="{{ $teacher->name }}"
                                         class="w-9 h-9 rounded-full object-cover border border-slate-200 mx-auto">
                                @else
                                    <div class="w-9 h-9 rounded-full bg-emerald-50 text-emerald-700 font-bold flex items-center justify-center text-xs mx-auto">
                                        {{ mb_substr($teacher->name_bn ?: $teacher->name, 0, 1) }}
                                    </div>
                                @endif
                            </td>

                            {{-- Name --}}
                            <td class="px-3.5 py-2.5">
                                <div class="font-bold text-slate-900 leading-snug line-clamp-1">
                                    {{ $teacher->name_bn ?: $teacher->name }}
                                </div>
                                @if($teacher->name_en)
                                    <div class="text-[11px] text-slate-400 font-normal truncate">
                                        {{ $teacher->name_en }}
                                    </div>
                                @endif
                                @if($teacher->email)
                                    <div class="text-[10px] text-slate-400 truncate">
                                        {{ $teacher->email }}
                                    </div>
                                @endif
                            </td>

                            {{-- Type --}}
                            <td class="px-3 py-2.5 text-center whitespace-nowrap">
                                @if($teacher->type === 'teacher')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-[10px] font-bold">
                                        শিক্ষক
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 border border-slate-200 text-[10px] font-bold">
                                        স্টাফ
                                    </span>
                                @endif
                            </td>

                            {{-- Designation & Subject --}}
                            <td class="px-3 py-2.5">
                                <div class="font-semibold text-slate-800 line-clamp-1">
                                    {{ $teacher->designation_bn ?: $teacher->designation ?: '-' }}
                                </div>
                                @if($teacher->type === 'teacher' && $teacher->subject)
                                    <div class="text-[11px] text-slate-400">
                                        বিষয়: {{ $teacher->subject }}
                                    </div>
                                @endif
                            </td>

                            {{-- Phone --}}
                            <td class="px-3 py-2.5 whitespace-nowrap text-slate-600 font-mono text-[11px]">
                                {{ $teacher->phone ?: '-' }}
                            </td>

                            {{-- Status --}}
                            <td class="px-3 py-2.5 text-center whitespace-nowrap">
                                @if($teacher->status)
                                    <span class="inline-flex px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold">
                                        সক্রিয়
                                    </span>
                                @else
                                    <span class="inline-flex px-2 py-0.5 rounded-full bg-slate-100 text-slate-600 text-[10px] font-semibold">
                                        নিষ্ক্রিয়
                                    </span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="px-3 py-2.5 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.teachers.edit', $teacher->id) }}"
                                       title="সম্পাদনা করুন"
                                       class="p-1.5 rounded-lg text-slate-500 hover:text-emerald-700 hover:bg-emerald-50 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>

                                    <form action="{{ route('admin.teachers.destroy', $teacher->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('আপনি কি নিশ্চিত যে এই শিক্ষক/স্টাফকে মুছে ফেলতে চান?');"
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
                        </tr>           </tr>

                    @empty

                        <tr>
                            <td colspan="9" class="px-5 py-12 text-center">

                                <div class="text-4xl mb-3">
                                    👨‍🏫
                                </div>

                                <p class="text-gray-500 font-medium">
                                    No teachers or staff found.
                                </p>

                                <a
                                    href="{{ route('admin.teachers.create') }}"
                                    class="inline-block mt-3 text-sm text-blue-600 hover:text-blue-700"
                                >
                                    Add your first teacher or staff
                                </a>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>
    </div>

    {{-- Pagination --}}
    @if($teachers->hasPages())
        <div class="mt-4 px-5 py-4 border border-gray-200 rounded-xl bg-white">
            {{ $teachers->links() }}
        </div>
    @endif

</div>
@endsection