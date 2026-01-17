@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Edit Event</h2>

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

    <form action="{{ route('admin.events.update', $event->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div class="mb-3">
            <label class="form-label">Title *</label>
            <input type="text"
                   name="title"
                   class="form-control"
                   value="{{ old('title', $event->title) }}"
                   required>
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label class="form-label">Description *</label>
            <textarea name="description"
                      class="form-control"
                      rows="4"
                      required>{{ old('description', $event->description) }}</textarea>
        </div>

        {{-- Event Date --}}
        <div class="mb-3">
            <label class="form-label">Event Date</label>
            <input type="date"
                   name="date"
                   class="form-control"
                   value="{{ old('date', optional($event->date)->format('Y-m-d') ?? $event->date) }}">
        </div>

        {{-- Current Image Preview --}}
        @if($event->image)
            <div class="mb-3">
                <label class="form-label d-block">Current Image</label>
                <img src="{{ asset('storage/'.$event->image) }}"
                     alt="Event Image"
                     class="img-fluid rounded border"
                     style="max-height:220px;">
                <div class="form-check mt-2">
                    <input class="form-check-input"
                           type="checkbox"
                           name="remove_image"
                           value="1"
                           id="remove_image">
                    <label class="form-check-label" for="remove_image">
                        Remove current image
                    </label>
                </div>
            </div>
        @endif

        {{-- Upload New Image --}}
        <div class="mb-3">
            <label class="form-label">Replace Image (optional)</label>
            <input type="file"
                   name="image"
                   class="form-control"
                   accept="image/*">
        </div>

        {{-- Video --}}
        <div class="mb-3">
            <label class="form-label">Video (YouTube URL or MP4 URL)</label>
            <input type="text"
                   name="video"
                   class="form-control"
                   value="{{ old('video', $event->video) }}"
                   placeholder="https://youtube.com/... or https://.../video.mp4">
        </div>

        {{-- Video Preview (optional) --}}
        @if($event->video)
            <div class="mb-3">
                <label class="form-label d-block">Current Video</label>

                @php
                    $v = $event->video;
                    $isYoutube = str_contains($v, 'youtube') || str_contains($v, 'youtu.be');
                @endphp

                @if($isYoutube)
                    <iframe width="100%" height="315"
                            src="{{ $v }}"
                            frameborder="0"
                            allowfullscreen></iframe>
                @else
                    <video controls width="100%" style="max-height:360px;">
                        <source src="{{ $v }}" type="video/mp4">
                    </video>
                @endif
            </div>
        @endif

        {{-- Buttons --}}
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.events.index') }}"
           class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
