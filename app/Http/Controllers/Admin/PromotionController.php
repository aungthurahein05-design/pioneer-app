<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Promotion;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::with('student')
            ->latest()
            ->paginate(20);

        return view('admin.promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('admin.promotions.create', [
            'classrooms' => Classroom::orderBy('name')->get(),
            'sections'   => Section::orderBy('name')->get(),
            'students'   => Student::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_ids'        => ['required', 'array', 'min:1'],
            'student_ids.*'      => ['integer', 'exists:students,id'],

            // ✅ From (required)
            'from_classroom_id'  => ['required', 'exists:classrooms,id'],
            'from_section_id'    => ['required', 'exists:sections,id'],

            // ✅ To (required)
            'to_classroom_id'    => ['required', 'exists:classrooms,id'],
            'to_section_id'      => ['required', 'exists:sections,id'],

            'from_academic_year' => ['nullable', 'string', 'max:20'],
            'to_academic_year'   => ['nullable', 'string', 'max:20'],
            'note'               => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($data) {
            foreach ($data['student_ids'] as $studentId) {

                // Save promotion record
                Promotion::updateOrCreate(
                    [
                        'student_id'       => $studentId,
                        'to_classroom_id'  => $data['to_classroom_id'],
                        'to_section_id'    => $data['to_section_id'],
                        'to_academic_year' => $data['to_academic_year'] ?? null,
                    ],
                    [
                        'from_classroom_id'  => $data['from_classroom_id'],
                        'from_section_id'    => $data['from_section_id'],
                        'from_academic_year' => $data['from_academic_year'] ?? null,
                        'note'               => $data['note'] ?? null,
                    ]
                );

                // Update student's current class/section
                Student::where('id', $studentId)->update([
                    'classroom_id' => $data['to_classroom_id'],
                    'section_id'   => $data['to_section_id'],
                ]);
            }
        });

        return redirect()->route('admin.promotions.index')
            ->with('success', 'Students promoted successfully.');
    }
}
