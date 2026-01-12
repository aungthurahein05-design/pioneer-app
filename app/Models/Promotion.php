<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'student_id',
        'from_classroom_id','from_section_id',
        'to_classroom_id','to_section_id',
        'from_academic_year','to_academic_year',
        'note'
    ];

    public function student() { return $this->belongsTo(Student::class); }
}
