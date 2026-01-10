<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::latest()->paginate(10);
        return view('admin.classrooms.index', compact('classrooms'));
    }

    public function create()
    {
        return view('admin.classrooms.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:classrooms,name',
            'code' => 'nullable|string|max:50',
        ]);

        Classroom::create($data);

        return redirect()->route('admin.classrooms.index')->with('success', 'Classroom created.');
    }

    public function edit(Classroom $classroom)
    {
        return view('admin.classrooms.edit', compact('classroom'));
    }

    public function update(Request $request, Classroom $classroom)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:classrooms,name,' . $classroom->id,
            'code' => 'nullable|string|max:50',
        ]);

        $classroom->update($data);

        return redirect()->route('admin.classrooms.index')->with('success', 'Classroom updated.');
    }

    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return redirect()->route('admin.classrooms.index')->with('success', 'Classroom deleted.');
    }

    public function show(Classroom $classroom)
    {
        return view('admin.classrooms.show', compact('classroom'));
    }
}
