@extends('layouts.admin')

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

    <table class="table table-bordered table-striped align-middle">
        <thead>
            <tr>
                <th style="width:60px;">#</th>
                <th style="width:120px;">Image</th>
                <th>Title</th>
                <th>Description</th>
                <th style="width:120px;">Date</th>
                <th style="width:130px;">Video</th>
                <th style="width:170px;">Action</th>
            </tr>
        </thead>

        <tbody>
        @forelse($events as $i => $event)
            <tr>
                <td>{{ $i + 1 }}</td>

                {{-- Image --}}
                <td>
                    @if($event->image)
                        <img src="{{ asset('storage/'.$event->image) }}"
                             alt="event image"
                             class="img-fluid rounded border"
                             style="max-height:60px;">
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>

                <td>{{ $event->title }}</td>

                <td style="max-width:420px;">
                    <div class="text-truncate" style="max-width:420px;">
                        {{ $event->description }}
                    </div>
                </td>

                {{-- Date --}}
                <td>
                    {{ $event->date ? \Carbon\Carbon::parse($event->date)->format('Y-m-d') : '-' }}
                </td>

                {{-- Video --}}
                <td>
                    @if($event->video)
                        @php
                            $v = $event->video;
                            $isYoutube = str_contains($v, 'youtube') || str_contains($v, 'youtu.be');
                        @endphp

                        @if($isYoutube)
                            <a href="{{ $v }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                YouTube
                            </a>
                        @else
                            <a href="{{ $v }}" target="_blank" class="btn btn-sm btn-outline-success">
                                MP4
                            </a>
                        @endif
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>

                {{-- Actions --}}
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
            <tr>
                <td colspan="7" class="text-center">No data</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
