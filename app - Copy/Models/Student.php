<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // table name က students ဖြစ်လို့ အောက်က line မရေးလည်းရ
    protected $table = 'students';

    // mass-assign လုပ်ချင်ရင် ဒီလိုရိုက်ထားလို့ရ
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
}
