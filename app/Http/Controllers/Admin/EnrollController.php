<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enroll;
use Illuminate\Http\Request;

class EnrollController extends Controller
{
    // Display list of enrollments
    public function index()
    {
        $enrolls = Enroll::latest()->get();
        return view('admin.enroll.index', compact('enrolls'));
    }

    // Show form to create a new enrollment
    public function create()
    {
        return view('admin.enroll.create');
    }

    // Store a new enrollment
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'        => 'required|string|max:255',
            'nrc'         => 'required|string|max:50|unique:enrolls,nrc',
            'gender'      => 'required|in:male,female',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'dob'         => 'required|date',
            'phone'       => 'required|string|max:50',
            'address'     => 'required|string|max:500',
        ]);

        Enroll::create($validatedData);

        return redirect()
            ->route('admin.enroll.index')
            ->with('success', 'Enrollment added successfully!');
    }

    // Show single enrollment details
    public function show(Enroll $enroll)
    {
        return view('admin.enroll.show', compact('enroll'));
    }

    // Show form to edit an enrollment
    public function edit(Enroll $enroll)
    {
        return view('admin.enroll.edit', compact('enroll'));
    }

    // Update an existing enrollment
    public function update(Request $request, Enroll $enroll)
    {
        $validatedData = $request->validate([
            'name'        => 'required|string|max:255',
            'nrc'         => 'required|string|max:50|unique:enrolls,nrc,' . $enroll->id,
            'gender'      => 'required|in:male,female',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'dob'         => 'required|date',
            'phone'       => 'required|string|max:50',
            'address'     => 'required|string|max:500',
        ]);

        $enroll->update($validatedData);

        return redirect()
            ->route('admin.enroll.index')
            ->with('success', 'Enrollment updated successfully!');
    }

    // Delete an enrollment
    public function destroy(Enroll $enroll)
    {
        $enroll->delete();

        return redirect()
            ->route('admin.enroll.index')
            ->with('success', 'Enrollment deleted successfully!');
    }
}
