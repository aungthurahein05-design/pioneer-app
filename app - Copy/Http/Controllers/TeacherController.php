<?php

namespace App\Http\Controllers;

use App\Models\Teacher;        // Teacher model ကိုသုံးမလို့ import လိုအပ်
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // ================= FRONTEND OLD FORM (မသုံးတော့ရင် ဖျက်လည်းရ) =================

    // ညီလေးရဲ့ စောက form ပေါ်စေချင်ရင် ဒီ method သုံးနိုင်တယ်
    public function showForm()
    {
        return view('teacher');   // resources/views/teacher.blade.php
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string',
        ]);

        // database မသိမ်းသေးဘူး – လက်ရှိတော့ success message ပဲ ပြမယ်
        return back()->with('success', 'Teacher submitted successfully!');
    }

    // ================= ADMIN SIDE ( /admin/teachers … ) =================

    // list page
    public function index()
    {
        // admin စာရင်းစာမျက်နှာအတွက် paginate ပြ
        $teachers = Teacher::latest()->paginate(10);
        return view('admin.teachers.index', compact('teachers'));
    }

    // create form
    public function create()
    {
        return view('admin.teachers.create');
    }

    // save to DB
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:teachers,email',
            'phone'     => 'nullable|string|max:50',
            'education' => 'nullable|string|max:255',
            'photo'     => 'nullable|image|max:2048',   // 2MB
        ]);

        $data = $request->only(['name', 'email', 'phone', 'education']);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('teachers', 'public');
            $data['photo'] = $path;
        }

        Teacher::create($data);

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Teacher created successfully.');
    }

    // edit form
    public function edit(Teacher $teacher)
    {
        return view('admin.teachers.edit', compact('teacher'));
    }

    // update DB
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:teachers,email,' . $teacher->id,
            'phone'     => 'nullable|string|max:50',
            'education' => 'nullable|string|max:255',
            'photo'     => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'phone', 'education']);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('teachers', 'public');
            $data['photo'] = $path;
        }

        $teacher->update($data);

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }

    // delete
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }

    // ================= FRONTEND TEACHER PAGE ( /teacher ) =================

    public function publicIndex()
    {
        // DB ထဲက teacher အားလုံးကို ယူပြီး frontend design ပေါ်မှာ ပြမယ်
        $teachers = Teacher::latest()->get();

        // resources/views/teacher.blade.php ထဲမှာ loop ပတ်သုံးရမယ်
        return view('teacher', compact('teachers'));
    }
}
