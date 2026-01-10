@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Create Event</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.events.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Title *</label>
        <input type="text" name="title" class="form-control"
               value="{{ old('title') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4"
                  placeholder="Enter event description">{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Date</label>
        <input type="date" name="date" class="form-control"
               value="{{ old('date') }}">
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
</form>

</div>
@endsection
