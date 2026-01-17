@extends('layouts.admin')
@section('content')
<div class="container py-4">
    <h3>Classroom Detail</h3>
    <div class="card">
        <div class="card-body">
            <p><b>Name:</b> {{ $classroom->name }}</p>
            <p><b>Code:</b> {{ $classroom->code }}</p>
        </div>
    </div>
    <a class="btn btn-secondary mt-3" href="{{ route('admin.classrooms.index') }}">Back</a>
</div>
@endsection
