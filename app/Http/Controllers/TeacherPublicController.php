<?php

namespace App\Http\Controllers;

use App\Models\Teacher;   // Teacher model ကို import လုပ်မယ်

class TeacherPublicController extends Controller
{
    // /teachers route ကနေ ခေါ်သွားမယ့် method
    public function index()
    {
        // Admin side မှာ create လုပ်ထားတဲ့ teachers data အကုန်ယူမယ်
        // သင့်လိုချင်သလို orderBy ပြောင်းလို့ရ (name, created_at, etc.)
        $teachers = Teacher::orderBy('created_at', 'desc')->get();

        // သင့် Blade file နာမည်ကို ဒီအောက်မှာ သတ်မှတ်ရမယ်
        // eg: resources/views/teachers/index.blade.php
        return view('teachers.index', compact('teachers'));
    }
}
