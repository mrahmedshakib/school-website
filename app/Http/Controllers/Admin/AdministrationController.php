<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdministrationController extends Controller
{
    public function index()
    {
        $administrations = Administration::where('is_delete', 0)
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(5);

        $totalAdministrations = Administration::where('is_delete', 0)->count();

        $activeAdministrations = Administration::where('is_delete', 0)
            ->where('status', 1)
            ->count();

        $inactiveAdministrations = Administration::where('is_delete', 0)
            ->where('status', 0)
            ->count();

        return view('backend.administrations.index', compact(
            'administrations',
            'totalAdministrations',
            'activeAdministrations',
            'inactiveAdministrations'
        ));
    }

    public function create()
    {
        return view('backend.administrations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('administrations', 'public');
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_delete'] = 0;

        Administration::create($validated);

        return redirect()
            ->route('admin.administrations.index')
            ->with('success', 'Administration created successfully.');
    }

    public function edit($id)
    {
        $administration = Administration::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        return view(
            'backend.administrations.edit',
            compact('administration')
        );
    }

    public function update(Request $request, $id)
    {
        $administration = Administration::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {

            if (
                !empty($administration->image) &&
                Storage::disk('public')->exists($administration->image)
            ) {
                Storage::disk('public')->delete(
                    $administration->image
                );
            }

            $validated['image'] = $request
                ->file('image')
                ->store('administrations', 'public');
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $administration->update($validated);

        return redirect()
            ->route('admin.administrations.index')
            ->with('success', 'Administration updated successfully.');
    }

    public function destroy($id)
    {
        $administration = Administration::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        $administration->update([
            'is_delete' => 1,
        ]);

        return redirect()
            ->route('admin.administrations.index')
            ->with('success', 'Administration deleted successfully.');
    }

    public function toggleStatus($id)
    {
        $administration = Administration::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        $newStatus = $administration->status ? 0 : 1;

        $administration->update([
            'status' => $newStatus,
        ]);

        return redirect()
            ->route('admin.administrations.index')
            ->with(
                'success',
                $newStatus
                    ? 'Administration activated successfully.'
                    : 'Administration deactivated successfully.'
            );
    }
}
