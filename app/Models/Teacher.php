<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class Teacher extends Model
// {
//     use HasFactory;
//     // app/Models/Teacher.php
// protected $fillable = [];



// }
class Teacher extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'education', 'photo'];
}
