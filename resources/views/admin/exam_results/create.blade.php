@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-3">Add Exam Result</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.exam-results.store') }}" method="POST" class="card card-body">
        @csrf

        @include('admin.exam_results.partials.form', [
            'examResult' => null,
            'students'   => $students,
            'classrooms' => $classrooms,
            'sections'   => $sections,
            'subjects'   => $subjects,
            'teachers'   => $teachers ?? collect(),
        ])

        <button class="btn btn-primary mt-3">Save</button>
        <a href="{{ route('admin.exam-results.index') }}" class="btn btn-secondary mt-2">Back</a>
    </form>
</div>
@endsection
