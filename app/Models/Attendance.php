<?php

class Attendance extends Model
{
    protected $fillable = [
        'student_id',
        'attendance_date',
        'status',
        'remark'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
