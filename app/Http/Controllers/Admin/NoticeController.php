<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * Display notices.
     */
    public function index()
    {
        $notices = Notice::where('status', 1)
            ->where('is_delete', 0)
            ->orderBy('notice_date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('backend.notices.index', compact('notices'));
    }


    /**
     * Show create form.
     */
    public function create()
    {
        return view('backend.notices.create');
    }


    /**
     * Store notice.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'nullable|string|max:255',
            'title_bn'       => 'nullable|string|max:255',
            'title_en'       => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'description_bn' => 'nullable|string',
            'description_en' => 'nullable|string',
            'category'       => 'nullable|string|max:100',
            'notice_date'    => 'nullable|date',
            'file'           => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,webp|max:10240',
            'status'         => 'required|boolean',
        ]);

        $notice = new Notice();

        $titleBn = $validated['title_bn'] ?? $validated['title'] ?? 'নোটিশ';
        $titleEn = $validated['title_en'] ?? $titleBn;

        $notice->title = $titleBn;
        $notice->title_bn = $titleBn;
        $notice->title_en = $titleEn;
        $notice->description = $validated['description_bn'] ?? $validated['description'] ?? null;
        $notice->description_bn = $validated['description_bn'] ?? $validated['description'] ?? null;
        $notice->description_en = $validated['description_en'] ?? null;
        $notice->category = $validated['category'] ?? 'Academic';
        $notice->notice_date = $validated['notice_date'] ?? date('Y-m-d');
        $notice->status = $validated['status'];
        $notice->is_delete = 0;


        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $fileName = time() . '_' . uniqid() . '.' .
                $file->getClientOriginalExtension();

            $file->move(
                public_path('uploads/notices'),
                $fileName
            );

            $notice->file = 'uploads/notices/' . $fileName;
        }


        $notice->save();

        return redirect()
            ->route('admin.notices.index')
            ->with('success', 'Notice created successfully.');
    }


    /**
     * Show edit form.
     */
    public function edit($id)
    {
        $notice = Notice::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        return view('backend.notices.edit', compact('notice'));
    }


    /**
     * Update notice.
     */
    public function update(Request $request, $id)
    {
        $notice = Notice::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        $validated = $request->validate([
            'title'          => 'nullable|string|max:255',
            'title_bn'       => 'nullable|string|max:255',
            'title_en'       => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'description_bn' => 'nullable|string',
            'description_en' => 'nullable|string',
            'category'       => 'nullable|string|max:100',
            'notice_date'    => 'nullable|date',
            'file'           => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png,webp|max:10240',
            'status'         => 'required|boolean',
        ]);

        $titleBn = $validated['title_bn'] ?? $validated['title'] ?? $notice->title_bn;
        $titleEn = $validated['title_en'] ?? $titleBn;

        $notice->title = $titleBn;
        $notice->title_bn = $titleBn;
        $notice->title_en = $titleEn;
        $notice->description = $validated['description_bn'] ?? $validated['description'] ?? $notice->description_bn;
        $notice->description_bn = $validated['description_bn'] ?? $validated['description'] ?? $notice->description_bn;
        $notice->description_en = $validated['description_en'] ?? $notice->description_en;
        $notice->category = $validated['category'] ?? $notice->category ?? 'Academic';
        $notice->notice_date = $validated['notice_date'] ?? $notice->notice_date;
        $notice->status = $validated['status'];


        if ($request->hasFile('file')) {

            // Delete old file
            if ($notice->file) {

                $oldFile = public_path($notice->file);

                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }


            // Upload new file
            $file = $request->file('file');

            $fileName = time() . '_' . uniqid() . '.' .
                $file->getClientOriginalExtension();

            $file->move(
                public_path('uploads/notices'),
                $fileName
            );

            $notice->file = 'uploads/notices/' . $fileName;
        }


        $notice->save();

        return redirect()
            ->route('admin.notices.index')
            ->with('success', 'Notice updated successfully.');
    }


    /**
     * Toggle status.
     */
    public function toggleStatus($id)
    {
        $notice = Notice::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        $notice->status = $notice->status == 1 ? 0 : 1;

        $notice->save();

        return redirect()
            ->route('admin.notices.index')
            ->with('success', 'Notice status updated successfully.');
    }


    /**
     * Soft delete notice.
     */
    public function destroy($id)
    {
        $notice = Notice::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        $notice->is_delete = 1;

        $notice->save();

        return redirect()
            ->route('admin.notices.index')
            ->with('success', 'Notice deleted successfully.');
    }
}