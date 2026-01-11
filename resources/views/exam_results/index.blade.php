@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-3">Exam Results</h3>

    <form class="card card-body mb-3" method="GET">
        <div class="row g-2">
            <div class="col-md-2">
                <input name="year" class="form-control" placeholder="Year" value="{{ request('year') }}">
            </div>
            <div class="col-md-2">
                <input name="month" class="form-control" placeholder="Month (1-12)" value="{{ request('month') }}">
            </div>

            <div class="col-md-3">
                <select name="student_id" class="form-control">
                    <option value="">Student</option>
                    @foreach($students as $st)
                        <option value="{{ $st->id }}" @selected(request('student_id')==$st->id)>{{ $st->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <select name="classroom_id" class="form-control">
                    <option value="">Classroom</option>
                    @foreach($classrooms as $c)
                        <option value="{{ $c->id }}" @selected(request('classroom_id')==$c->id)>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-1">
                <select name="section_id" class="form-control">
                    <option value="">Sec</option>
                    @foreach($sections as $s)
                        <option value="{{ $s->id }}" @selected(request('section_id')==$s->id)>{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <input name="exam_type" class="form-control" placeholder="Exam Type" value="{{ request('exam_type') }}">
            </div>

            <div class="col-md-2 d-grid">
                <button class="btn btn-dark">Search</button>
            </div>
            <div class="col-md-2 d-grid">
                <a href="{{ route('exam-results.public') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Student</th>
                        <th>Class</th>
                        <th>Sec</th>
                        <th>Subject</th>
                        <th>Exam</th>
                        <th>Score</th>
                        <th>%</th>
                        <th>Grade</th>
                        <th>Pass</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($examResults as $i => $r)
                        <tr>
                            <td>{{ $examResults->firstItem() + $i }}</td>
                            <td>{{ optional($r->result_date)->format('Y-m-d') }}</td>
                            <td>{{ $r->student->name ?? '-' }}</td>
                            <td>{{ $r->classroom->name ?? '-' }}</td>
                            <td>{{ $r->section->name ?? '-' }}</td>
                            <td>{{ $r->subject->name ?? '-' }}</td>
                            <td>{{ $r->exam_type }}</td>
                            <td>{{ $r->score }} / {{ $r->max_score }}</td>
                            <td>{{ $r->percentage }}</td>
                            <td>{{ $r->grade_letter }}</td>
                            <td>
                                @if($r->pass_fail === null) -
                                @elseif($r->pass_fail) <span class="badge bg-success">Pass</span>
                                @else <span class="badge bg-danger">Fail</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="11" class="text-center py-4">No published results found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-body">
            {{ $examResults->links() }}
        </div>
    </div>
</div>
@endsection
