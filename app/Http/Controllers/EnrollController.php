<?php

namespace App\Http\Controllers;

use App\Models\Enroll;
use Illuminate\Http\Request;

class EnrollController extends Controller
{
    // User form page: /enroll (GET)
    public function showForm()
    {
        return view('enroll');
    }

    // Submit enroll form: /enroll (POST)
    public function submitForm(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'nrc'         => 'required|string|max:50',
            'gender'      => 'required|in:male,female',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'dob'         => 'required|date',
            'phone'       => 'required|string|max:50',
            'address'     => 'required|string|max:500',
        ]);

        Enroll::create($validated);

        return redirect()->back()->with('success', 'Enrollment successful!');
    }

    // Admin list page: /admin/enrolls (GET)  (optional)
    // public function index()
    // {
    //     $enrolls = Enroll::latest()->paginate(10);
    //     return view('admin.enrolls.index', compact('enrolls'));
    // }
}
