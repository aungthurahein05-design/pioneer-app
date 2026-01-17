<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classroom;
use App\Models\Section;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // ======================
    // INDEX
    // ======================
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    // ======================
    // CREATE
    // ======================
    public function create()
    {
        $classrooms = Classroom::all();
        $sections = Section::all();

        return view('students.create', compact('classrooms', 'sections'));
    }

    // ======================
    // STORE
    // ======================
    public function store(Request $request)
    {
        $data = $request->validate([
            'student_code' => 'required|unique:students',
            'name'         => 'required',
            'gender'       => 'nullable',
            'date_of_birth'=> 'nullable|date',
            'classroom_id' => 'required',
            'section_id'   => 'required',
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $fileName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images/students'), $fileName);
            $data['photo'] = $fileName;
        }

        Student::create($data);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student created successfully');
    }

    // ======================
    // SHOW
    // ======================
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    // ======================
    // EDIT
    // ======================
    public function edit(Student $student)
    {
        $classrooms = Classroom::all();
        $sections = Section::all();

        return view('students.edit', compact('student', 'classrooms', 'sections'));
    }

    // ======================
    // UPDATE
    // ======================
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'student_code' => 'required|unique:students,student_code,' . $student->id,
            'name'         => 'required',
            'gender'       => 'nullable',
            'date_of_birth'=> 'nullable|date',
            'classroom_id' => 'required',
            'section_id'   => 'required',
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle photo update
        if ($request->hasFile('photo')) {

            // delete old photo
            if ($student->photo && file_exists(public_path('images/students/' . $student->photo))) {
                unlink(public_path('images/students/' . $student->photo));
            }

            $fileName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images/students'), $fileName);
            $data['photo'] = $fileName;
        }

        $student->update($data);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully');
    }

    // ======================
    // DESTROY
    // ======================
    public function destroy(Student $student)
    {
        // delete photo
        if ($student->photo && file_exists(public_path('images/students/' . $student->photo))) {
            unlink(public_path('images/students/' . $student->photo));
        }

        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted successfully');
    }
}
