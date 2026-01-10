<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    protected $fillable = [
        'student_id',
        'grade_id',

        // ✅ manual display fields (hybrid)
        'student_name',
        'grade_name',

        'exam_name',
        'subject',
        'score',
        'max_score',
        'result_date',
        'status',
        'remarks',
    ];

    protected $casts = [
        'result_date' => 'date',
        'score'       => 'decimal:2',
        'max_score'   => 'decimal:2',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class)->withDefault();
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class)->withDefault();
    }
}
