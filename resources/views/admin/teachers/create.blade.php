@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Create Teacher</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.teachers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name *</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email *</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control"
                   value="{{ old('phone') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Education</label>
            <input type="text" name="education" class="form-control"
                   value="{{ old('education') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Photo</label>
            <input type="file" name="photo" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
