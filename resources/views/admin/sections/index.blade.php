@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Sections</h3>
        <a class="btn btn-primary" href="{{ route('admin.sections.create') }}">
            Add Section
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
            <th>Classroom</th>
            <th>Section</th>
            <th width="220">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sections as $section)
            <tr>
                <td>{{ $section->id }}</td>
                <td>{{ $section->classroom->name }}</td>
                <td>{{ $section->name }}</td>
                <td>
                    <a class="btn btn-sm btn-info"
                       href="{{ route('admin.sections.show', $section->id) }}">
                        View
                    </a>

                    <a class="btn btn-sm btn-warning"
                       href="{{ route('admin.sections.edit', $section->id) }}">
                        Edit
                    </a>

                    <form class="d-inline"
                          method="POST"
                          action="{{ route('admin.sections.destroy', $section->id) }}"
                          onsubmit="return confirm('Delete this section?')">
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

    {{ $sections->links() }}
</div>
@endsection
