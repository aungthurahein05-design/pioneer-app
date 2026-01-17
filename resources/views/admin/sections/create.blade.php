@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h3 class="mb-3">Create Section</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.sections.store') }}">
        @csrf

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
            <label class="form-label">Section Name *</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   placeholder="e.g. A, B, C"
                   value="{{ old('name') }}"
                   required>
        </div>

        <button class="btn btn-primary">Save</button>
        <a class="btn btn-secondary" href="{{ route('admin.sections.index') }}">
            Cancel
        </a>
    </form>
</div>
@endsection
