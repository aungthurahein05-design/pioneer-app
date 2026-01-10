@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Edit Exam Result</h4>

    <form method="POST" action="{{ route('admin.exam-results.update', $result->id) }}">
        @csrf
        @method('PUT')

        {{-- Student & Grade (Manual Input) --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Student Name</label>
                <input type="text"
                       name="student_name"
                       class="form-control"
                       value="{{ old('student_name', $result->student_name) }}"
                       required>
                @error('student_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Grade</label>
                <input type="text"
                       name="grade_name"
                       class="form-control"
                       value="{{ old('grade_name', $result->grade_name) }}"
                       required>
                @error('grade_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- Exam Info --}}
        <div class="mb-3">
            <label class="form-label">Exam Name</label>
            <input type="text"
                   name="exam_name"
                   class="form-control"
                   value="{{ old('exam_name', $result->exam_name) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Subject</label>
            <input type="text"
                   name="subject"
                   class="form-control"
                   value="{{ old('subject', $result->subject) }}">
        </div>

        {{-- Score --}}
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Score</label>
                <input type="number"
                       step="0.01"
                       name="score"
                       class="form-control"
                       value="{{ old('score', $result->score) }}">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Max Score</label>
                <input type="number"
                       step="0.01"
                       name="max_score"
                       class="form-control"
                       value="{{ old('max_score', $result->max_score) }}">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Result Date</label>
                <input type="date"
                       name="result_date"
                       class="form-control"
                       value="{{ old('result_date', $result->result_date) }}"
                       required>
            </div>
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label class="form-label">Status</label>
            <input type="text"
                   name="status"
                   class="form-control"
                   value="{{ old('status', $result->status) }}">
        </div>

        {{-- Remarks --}}
        <div class="mb-3">
            <label class="form-label">Remarks</label>
            <textarea name="remarks"
                      class="form-control"
                      rows="3">{{ old('remarks', $result->remarks) }}</textarea>
        </div>

        {{-- Buttons --}}
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.exam-results.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
