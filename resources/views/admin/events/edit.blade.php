@extends('layouts.app')

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
                   value="{{ old('date', $event->date) }}">
        </div>

        {{-- Buttons --}}
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.events.index') }}"
           class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
