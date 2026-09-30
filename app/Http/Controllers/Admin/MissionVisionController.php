<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MissionVision;
use Illuminate\Http\Request;

class MissionVisionController extends Controller
{
    public function index()
    {
        $missionVision = MissionVision::where('is_delete', 0)
            ->latest()
            ->first();

        return view(
            'backend.mission-visions.index',
            compact('missionVision')
        );
    }

    public function create()
    {
        return view('backend.mission-visions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mission_title' => 'required|string|max:255',
            'mission_description' => 'required|string',

            'vision_title' => 'required|string|max:255',
            'vision_description' => 'required|string',

            'status' => 'required|boolean',
        ]);

        MissionVision::create([
            'mission_title' => $validated['mission_title'],
            'mission_description' => $validated['mission_description'],

            'vision_title' => $validated['vision_title'],
            'vision_description' => $validated['vision_description'],

            'status' => $validated['status'],
            'is_delete' => 0,
        ]);

        return redirect()
            ->route('admin.mission-visions.index')
            ->with('success', 'Mission & Vision created successfully.');
    }

    public function edit($id)
    {
        $missionVision = MissionVision::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        return view(
            'backend.mission-visions.edit',
            compact('missionVision')
        );
    }

    public function update(Request $request, $id)
    {
        $missionVision = MissionVision::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        $validated = $request->validate([
            'mission_title' => 'required|string|max:255',
            'mission_description' => 'required|string',

            'vision_title' => 'required|string|max:255',
            'vision_description' => 'required|string',

            'status' => 'required|boolean',
        ]);

        $missionVision->update([
            'mission_title' => $validated['mission_title'],
            'mission_description' => $validated['mission_description'],

            'vision_title' => $validated['vision_title'],
            'vision_description' => $validated['vision_description'],

            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.mission-visions.index')
            ->with('success', 'Mission & Vision updated successfully.');
    }

    public function toggleStatus($id)
    {
        $missionVision = MissionVision::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        $missionVision->status = !$missionVision->status;
        $missionVision->save();

        return redirect()
            ->route('admin.mission-visions.index')
            ->with('success', 'Mission & Vision status updated successfully.');
    }

    public function destroy($id)
    {
        $missionVision = MissionVision::where('id', $id)
            ->where('is_delete', 0)
            ->firstOrFail();

        $missionVision->is_delete = 1;
        $missionVision->save();

        return redirect()
            ->route('admin.mission-visions.index')
            ->with('success', 'Mission & Vision deleted successfully.');
    }
}