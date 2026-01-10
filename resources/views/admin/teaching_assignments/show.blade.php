@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Teaching Assignment Detail</h3>

    <div class="card">
        <div class="card-body">
            <p><strong>Teacher:</strong> {{ $item->teacher->name }}</p>
            <p><strong>Subject:</strong> {{ $item->subject->name }}</p>
            <p><strong>Classroom:</strong> {{ $item->classroom->name }}</p>
            <p><strong>Section:</strong> {{ $item->section?->name ?? 'N/A' }}</p>
        </div>
    </div>

    <a class="btn btn-secondary mt-3"
       href="{{ route('admin.teaching-assignments.index') }}">
        Back
    </a>
</div>
@endsection
