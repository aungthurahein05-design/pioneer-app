<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'nrc',   // ✅ required in DB, but we will auto-fill '-'
    ];

    public function subjects()
{
    return $this->belongsToMany(\App\Models\Subject::class, 'student_subjects')
        ->withPivot(['academic_year','term','status'])
        ->withTimestamps();
}

}
