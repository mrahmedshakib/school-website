<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentMark;
use Illuminate\Http\Request;

class StudentMarkController extends Controller
{
    public function index(Request $request)
    {
        $query = StudentMark::latest('id');

        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function($q) use ($term) {
                $q->where('student_name_bn', 'like', "%{$term}%")
                  ->orWhere('student_name_en', 'like', "%{$term}%")
                  ->orWhere('roll_no', 'like', "%{$term}%")
                  ->orWhere('student_id', 'like', "%{$term}%");
            });
        }

        $marks = $query->paginate(15)->withQueryString();
        $classes = StudentMark::distinct()->pluck('class');

        return view('backend.student-marks.index', compact('marks', 'classes'));
    }

    public function create()
    {
        return view('backend.student-marks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_name_bn' => 'required|string|max:150',
            'student_name_en' => 'nullable|string|max:150',
            'roll_no' => 'required|string|max:50',
            'student_id' => 'nullable|string|max:50',
            'class' => 'required|string|max:100',
            'section' => 'nullable|string|max:50',
            'exam_name_bn' => 'required|string|max:150',
            'exam_name_en' => 'nullable|string|max:150',
            'academic_year' => 'nullable|string|max:20',
            'gpa' => 'required|numeric|between:0,5.00',
            'grade' => 'required|string|max:10',
            'total_marks' => 'required|integer',
            'result_status' => 'required|in:PASSED,FAILED',
            'remarks' => 'nullable|string',
            'marks_details_json' => 'nullable|string',
        ]);

        $mark = new StudentMark();
        $mark->student_name_bn = $validated['student_name_bn'];
        $mark->student_name_en = $validated['student_name_en'] ?? $validated['student_name_bn'];
        $mark->roll_no = $validated['roll_no'];
        $mark->student_id = $validated['student_id'] ?? null;
        $mark->class = $validated['class'];
        $mark->section = $validated['section'] ?? null;
        $mark->exam_name_bn = $validated['exam_name_bn'];
        $mark->exam_name_en = $validated['exam_name_en'] ?? $validated['exam_name_bn'];
        $mark->academic_year = $validated['academic_year'] ?? date('Y');
        $mark->gpa = $validated['gpa'];
        $mark->grade = $validated['grade'];
        $mark->total_marks = $validated['total_marks'];
        $mark->result_status = $validated['result_status'];
        $mark->remarks = $validated['remarks'] ?? null;

        if ($request->filled('marks_details_json')) {
            $mark->marks_details = json_decode($request->marks_details_json, true);
        }

        $mark->save();

        return redirect()->route('admin.student-marks.index')->with('success', 'Student marksheet created successfully.');
    }

    public function edit($id)
    {
        $mark = StudentMark::findOrFail($id);
        return view('backend.student-marks.edit', compact('mark'));
    }

    public function update(Request $request, $id)
    {
        $mark = StudentMark::findOrFail($id);

        $validated = $request->validate([
            'student_name_bn' => 'required|string|max:150',
            'student_name_en' => 'nullable|string|max:150',
            'roll_no' => 'required|string|max:50',
            'student_id' => 'nullable|string|max:50',
            'class' => 'required|string|max:100',
            'section' => 'nullable|string|max:50',
            'exam_name_bn' => 'required|string|max:150',
            'exam_name_en' => 'nullable|string|max:150',
            'academic_year' => 'nullable|string|max:20',
            'gpa' => 'required|numeric|between:0,5.00',
            'grade' => 'required|string|max:10',
            'total_marks' => 'required|integer',
            'result_status' => 'required|in:PASSED,FAILED',
            'remarks' => 'nullable|string',
            'marks_details_json' => 'nullable|string',
        ]);

        $mark->student_name_bn = $validated['student_name_bn'];
        $mark->student_name_en = $validated['student_name_en'] ?? $validated['student_name_bn'];
        $mark->roll_no = $validated['roll_no'];
        $mark->student_id = $validated['student_id'] ?? null;
        $mark->class = $validated['class'];
        $mark->section = $validated['section'] ?? null;
        $mark->exam_name_bn = $validated['exam_name_bn'];
        $mark->exam_name_en = $validated['exam_name_en'] ?? $validated['exam_name_bn'];
        $mark->academic_year = $validated['academic_year'] ?? date('Y');
        $mark->gpa = $validated['gpa'];
        $mark->grade = $validated['grade'];
        $mark->total_marks = $validated['total_marks'];
        $mark->result_status = $validated['result_status'];
        $mark->remarks = $validated['remarks'] ?? null;

        if ($request->filled('marks_details_json')) {
            $mark->marks_details = json_decode($request->marks_details_json, true);
        }

        $mark->save();

        return redirect()->route('admin.student-marks.index')->with('success', 'Student marksheet updated successfully.');
    }

    public function destroy($id)
    {
        $mark = StudentMark::findOrFail($id);
        $mark->delete();

        return redirect()->route('admin.student-marks.index')->with('success', 'Student marksheet deleted.');
    }
}
