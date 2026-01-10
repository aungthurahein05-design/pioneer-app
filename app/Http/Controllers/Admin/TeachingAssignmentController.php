<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeachingAssignment;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\Section;
use Illuminate\Http\Request;

class TeachingAssignmentController extends Controller
{
    public function index()
    {
        $items = TeachingAssignment::with(['teacher','subject','classroom','section'])
            ->latest()->paginate(10);

        return view('admin.teaching_assignments.index', compact('items'));
    }

    public function create()
    {
        $teachers = Teacher::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        $classrooms = Classroom::orderBy('name')->get();
        $sections = Section::with('classroom')->orderBy('name')->get();

        return view('admin.teaching_assignments.create', compact('teachers','subjects','classrooms','sections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'nullable|exists:sections,id',
        ]);

        // if section provided, ensure it belongs to classroom
        if (!empty($data['section_id'])) {
            $sec = Section::find($data['section_id']);
            if ($sec->classroom_id != $data['classroom_id']) {
                return back()->withErrors(['section_id' => 'Section does not belong to selected classroom.'])->withInput();
            }
        }

        // prevent duplicates
        $exists = TeachingAssignment::where($data)->exists();
        if ($exists) {
            return back()->withErrors(['teacher_id' => 'This teaching assignment already exists.'])->withInput();
        }

        TeachingAssignment::create($data);

        return redirect()->route('admin.teaching-assignments.index')->with('success', 'Teaching assignment created.');
    }

    public function edit(TeachingAssignment $teaching_assignment)
    {
        $teachers = Teacher::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        $classrooms = Classroom::orderBy('name')->get();
        $sections = Section::with('classroom')->orderBy('name')->get();

        return view('admin.teaching_assignments.edit', [
            'item' => $teaching_assignment,
            'teachers' => $teachers,
            'subjects' => $subjects,
            'classrooms' => $classrooms,
            'sections' => $sections,
        ]);
    }

    public function update(Request $request, TeachingAssignment $teaching_assignment)
    {
        $data = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'nullable|exists:sections,id',
        ]);

        if (!empty($data['section_id'])) {
            $sec = Section::find($data['section_id']);
            if ($sec->classroom_id != $data['classroom_id']) {
                return back()->withErrors(['section_id' => 'Section does not belong to selected classroom.'])->withInput();
            }
        }

        $exists = TeachingAssignment::where($data)
            ->where('id','!=',$teaching_assignment->id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['teacher_id' => 'This teaching assignment already exists.'])->withInput();
        }

        $teaching_assignment->update($data);

        return redirect()->route('admin.teaching-assignments.index')->with('success', 'Teaching assignment updated.');
    }

    public function destroy(TeachingAssignment $teaching_assignment)
    {
        $teaching_assignment->delete();
        return redirect()->route('admin.teaching-assignments.index')->with('success', 'Teaching assignment deleted.');
    }

    public function show(TeachingAssignment $teaching_assignment)
    {
        $teaching_assignment->load(['teacher','subject','classroom','section']);
        return view('admin.teaching_assignments.show', ['item' => $teaching_assignment]);
    }
}
