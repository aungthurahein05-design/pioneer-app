<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    protected $fillable = [
        'student_id','student_code','subject','mark','grade','exam_date'
    ];
    protected $casts = ['exam_date' => 'date'];
}

