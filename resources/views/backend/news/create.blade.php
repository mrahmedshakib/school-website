@extends('backend.layouts.app')

@section('title', 'Add News Article')
@section('page_title', 'Add News Article')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                Add News Article
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Publish a news post, achievement report, or press release.
            </p>
        </div>
        <a href="{{ route('admin.news.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-sm rounded-xl transition">
            ← Back to News
        </a>
    </div>

    @if ($errors->any())
        <div class="rounded-2xl bg-rose-50 border border-rose-200 p-4 text-rose-700 text-sm">
            <p class="font-bold mb-1">Please fix the following errors:</p>
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">

            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-1.5">
                    News Title <span class="text-rose-500">*</span>
                </label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    required
                    placeholder="e.g. Annual Sports Meet 2026 Concludes with Grand Celebration"
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none transition"
                >
            </div>

            {{-- Short Description --}}
            <div>
                <label for="short_description" class="block text-sm font-semibold text-slate-700 mb-1.5">
                    Short Summary / Excerpt
                </label>
                <textarea
                    id="short_description"
                    name="short_description"
                    rows="2"
                    placeholder="Brief 1-2 sentence overview for cards and meta preview..."
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none transition"
                >{{ old('short_description') }}</textarea>
            </div>

            {{-- Full Content --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-slate-700 mb-1.5">
                    Full News Content
                </label>
                <textarea
                    id="description"
                    name="description"
                    rows="8"
                    placeholder="Write the complete news article details here..."
                    class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none transition"
                >{{ old('description') }}</textarea>
            </div>

            {{-- Image Upload with Preview --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">
                    Featured Cover Image
                </label>
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <div id="imagePreviewContainer" class="w-32 h-24 rounded-2xl bg-slate-100 border-2 border-dashed border-slate-300 flex items-center justify-center overflow-hidden shrink-0">
                        <span id="previewPlaceholder" class="text-xs text-slate-400 font-medium">Preview</span>
                        <img id="imagePreview" src="#" alt="Preview" class="w-full h-full object-cover hidden">
                    </div>
                    <div class="flex-1">
                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept="image/png,image/jpeg,image/jpg,image/webp"
                            onchange="previewNewsImage(this)"
                            class="block w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 cursor-pointer"
                        >
                        <p class="text-[11px] text-slate-400 mt-1">Supported formats: JPG, PNG, WebP (Max 2MB). Ideal size: 1200x630px.</p>
                    </div>
                </div>
            </div>

            {{-- Date & Order --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-4 border-t border-slate-100">
                <div>
                    <label for="published_at" class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Publish Date
                    </label>
                    <input
                        type="date"
                        id="published_at"
                        name="published_at"
                        value="{{ old('published_at', date('Y-m-d')) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none transition"
                    >
                </div>

                <div>
                    <label for="sort_order" class="block text-sm font-semibold text-slate-700 mb-1.5">
                        Sort Order
                    </label>
                    <input
                        type="number"
                        id="sort_order"
                        name="sort_order"
                        value="{{ old('sort_order', 0) }}"
                        min="0"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-emerald-600 focus:ring-2 focus:ring-emerald-600/10 outline-none transition"
                    >
                </div>
            </div>

            {{-- Status Switch --}}
            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <div>
                    <span class="block text-sm font-semibold text-slate-800">Publish Immediately</span>
                    <span class="block text-xs text-slate-400">If checked, news will be visible on the public website.</span>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="status" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                </label>
            </div>

        </div>

        {{-- Form Actions --}}
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.news.index') }}" class="px-5 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-sm transition">
                Cancel
            </a>
            <button type="submit" class="px-7 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-md shadow-emerald-900/20 transition">
                Publish News
            </button>
        </div>
    </form>

</div>

<script>
function previewNewsImage(input) {
    const preview = document.getElementById('imagePreview');
    const placeholder = document.getElementById('previewPlaceholder');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
