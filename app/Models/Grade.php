<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'name', // A/B/C/D/F or any text
    ];

    public function examResults()
{
    return $this->hasMany(ExamResult::class);
}

}
