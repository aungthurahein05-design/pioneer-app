<?php

namespace App\Http\Controllers;

use App\Models\ExamResult;
use Illuminate\Http\Request;

class ExamResultPublicController extends Controller
{
    public function index(Request $request)
    {
        $year  = $request->integer('year');
        $month = $request->integer('month');

        // ✅ User side မှာ student/grade ပြနိုင်အောင် eager load
        $query = ExamResult::with(['student','grade']);

        if ($year) {
            $query->whereYear('result_date', $year);
        }
        if ($month) {
            $query->whereMonth('result_date', $month);
        }

        $results = $query->orderByDesc('result_date')->paginate(20);

        $years = ExamResult::selectRaw('YEAR(result_date) as y')
            ->distinct()->orderByDesc('y')->pluck('y');

        return view('exam_results.index', compact('results', 'years', 'year', 'month'));
    }
}
