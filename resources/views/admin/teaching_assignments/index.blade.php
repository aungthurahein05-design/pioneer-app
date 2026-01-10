@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Teaching Assignments</h3>
        <a class="btn btn-primary"
           href="{{ route('admin.teaching-assignments.create') }}">
            Add Assignment
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Teacher</th>
            <th>Subject</th>
            <th>Classroom</th>
            <th>Section</th>
            <th width="220">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->teacher->name }}</td>
                <td>{{ $item->subject->name }}</td>
                <td>{{ $item->classroom->name }}</td>
                <td>{{ $item->section?->name ?? '-' }}</td>
                <td>
                    <a class="btn btn-sm btn-info"
                       href="{{ route('admin.teaching-assignments.show', $item->id) }}">
                        View
                    </a>

                    <a class="btn btn-sm btn-warning"
                       href="{{ route('admin.teaching-assignments.edit', $item->id) }}">
                        Edit
                    </a>

                    <form class="d-inline"
                          method="POST"
                          action="{{ route('admin.teaching-assignments.destroy', $item->id) }}"
                          onsubmit="return confirm('Delete this assignment?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $items->links() }}
</div>
@endsection
