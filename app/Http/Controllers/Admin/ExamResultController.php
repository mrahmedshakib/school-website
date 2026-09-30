<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use Illuminate\Http\Request;

class ExamResultController extends Controller
{
    public function index(Request $request)
    {
        $query = ExamResult::orderBy('sort_order')->latest('publish_date');

        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        $results = $query->paginate(15)->withQueryString();
        $classes = ExamResult::distinct()->pluck('class');

        return view('backend.exam-results.index', compact('results', 'classes'));
    }

    public function create()
    {
        return view('backend.exam-results.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_bn' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'exam_name_bn' => 'nullable|string|max:150',
            'exam_name_en' => 'nullable|string|max:150',
            'class' => 'nullable|string|max:100',
            'academic_year' => 'nullable|string|max:20',
            'publish_date' => 'nullable|date',
            'total_students' => 'nullable|integer',
            'passed_students' => 'nullable|integer',
            'failed_students' => 'nullable|integer',
            'gpa5_count' => 'nullable|integer',
            'pass_rate' => 'nullable|numeric',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $result = new ExamResult();
        $result->title_bn = $validated['title_bn'];
        $result->title_en = $validated['title_en'] ?? $validated['title_bn'];
        $result->exam_name_bn = $validated['exam_name_bn'] ?? null;
        $result->exam_name_en = $validated['exam_name_en'] ?? null;
        $result->class = $validated['class'] ?? null;
        $result->academic_year = $validated['academic_year'] ?? date('Y');
        $result->publish_date = $validated['publish_date'] ?? date('Y-m-d');
        $result->total_students = $validated['total_students'] ?? 0;
        $result->passed_students = $validated['passed_students'] ?? 0;
        $result->failed_students = $validated['failed_students'] ?? 0;
        $result->gpa5_count = $validated['gpa5_count'] ?? 0;
        $result->pass_rate = $validated['pass_rate'] ?? 100.00;
        $result->status = $request->has('status') ? 1 : 0;
        $result->sort_order = $validated['sort_order'] ?? 0;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'gazette_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/results'), $fileName);
            $result->file_path = 'uploads/results/' . $fileName;
        }

        $result->save();

        return redirect()->route('admin.exam-results.index')->with('success', 'Exam Result Gazette published successfully.');
    }

    public function edit($id)
    {
        $result = ExamResult::findOrFail($id);
        return view('backend.exam-results.edit', compact('result'));
    }

    public function update(Request $request, $id)
    {
        $result = ExamResult::findOrFail($id);

        $validated = $request->validate([
            'title_bn' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'exam_name_bn' => 'nullable|string|max:150',
            'exam_name_en' => 'nullable|string|max:150',
            'class' => 'nullable|string|max:100',
            'academic_year' => 'nullable|string|max:20',
            'publish_date' => 'nullable|date',
            'total_students' => 'nullable|integer',
            'passed_students' => 'nullable|integer',
            'failed_students' => 'nullable|integer',
            'gpa5_count' => 'nullable|integer',
            'pass_rate' => 'nullable|numeric',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
            'status' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $result->title_bn = $validated['title_bn'];
        $result->title_en = $validated['title_en'] ?? $validated['title_bn'];
        $result->exam_name_bn = $validated['exam_name_bn'] ?? null;
        $result->exam_name_en = $validated['exam_name_en'] ?? null;
        $result->class = $validated['class'] ?? null;
        $result->academic_year = $validated['academic_year'] ?? date('Y');
        $result->publish_date = $validated['publish_date'] ?? date('Y-m-d');
        $result->total_students = $validated['total_students'] ?? 0;
        $result->passed_students = $validated['passed_students'] ?? 0;
        $result->failed_students = $validated['failed_students'] ?? 0;
        $result->gpa5_count = $validated['gpa5_count'] ?? 0;
        $result->pass_rate = $validated['pass_rate'] ?? 100.00;
        $result->status = $request->has('status') ? 1 : 0;
        $result->sort_order = $validated['sort_order'] ?? 0;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'gazette_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/results'), $fileName);
            $result->file_path = 'uploads/results/' . $fileName;
        }

        $result->save();

        return redirect()->route('admin.exam-results.index')->with('success', 'Exam Result updated successfully.');
    }

    public function toggleStatus($id)
    {
        $result = ExamResult::findOrFail($id);
        $result->status = !$result->status;
        $result->save();

        return back()->with('success', 'Status updated.');
    }

    public function destroy($id)
    {
        $result = ExamResult::findOrFail($id);
        $result->delete();

        return redirect()->route('admin.exam-results.index')->with('success', 'Result Gazette deleted.');
    }
}
