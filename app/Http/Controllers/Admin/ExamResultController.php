<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExamResult;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Classroom;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExamResultController extends Controller
{
    public function index(Request $request)
    {
        $q = ExamResult::query()
            ->with(['student','classroom','section','subject'])
            ->orderByDesc('result_date');

        $results = $q->paginate(20)->withQueryString();

        return view('admin.exam_results.index', [
            'examResults' => $results,
            'classrooms'  => Classroom::orderBy('name')->get(),
            'sections'    => Section::orderBy('name')->get(),
            'subjects'    => Subject::orderBy('name')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.exam_results.create', [
            'students'   => Student::orderBy('name')->get(),
            'classrooms' => Classroom::orderBy('name')->get(),
            'sections'   => Section::orderBy('name')->get(),
            'subjects'   => Subject::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        ExamResult::create($data);

        return redirect()->route('admin.exam-results.index')
            ->with('success', 'Exam result created successfully.');
    }

    public function edit(ExamResult $examResult)
    {
        return view('admin.exam_results.edit', [
            'examResult' => $examResult,
            'students'   => Student::orderBy('name')->get(),
            'classrooms' => Classroom::orderBy('name')->get(),
            'sections'   => Section::orderBy('name')->get(),
            'subjects'   => Subject::orderBy('name')->get(),
        ]);
    }

    // ✅ UPDATE
    public function update(Request $request, ExamResult $examResult)
    {
        $data = $this->validateData($request);

        $examResult->update($data);

        return redirect()->route('admin.exam-results.index')
            ->with('success', 'Exam result updated successfully.');
    }

    // ✅ DESTROY
    public function destroy(ExamResult $examResult)
    {
        $examResult->delete();

        return back()->with('success', 'Exam result deleted successfully.');
    }

    // ✅ Shared validation
    private function validateData(Request $request): array
    {
        return $request->validate([
            'student_id'   => ['required','exists:students,id'],
            'classroom_id' => ['required','exists:classrooms,id'],
            'section_id'   => ['required','exists:sections,id'],
            'subject_id'   => ['required','exists:subjects,id'],

            'exam_type'    => ['required','string','max:100'],
            'result_date'  => ['required','date'],

            'score'        => ['nullable','numeric','min:0'],
            'max_score'    => ['nullable','numeric','min:0'],
            'grade_letter' => ['nullable','string','max:5'],

            'status'       => ['required', Rule::in(['draft','published','locked'])],
            'remarks'      => ['nullable','string'],
        ]);
    }
}
