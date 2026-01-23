@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="mb-0">Users (Admin)</h2>

        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            + Add User
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th style="width:170px">Action</th>
                </tr>
            </thead>
            <tbody>
            @forelse($users as $i => $user)
                <tr>
                    {{-- Works with pagination --}}
                    <td>
                        {{ method_exists($users, 'firstItem') ? $users->firstItem() + $i : $i + 1 }}
                    </td>

                    <td class="fw-semibold">{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'secondary' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>

                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        @if(auth()->id() != $user->id)
                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No users</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- Show pagination if using paginate() --}}
    @if(method_exists($users, 'links'))
        <div class="mt-3">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection
