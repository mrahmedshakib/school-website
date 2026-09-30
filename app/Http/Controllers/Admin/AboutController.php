<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    /**
     * Display About sections.
     */
    public function index()
    {
        $abouts = About::where('is_delete', 0)
            ->orderBy('id', 'desc')
            ->get();

        return view('backend.abouts.index', compact('abouts'));
    }


    /**
     * Show create form.
     */
    public function create()
    {
        return view('backend.abouts.create');
    }


    /**
     * Store About section.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'nullable|boolean',
        ]);

        $imagePath = null;

        /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = 'about_' . time() . '_' . Str::random(10)
                . '.' . $image->getClientOriginalExtension();

            $uploadPath = public_path('storage/images/about');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $image->move($uploadPath, $imageName);

            $imagePath = 'storage/images/about/' . $imageName;
        }


        /*
        |--------------------------------------------------------------------------
        | Create About
        |--------------------------------------------------------------------------
        */

        About::create([
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $imagePath,
            'status'      => $request->has('status') ? 1 : 0,
            'is_delete'   => 0,
        ]);


        return redirect()
            ->route('admin.abouts.index')
            ->with('success', 'About section created successfully.');
    }


    /**
     * Show edit form.
     */
    public function edit($id)
    {
        $about = About::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        return view('backend.abouts.edit', compact('about'));
    }


    /**
     * Update About section.
     */
    public function update(Request $request, $id)
    {
        $about = About::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'nullable|boolean',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Update Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            // Delete old image
            if (!empty($about->image)) {

                $oldImagePath = public_path($about->image);

                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }


            // Upload new image
            $image = $request->file('image');

            $imageName = 'about_' . time() . '_' . Str::random(10)
                . '.' . $image->getClientOriginalExtension();

            $uploadPath = public_path('storage/images/about');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $image->move($uploadPath, $imageName);

            $about->image = 'storage/images/about/' . $imageName;
        }


        /*
        |--------------------------------------------------------------------------
        | Update Data
        |--------------------------------------------------------------------------
        */

        $about->title = $request->title;
        $about->description = $request->description;
        $about->status = $request->has('status') ? 1 : 0;

        $about->save();


        return redirect()
            ->route('admin.abouts.index')
            ->with('success', 'About section updated successfully.');
    }


    /**
     * Toggle Status.
     */
    public function toggleStatus($id)
    {
        $about = About::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        $about->status = $about->status ? 0 : 1;

        $about->save();

        return redirect()
            ->back()
            ->with('success', 'About status updated successfully.');
    }


    /**
     * Soft Delete.
     */
    public function destroy($id)
    {
        $about = About::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        $about->is_delete = 1;

        $about->save();

        return redirect()
            ->route('admin.abouts.index')
            ->with('success', 'About section deleted successfully.');
    }
}