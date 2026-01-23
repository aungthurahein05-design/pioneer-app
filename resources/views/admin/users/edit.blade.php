@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2>Edit User</h2>

    <form action="{{ route('admin.users.update', $users->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name"
                   value="{{ $users->name }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email"
                   value="{{ $users->email }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password (leave blank if not change)</label>
            <input type="password" name="password"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="user" {{ $user->role=='user'?'selected':'' }}>User</option>
                <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
