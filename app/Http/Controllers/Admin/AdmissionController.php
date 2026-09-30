<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdmissionController extends Controller
{
    /**
     * Display admission information.
     */
    public function index()
    {
        $admissions = Admission::where('is_delete', 0)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('backend.admissions.index', compact('admissions'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('backend.admissions.create');
    }

    /**
     * Store new admission information.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'pdf' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:5120',
            ],

            'application_start' => 'nullable|date',

            'application_end' => [
                'nullable',
                'date',
                'after_or_equal:application_start',
            ],

            'application_url' => 'nullable|url|max:500',

            'sort_order' => 'nullable|integer|min:0',

            'status' => 'nullable|boolean',
        ]);

        $admission = new Admission();

        $admission->title = $validated['title'];
        $admission->description = $validated['description'] ?? null;
        $admission->application_start = $validated['application_start'] ?? null;
        $admission->application_end = $validated['application_end'] ?? null;
        $admission->application_url = $validated['application_url'] ?? null;
        $admission->sort_order = $validated['sort_order'] ?? 0;
        $admission->status = $request->has('status') ? 1 : 0;
        $admission->is_delete = 0;

        /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $filename = time() . '_' .
                Str::random(10) . '.' .
                $image->getClientOriginalExtension();

            $image->storeAs(
                'images/admissions',
                $filename,
                'public'
            );

            $admission->image =
                'storage/images/admissions/' . $filename;
        }

        /*
        |--------------------------------------------------------------------------
        | Upload PDF
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('pdf')) {

            $pdf = $request->file('pdf');

            $filename = time() . '_' .
                Str::random(10) . '.pdf';

            $pdf->storeAs(
                'documents/admissions',
                $filename,
                'public'
            );

            $admission->pdf =
                'storage/documents/admissions/' . $filename;
        }

        $admission->save();

        return redirect()
            ->route('admin.admissions.index')
            ->with(
                'success',
                'Admission information added successfully.'
            );
    }

    /**
     * Show edit form.
     */
    public function edit(Admission $admission)
    {
        return view(
            'backend.admissions.edit',
            compact('admission')
        );
    }

    /**
     * Update admission information.
     */
    public function update(Request $request, Admission $admission)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'pdf' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:5120',
            ],

            'application_start' => 'nullable|date',

            'application_end' => [
                'nullable',
                'date',
                'after_or_equal:application_start',
            ],

            'application_url' => 'nullable|url|max:500',

            'sort_order' => 'nullable|integer|min:0',

            'status' => 'nullable|boolean',
        ]);

        $admission->title = $validated['title'];
        $admission->description = $validated['description'] ?? null;
        $admission->application_start = $validated['application_start'] ?? null;
        $admission->application_end = $validated['application_end'] ?? null;
        $admission->application_url = $validated['application_url'] ?? null;
        $admission->sort_order = $validated['sort_order'] ?? 0;
        $admission->status = $request->has('status') ? 1 : 0;

        /*
        |--------------------------------------------------------------------------
        | Replace Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            // Delete old image
            if ($admission->image) {

                $oldImage = str_replace(
                    'storage/',
                    '',
                    $admission->image
                );

                if (
                    Storage::disk('public')
                        ->exists($oldImage)
                ) {
                    Storage::disk('public')
                        ->delete($oldImage);
                }
            }

            // Upload new image
            $image = $request->file('image');

            $filename = time() . '_' .
                Str::random(10) . '.' .
                $image->getClientOriginalExtension();

            $image->storeAs(
                'images/admissions',
                $filename,
                'public'
            );

            $admission->image =
                'storage/images/admissions/' . $filename;
        }

        /*
        |--------------------------------------------------------------------------
        | Replace PDF
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('pdf')) {

            // Delete old PDF
            if ($admission->pdf) {

                $oldPdf = str_replace(
                    'storage/',
                    '',
                    $admission->pdf
                );

                if (
                    Storage::disk('public')
                        ->exists($oldPdf)
                ) {
                    Storage::disk('public')
                        ->delete($oldPdf);
                }
            }

            // Upload new PDF
            $pdf = $request->file('pdf');

            $filename = time() . '_' .
                Str::random(10) . '.pdf';

            $pdf->storeAs(
                'documents/admissions',
                $filename,
                'public'
            );

            $admission->pdf =
                'storage/documents/admissions/' . $filename;
        }

        $admission->save();

        return redirect()
            ->route('admin.admissions.index')
            ->with(
                'success',
                'Admission information updated successfully.'
            );
    }

    /**
     * Soft delete admission information.
     */
    public function destroy(Admission $admission)
    {
        $admission->update([
            'is_delete' => 1,
        ]);

        return redirect()
            ->route('admin.admissions.index')
            ->with(
                'success',
                'Admission information deleted successfully.'
            );
    }
}