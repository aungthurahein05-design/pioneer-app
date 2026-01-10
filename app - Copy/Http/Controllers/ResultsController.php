<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultsController extends Controller
{
    //
     public function index()
    {
        return view('results'); // results.blade.php
    }

    public function fetch(Request $request)
    {
        $semester = $request->query('semester');
        $student_id = auth()->user()->id; // or your logic for student

        $results = Result::where('student_id', $student_id)
                         ->where('semester', $semester)
                         ->get(['subject', 'marks', 'grade']);

        return response()->json($results);
    }
}
