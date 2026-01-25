@extends('layouts.admin')

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

        {{-- Photo --}}
        <div class="mb-3">
            <label class="form-label">Photo</label>

            {{-- optional preview --}}
            <div class="mb-2">
                <img id="preview"
                     src="{{ asset('images/default-teacher.png') }}"
                     style="width:70px;height:70px;object-fit:cover;border-radius:50%;">
            </div>

            <input type="file" name="photo" class="form-control"
                   accept="image/*" onchange="previewImage(event)">
            <small class="text-muted">
                JPG / PNG only • Saved to <code>public/images/teachers/</code>
            </small>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script>
function previewImage(e){
    const img = document.getElementById('preview');
    img.src = URL.createObjectURL(e.target.files[0]);
}
</script>
@endsection
