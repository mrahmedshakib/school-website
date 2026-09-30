<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Teachers & Staff list
     */
    public function index()
    {
        $teachers = Teacher::where('is_delete', 0)
            ->orderBy('type', 'asc')
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('backend.teachers.index', compact('teachers'));
    }

    /**
     * Create page
     */
    public function create()
    {
        return view('backend.teachers.create');
    }

    /**
     * Store teacher or staff
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'nullable|string|max:255',
            'name_bn'          => 'nullable|string|max:255',
            'name_en'          => 'nullable|string|max:255',
            'type'             => 'required|in:teacher,staff',
            'designation'      => 'nullable|string|max:255',
            'designation_bn'   => 'nullable|string|max:255',
            'designation_en'   => 'nullable|string|max:255',
            'subject'          => 'nullable|string|max:255',
            'subject_bn'       => 'nullable|string|max:255',
            'subject_en'       => 'nullable|string|max:255',
            'qualification_bn' => 'nullable|string|max:255',
            'qualification_en' => 'nullable|string|max:255',
            'phone'            => 'nullable|string|max:50',
            'email'            => 'nullable|email|max:255',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order'       => 'nullable|integer|min:0',
            'status'           => 'nullable|boolean',
        ]);

        $teacher = new Teacher();

        $nameBn = $validated['name_bn'] ?? $validated['name'] ?? '';
        $nameEn = $validated['name_en'] ?? $nameBn;

        $teacher->name = $nameBn;
        $teacher->name_bn = $nameBn;
        $teacher->name_en = $nameEn;
        $teacher->type = $validated['type'];

        $desigBn = $validated['designation_bn'] ?? $validated['designation'] ?? null;
        $teacher->designation = $desigBn;
        $teacher->designation_bn = $desigBn;
        $teacher->designation_en = $validated['designation_en'] ?? $desigBn;

        $subBn = $validated['subject_bn'] ?? $validated['subject'] ?? null;
        $teacher->subject = $subBn;
        $teacher->subject_bn = $subBn;
        $teacher->subject_en = $validated['subject_en'] ?? $subBn;

        $teacher->qualification_bn = $validated['qualification_bn'] ?? null;
        $teacher->qualification_en = $validated['qualification_en'] ?? null;

        $teacher->phone = $validated['phone'] ?? null;
        $teacher->email = $validated['email'] ?? null;
        $teacher->sort_order = $validated['sort_order'] ?? 0;
        $teacher->status = $request->has('status') ? 1 : 0;
        $teacher->is_delete = 0;

        /**
         * Upload image
         */
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $filename = time() . '_' . uniqid() . '.' .
                $image->getClientOriginalExtension();

            $image->storeAs(
                'images/teachers',
                $filename,
                'public'
            );

            $teacher->image = 'storage/images/teachers/' . $filename;
        }

        $teacher->save();

        $message = $teacher->type === 'staff'
            ? 'Staff added successfully.'
            : 'Teacher added successfully.';

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', $message);
    }

    /**
     * Edit page
     */
    public function edit(Teacher $teacher)
    {
        return view('backend.teachers.edit', compact('teacher'));
    }

    /**
     * Update teacher or staff
     */
    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name'             => 'nullable|string|max:255',
            'name_bn'          => 'nullable|string|max:255',
            'name_en'          => 'nullable|string|max:255',
            'type'             => 'required|in:teacher,staff',
            'designation'      => 'nullable|string|max:255',
            'designation_bn'   => 'nullable|string|max:255',
            'designation_en'   => 'nullable|string|max:255',
            'subject'          => 'nullable|string|max:255',
            'subject_bn'       => 'nullable|string|max:255',
            'subject_en'       => 'nullable|string|max:255',
            'qualification_bn' => 'nullable|string|max:255',
            'qualification_en' => 'nullable|string|max:255',
            'phone'            => 'nullable|string|max:50',
            'email'            => 'nullable|email|max:255',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order'       => 'nullable|integer|min:0',
            'status'           => 'nullable|boolean',
        ]);

        $nameBn = $validated['name_bn'] ?? $validated['name'] ?? $teacher->name_bn;
        $nameEn = $validated['name_en'] ?? $nameBn;

        $teacher->name = $nameBn;
        $teacher->name_bn = $nameBn;
        $teacher->name_en = $nameEn;
        $teacher->type = $validated['type'];

        $desigBn = $validated['designation_bn'] ?? $validated['designation'] ?? $teacher->designation_bn;
        $teacher->designation = $desigBn;
        $teacher->designation_bn = $desigBn;
        $teacher->designation_en = $validated['designation_en'] ?? $desigBn;

        $subBn = $validated['subject_bn'] ?? $validated['subject'] ?? $teacher->subject_bn;
        $teacher->subject = $subBn;
        $teacher->subject_bn = $subBn;
        $teacher->subject_en = $validated['subject_en'] ?? $subBn;

        $teacher->qualification_bn = $validated['qualification_bn'] ?? $teacher->qualification_bn;
        $teacher->qualification_en = $validated['qualification_en'] ?? $teacher->qualification_en;

        $teacher->phone = $validated['phone'] ?? null;
        $teacher->email = $validated['email'] ?? null;
        $teacher->sort_order = $validated['sort_order'] ?? 0;
        $teacher->status = $request->has('status') ? 1 : 0;

        /**
         * Replace old image
         */
        if ($request->hasFile('image')) {

            if ($teacher->image) {
                $oldImage = str_replace(
                    'storage/',
                    '',
                    $teacher->image
                );

                if (Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $image = $request->file('image');

            $filename = time() . '_' . uniqid() . '.' .
                $image->getClientOriginalExtension();

            $image->storeAs(
                'images/teachers',
                $filename,
                'public'
            );

            $teacher->image = 'storage/images/teachers/' . $filename;
        }

        $teacher->save();

        $message = $teacher->type === 'staff'
            ? 'Staff updated successfully.'
            : 'Teacher updated successfully.';

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', $message);
    }

    /**
     * Soft delete
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->update([
            'is_delete' => 1,
        ]);

        $message = $teacher->type === 'staff'
            ? 'Staff deleted successfully.'
            : 'Teacher deleted successfully.';

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', $message);
    }
}