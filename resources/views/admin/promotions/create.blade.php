{{-- resources/views/admin/promotions/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Promote Students</h3>
    <a href="{{ route('admin.promotions.index') }}" class="btn btn-outline-secondary">Back</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('admin.promotions.store') }}" class="card card-body">
    @csrf

    <div class="row g-3">

      {{-- Students multi select --}}
      <div class="col-md-6">
        <label class="form-label">Select Students (Multi)</label>
        <select name="student_ids[]" class="form-control" multiple size="12" required>
          @foreach(($students ?? collect()) as $st)
            <option value="{{ $st->id }}"
              @selected(collect(old('student_ids', []))->contains($st->id))>
              {{ $st->name }}
            </option>
          @endforeach
        </select>
        <small class="text-muted">Hold Ctrl (Windows) / Cmd (Mac) to select multiple.</small>
      </div>

      {{-- From --}}
      <div class="col-md-3">
        <label class="form-label">From Classroom</label>
        <select name="from_classroom_id" class="form-control" required>
          <option value="">Choose</option>
          @foreach(($classrooms ?? collect()) as $c)
            <option value="{{ $c->id }}" @selected(old('from_classroom_id')==$c->id)>{{ $c->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-3">
        <label class="form-label">From Section</label>
        <select name="from_section_id" class="form-control" required>
          <option value="">Choose</option>
          @foreach(($sections ?? collect()) as $s)
            <option value="{{ $s->id }}" @selected(old('from_section_id')==$s->id)>{{ $s->name }}</option>
          @endforeach
        </select>
      </div>

      {{-- To --}}
      <div class="col-md-3">
        <label class="form-label">To Classroom</label>
        <select name="to_classroom_id" class="form-control" required>
          <option value="">Choose</option>
          @foreach(($classrooms ?? collect()) as $c)
            <option value="{{ $c->id }}" @selected(old('to_classroom_id')==$c->id)>{{ $c->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-3">
        <label class="form-label">To Section</label>
        <select name="to_section_id" class="form-control" required>
          <option value="">Choose</option>
          @foreach(($sections ?? collect()) as $s)
            <option value="{{ $s->id }}" @selected(old('to_section_id')==$s->id)>{{ $s->name }}</option>
          @endforeach
        </select>
      </div>

      {{-- Academic years --}}
      <div class="col-md-3">
        <label class="form-label">From Academic Year</label>
        <input name="from_academic_year" class="form-control"
               placeholder="2025-2026" value="{{ old('from_academic_year') }}">
      </div>

      <div class="col-md-3">
        <label class="form-label">To Academic Year</label>
        <input name="to_academic_year" class="form-control"
               placeholder="2026-2027" value="{{ old('to_academic_year') }}">
      </div>

      {{-- Note --}}
      <div class="col-12">
        <label class="form-label">Note</label>
        <textarea name="note" class="form-control" rows="2">{{ old('note') }}</textarea>
      </div>

      {{-- Actions --}}
      <div class="col-12 d-flex gap-2">
        <button class="btn btn-primary">
          <i class="bi bi-arrow-up-circle"></i> Promote
        </button>
        <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary">Cancel</a>
      </div>

    </div>
  </form>
</div>
@endsection
