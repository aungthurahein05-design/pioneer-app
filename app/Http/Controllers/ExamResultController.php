<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use Illuminate\Http\Request;

class ExamResultController extends Controller
{
    public function index()
    {
        $results = ExamResult::orderByDesc('result_date')->paginate(20);
        return view('admin.exam_results.index', compact('results'));
    }

    public function create()
    {
        return view('admin.exam_results.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id'  => 'nullable|integer',
            'grade_id'    => 'nullable|integer',
            'exam_name'   => 'required|string|max:255',
            'subject'     => 'nullable|string|max:255',
            'score'       => 'nullable|numeric',
            'max_score'   => 'nullable|numeric',
            'result_date' => 'required|date',
            'status'      => 'nullable|string|max:50',
            'remarks'     => 'nullable|string',
        ]);

        ExamResult::create($data);

        return redirect()->route('admin.exam-results.index')
            ->with('success', 'Exam result created successfully.');
    }

    public function edit(ExamResult $exam_result)
    {
        return view('admin.exam_results.edit', ['result' => $exam_result]);
    }

    public function update(Request $request, ExamResult $exam_result)
    {
        $data = $request->validate([
            'student_id'  => 'nullable|integer',
            'grade_id'    => 'nullable|integer',
            'exam_name'   => 'required|string|max:255',
            'subject'     => 'nullable|string|max:255',
            'score'       => 'nullable|numeric',
            'max_score'   => 'nullable|numeric',
            'result_date' => 'required|date',
            'status'      => 'nullable|string|max:50',
            'remarks'     => 'nullable|string',
        ]);

        $exam_result->update($data);

        return redirect()->route('admin.exam-results.index')
            ->with('success', 'Exam result updated successfully.');
    }

    public function destroy(ExamResult $exam_result)
    {
        $exam_result->delete();

        return redirect()->route('admin.exam-results.index')
            ->with('success', 'Exam result deleted successfully.');
    }
}
