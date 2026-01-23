@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Enrollment</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.enroll.update', $enroll) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name', $enroll->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="nrc" class="form-label">NRC <span class="text-danger">*</span></label>
            <input type="text" id="nrc" name="nrc" value="{{ old('nrc', $enroll->nrc) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Gender <span class="text-danger">*</span></label>
            <select name="gender" class="form-select" required>
                <option value="male" {{ old('gender', $enroll->gender) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', $enroll->gender) == 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="father_name" class="form-label">Father Name <span class="text-danger">*</span></label>
            <input type="text" id="father_name" name="father_name" value="{{ old('father_name', $enroll->father_name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="mother_name" class="form-label">Mother Name <span class="text-danger">*</span></label>
            <input type="text" id="mother_name" name="mother_name" value="{{ old('mother_name', $enroll->mother_name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth <span class="text-danger">*</span></label>
            <input type="date" id="dob" name="dob" value="{{ old('dob', $enroll->dob) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $enroll->phone) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
            <textarea id="address" name="address" class="form-control" rows="3" required>{{ old('address', $enroll->address) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Enrollment</button>
        <a href="{{ route('admin.enroll.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
