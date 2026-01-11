<?php

namespace App\Http\Controllers;

use App\Models\ExamResult;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExamResultController extends Controller
{
    // ADMIN: list + filter
    public function index(Request $request)
    {
        $q = ExamResult::query()
            ->with(['student','classroom','section','subject','teacher'])
            ->orderByDesc('result_date')
            ->orderByDesc('id');

        if ($request->filled('classroom_id')) $q->where('classroom_id', $request->classroom_id);
        if ($request->filled('section_id'))   $q->where('section_id', $request->section_id);
        if ($request->filled('subject_id'))   $q->where('subject_id', $request->subject_id);
        if ($request->filled('exam_type'))    $q->where('exam_type', $request->exam_type);
        if ($request->filled('status'))       $q->where('status', $request->status);

        if ($request->filled('year'))  $q->whereYear('result_date', $request->year);
        if ($request->filled('month')) $q->whereMonth('result_date', $request->month);

        $examResults = $q->paginate(15)->withQueryString();

        return view('admin.exam_results.index', [
            'examResults' => $examResults,
            'classrooms'  => Classroom::orderBy('name')->get(),
            'sections'    => Section::orderBy('name')->get(),
            'subjects'    => Subject::orderBy('name')->get(),
        ]);
    }

    // ADMIN: create form
    public function create()
    {
        return view('admin.exam_results.create', [
            'students'   => Student::orderBy('name')->get(),
            'classrooms' => Classroom::orderBy('name')->get(),
            'sections'   => Section::orderBy('name')->get(),
            'subjects'   => Subject::orderBy('name')->get(),
            'teachers'   => class_exists(Teacher::class) ? Teacher::orderBy('name')->get() : collect(),
        ]);
    }

    // ADMIN: store
    public function store(Request $request)
    {
        $data = $this->validated($request);

        // auto calc percentage
        $data['percentage'] = $this->calcPercentage($data['score'] ?? null, $data['max_score'] ?? null);

        // auto pass/fail (optional rule: pass if >= 40%)
        if (!is_null($data['percentage'])) {
            $data['pass_fail'] = ($data['percentage'] >= 40);
        }

        ExamResult::create($data);

        return redirect()->route('admin.exam-results.index')->with('success', 'Exam result created successfully.');
    }

    // ADMIN: edit
    public function edit(ExamResult $examResult)
    {
        $examResult->load(['student','classroom','section','subject','teacher']);

        return view('admin.exam_results.edit', [
            'examResult' => $examResult,
            'students'   => Student::orderBy('name')->get(),
            'classrooms' => Classroom::orderBy('name')->get(),
            'sections'   => Section::orderBy('name')->get(),
            'subjects'   => Subject::orderBy('name')->get(),
            'teachers'   => class_exists(Teacher::class) ? Teacher::orderBy('name')->get() : collect(),
        ]);
    }

    // ADMIN: update
    public function update(Request $request, ExamResult $examResult)
    {
        if ($examResult->status === 'locked') {
            return back()->with('error', 'This record is locked and cannot be edited.');
        }

        $data = $this->validated($request, $examResult->id);
        $data['percentage'] = $this->calcPercentage($data['score'] ?? null, $data['max_score'] ?? null);

        if (!is_null($data['percentage'])) {
            $data['pass_fail'] = ($data['percentage'] >= 40);
        }

        $examResult->update($data);

        return redirect()->route('admin.exam-results.index')->with('success', 'Exam result updated successfully.');
    }

    // ADMIN: delete
    public function destroy(ExamResult $examResult)
    {
        if ($examResult->status === 'locked') {
            return back()->with('error', 'This record is locked and cannot be deleted.');
        }

        $examResult->delete();
        return back()->with('success', 'Exam result deleted successfully.');
    }

    // USER: public results page (published only)
    public function publicIndex(Request $request)
    {
        $q = ExamResult::query()
            ->with(['student','classroom','section','subject'])
            ->where('status', 'published')
            ->orderByDesc('result_date');

        if ($request->filled('classroom_id')) $q->where('classroom_id', $request->classroom_id);
        if ($request->filled('section_id'))   $q->where('section_id', $request->section_id);
        if ($request->filled('student_id'))   $q->where('student_id', $request->student_id);
        if ($request->filled('exam_type'))    $q->where('exam_type', $request->exam_type);
        if ($request->filled('year'))         $q->whereYear('result_date', $request->year);
        if ($request->filled('month'))        $q->whereMonth('result_date', $request->month);

        $examResults = $q->paginate(15)->withQueryString();

        return view('exam_results.index', [
            'examResults' => $examResults,
            'students'    => Student::orderBy('name')->get(),
            'classrooms'  => Classroom::orderBy('name')->get(),
            'sections'    => Section::orderBy('name')->get(),
        ]);
    }

    private function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'student_id'   => ['required','exists:students,id'],
            'classroom_id' => ['required','exists:classrooms,id'],
            'section_id'   => ['required','exists:sections,id'],
            'subject_id'   => ['required','exists:subjects,id'],
            'teacher_id'   => ['nullable','exists:teachers,id'],

            'exam_type'    => ['required','string','max:100'],
            'exam_name'    => ['nullable','string','max:255'],
            'academic_year'=> ['nullable','string','max:20'],
            'term'         => ['nullable','string','max:50'],
            'result_date'  => ['required','date'],

            'score'        => ['nullable','numeric','min:0'],
            'max_score'    => ['nullable','numeric','min:0'],
            'grade_letter' => ['nullable','string','max:5'],
            'status'       => ['required', Rule::in(['draft','published','locked'])],
            'remarks'      => ['nullable','string'],

            // Unique constraint needs same columns check (handled by DB unique index too)
        ]);
    }

    private function calcPercentage($score, $max)
    {
        if ($score === null || $max === null) return null;
        if ((float)$max <= 0) return null;
        return round(((float)$score / (float)$max) * 100, 2);
    }
}
