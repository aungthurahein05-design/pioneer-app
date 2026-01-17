@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Teachers (Admin)</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">+ Add Teacher</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Education</th>
                <th width="150">Action</th>
            </tr>
        </thead>
        <tbody>
        @forelse($teachers as $index => $teacher)
            <tr>
                <td>{{ $teachers->firstItem() + $index }}</td>
                <td>
                    @if($teacher->photo)
                        <img src="{{ asset('storage/' . $teacher->photo) }}"
                             alt="{{ $teacher->name }}"
                             style="width:50px; height:50px; object-fit:cover; border-radius:50%;">
                    @endif
                </td>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->email }}</td>
                <td>{{ $teacher->phone }}</td>
                <td>{{ $teacher->education }}</td>
                <td>
                    <a href="{{ route('admin.teachers.edit', $teacher->id) }}"
                       class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('admin.teachers.destroy', $teacher->id) }}"
                          method="POST"
                          style="display:inline-block"
                          onsubmit="return confirm('Delete this teacher?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" class="text-center">No data</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $teachers->links() }}
</div>
@endsection
