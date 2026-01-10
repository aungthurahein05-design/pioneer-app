<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // Enroll form ပြသဖို့ (optional)
    public function create()
    {
        return view('enroll');   // နင့် blade ဖိုင်နာမည်နဲ့ ကိုက်အောင်
    }

    // ဒီက data ကို DB ထဲသိမ်းမယ့် အဓိကပိုင်း
    public function store(Request $request)
    {
        // 1. validation (အလိုမလို ပြင်လို့ရ)
        $request->validate([
            'name'        => 'required|string|max:255',
            'nrc'         => 'required|string|max:255',
            'gender'      => 'required|in:male,female',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'dob'         => 'required|date',
            'phone'       => 'required|string|max:20',
            'address'     => 'required|string|max:255',
        ]);

        // 2. DB ထဲသိမ်း
        $student = new Student();
        $student->name        = $request->name;
        $student->nrc         = $request->nrc;
        $student->gender      = $request->gender;
        $student->father_name = $request->father_name;
        $student->mother_name = $request->mother_name;
        $student->dob         = $request->dob;
        $student->phone       = $request->phone;
        $student->address     = $request->address;
        $student->save();

        // 3. success message နဲ့ ပြန်သွား
        return back()->with('success', 'Student enrolled successfully!');
    }
}
