<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnrollController extends Controller
{
    //
     public function showForm()
    {
        return view('enroll');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'course' => 'required',
        ]);

        // လုပ်ဆောင်ချက်တွေ (ဥပမာ - DB ထဲသိမ်းခြင်း)

        return back()->with('success', 'Enrollment successful!');
    }
}
