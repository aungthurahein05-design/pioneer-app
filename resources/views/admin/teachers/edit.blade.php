@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Edit Teacher</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name *</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $teacher->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email *</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email', $teacher->email) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control"
                   value="{{ old('phone', $teacher->phone) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Education</label>
            <input type="text" name="education" class="form-control"
                   value="{{ old('education', $teacher->education) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Photo</label><br>
            @if($teacher->photo)
                <img src="{{ asset('storage/' . $teacher->photo) }}"
                     alt="{{ $teacher->name }}"
                     style="width:70px; height:70px; object-fit:cover; border-radius:50%; margin-bottom:10px;">
            @endif
            <input type="file" name="photo" class="form-control" accept="image/*">
            <small class="text-muted">If you don't choose new photo, old one will keep.</small>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
