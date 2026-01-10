@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-3">Create Teaching Assignment</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.teaching-assignments.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Teacher *</label>
            <select name="teacher_id" class="form-control" required>
                <option value="">-- Select Teacher --</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}"
                        {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Subject *</label>
            <select name="subject_id" class="form-control" required>
                <option value="">-- Select Subject --</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}"
                        {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Classroom *</label>
            <select name="classroom_id" class="form-control" required>
                <option value="">-- Select Classroom --</option>
                @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}"
                        {{ old('classroom_id') == $classroom->id ? 'selected' : '' }}>
                        {{ $classroom->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Section (Optional)</label>
            <select name="section_id" class="form-control">
                <option value="">-- No Section --</option>
                @foreach($sections as $section)
                    <option value="{{ $section->id }}"
                        {{ old('section_id') == $section->id ? 'selected' : '' }}>
                        {{ $section->classroom->name }} - {{ $section->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Save</button>
        <a class="btn btn-secondary"
           href="{{ route('admin.teaching-assignments.index') }}">
            Cancel
        </a>
    </form>
</div>
@endsection
