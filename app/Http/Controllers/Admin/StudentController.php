<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::orderBy('class')->orderBy('roll_no');

        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function($q) use ($term) {
                $q->where('name_bn', 'like', "%{$term}%")
                  ->orWhere('name_en', 'like', "%{$term}%")
                  ->orWhere('roll_no', 'like', "%{$term}%")
                  ->orWhere('student_id', 'like', "%{$term}%");
            });
        }

        $students = $query->paginate(20)->withQueryString();
        $classes = Student::distinct()->pluck('class');

        return view('backend.students.index', compact('students', 'classes'));
    }

    public function create()
    {
        return view('backend.students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_bn' => 'required|string|max:150',
            'name_en' => 'nullable|string|max:150',
            'student_id' => 'nullable|string|max:50|unique:students,student_id',
            'class' => 'required|string|max:100',
            'section' => 'nullable|string|max:50',
            'roll_no' => 'required|string|max:50',
            'gender' => 'required|in:male,female,other',
            'academic_year' => 'nullable|string|max:20',
            'guardian_name_bn' => 'nullable|string|max:150',
            'guardian_name_en' => 'nullable|string|max:150',
            'guardian_phone' => 'nullable|string|max:50',
            'blood_group' => 'nullable|string|max:10',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $student = new Student();
        $student->name_bn = $validated['name_bn'];
        $student->name_en = $validated['name_en'] ?? $validated['name_bn'];
        $student->student_id = $validated['student_id'] ?? null;
        $student->class = $validated['class'];
        $student->section = $validated['section'] ?? null;
        $student->roll_no = $validated['roll_no'];
        $student->gender = $validated['gender'];
        $student->academic_year = $validated['academic_year'] ?? date('Y');
        $student->guardian_name_bn = $validated['guardian_name_bn'] ?? null;
        $student->guardian_name_en = $validated['guardian_name_en'] ?? null;
        $student->guardian_phone = $validated['guardian_phone'] ?? null;
        $student->blood_group = $validated['blood_group'] ?? null;
        $student->status = $request->has('status') ? 1 : 0;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = 'student_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/students'), $fileName);
            $student->photo = 'uploads/students/' . $fileName;
        }

        $student->save();

        return redirect()->route('admin.students.index')->with('success', 'Student enrolled successfully.');
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('backend.students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'name_bn' => 'required|string|max:150',
            'name_en' => 'nullable|string|max:150',
            'student_id' => 'nullable|string|max:50|unique:students,student_id,' . $id,
            'class' => 'required|string|max:100',
            'section' => 'nullable|string|max:50',
            'roll_no' => 'required|string|max:50',
            'gender' => 'required|in:male,female,other',
            'academic_year' => 'nullable|string|max:20',
            'guardian_name_bn' => 'nullable|string|max:150',
            'guardian_name_en' => 'nullable|string|max:150',
            'guardian_phone' => 'nullable|string|max:50',
            'blood_group' => 'nullable|string|max:10',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean',
        ]);

        $student->name_bn = $validated['name_bn'];
        $student->name_en = $validated['name_en'] ?? $validated['name_bn'];
        $student->student_id = $validated['student_id'] ?? null;
        $student->class = $validated['class'];
        $student->section = $validated['section'] ?? null;
        $student->roll_no = $validated['roll_no'];
        $student->gender = $validated['gender'];
        $student->academic_year = $validated['academic_year'] ?? date('Y');
        $student->guardian_name_bn = $validated['guardian_name_bn'] ?? null;
        $student->guardian_name_en = $validated['guardian_name_en'] ?? null;
        $student->guardian_phone = $validated['guardian_phone'] ?? null;
        $student->blood_group = $validated['blood_group'] ?? null;
        $student->status = $request->has('status') ? 1 : 0;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = 'student_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/students'), $fileName);
            $student->photo = 'uploads/students/' . $fileName;
        }

        $student->save();

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }

    public function toggleStatus($id)
    {
        $student = Student::findOrFail($id);
        $student->status = !$student->status;
        $student->save();

        return back()->with('success', 'Status updated.');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Student record deleted.');
    }
}
