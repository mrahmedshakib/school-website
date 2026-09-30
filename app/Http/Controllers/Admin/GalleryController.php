<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::where('is_delete', 0)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('backend.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('backend.galleries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $gallery = new Gallery();

        $gallery->title = $validated['title'] ?? null;
        $gallery->description = $validated['description'] ?? null;
        $gallery->sort_order = $validated['sort_order'] ?? 0;
        $gallery->status = $request->has('status') ? 1 : 0;
        $gallery->is_delete = 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $filename = time() . '_' . uniqid() . '.' .
                $image->getClientOriginalExtension();

            $image->storeAs(
                'images/galleries',
                $filename,
                'public'
            );

            $gallery->image =
                'storage/images/galleries/' . $filename;
        }

        $gallery->save();

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery image added successfully.');
    }

    public function edit(Gallery $gallery)
    {
        return view('backend.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $gallery->title = $validated['title'] ?? null;
        $gallery->description = $validated['description'] ?? null;
        $gallery->sort_order = $validated['sort_order'] ?? 0;
        $gallery->status = $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {

            if ($gallery->image) {
                $oldImage = str_replace(
                    'storage/',
                    '',
                    $gallery->image
                );

                if (Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $image = $request->file('image');

            $filename = time() . '_' . uniqid() . '.' .
                $image->getClientOriginalExtension();

            $image->storeAs(
                'images/galleries',
                $filename,
                'public'
            );

            $gallery->image =
                'storage/images/galleries/' . $filename;
        }

        $gallery->save();

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery image updated successfully.');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->update([
            'is_delete' => 1,
        ]);

        return redirect()
            ->route('admin.galleries.index')
            ->with('success', 'Gallery image deleted successfully.');
    }
}