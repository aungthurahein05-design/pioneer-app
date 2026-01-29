@extends('layouts.admin')
@section('content')

@can('classroom.view')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Classrooms</h3>
        @can('classroom.create')
        <a class="btn btn-primary" href="{{ route('admin.classrooms.create') }}">Add Classroom </a>
        @endcan
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th><th>Name</th><th>Code</th><th width="220">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($classrooms as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->code }}</td>
                <td>
                    <a class="btn btn-sm btn-info" href="{{ route('admin.classrooms.show',$c->id) }}">View</a>
                    @can('classroom.edit')
                    <a class="btn btn-sm btn-warning" href="{{ route('admin.classrooms.edit',$c->id) }}">Edit</a>
                    @endcan
                    <form class="d-inline" method="POST" action="{{ route('admin.classrooms.destroy',$c->id) }}"
                          onsubmit="return confirm('Delete classroom?')">
                        @csrf @method('DELETE')
                        @can('classroom.delete')
                        <button class="btn btn-sm btn-danger">Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $classrooms->links() }}
</div>
@endcan
@endsection
