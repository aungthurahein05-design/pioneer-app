<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /* =========================
       ADMIN SIDE
    ========================== */

    public function index()
    {
        $events = Event::orderBy('date', 'desc')->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'date'        => 'nullable|date',

            // Media
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'video'       => 'nullable|string|max:2000', // YouTube / MP4 URL
        ]);

        $data = $request->only(['title', 'description', 'date', 'video']);

        // Upload image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        Event::create($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event created successfully.');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date'        => 'required|date',

            // Media
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'video'       => 'nullable|string|max:2000',
            'remove_image'=> 'nullable|boolean',
        ]);

        $data = $request->only(['title', 'description', 'date', 'video']);

        // Remove current image (checkbox)
        if ($request->boolean('remove_image') && $event->image) {
            Storage::disk('public')->delete($event->image);
            $data['image'] = null;
        }

        // Replace image (new upload)
        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $event->update($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event updated successfully.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // delete image file
        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event deleted successfully.');
    }


    /* =========================
       PUBLIC / USER SIDE
    ========================== */

    public function publicIndex(Request $request)
    {
        $query = Event::query();

        // Search (title/description)
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        // Filter: upcoming / past
        if ($request->type === 'upcoming') {
            $query->whereDate('date', '>=', now());
        } elseif ($request->type === 'past') {
            $query->whereDate('date', '<', now());
        }

        $events = $query
            ->orderBy('date', 'asc')
            ->paginate(9)
            ->withQueryString();

        return view('events', compact('events'));
    }
}
