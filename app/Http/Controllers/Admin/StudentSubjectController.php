<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class StudentSubjectController extends Controller
{
    // Show assign subjects form
    public function create(Student $student)
    {
        return view('admin.student_subjects.create', [
            'student'  => $student,
            'subjects' => Subject::orderBy('name')->get(),
        ]);
    }

    // Save assigned subjects
    public function store(Request $request, Student $student)
    {
        $data = $request->validate([
            'subject_ids'   => ['required','array','min:1'],
            'subject_ids.*' => ['exists:subjects,id'],
            'academic_year' => ['required','string','max:20'],
            'term'          => ['required','string','max:50'],
        ]);

        /**
         * ✅ THIS IS WHERE YOUR CODE GOES
         */
        $syncData = [];

        foreach ($data['subject_ids'] as $subjectId) {
            $syncData[$subjectId] = [
                'academic_year' => $data['academic_year'],
                'term'          => $data['term'],
                'status'        => 'active',
            ];
        }

        $student->subjects()->sync($syncData);

        return redirect()
            ->route('admin.students.show', $student)
            ->with('success', 'Subjects assigned successfully.');
    }
}
