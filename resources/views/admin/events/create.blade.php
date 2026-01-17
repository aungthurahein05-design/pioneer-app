@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Create Event (Admin)</h2>
        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>

    {{-- Validation Errors --}}
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
          action="{{ route('admin.events.store') }}"
          enctype="multipart/form-data">
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

        {{-- Image --}}
        <div class="mb-3">
            <label class="form-label">Event Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        {{-- Video --}}
        <div class="mb-3">
            <label class="form-label">Event Video (YouTube URL or MP4 URL)</label>
            <input type="text" name="video" class="form-control"
                   value="{{ old('video') }}"
                   placeholder="https://youtube.com/... or https://.../video.mp4">
            <small class="text-muted">
                Recommended: use YouTube link. (Uploading MP4 is heavy)
            </small>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
