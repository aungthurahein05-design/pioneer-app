<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
    // ✅ Table name (optional, but recommended)
    protected $table = 'enrolls';

    // ✅ Mass assignment allow
    protected $fillable = [
        'name',
        'nrc',
        'gender',
        'father_name',
        'mother_name',
        'dob',
        'phone',
        'address',
    ];

    // ✅ Cast date column
    protected $casts = [
        'dob' => 'date',
    ];
}
