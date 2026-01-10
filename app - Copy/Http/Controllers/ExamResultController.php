<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExamResultController extends Controller
{
    //
    public function index(Request $request)
{
    $query = ExamResult::query();

    if ($request->student_code) {
        $query->where('student_code', $request->student_code);
    }
    if ($request->month) {
        $query->whereMonth('exam_date', $request->month);
    }
    if ($request->year) {
        $query->whereYear('exam_date', $request->year);
    }

    $results = $query->orderBy('exam_date','desc')->get();
    $years = ExamResult::selectRaw('YEAR(exam_date) as year')
                ->distinct()->orderBy('year','desc')->pluck('year');

    return view('exam-results.index', compact('results','years'));
}

}
