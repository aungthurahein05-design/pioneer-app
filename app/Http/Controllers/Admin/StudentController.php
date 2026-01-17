<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Section;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['classroom', 'section'])
            ->latest()
            ->get();

        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $classrooms = Classroom::all();
        $sections   = Section::all();

        return view('admin.students.create', compact('classrooms', 'sections'));
    }

    public function store(Request $request)
    {
        Student::create($request->all());

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student created successfully');
    }

    public function show(Student $student)
    {
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $classrooms = Classroom::all();
        $sections   = Section::all();

        return view('admin.students.edit', compact('student', 'classrooms', 'sections'));
    }

    public function update(Request $request, Student $student)
    {
        $student->update($request->all());

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student deleted successfully');
    }
}
