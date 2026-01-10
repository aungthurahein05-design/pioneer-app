@extends('layouts.app')

@section('content')

<style>
    body {
        background: #f4f6f9;
    }

    .filter-box {
        background: #ffffff;
        padding: 16px;
        border-radius: 14px;
        box-shadow: 0 10px 30px rgba(0,0,0,.06);
    }

    .result-card {
        border-radius: 16px;
        border: none;
        box-shadow: 0 10px 25px rgba(0,0,0,.08);
        transition: .25s;
    }

    .result-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(0,0,0,.12);
    }

    .exam-title {
        font-weight: 600;
        font-size: 1.05rem;
        color: #1f2937;
    }

    .exam-date {
        font-size: .85rem;
        color: #6b7280;
    }

    .label {
        font-weight: 600;
        color: #374151;
    }

    .score-badge {
        background: linear-gradient(135deg,#22c55e,#16a34a);
        color: #fff;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: .85rem;
        font-weight: 600;
        display: inline-block;
    }

    .pagination {
        justify-content: center;
    }
</style>

<div class="container">
    <h4 class="mb-3">Exam Results</h4>

    {{-- Filter --}}
    <div class="filter-box mb-3">
        <form method="GET" action="{{ route('exam-results.index') }}" class="row g-2">
            <div class="col-md-3">
                <select name="year" class="form-control">
                    <option value="">All Years</option>
                    @foreach($years as $y)
                        <option value="{{ $y }}" @selected((int)$year === (int)$y)>
                            {{ $y }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select name="month" class="form-control">
                    <option value="">All Months</option>
                    @for($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" @selected((int)$month === $m)>
                            {{ $m }}
                        </option>
                    @endfor
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100">Filter</button>
            </div>
        </form>
    </div>

    {{-- Results --}}
    @forelse($results as $r)
        <div class="card result-card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="exam-title">{{ $r->exam_name }}</span>
                    <span class="exam-date">{{ $r->result_date->format('d M Y') }}</span>
                </div>

                <div class="mb-1">
                    <span class="label">Student:</span>
                    {{ $r->student_name ?? $r->student?->name ?? 'N/A' }}
                </div>

                <div class="mb-1">
                    <span class="label">Grade:</span>
                    {{ $r->grade_name ?? $r->grade?->name ?? 'N/A' }}
                </div>

                <div class="mb-1">
                    <span class="label">Subject:</span>
                    {{ $r->subject ?? '-' }}
                </div>

                <div class="mt-2">
                    <span class="score-badge">
                        {{ $r->score ?? '-' }}
                        @if($r->max_score)
                            / {{ $r->max_score }}
                        @endif
                    </span>
                </div>

                @if($r->remarks)
                    <div class="mt-2 text-muted small">
                        {{ $r->remarks }}
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center">
            No results found.
        </div>
    @endforelse

    {{-- Pagination --}}
    {{ $results->withQueryString()->links() }}
</div>
@endsection
