@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Edit Subject</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.subjects.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Subject Name *</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $subject->name) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
