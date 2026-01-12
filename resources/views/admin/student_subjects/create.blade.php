@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h3>Assign Subjects to {{ $student->name }}</h3>

  <form method="POST" action="{{ route('admin.students.subjects.store', $student) }}">
    @csrf

    <div class="mb-3">
      <label class="form-label">Subjects</label>
      <select name="subject_ids[]" class="form-control" multiple required>
        @foreach($subjects as $sub)
          <option value="{{ $sub->id }}">{{ $sub->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Academic Year</label>
      <input name="academic_year" class="form-control" placeholder="2025-2026" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Term</label>
      <input name="term" class="form-control" placeholder="Term 1" required>
    </div>

    <button class="btn btn-primary">Save</button>
  </form>
</div>
@endsection
