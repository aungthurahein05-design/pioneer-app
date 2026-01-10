@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-3">Edit Section</h3>

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
          action="{{ route('admin.sections.update', $section->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Classroom *</label>
            <select name="classroom_id" class="form-control" required>
                @foreach($classrooms as $classroom)
                    <option value="{{ $classroom->id }}"
                        {{ old('classroom_id', $section->classroom_id) == $classroom->id ? 'selected' : '' }}>
                        {{ $classroom->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Section Name *</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name', $section->name) }}"
                   required>
        </div>

        <button class="btn btn-primary">Update</button>
        <a class="btn btn-secondary" href="{{ route('admin.sections.index') }}">
            Cancel
        </a>
    </form>
</div>
@endsection
