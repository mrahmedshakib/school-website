<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicSyllabus;
use Illuminate\Http\Request;

class AcademicSyllabusController extends Controller
{
    public function index(Request $request)
    {
        $query = AcademicSyllabus::orderBy('sort_order')->latest('id');

        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function($q) use ($term) {
                $q->where('title_bn', 'like', "%{$term}%")
                  ->orWhere('title_en', 'like', "%{$term}%")
                  ->orWhere('subject_name_bn', 'like', "%{$term}%")
                  ->orWhere('subject_name_en', 'like', "%{$term}%");
            });
        }

        $syllabuses = $query->paginate(15)->withQueryString();
        $classes = AcademicSyllabus::distinct()->pluck('class');

        return view('backend.syllabuses.index', compact('syllabuses', 'classes'));
    }

    public function create()
    {
        return view('backend.syllabuses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_bn' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'class' => 'required|string|max:100',
            'academic_year' => 'nullable|string|max:20',
            'subject_name_bn' => 'nullable|string|max:150',
            'subject_name_en' => 'nullable|string|max:150',
            'description_bn' => 'nullable|string',
            'description_en' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $syllabus = new AcademicSyllabus();
        $syllabus->title_bn = $validated['title_bn'];
        $syllabus->title_en = $validated['title_en'] ?? $validated['title_bn'];
        $syllabus->class = $validated['class'];
        $syllabus->academic_year = $validated['academic_year'] ?? date('Y');
        $syllabus->subject_name_bn = $validated['subject_name_bn'] ?? null;
        $syllabus->subject_name_en = $validated['subject_name_en'] ?? null;
        $syllabus->description_bn = $validated['description_bn'] ?? null;
        $syllabus->description_en = $validated['description_en'] ?? null;
        $syllabus->status = $request->has('status') ? 1 : 0;
        $syllabus->sort_order = $validated['sort_order'] ?? 0;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'syllabus_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/syllabuses'), $fileName);
            $syllabus->file_path = 'uploads/syllabuses/' . $fileName;
        }

        $syllabus->save();

        return redirect()->route('admin.syllabuses.index')->with('success', 'Syllabus created successfully.');
    }

    public function edit($id)
    {
        $syllabus = AcademicSyllabus::findOrFail($id);
        return view('backend.syllabuses.edit', compact('syllabus'));
    }

    public function update(Request $request, $id)
    {
        $syllabus = AcademicSyllabus::findOrFail($id);

        $validated = $request->validate([
            'title_bn' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'class' => 'required|string|max:100',
            'academic_year' => 'nullable|string|max:20',
            'subject_name_bn' => 'nullable|string|max:150',
            'subject_name_en' => 'nullable|string|max:150',
            'description_bn' => 'nullable|string',
            'description_en' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $syllabus->title_bn = $validated['title_bn'];
        $syllabus->title_en = $validated['title_en'] ?? $validated['title_bn'];
        $syllabus->class = $validated['class'];
        $syllabus->academic_year = $validated['academic_year'] ?? date('Y');
        $syllabus->subject_name_bn = $validated['subject_name_bn'] ?? null;
        $syllabus->subject_name_en = $validated['subject_name_en'] ?? null;
        $syllabus->description_bn = $validated['description_bn'] ?? null;
        $syllabus->description_en = $validated['description_en'] ?? null;
        $syllabus->status = $request->has('status') ? 1 : 0;
        $syllabus->sort_order = $validated['sort_order'] ?? 0;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'syllabus_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/syllabuses'), $fileName);
            $syllabus->file_path = 'uploads/syllabuses/' . $fileName;
        }

        $syllabus->save();

        return redirect()->route('admin.syllabuses.index')->with('success', 'Syllabus updated successfully.');
    }

    public function toggleStatus($id)
    {
        $syllabus = AcademicSyllabus::findOrFail($id);
        $syllabus->status = !$syllabus->status;
        $syllabus->save();

        return back()->with('success', 'Status toggled successfully.');
    }

    public function destroy($id)
    {
        $syllabus = AcademicSyllabus::findOrFail($id);
        $syllabus->delete();

        return redirect()->route('admin.syllabuses.index')->with('success', 'Syllabus deleted successfully.');
    }
}
