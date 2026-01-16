@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New Student</h2>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Identity --}}
        <div class="mb-3">
            <label for="student_code" class="form-label">Student Code</label>
            <input type="text" name="student_code" id="student_code" class="form-control" value="{{ old('student_code') }}" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" id="gender" class="form-select">
                <option value="" selected>Select Gender</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="date_of_birth" class="form-label">Date of Birth</label>
            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}">
        </div>

        {{-- Academic --}}
        <div class="mb-3">
            <label for="classroom_id" class="form-label">Classroom</label>
            <select name="classroom_id" id="classroom_id" class="form-select" required>
                <option value="">Select Classroom</option>
                @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}" {{ old('classroom_id') == $classroom->id ? 'selected' : '' }}>
                        {{ $classroom->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="section_id" class="form-label">Section</label>
            <select name="section_id" id="section_id" class="form-select" required>
                <option value="">Select Section</option>
                @foreach($sections as $section)
                    <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
                        {{ $section->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="admission_year" class="form-label">Admission Year</label>
            <input type="number" name="admission_year" id="admission_year" class="form-control" value="{{ old('admission_year') }}">
        </div>

        <div class="mb-3">
    <label for="roll_number" class="form-label">Roll Number</label>
    <input type="text" name="roll_number" id="roll_number" class="form-control" value="{{ old('roll_number') }}">
</div>

<div class="mb-3">
    <label for="father_name" class="form-label">Father Name</label>
    <input type="text" name="father_name" id="father_name"
           class="form-control" value="{{ old('father_name') }}">
</div>

<div class="mb-3">
    <label for="mother_name" class="form-label">Mother Name</label>
    <input type="text" name="mother_name" id="mother_name"
           class="form-control" value="{{ old('mother_name') }}">
</div>

<div class="mb-3">
    <label for="guardian_phone" class="form-label">Guardian Phone</label>
    <input type="text" name="guardian_phone" id="guardian_phone"
           class="form-control" value="{{ old('guardian_phone') }}">
</div>

<div class="mb-3">
    <label for="address" class="form-label">Address</label>
    <textarea name="address" id="address"
              class="form-control" rows="3">{{ old('address') }}</textarea>
</div>

<div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input type="text" name="phone" id="phone"
           class="form-control" value="{{ old('phone') }}">
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" id="email"
           class="form-control" value="{{ old('email') }}">
</div>
<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select name="status" id="status" class="form-select">
        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Photo</label>
    <input type="file" name="photo" class="form-control"
           accept="image/*"
           onchange="previewImage(event)">
    <img id="preview" style="display:none; width:70px; margin-top:10px;">
</div>

<script>
function previewImage(event) {
    const img = document.getElementById('preview');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.style.display = 'block';
}
</script>


<div class="mb-3">
    <label for="remarks" class="form-label">Remarks</label>
    <textarea name="remarks" id="remarks"
              class="form-control" rows="3">{{ old('remarks') }}</textarea>
</div>


<button type="submit" class="btn btn-primary">Add Student</button>
</form>
@endsection