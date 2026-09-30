<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoGallery;
use Illuminate\Http\Request;

class VideoGalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = VideoGallery::orderBy('sort_order')->latest('id');

        $videos = $query->paginate(15);

        return view('backend.video-galleries.index', compact('videos'));
    }

    public function create()
    {
        return view('backend.video-galleries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_bn' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'youtube_url' => 'required|string|max:500',
            'category_bn' => 'nullable|string|max:100',
            'category_en' => 'nullable|string|max:100',
            'description_bn' => 'nullable|string',
            'description_en' => 'nullable|string',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $video = new VideoGallery();
        $video->title_bn = $validated['title_bn'];
        $video->title_en = $validated['title_en'] ?? $validated['title_bn'];
        $video->youtube_url = $validated['youtube_url'];

        // Extract YouTube ID
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video->youtube_url, $matches)) {
            $video->video_id = $matches[1];
        }

        $video->category_bn = $validated['category_bn'] ?? 'অনুষ্ঠান';
        $video->category_en = $validated['category_en'] ?? 'Events';
        $video->description_bn = $validated['description_bn'] ?? null;
        $video->description_en = $validated['description_en'] ?? null;
        $video->status = $request->has('status') ? 1 : 0;
        $video->sort_order = $validated['sort_order'] ?? 0;
        $video->save();

        return redirect()->route('admin.video-galleries.index')->with('success', 'Video added successfully.');
    }

    public function edit($id)
    {
        $video = VideoGallery::findOrFail($id);
        return view('backend.video-galleries.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $video = VideoGallery::findOrFail($id);

        $validated = $request->validate([
            'title_bn' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'youtube_url' => 'required|string|max:500',
            'category_bn' => 'nullable|string|max:100',
            'category_en' => 'nullable|string|max:100',
            'description_bn' => 'nullable|string',
            'description_en' => 'nullable|string',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $video->title_bn = $validated['title_bn'];
        $video->title_en = $validated['title_en'] ?? $validated['title_bn'];
        $video->youtube_url = $validated['youtube_url'];

        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $video->youtube_url, $matches)) {
            $video->video_id = $matches[1];
        }

        $video->category_bn = $validated['category_bn'] ?? 'অনুষ্ঠান';
        $video->category_en = $validated['category_en'] ?? 'Events';
        $video->description_bn = $validated['description_bn'] ?? null;
        $video->description_en = $validated['description_en'] ?? null;
        $video->status = $request->has('status') ? 1 : 0;
        $video->sort_order = $validated['sort_order'] ?? 0;
        $video->save();

        return redirect()->route('admin.video-galleries.index')->with('success', 'Video updated successfully.');
    }

    public function toggleStatus($id)
    {
        $video = VideoGallery::findOrFail($id);
        $video->status = !$video->status;
        $video->save();

        return back()->with('success', 'Status toggled.');
    }

    public function destroy($id)
    {
        $video = VideoGallery::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.video-galleries.index')->with('success', 'Video deleted.');
    }
}
