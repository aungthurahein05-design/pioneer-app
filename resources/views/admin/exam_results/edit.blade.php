@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-3">Edit Exam Result</h3>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.exam-results.update', $examResult) }}" method="POST" class="card card-body">
        @csrf
        @method('PUT')

        @include('admin.exam_results.partials.form', [
            'examResult' => $examResult,
            'students'   => $students,
            'classrooms' => $classrooms,
            'sections'   => $sections,
            'subjects'   => $subjects,
            'teachers'   => $teachers ?? collect(),
        ])

        <button class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('admin.exam-results.index') }}" class="btn btn-secondary mt-2">Back</a>
    </form>
</div>
@endsection
