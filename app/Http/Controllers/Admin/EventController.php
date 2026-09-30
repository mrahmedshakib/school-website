<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('is_delete', 0)
            ->orderBy('sort_order', 'asc')
            ->orderBy('event_date', 'desc')
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('backend.events.index', compact('events'));
    }

    public function create()
    {
        return view('backend.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'event_date' => 'required|date',
            'event_time' => 'nullable',
            'location' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $event = new Event();

        $event->title = $validated['title'];
        $event->slug = $this->generateUniqueSlug($validated['title']);
        $event->description = $validated['description'] ?? null;
        $event->event_date = $validated['event_date'];
        $event->event_time = $validated['event_time'] ?? null;
        $event->location = $validated['location'] ?? null;
        $event->sort_order = $validated['sort_order'] ?? 0;
        $event->status = $request->has('status') ? 1 : 0;
        $event->is_delete = 0;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $filename = time() . '_' . uniqid() . '.' .
                $image->getClientOriginalExtension();

            $image->storeAs(
                'images/events',
                $filename,
                'public'
            );

            $event->image =
                'storage/images/events/' . $filename;
        }

        $event->save();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event added successfully.');
    }

    public function edit(Event $event)
    {
        return view('backend.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'event_date' => 'required|date',
            'event_time' => 'nullable',
            'location' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $event->title = $validated['title'];

        $event->slug = $this->generateUniqueSlug(
            $validated['title'],
            $event->id
        );

        $event->description =
            $validated['description'] ?? null;

        $event->event_date =
            $validated['event_date'];

        $event->event_time =
            $validated['event_time'] ?? null;

        $event->location =
            $validated['location'] ?? null;

        $event->sort_order =
            $validated['sort_order'] ?? 0;

        $event->status =
            $request->has('status') ? 1 : 0;

        if ($request->hasFile('image')) {

            if ($event->image) {
                $oldImage = str_replace(
                    'storage/',
                    '',
                    $event->image
                );

                if (Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $image = $request->file('image');

            $filename = time() . '_' . uniqid() . '.' .
                $image->getClientOriginalExtension();

            $image->storeAs(
                'images/events',
                $filename,
                'public'
            );

            $event->image =
                'storage/images/events/' . $filename;
        }

        $event->save();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->update([
            'is_delete' => 1,
        ]);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event deleted successfully.');
    }

    private function generateUniqueSlug(
        string $title,
        ?int $ignoreId = null
    ): string {
        $slug = Str::slug($title);

        if (!$slug) {
            $slug = 'event-' . time();
        }

        $originalSlug = $slug;
        $counter = 1;

        while (
            Event::where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) =>
                        $query->where('id', '!=', $ignoreId)
                )
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}