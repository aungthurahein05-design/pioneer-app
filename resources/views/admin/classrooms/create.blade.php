@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h3 class="mb-3">Create Classroom</h3>

    @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">
            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul></div>
    @endif

    <form method="POST" action="{{ route('admin.classrooms.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name *</label>
            <input name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Code</label>
            <input name="code" class="form-control" value="{{ old('code') }}">
        </div>
        <button class="btn btn-primary">Save</button>
        <a class="btn btn-secondary" href="{{ route('admin.classrooms.index') }}">Cancel</a>
    </form>
</div>
@endsection
