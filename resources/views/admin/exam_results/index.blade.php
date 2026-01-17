@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Exam Results (Admin)</h3>
        <a href="{{ route('admin.exam-results.create') }}" class="btn btn-primary">+ Add Result</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form class="card card-body mb-3" method="GET">
        <div class="row g-2">
            <div class="col-md-2">
                <input name="year" class="form-control" placeholder="Year (e.g 2026)" value="{{ request('year') }}">
            </div>
            <div class="col-md-2">
                <input name="month" class="form-control" placeholder="Month (1-12)" value="{{ request('month') }}">
            </div>
            <div class="col-md-2">
                <select name="classroom_id" class="form-control">
                    <option value="">Classroom</option>
                    @foreach($classrooms as $c)
                        <option value="{{ $c->id }}" @selected(request('classroom_id')==$c->id)>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="section_id" class="form-control">
                    <option value="">Section</option>
                    @foreach($sections as $s)
                        <option value="{{ $s->id }}" @selected(request('section_id')==$s->id)>{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="subject_id" class="form-control">
                    <option value="">Subject</option>
                    @foreach($subjects as $sub)
                        <option value="{{ $sub->id }}" @selected(request('subject_id')==$sub->id)>{{ $sub->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input name="exam_type" class="form-control" placeholder="Exam Type" value="{{ request('exam_type') }}">
            </div>
            <div class="col-md-2">
                <select name="status" class="form-control">
                    <option value="">Status</option>
                    @foreach(['draft','published','locked'] as $st)
                        <option value="{{ $st }}" @selected(request('status')==$st)>{{ ucfirst($st) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 d-grid">
                <button class="btn btn-dark">Filter</button>
            </div>
            <div class="col-md-2 d-grid">
                <a class="btn btn-outline-secondary" href="{{ route('admin.exam-results.index') }}">Reset</a>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-bordered table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Student</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>Exam</th>
                        <th>Score</th>
                        <th>%</th>
                        <th>Grade</th>
                        <th>Status</th>
                        <th style="width:170px;">Action</th>
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
                            <td><span class="badge bg-info text-dark">{{ $r->status }}</span></td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="{{ route('admin.exam-results.edit', $r) }}">Edit</a>
                                <form action="{{ route('admin.exam-results.destroy', $r) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this record?')">Del</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="12" class="text-center py-4">No results found.</td></tr>
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
