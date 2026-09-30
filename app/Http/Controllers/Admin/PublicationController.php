<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolPublication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index(Request $request)
    {
        $query = SchoolPublication::orderBy('sort_order')->latest('publish_date');

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $publications = $query->paginate(15)->withQueryString();

        return view('backend.publications.index', compact('publications'));
    }

    public function create()
    {
        return view('backend.publications.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_bn' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'type' => 'required|in:magazine,publication',
            'edition_bn' => 'nullable|string|max:100',
            'edition_en' => 'nullable|string|max:100',
            'publish_date' => 'nullable|date',
            'academic_year' => 'nullable|string|max:20',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'file' => 'nullable|file|mimes:pdf|max:20480',
            'description_bn' => 'nullable|string',
            'description_en' => 'nullable|string',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $pub = new SchoolPublication();
        $pub->title_bn = $validated['title_bn'];
        $pub->title_en = $validated['title_en'] ?? $validated['title_bn'];
        $pub->type = $validated['type'];
        $pub->edition_bn = $validated['edition_bn'] ?? null;
        $pub->edition_en = $validated['edition_en'] ?? null;
        $pub->publish_date = $validated['publish_date'] ?? date('Y-m-d');
        $pub->academic_year = $validated['academic_year'] ?? date('Y');
        $pub->description_bn = $validated['description_bn'] ?? null;
        $pub->description_en = $validated['description_en'] ?? null;
        $pub->status = $request->has('status') ? 1 : 0;
        $pub->sort_order = $validated['sort_order'] ?? 0;

        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $imgName = 'pub_cover_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/publications'), $imgName);
            $pub->cover_image = 'uploads/publications/' . $imgName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'pub_file_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/publications'), $fileName);
            $pub->file_path = 'uploads/publications/' . $fileName;
        }

        $pub->save();

        return redirect()->route('admin.publications.index')->with('success', 'Publication / Magazine created successfully.');
    }

    public function edit($id)
    {
        $publication = SchoolPublication::findOrFail($id);
        return view('backend.publications.edit', compact('publication'));
    }

    public function update(Request $request, $id)
    {
        $pub = SchoolPublication::findOrFail($id);

        $validated = $request->validate([
            'title_bn' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'type' => 'required|in:magazine,publication',
            'edition_bn' => 'nullable|string|max:100',
            'edition_en' => 'nullable|string|max:100',
            'publish_date' => 'nullable|date',
            'academic_year' => 'nullable|string|max:20',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'file' => 'nullable|file|mimes:pdf|max:20480',
            'description_bn' => 'nullable|string',
            'description_en' => 'nullable|string',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $pub->title_bn = $validated['title_bn'];
        $pub->title_en = $validated['title_en'] ?? $validated['title_bn'];
        $pub->type = $validated['type'];
        $pub->edition_bn = $validated['edition_bn'] ?? null;
        $pub->edition_en = $validated['edition_en'] ?? null;
        $pub->publish_date = $validated['publish_date'] ?? date('Y-m-d');
        $pub->academic_year = $validated['academic_year'] ?? date('Y');
        $pub->description_bn = $validated['description_bn'] ?? null;
        $pub->description_en = $validated['description_en'] ?? null;
        $pub->status = $request->has('status') ? 1 : 0;
        $pub->sort_order = $validated['sort_order'] ?? 0;

        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $imgName = 'pub_cover_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/publications'), $imgName);
            $pub->cover_image = 'uploads/publications/' . $imgName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'pub_file_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/publications'), $fileName);
            $pub->file_path = 'uploads/publications/' . $fileName;
        }

        $pub->save();

        return redirect()->route('admin.publications.index')->with('success', 'Publication updated successfully.');
    }

    public function toggleStatus($id)
    {
        $pub = SchoolPublication::findOrFail($id);
        $pub->status = !$pub->status;
        $pub->save();

        return back()->with('success', 'Status updated.');
    }

    public function destroy($id)
    {
        $pub = SchoolPublication::findOrFail($id);
        $pub->delete();

        return redirect()->route('admin.publications.index')->with('success', 'Publication deleted.');
    }
}
