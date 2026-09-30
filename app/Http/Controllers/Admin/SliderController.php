<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Slider List
     */

    public function index() {
        // Slider list
        $sliders = Slider::select([
                'id',
                'image',
                'title',
                'subtitle',
                'description',
                'button_text',
                'button_url',
                'sort_order',
                'status',
            ])
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(10);

        // Counts directly from database
        $totalSliders = Slider::count();

        $activeSliders = Slider::where('status', 1)->count();

        $inactiveSliders = Slider::where('status', 0)->count();

        return view('backend.sliders.index', compact(
            'sliders',
            'totalSliders',
            'activeSliders',
            'inactiveSliders'
        ));
    }


    /**
     * Create Page
     */
    public function create()
    {
        return view('backend.sliders.create');
    }


    /**
     * Store Slider
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);


        $data = [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->has('status') ? 1 : 0,
            'is_delete' => 0,
        ];


        /**
         * Upload Image
         */
        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = 'slider_' . time() . '_' . uniqid()
                . '.' . $image->getClientOriginalExtension();

            $image->move(
                public_path('storage/images/sliders'),
                $imageName
            );

            $data['image'] =
                'storage/images/sliders/' . $imageName;
        }


        Slider::create($data);


        return redirect()
            ->route('admin.sliders.index')
            ->with('success', 'Slider successfully added.');
    }


    /**
     * Edit Page
     */
    public function edit($id)
    {
        $slider = Slider::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        return view(
            'backend.sliders.edit',
            compact('slider')
        );
    }


    /**
     * Update Slider
     */
    public function update(Request $request, $id)
    {
        $slider = Slider::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();


        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);


        $data = [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_url' => $request->button_url,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->has('status') ? 1 : 0,
        ];


        /**
         * New Image Upload
         */
        if ($request->hasFile('image')) {

            // Delete old image
            if ($slider->image) {

                $oldImage = public_path($slider->image);

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }


            $image = $request->file('image');

            $imageName = 'slider_' . time() . '_' . uniqid()
                . '.' . $image->getClientOriginalExtension();

            $image->move(
                public_path('storage/images/sliders'),
                $imageName
            );


            $data['image'] =
                'storage/images/sliders/' . $imageName;
        }


        $slider->update($data);


        return redirect()
            ->route('admin.sliders.index')
            ->with('success', 'Slider successfully updated.');
    }


    /**
     * Delete Slider
     */
    public function destroy($id)
    {
        $slider = Slider::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();


        // Delete image
        if ($slider->image) {

            $image = public_path($slider->image);

            if (file_exists($image)) {
                unlink($image);
            }
        }


        // Soft delete
        $slider->update([
            'is_delete' => 1,
        ]);


        return redirect()
            ->route('admin.sliders.index')
            ->with('success', 'Slider successfully deleted.');
    }


    /**
     * Toggle Status
     */
    public function toggleStatus($id)
    {
        $slider = Slider::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();


        $slider->update([
            'status' => !$slider->status,
        ]);


        return redirect()
            ->route('admin.sliders.index')
            ->with('success', 'Slider status updated.');
    }
}