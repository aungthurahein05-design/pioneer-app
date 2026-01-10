<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
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
        ]);

        Event::create([
            'title'       => $request->title,
            'description' => $request->description,
            'date'        => $request->date,
        ]);

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
        ]);

        // Update fields
        $event->title = $request->title;
        $event->description = $request->description;
        $event->date = $request->date;        

        $event->save();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event updated successfully.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);       

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event deleted successfully.');
    }


    public function publicIndex(Request $request)
    {
        $query = Event::query();

        // Search
        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%')
                  ->orWhere('description', 'like', '%' . $request->q . '%');
        }

        // Filters
        if ($request->type === 'upcoming') {
            $query->whereDate('date', '>=', now());
        } elseif ($request->type === 'past') {
            $query->whereDate('date', '<', now());
        }

        $events = $query
            ->orderBy('date', 'asc')
            ->paginate(9);

        return view('events', compact('events'));
    }

   

}
