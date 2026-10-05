@extends('backend.layouts.app')

@section('title', 'Add Mission & Vision')
@section('page_title', 'Add Mission & Vision')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                Add Mission & Vision
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Define the institutional mission and vision statement of your school.
            </p>
        </div>
        <a href="{{ route('admin.mission-visions.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-sm rounded-xl transition">
            ← Back
        </a>
    </div>

    @if ($errors->any())
        <div class="rounded-2xl bg-rose-50 border border-rose-200 p-4 text-rose-700 text-sm">
            <p class="font-bold mb-1">Please correct the following errors:</p>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.mission-visions.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Mission Section --}}
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-5">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">🎯</span>
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Our Mission (মিশন)</h2>
                    <p class="text-xs text-slate-400">Statement of purpose and objectives</p>
                </div>
            </div>

            <div>
                <label for="mission_title" class="block text-sm font-semibold text-slate-700 mb-1.5">
                    Mission Title <span class="text-rose-500">*</span>
                </label>
                <input
                    type="text"
                    id="mission_title"
                    name="mission_title"
                    value="{{ old('mission_title', 'আমাদের লক্ষ্য ও উদ্দেশ্য (Mission)') }}"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none transition"
                >
            </div>

            <div>
                <label for="mission_description" class="block text-sm font-semibold text-slate-700 mb-1.5">
                    Mission Description <span class="text-rose-500">*</span>
                </label>
                <textarea
                    id="mission_description"
                    name="mission_description"
                    rows="5"
                    required
                    placeholder="Enter mission description in details..."
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none transition"
                >{{ old('mission_description') }}</textarea>
            </div>
        </div>

        {{-- Vision Section --}}
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-5">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <span class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl">🔭</span>
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Our Vision (ভিশন)</h2>
                    <p class="text-xs text-slate-400">Long-term aspiration and future goals</p>
                </div>
            </div>

            <div>
                <label for="vision_title" class="block text-sm font-semibold text-slate-700 mb-1.5">
                    Vision Title <span class="text-rose-500">*</span>
                </label>
                <input
                    type="text"
                    id="vision_title"
                    name="vision_title"
                    value="{{ old('vision_title', 'আমাদের ভবিষ্যৎ দৃষ্টিভঙ্গি (Vision)') }}"
                    required
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none transition"
                >
            </div>

            <div>
                <label for="vision_description" class="block text-sm font-semibold text-slate-700 mb-1.5">
                    Vision Description <span class="text-rose-500">*</span>
                </label>
                <textarea
                    id="vision_description"
                    name="vision_description"
                    rows="5"
                    required
                    placeholder="Enter vision description in details..."
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none transition"
                >{{ old('vision_description') }}</textarea>
            </div>
        </div>

        {{-- Status and Submit --}}
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
            <div>
                <label for="status" class="block text-sm font-semibold text-slate-700 mb-1">
                    Display Status
                </label>
                <select
                    id="status"
                    name="status"
                    class="rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none"
                >
                    <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active (Show on Website)</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive (Hide)</option>
                </select>
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <a href="{{ route('admin.mission-visions.index') }}" class="w-full sm:w-auto text-center px-5 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-sm transition">
                    Cancel
                </a>
                <button type="submit" class="w-full sm:w-auto px-7 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-md shadow-emerald-900/20 transition">
                    Save Mission & Vision
                </button>
            </div>
        </div>
    </form>

</div>
@endsection