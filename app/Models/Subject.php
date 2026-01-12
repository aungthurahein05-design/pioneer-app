<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class Subject extends Model
{
    protected $fillable = ['name'];

    // ✅ Subject has many Events
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function students()
{
    return $this->belongsToMany(\App\Models\Student::class, 'student_subjects')
        ->withPivot(['academic_year','term','status'])
        ->withTimestamps();
}

}
