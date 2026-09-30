<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamRoutine;
use Illuminate\Http\Request;

class ExamRoutineController extends Controller
{
    public function index(Request $request)
    {
        $query = ExamRoutine::orderBy('sort_order')->latest('start_date');

        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        $examRoutines = $query->paginate(15)->withQueryString();
        $classes = ExamRoutine::distinct()->pluck('class');

        return view('backend.exam-routines.index', compact('examRoutines', 'classes'));
    }

    public function create()
    {
        return view('backend.exam-routines.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_bn' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'exam_name_bn' => 'nullable|string|max:150',
            'exam_name_en' => 'nullable|string|max:150',
            'class' => 'required|string|max:100',
            'academic_year' => 'nullable|string|max:20',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $exam = new ExamRoutine();
        $exam->title_bn = $validated['title_bn'];
        $exam->title_en = $validated['title_en'] ?? $validated['title_bn'];
        $exam->exam_name_bn = $validated['exam_name_bn'] ?? null;
        $exam->exam_name_en = $validated['exam_name_en'] ?? null;
        $exam->class = $validated['class'];
        $exam->academic_year = $validated['academic_year'] ?? date('Y');
        $exam->start_date = $validated['start_date'] ?? null;
        $exam->end_date = $validated['end_date'] ?? null;
        $exam->status = $request->has('status') ? 1 : 0;
        $exam->sort_order = $validated['sort_order'] ?? 0;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'exam_routine_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/exam_routines'), $fileName);
            $exam->file_path = 'uploads/exam_routines/' . $fileName;
        }

        $exam->save();

        return redirect()->route('admin.exam-routines.index')->with('success', 'Exam Routine created successfully.');
    }

    public function edit($id)
    {
        $exam = ExamRoutine::findOrFail($id);
        return view('backend.exam-routines.edit', compact('exam'));
    }

    public function update(Request $request, $id)
    {
        $exam = ExamRoutine::findOrFail($id);

        $validated = $request->validate([
            'title_bn' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'exam_name_bn' => 'nullable|string|max:150',
            'exam_name_en' => 'nullable|string|max:150',
            'class' => 'required|string|max:100',
            'academic_year' => 'nullable|string|max:20',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $exam->title_bn = $validated['title_bn'];
        $exam->title_en = $validated['title_en'] ?? $validated['title_bn'];
        $exam->exam_name_bn = $validated['exam_name_bn'] ?? null;
        $exam->exam_name_en = $validated['exam_name_en'] ?? null;
        $exam->class = $validated['class'];
        $exam->academic_year = $validated['academic_year'] ?? date('Y');
        $exam->start_date = $validated['start_date'] ?? null;
        $exam->end_date = $validated['end_date'] ?? null;
        $exam->status = $request->has('status') ? 1 : 0;
        $exam->sort_order = $validated['sort_order'] ?? 0;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'exam_routine_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/exam_routines'), $fileName);
            $exam->file_path = 'uploads/exam_routines/' . $fileName;
        }

        $exam->save();

        return redirect()->route('admin.exam-routines.index')->with('success', 'Exam Routine updated successfully.');
    }

    public function toggleStatus($id)
    {
        $exam = ExamRoutine::findOrFail($id);
        $exam->status = !$exam->status;
        $exam->save();

        return back()->with('success', 'Status toggled.');
    }

    public function destroy($id)
    {
        $exam = ExamRoutine::findOrFail($id);
        $exam->delete();

        return redirect()->route('admin.exam-routines.index')->with('success', 'Exam Routine deleted.');
    }
}
