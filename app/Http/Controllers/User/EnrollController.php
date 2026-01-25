<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enroll;

class EnrollController extends Controller
{
    /**
     * Show enroll form
     */
    public function showForm(Request $request)
    {
        return view('user.enroll.form', [
            'data' => $request->all()
        ]);
    }

    /**
     * Validate form data (optional step)
     */
    public function submitForm(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'nrc'          => 'required|string|max:50',
            'gender'       => 'required|string',
            'father_name'  => 'required|string|max:255',
            'mother_name'  => 'required|string|max:255',
            'dob'          => 'required|date',
            'phone'        => 'required|string|max:30',
            'address'      => 'required|string',
        ]);

        // Pass validated data to confirmation page (optional)
        return view('user.enroll.confirm', compact('data'));
    }

    /**
     * Store enroll data
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'nrc'          => 'required|string|max:50',
            'gender'       => 'required|string',
            'father_name'  => 'required|string|max:255',
            'mother_name'  => 'required|string|max:255',
            'dob'          => 'required|date',
            'phone'        => 'required|string|max:30',
            'address'      => 'required|string',
        ]);

        Enroll::create($data);

        return redirect()
            ->route('enroll.form')
            ->with('success', 'Enrollment submitted successfully.');
    }



}
