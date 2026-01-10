<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /* ===========================
     * USER SIDE: /subject
     * =========================== */
    public function publicIndex(Request $request)
    {
        $query = Subject::query();

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        if ($request->sort === 'az') {
            $query->orderBy('name', 'asc');
        } elseif ($request->sort === 'za') {
            $query->orderBy('name', 'desc');
        } else {
            $query->latest();
        }

        $subjects = $query->paginate(9);

        return view('subject', compact('subjects'));
    }

    /* ===========================
     * ADMIN SIDE CRUD
     * =========================== */
    public function index()
    {
        $subjects = Subject::latest()->paginate(10);
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Subject::create($validated);

        return redirect()->route('admin.subjects.index')->with('success', 'Subject created.');
    }

    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $subject->update($validated);

        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted.');
    }
}
