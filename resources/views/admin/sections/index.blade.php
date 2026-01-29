@extends('layouts.admin')

@section('content')
@can('section.view')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Sections</h3>
        @can('section.create')
        <a class="btn btn-primary" href="{{ route('admin.sections.create') }}">
            Add Section
        </a>
        @endcan
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
                    @can('section.edit')
                    <a class="btn btn-sm btn-warning"
                       href="{{ route('admin.sections.edit', $section->id) }}">
                        Edit
                    </a>
                    @endcan

                    <form class="d-inline"
                          method="POST"
                          action="{{ route('admin.sections.destroy', $section->id) }}"
                          onsubmit="return confirm('Delete this section?')">
                        @csrf
                        @method('DELETE')
                        @can('section.delete')
                        <button class="btn btn-sm btn-danger">
                            Delete
                        </button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $sections->links() }}
</div>
@endcan
@endsection
