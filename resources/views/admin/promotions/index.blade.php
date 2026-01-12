@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Promotions</h3>
    <a class="btn btn-primary" href="{{ route('admin.promotions.create') }}">+ Promote</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card">
    <div class="table-responsive">
      <table class="table table-bordered mb-0">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>Student</th>
            <th>From</th>
            <th>To</th>
            <th>Year</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          @forelse($promotions as $i => $p)
            <tr>
              <td>{{ $promotions->firstItem() + $i }}</td>
              <td>{{ $p->student->name ?? '-' }}</td>
              <td>{{ $p->from_classroom_id }} / {{ $p->from_section_id }}</td>
              <td>{{ $p->to_classroom_id }} / {{ $p->to_section_id }}</td>
              <td>{{ $p->from_academic_year }} → {{ $p->to_academic_year }}</td>
              <td>{{ $p->created_at->format('Y-m-d') }}</td>
            </tr>
          @empty
            <tr><td colspan="6" class="text-center py-4">No promotions yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="card-body">{{ $promotions->links() }}</div>
  </div>
</div>
@endsection
