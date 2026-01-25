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

        // ✅ Save photo to: public/images/teachers/
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

            $file->move(public_path('images/teachers'), $filename);

            // ✅ store filename only in DB
            $validated['photo'] = $filename;
        }

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

        // ✅ If new photo uploaded: delete old + save new to public/images/teachers/
        if ($request->hasFile('photo')) {

            // delete old file if exists
            if (!empty($teacher->photo)) {
                $oldPath = public_path('images/teachers/' . $teacher->photo);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $file = $request->file('photo');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());

            $file->move(public_path('images/teachers'), $filename);

            $validated['photo'] = $filename; // filename only
        }

        $teacher->update($validated);

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher)
    {
        // ✅ delete photo file too
        if (!empty($teacher->photo)) {
            $path = public_path('images/teachers/' . $teacher->photo);
            if (file_exists($path)) {
                @unlink($path);
            }
        }

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
}
