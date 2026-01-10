@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Events (Admin)</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
            + Add Event
        </a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th width="150">Action</th>
            </tr>
        </thead>
        <tbody>
        @forelse($events as $i => $event)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $event->title }}</td>
                <td>{{ $event->description }}</td>
                <td>{{ $event->date ? $event->date->format('Y-m-d') : '-' }}</td>
                <td>
                    <a href="{{ route('admin.events.edit', $event->id) }}"
                       class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('admin.events.destroy', $event->id) }}"
                          method="POST"
                          class="d-inline"
                          onsubmit="return confirm('Delete this event?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="text-center">No data</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
