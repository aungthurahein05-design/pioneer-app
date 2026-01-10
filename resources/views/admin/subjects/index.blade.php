@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="mb-0">Subjects (Admin)</h2>

        <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary">
            + Add Subject
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th style="width:70px">#</th>
                    <th>Subject Name</th>
                    <th style="width:170px">Action</th>
                </tr>
            </thead>
            <tbody>
            @forelse($subjects as $i => $subject)
                <tr>
                    {{-- ✅ works with pagination also --}}
                    <td>
                        {{ method_exists($subjects, 'firstItem') ? $subjects->firstItem() + $i : $i + 1 }}
                    </td>

                    <td class="fw-semibold">{{ $subject->name }}</td>

                    <td>
                        <a href="{{ route('admin.subjects.edit', $subject->id) }}"
                           class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('admin.subjects.destroy', $subject->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Delete this subject?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No data</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- ✅ show pagination if using paginate() --}}
    @if(method_exists($subjects, 'links'))
        <div class="mt-3">
            {{ $subjects->links() }}
        </div>
    @endif
</div>
@endsection
