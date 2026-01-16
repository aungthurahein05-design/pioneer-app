<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classroom;
use App\Models\Section;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

  public function create()
{
    $classrooms = Classroom::all();
    $sections = Section::all();

    return view('students.create', compact('classrooms', 'sections'));
}

    public function store(Request $request)
    {
        Student::create($request->all());

        return redirect()
            ->route('students.index')
            ->with('success', 'Student created successfully');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

   public function edit(Student $student)
{
    $classrooms = Classroom::all();
    $sections = Section::all();

    return view('students.edit', compact('student', 'classrooms', 'sections'));
}

    public function update(Request $request, Student $student)
    {
        $student->update($request->all());

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted successfully');
    }
}
