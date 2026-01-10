@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Exam Results</h4>
        <a href="{{ route('admin.exam-results.create') }}" class="btn btn-primary">
            Add Result
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Date</th>
                <th>Student</th>
                <th>Grade</th>
                <th>Exam</th>
                <th>Subject</th>
                <th>Score</th>
                <th>Status</th>
                <th width="160">Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($results as $r)
            <tr>
                <td>{{ \Carbon\Carbon::parse($r->result_date)->format('d M Y') }}</td>
                <td>{{ $r->student_name }}</td>
                <td>{{ $r->grade_name }}</td>
                <td>{{ $r->exam_name }}</td>
                <td>{{ $r->subject }}</td>
                <td>
                    {{ $r->score }}
                    @if($r->max_score)
                        / {{ $r->max_score }}
                    @endif
                </td>
                <td>{{ $r->status }}</td>
                <td>
                    <a href="{{ route('admin.exam-results.edit', $r->id) }}"
                       class="btn btn-sm btn-warning">
                        Edit
                    </a>

                    <form action="{{ route('admin.exam-results.destroy', $r->id) }}"
                          method="POST"
                          class="d-inline"
                          onsubmit="return confirm('Delete this result?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">
                    No results found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $results->links() }}
    </div>
</div>
@endsection
