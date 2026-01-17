@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h3>Section Detail</h3>

    <div class="card">
        <div class="card-body">
            <p><strong>Classroom:</strong> {{ $section->classroom->name }}</p>
            <p><strong>Section:</strong> {{ $section->name }}</p>
        </div>
    </div>

    <a class="btn btn-secondary mt-3"
       href="{{ route('admin.sections.index') }}">
        Back
    </a>
</div>
@endsection
