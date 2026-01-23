<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Classroom;
use App\Models\Section;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Display list of students
    public function index()
    {
        $students = Student::with(['classroom', 'section'])
            ->latest()
            ->get();

        return view('admin.students.index', compact('students'));
    }

    // Show the form to create a new student
    public function create()
    {
        $classrooms = Classroom::all();
        $sections   = Section::all();

        return view('admin.students.create', compact('classrooms', 'sections'));
    }

    // Store a new student
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'student_code'    => 'required|unique:students,student_code|max:20',
            'name'            => 'required|string|max:255',
            'gender'          => 'required|in:male,female,other',
            'date_of_birth'   => 'nullable|date',
            'classroom_id'    => 'required|exists:classrooms,id',
            'section_id'      => 'required|exists:sections,id',
            'admission_year'  => 'nullable|digits:4|integer',
            'roll_number'     => 'nullable|integer',
            'father_name'     => 'nullable|string|max:255',
            'mother_name'     => 'nullable|string|max:255',
            'guardian_phone'  => 'nullable|string|max:15',
            'phone'           => 'nullable|string|max:15',
            'photo'           => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'email'           => 'nullable|email|unique:students,email',
            'status'          => 'required|in:active,inactive',
        ]);

        // Handle photo upload if present
        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('students', 'public');
        }

        // Create student record
        Student::create($validatedData);

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student created successfully');
    }

    // Show single student details
    public function show(Student $student)
    {
        return view('admin.students.show', compact('student'));
    }

    // Show form to edit a student
    public function edit(Student $student)
    {
        $classrooms = Classroom::all();
        $sections   = Section::all();

        return view('admin.students.edit', compact('student', 'classrooms', 'sections'));
    }

    // Update an existing student
    public function update(Request $request, Student $student)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'student_code'    => 'required|max:20|unique:students,student_code,' . $student->id,
            'name'            => 'required|string|max:255',
            'gender'          => 'required|in:male,female,other',
            'date_of_birth'   => 'nullable|date',
            'classroom_id'    => 'required|exists:classrooms,id',
            'section_id'      => 'required|exists:sections,id',
            'admission_year'  => 'nullable|digits:4|integer',
            'roll_number'     => 'nullable|integer',
            'father_name'     => 'nullable|string|max:255',
            'mother_name'     => 'nullable|string|max:255',
            'guardian_phone'  => 'nullable|string|max:15',
            'phone'           => 'nullable|string|max:15',
            'photo'           => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'email'           => 'nullable|email|unique:students,email,' . $student->id,
            'status'          => 'required|in:active,inactive',
        ]);

        // Handle photo upload if present
        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('students', 'public');
        }

        // Update student record
        $student->update($validatedData);

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student updated successfully');
    }

    // Delete a student
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->route('admin.students.index')
            ->with('success', 'Student deleted successfully');
    }
}
