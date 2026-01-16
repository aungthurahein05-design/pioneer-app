<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_code',
        'name',
        'gender',
        'date_of_birth',
        'classroom_id',
        'section_id',
        'admission_year',
        'roll_number',
        'father_name',
        'mother_name',
        'guardian_phone',
        'address',
        'phone',
        'email',
        'status',
        'photo',
        'remarks',
    ];

    // Relationships
   
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subjects')
            ->withPivot(['academic_year', 'term', 'status'])
            ->withTimestamps();
    }

        public function classroom()
{
    return $this->belongsTo(Classroom::class);
}
}
