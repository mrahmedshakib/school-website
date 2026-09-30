<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicSubject;
use Illuminate\Http\Request;

class AcademicSubjectController extends Controller
{
    public function index(Request $request)
    {
        $query = AcademicSubject::orderBy('sort_order')->orderBy('class')->orderBy('code');

        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        if ($request->filled('group_name')) {
            $query->where('group_name', $request->group_name);
        }

        $subjects = $query->paginate(20)->withQueryString();
        $classes = AcademicSubject::distinct()->pluck('class');
        $groups = AcademicSubject::whereNotNull('group_name')->distinct()->pluck('group_name');

        return view('backend.subjects.index', compact('subjects', 'classes', 'groups'));
    }

    public function create()
    {
        return view('backend.subjects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_bn' => 'required|string|max:150',
            'name_en' => 'nullable|string|max:150',
            'code' => 'nullable|string|max:30',
            'class' => 'required|string|max:100',
            'group_name' => 'nullable|string|max:50',
            'type' => 'required|in:Compulsory,Elective,Optional',
            'total_marks' => 'required|integer',
            'theory_marks' => 'nullable|integer',
            'practical_marks' => 'nullable|integer',
            'viva_marks' => 'nullable|integer',
            'description_bn' => 'nullable|string',
            'description_en' => 'nullable|string',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $subject = new AcademicSubject();
        $subject->name_bn = $validated['name_bn'];
        $subject->name_en = $validated['name_en'] ?? $validated['name_bn'];
        $subject->code = $validated['code'] ?? null;
        $subject->class = $validated['class'];
        $subject->group_name = $validated['group_name'] ?? 'General';
        $subject->type = $validated['type'];
        $subject->total_marks = $validated['total_marks'];
        $subject->theory_marks = $validated['theory_marks'] ?? null;
        $subject->practical_marks = $validated['practical_marks'] ?? null;
        $subject->viva_marks = $validated['viva_marks'] ?? null;
        $subject->description_bn = $validated['description_bn'] ?? null;
        $subject->description_en = $validated['description_en'] ?? null;
        $subject->status = $request->has('status') ? 1 : 0;
        $subject->sort_order = $validated['sort_order'] ?? 0;
        $subject->save();

        return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully.');
    }

    public function edit($id)
    {
        $subject = AcademicSubject::findOrFail($id);
        return view('backend.subjects.edit', compact('subject'));
    }

    public function update(Request $request, $id)
    {
        $subject = AcademicSubject::findOrFail($id);

        $validated = $request->validate([
            'name_bn' => 'required|string|max:150',
            'name_en' => 'nullable|string|max:150',
            'code' => 'nullable|string|max:30',
            'class' => 'required|string|max:100',
            'group_name' => 'nullable|string|max:50',
            'type' => 'required|in:Compulsory,Elective,Optional',
            'total_marks' => 'required|integer',
            'theory_marks' => 'nullable|integer',
            'practical_marks' => 'nullable|integer',
            'viva_marks' => 'nullable|integer',
            'description_bn' => 'nullable|string',
            'description_en' => 'nullable|string',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $subject->name_bn = $validated['name_bn'];
        $subject->name_en = $validated['name_en'] ?? $validated['name_bn'];
        $subject->code = $validated['code'] ?? null;
        $subject->class = $validated['class'];
        $subject->group_name = $validated['group_name'] ?? 'General';
        $subject->type = $validated['type'];
        $subject->total_marks = $validated['total_marks'];
        $subject->theory_marks = $validated['theory_marks'] ?? null;
        $subject->practical_marks = $validated['practical_marks'] ?? null;
        $subject->viva_marks = $validated['viva_marks'] ?? null;
        $subject->description_bn = $validated['description_bn'] ?? null;
        $subject->description_en = $validated['description_en'] ?? null;
        $subject->status = $request->has('status') ? 1 : 0;
        $subject->sort_order = $validated['sort_order'] ?? 0;
        $subject->save();

        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function toggleStatus($id)
    {
        $subject = AcademicSubject::findOrFail($id);
        $subject->status = !$subject->status;
        $subject->save();

        return back()->with('success', 'Status updated.');
    }

    public function destroy($id)
    {
        $subject = AcademicSubject::findOrFail($id);
        $subject->delete();

        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted.');
    }
}
