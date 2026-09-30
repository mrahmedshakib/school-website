<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoutine;
use Illuminate\Http\Request;

class ClassRoutineController extends Controller
{
    public function index(Request $request)
    {
        $query = ClassRoutine::orderBy('sort_order')->latest('id');

        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        if ($request->filled('shift')) {
            $query->where('shift', $request->shift);
        }

        $routines = $query->paginate(15)->withQueryString();
        $classes = ClassRoutine::distinct()->pluck('class');

        return view('backend.class-routines.index', compact('routines', 'classes'));
    }

    public function create()
    {
        return view('backend.class-routines.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_bn' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'class' => 'required|string|max:100',
            'section' => 'nullable|string|max:50',
            'shift' => 'nullable|string|max:50',
            'academic_year' => 'nullable|string|max:20',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $routine = new ClassRoutine();
        $routine->title_bn = $validated['title_bn'];
        $routine->title_en = $validated['title_en'] ?? $validated['title_bn'];
        $routine->class = $validated['class'];
        $routine->section = $validated['section'] ?? null;
        $routine->shift = $validated['shift'] ?? 'Day';
        $routine->academic_year = $validated['academic_year'] ?? date('Y');
        $routine->status = $request->has('status') ? 1 : 0;
        $routine->sort_order = $validated['sort_order'] ?? 0;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'routine_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/routines'), $fileName);
            $routine->file_path = 'uploads/routines/' . $fileName;
        }

        $routine->save();

        return redirect()->route('admin.class-routines.index')->with('success', 'Class Routine created successfully.');
    }

    public function edit($id)
    {
        $routine = ClassRoutine::findOrFail($id);
        return view('backend.class-routines.edit', compact('routine'));
    }

    public function update(Request $request, $id)
    {
        $routine = ClassRoutine::findOrFail($id);

        $validated = $request->validate([
            'title_bn' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'class' => 'required|string|max:100',
            'section' => 'nullable|string|max:50',
            'shift' => 'nullable|string|max:50',
            'academic_year' => 'nullable|string|max:20',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $routine->title_bn = $validated['title_bn'];
        $routine->title_en = $validated['title_en'] ?? $validated['title_bn'];
        $routine->class = $validated['class'];
        $routine->section = $validated['section'] ?? null;
        $routine->shift = $validated['shift'] ?? 'Day';
        $routine->academic_year = $validated['academic_year'] ?? date('Y');
        $routine->status = $request->has('status') ? 1 : 0;
        $routine->sort_order = $validated['sort_order'] ?? 0;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'routine_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/routines'), $fileName);
            $routine->file_path = 'uploads/routines/' . $fileName;
        }

        $routine->save();

        return redirect()->route('admin.class-routines.index')->with('success', 'Class Routine updated successfully.');
    }

    public function toggleStatus($id)
    {
        $routine = ClassRoutine::findOrFail($id);
        $routine->status = !$routine->status;
        $routine->save();

        return back()->with('success', 'Status updated.');
    }

    public function destroy($id)
    {
        $routine = ClassRoutine::findOrFail($id);
        $routine->delete();

        return redirect()->route('admin.class-routines.index')->with('success', 'Routine deleted.');
    }
}
