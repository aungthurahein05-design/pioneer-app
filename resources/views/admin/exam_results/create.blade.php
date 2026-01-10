@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Add Exam Result</h4>

    <form method="POST" action="{{ route('admin.exam-results.store') }}">
        @csrf

        {{-- Student & Grade (Manual Input) --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Student Name</label>
                <input type="text"
                       name="student_name"
                       class="form-control"
                       value="{{ old('student_name') }}"
                       placeholder="Enter student name"
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
                       value="{{ old('grade_name') }}"
                       placeholder="Enter grade"
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
                   value="{{ old('exam_name') }}"
                   placeholder="Midterm / Final / Monthly"
                   required>
            @error('exam_name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Subject</label>
            <input type="text"
                   name="subject"
                   class="form-control"
                   value="{{ old('subject') }}"
                   placeholder="Math / English / Science">
        </div>

        {{-- Score --}}
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Score</label>
                <input type="number"
                       step="0.01"
                       name="score"
                       class="form-control"
                       value="{{ old('score') }}">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Max Score</label>
                <input type="number"
                       step="0.01"
                       name="max_score"
                       class="form-control"
                       value="{{ old('max_score') }}">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Result Date</label>
                <input type="date"
                       name="result_date"
                       class="form-control"
                       value="{{ old('result_date') }}"
                       required>
                @error('result_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label class="form-label">Status</label>
            <input type="text"
                   name="status"
                   class="form-control"
                   value="{{ old('status') }}"
                   placeholder="Pass / Fail / Absent">
        </div>

        {{-- Remarks --}}
        <div class="mb-3">
            <label class="form-label">Remarks</label>
            <textarea name="remarks"
                      class="form-control"
                      rows="3">{{ old('remarks') }}</textarea>
        </div>

        {{-- Buttons --}}
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.exam-results.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
