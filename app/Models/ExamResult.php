<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    protected $fillable = [
        'student_id','classroom_id','section_id','subject_id','teacher_id',
        'exam_type','exam_name','academic_year','term','result_date',
        'score','max_score','percentage','grade_letter','pass_fail',
        'status','remarks'
    ];

    protected $casts = [
        'result_date' => 'date',
        'pass_fail' => 'boolean',
        'score' => 'decimal:2',
        'max_score' => 'decimal:2',
        'percentage' => 'decimal:2',
    ];

    public function student()  { return $this->belongsTo(Student::class); }
    public function classroom(){ return $this->belongsTo(Classroom::class); }
    public function section()  { return $this->belongsTo(Section::class); }
    public function subject()  { return $this->belongsTo(Subject::class); }
    public function teacher()  { return $this->belongsTo(Teacher::class); }
}
