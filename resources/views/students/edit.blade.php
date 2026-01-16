@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Edit Student</h2>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.update', $student->id) }}"
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Student Code --}}
        <div class="mb-3">
            <label class="form-label">Student Code *</label>
            <input type="text" name="student_code" class="form-control"
                   value="{{ old('student_code', $student->student_code) }}" required>
        </div>

        {{-- Name --}}
        <div class="mb-3">
            <label class="form-label">Name *</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $student->name) }}" required>
        </div>

        {{-- Gender --}}
        <div class="mb-3">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-select">
                <option value="">Select Gender</option>
                <option value="male"
                    {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>
                    Male
                </option>
                <option value="female"
                    {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>
                    Female
                </option>
            </select>
        </div>

        {{-- Date of Birth --}}
        <div class="mb-3">
            <label class="form-label">Date of Birth</label>
            <input type="date" name="date_of_birth" class="form-control"
                   value="{{ old('date_of_birth', $student->date_of_birth) }}">
        </div>

        {{-- Classroom --}}
        <div class="mb-3">
            <label class="form-label">Classroom *</label>
            <select name="classroom_id" class="form-select" required>
                <option value="">Select Classroom</option>
                @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}"
                        {{ old('classroom_id', $student->classroom_id) == $classroom->id ? 'selected' : '' }}>
                        {{ $classroom->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Section --}}
        <div class="mb-3">
            <label class="form-label">Section *</label>
            <select name="section_id" class="form-select" required>
                <option value="">Select Section</option>
                @foreach($sections as $section)
                    <option value="{{ $section->id }}"
                        {{ old('section_id', $student->section_id) == $section->id ? 'selected' : '' }}>
                        {{ $section->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Admission Year --}}
        <div class="mb-3">
            <label class="form-label">Admission Year</label>
            <input type="number" name="admission_year" class="form-control"
                   value="{{ old('admission_year', $student->admission_year) }}">
        </div>

        {{-- Roll Number --}}
        <div class="mb-3">
            <label class="form-label">Roll Number</label>
            <input type="number" name="roll_number" class="form-control"
                   value="{{ old('roll_number', $student->roll_number) }}">
        </div>

        {{-- Parent / Guardian --}}
        <div class="mb-3">
            <label class="form-label">Father Name</label>
            <input type="text" name="father_name" class="form-control"
                   value="{{ old('father_name', $student->father_name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Mother Name</label>
            <input type="text" name="mother_name" class="form-control"
                   value="{{ old('mother_name', $student->mother_name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Guardian Phone</label>
            <input type="text" name="guardian_phone" class="form-control"
                   value="{{ old('guardian_phone', $student->guardian_phone) }}">
        </div>

        {{-- Address --}}
        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control"
                      rows="3">{{ old('address', $student->address) }}</textarea>
        </div>

        {{-- Contact --}}
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control"
                   value="{{ old('phone', $student->phone) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email', $student->email) }}">
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="active"
                    {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>
                    Active
                </option>
                <option value="inactive"
                    {{ old('status', $student->status) == 'inactive' ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>
        </div>

        {{-- Photo --}}
        <div class="mb-3">
            <label class="form-label">Photo</label><br>
            @if($student->photo)
    <img src="{{ asset('storage/' . $student->photo) }}"
         alt="{{ $student->name }}"
         style="width:70px; height:70px; object-fit:cover; border-radius:50%; margin-bottom:10px;">
@endif
            <input type="file" name="photo" class="form-control" accept="image/*">
            <small class="text-muted">
                If you don't choose a new photo, the old one will remain.
            </small>
        </div>

        {{-- Remarks --}}
        <div class="mb-3">
            <label class="form-label">Remarks</label>
            <textarea name="remarks" class="form-control"
                      rows="3">{{ old('remarks', $student->remarks) }}</textarea>
        </div>

        {{-- Buttons --}}
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>

    </form>
</div>
@endsection
