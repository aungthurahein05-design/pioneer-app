<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use App\Models\Student;
use App\Models\Grade;
use Illuminate\Http\Request;

class ExamResultController extends Controller
{
    public function index()
    {
        $results = ExamResult::with(['student', 'grade'])
            ->orderByDesc('result_date')
            ->paginate(20);

        return view('admin.exam_results.index', compact('results'));
    }

    public function create()
    {
        $students = Student::orderBy('name')->get();
        $grades   = Grade::orderBy('name')->get();

        return view('admin.exam_results.create', compact('students', 'grades'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // ✅ hybrid: select OR manual
            'student_id'   => 'nullable|exists:students,id',
            'grade_id'     => 'nullable|exists:grades,id',
            'student_name' => 'nullable|string|max:255',
            'grade_name'   => 'nullable|string|max:255',

            'exam_name'    => 'required|string|max:255',
            'subject'      => 'nullable|string|max:255',
            'score'        => 'nullable|numeric',
            'max_score'    => 'nullable|numeric',
            'result_date'  => 'required|date',
            'status'       => 'nullable|string|max:255',
            'remarks'      => 'nullable|string',
        ]);

        // ✅ Ensure at least one of student_id or student_name
        if (empty($data['student_id']) && empty($data['student_name'])) {
            return back()->withErrors(['student_name' => 'Select student OR type student name'])->withInput();
        }
        if (empty($data['grade_id']) && empty($data['grade_name'])) {
            return back()->withErrors(['grade_name' => 'Select grade OR type grade name'])->withInput();
        }

        // ✅ If selected from DB, fill manual name automatically (for display)
        if (!empty($data['student_id'])) {
            $student = Student::find($data['student_id']);
            $data['student_name'] = $student?->name;
        }

        if (!empty($data['grade_id'])) {
            $grade = Grade::find($data['grade_id']);
            $data['grade_name'] = $grade?->name;
        }

        ExamResult::create($data);

        return redirect()->route('admin.exam-results.index')
            ->with('success', 'Exam result created successfully');
    }

    public function edit(ExamResult $examResult)
    {
        $students = Student::orderBy('name')->get();
        $grades   = Grade::orderBy('name')->get();

        return view('admin.exam_results.edit', compact('examResult', 'students', 'grades'));
    }

    public function update(Request $request, ExamResult $examResult)
    {
        $data = $request->validate([
            'student_id'   => 'nullable|exists:students,id',
            'grade_id'     => 'nullable|exists:grades,id',
            'student_name' => 'nullable|string|max:255',
            'grade_name'   => 'nullable|string|max:255',

            'exam_name'    => 'required|string|max:255',
            'subject'      => 'nullable|string|max:255',
            'score'        => 'nullable|numeric',
            'max_score'    => 'nullable|numeric',
            'result_date'  => 'required|date',
            'status'       => 'nullable|string|max:255',
            'remarks'      => 'nullable|string',
        ]);

        if (empty($data['student_id']) && empty($data['student_name'])) {
            return back()->withErrors(['student_name' => 'Select student OR type student name'])->withInput();
        }
        if (empty($data['grade_id']) && empty($data['grade_name'])) {
            return back()->withErrors(['grade_name' => 'Select grade OR type grade name'])->withInput();
        }

        // If selected, update manual name too
        if (!empty($data['student_id'])) {
            $student = Student::find($data['student_id']);
            $data['student_name'] = $student?->name;
        }

        if (!empty($data['grade_id'])) {
            $grade = Grade::find($data['grade_id']);
            $data['grade_name'] = $grade?->name;
        }

        $examResult->update($data);

        return redirect()->route('admin.exam-results.index')
            ->with('success', 'Exam result updated successfully');
    }

    public function destroy(ExamResult $examResult)
    {
        $examResult->delete();

        return redirect()->route('admin.exam-results.index')
            ->with('success', 'Exam result deleted successfully');
    }
}
