@extends('layouts.admin')

@section('content')

@can('teacher.view')
<div class="container py-4">

    <h2 class="mb-3">Teachers (Admin)</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Add Teacher --}}
    @can('teacher.create')
    <div class="mb-3">
        <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">
            + Add Teacher
        </a>
    </div>
    @endcan

    <table class="table table-bordered table-striped align-middle">
        <thead>
            <tr>
                <th width="60">#</th>
                <th width="90">Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Education</th>
                <th width="170">Action</th>
            </tr>
        </thead>

        <tbody>
        @forelse($teachers as $index => $teacher)
            @php
                $img = !empty($teacher->photo)
                    ? asset('images/teachers/' . $teacher->photo)
                    : asset('images/default-teacher.png');
            @endphp

            <tr>
                <td>{{ $teachers->firstItem() + $index }}</td>

                <td>
                    <img src="{{ $img }}"
                         alt="{{ $teacher->name }}"
                         style="width:50px; height:50px; object-fit:cover; border-radius:50%;">
                </td>

                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->email }}</td>
                <td>{{ $teacher->phone ?? '-' }}</td>
                <td>{{ $teacher->education ?? '-' }}</td>

                <td>
                    {{-- Edit --}}
                    @can('teacher.edit')
                    <a href="{{ route('admin.teachers.edit', $teacher->id) }}"
                       class="btn btn-sm btn-warning">
                        Edit
                    </a>
                    @endcan

                    {{-- Delete --}}
                    @can('teacher.delete')
                    <form action="{{ route('admin.teachers.destroy', $teacher->id) }}"
                          method="POST"
                          class="d-inline"
                          onsubmit="return confirm('Delete this teacher?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                    @endcan
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No data</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $teachers->links() }}

</div>
@else
<div class="alert alert-danger m-4">
    <i class="bi bi-shield-lock me-1"></i>
    You do not have permission to view this page.
</div>
@endcan

@endsection
