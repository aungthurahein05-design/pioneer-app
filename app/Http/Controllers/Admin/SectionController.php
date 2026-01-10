<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::with('classroom')->latest()->paginate(10);
        return view('admin.sections.index', compact('sections'));
    }

    public function create()
    {
        $classrooms = Classroom::orderBy('name')->get();
        return view('admin.sections.create', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'name' => 'required|string|max:50',
        ]);

        // unique per classroom
        if (Section::where('classroom_id', $data['classroom_id'])->where('name', $data['name'])->exists()) {
            return back()->withErrors(['name' => 'This section already exists for that classroom.'])->withInput();
        }

        Section::create($data);

        return redirect()->route('admin.sections.index')->with('success', 'Section created.');
    }

    public function edit(Section $section)
    {
        $classrooms = Classroom::orderBy('name')->get();
        return view('admin.sections.edit', compact('section','classrooms'));
    }

    public function update(Request $request, Section $section)
    {
        $data = $request->validate([
            'classroom_id' => 'required|exists:classrooms,id',
            'name' => 'required|string|max:50',
        ]);

        if (Section::where('classroom_id', $data['classroom_id'])
            ->where('name', $data['name'])
            ->where('id', '!=', $section->id)->exists()) {
            return back()->withErrors(['name' => 'This section already exists for that classroom.'])->withInput();
        }

        $section->update($data);

        return redirect()->route('admin.sections.index')->with('success', 'Section updated.');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('admin.sections.index')->with('success', 'Section deleted.');
    }

    public function show(Section $section)
    {
        $section->load('classroom');
        return view('admin.sections.show', compact('section'));
    }
}
