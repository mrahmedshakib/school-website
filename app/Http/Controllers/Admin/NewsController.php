<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('is_delete', 0)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('backend.news.index', compact('news'));
    }

    public function create()
    {
        return view('backend.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'published_at' => 'nullable|date',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $news = new News();

        $news->title = $validated['title'];
        $news->slug = $this->generateUniqueSlug($validated['title']);
        $news->short_description = $validated['short_description'] ?? null;
        $news->description = $validated['description'] ?? null;
        $news->published_at = $validated['published_at'] ?? null;
        $news->sort_order = $validated['sort_order'] ?? 0;
        $news->status = $request->has('status') ? 1 : 0;
        $news->is_delete = 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $filename = time() . '_' . uniqid() . '.' .
                $image->getClientOriginalExtension();

            $image->storeAs(
                'images/news',
                $filename,
                'public'
            );

            $news->image =
                'storage/images/news/' . $filename;
        }

        $news->save();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News added successfully.');
    }

    public function edit(News $news)
    {
        return view('backend.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'published_at' => 'nullable|date',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $news->title = $validated['title'];
        $news->slug = $this->generateUniqueSlug(
            $validated['title'],
            $news->id
        );
        $news->short_description =
            $validated['short_description'] ?? null;
        $news->description =
            $validated['description'] ?? null;
        $news->published_at =
            $validated['published_at'] ?? null;
        $news->sort_order =
            $validated['sort_order'] ?? 0;
        $news->status =
            $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {

            if ($news->image) {
                $oldImage = str_replace(
                    'storage/',
                    '',
                    $news->image
                );

                if (Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $image = $request->file('image');

            $filename = time() . '_' . uniqid() . '.' .
                $image->getClientOriginalExtension();

            $image->storeAs(
                'images/news',
                $filename,
                'public'
            );

            $news->image =
                'storage/images/news/' . $filename;
        }

        $news->save();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News updated successfully.');
    }

    public function destroy(News $news)
    {
        $news->update([
            'is_delete' => 1,
        ]);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News deleted successfully.');
    }

    private function generateUniqueSlug(
        string $title,
        ?int $ignoreId = null
    ): string {
        $slug = Str::slug($title);

        if (!$slug) {
            $slug = 'news-' . time();
        }

        $originalSlug = $slug;
        $counter = 1;

        while (
            News::where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) => $query->where('id', '!=', $ignoreId)
                )
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}