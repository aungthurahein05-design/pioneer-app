<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
   
    public function index()
    {
        $teachers = Teacher::latest()->paginate(10);
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:teachers,email',
            'phone'     => 'nullable|string|max:50',
            'education' => 'nullable|string|max:255',
            'photo'     => 'nullable|image|max:2048',
        ]);

        // photo upload
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        // ensure key exists (helps when DB expects it)
        $validated['education'] = $validated['education'] ?? null;
        $validated['phone']     = $validated['phone'] ?? null;

        Teacher::create($validated);

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher created successfully.');
    }

    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:teachers,email,' . $teacher->id,
            'phone'     => 'nullable|string|max:50',
            'education' => 'nullable|string|max:255',
            'photo'     => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('teachers', 'public');
        }

        $validated['education'] = $validated['education'] ?? null;
        $validated['phone']     = $validated['phone'] ?? null;

        $teacher->update($validated);

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }

    // ---------- Frontend teacher page ----------
    public function publicIndex()
    {
        $teachers = Teacher::latest()->get();
        return view('teacher', compact('teachers'));
    }

     // ---------- Frontend old form (optional) ----------
    public function showForm()
    {
        return view('teacher');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string',
        ]);

        return back()->with('success', 'Teacher submitted successfully!');
    }

}
