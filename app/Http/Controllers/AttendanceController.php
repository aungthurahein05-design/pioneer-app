<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //

    public function store(Request $request)
{
    foreach ($request->attendance as $student_id => $status) {
        Attendance::updateOrCreate(
            [
                'student_id' => $student_id,
                'attendance_date' => $request->date
            ],
            [
                'status' => $status,
                'remark' => $request->remark[$student_id] ?? null
            ]
        );
    }

    return back()->with('success', 'Attendance saved successfully');
}

}
