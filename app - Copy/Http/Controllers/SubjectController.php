<?php

namespace App\Http\Controllers;
use App\Models\Subject;


use Illuminate\Http\Request;

class SubjectController extends Controller
{
    //
    public function showForm()
    {
        return view('subject'); // resources/views/subject.blade.php
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255',
        ]);

        // DB ထဲထည့်တာမလုပ်သေးပဲ simple response
        return back()->with('success', 'Subject submitted successfully!');
    }




    public function index()
    {
        $subjects = Subject::all();
        return view('admin.subjects.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subjects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Subject::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.subjects.index')->with('success', 'Subject created.');
    }

    public function edit(Subject $subject)
    {
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $subject->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated.');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted.');
    }


    
}
