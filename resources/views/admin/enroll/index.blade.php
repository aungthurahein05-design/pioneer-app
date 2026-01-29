@extends('layouts.admin')

@section('content')
@can('enroll.view')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Enrollments</h2>
        @can('enroll.create')
        <a href="{{ route('admin.enroll.create') }}" class="btn btn-primary">+ Add Enrollment</a>
        @endcan
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>NRC</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Date of Birth</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enrolls as $index => $enroll)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $enroll->name }}</td>
                        <td>{{ $enroll->nrc }}</td>
                        <td>{{ ucfirst($enroll->gender) }}</td>
                        <td>{{ $enroll->phone }}</td>
                        <td>{{ $enroll->address }}</td>
                        <td>{{ $enroll->dob }}</td>
                        <td>
                        @can('enroll.edit')    
                        <a href="{{ route('admin.enroll.edit', $enroll) }}" class="btn btn-sm btn-warning">Edit</a>
                        @endcan

                        @can('enroll.delete')
                            <form action="{{ route('admin.enroll.destroy', $enroll) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this enrollment?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No enrollments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endcan
@endsection
