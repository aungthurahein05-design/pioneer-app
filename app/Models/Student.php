<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'nrc',   // ✅ required in DB, but we will auto-fill '-'
    ];
}
