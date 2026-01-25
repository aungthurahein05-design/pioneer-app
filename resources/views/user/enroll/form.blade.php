@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-3">
        <i class="bi bi-person-plus me-1"></i>
        Student Enrollment Form
    </h4>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('enroll.submit') }}">
                @csrf

                {{-- Name --}}
                <div class="mb-3">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', $data['name'] ?? '') }}" required>
                </div>

                {{-- NRC --}}
                <div class="mb-3">
                    <label class="form-label">NRC *</label>
                    <input type="text" name="nrc" class="form-control"
                        value="{{ old('nrc', $data['nrc'] ?? '') }}" required>
                </div>

                {{-- Gender --}}
                <div class="mb-3">
                    <label class="form-label">Gender *</label>
                    <select name="gender" class="form-select" required>
                        <option value="">-- Select --</option>
                        <option value="male"
                            {{ old('gender', $data['gender'] ?? '') == 'male' ? 'selected' : '' }}>
                            Male
                        </option>
                        <option value="female"
                            {{ old('gender', $data['gender'] ?? '') == 'female' ? 'selected' : '' }}>
                            Female
                        </option>
                    </select>
                </div>

                {{-- Father Name --}}
                <div class="mb-3">
                    <label class="form-label">Father Name *</label>
                    <input type="text" name="father_name" class="form-control"
                        value="{{ old('father_name', $data['father_name'] ?? '') }}" required>
                </div>

                {{-- Mother Name --}}
                <div class="mb-3">
                    <label class="form-label">Mother Name *</label>
                    <input type="text" name="mother_name" class="form-control"
                        value="{{ old('mother_name', $data['mother_name'] ?? '') }}" required>
                </div>

                {{-- Date of Birth --}}
                <div class="mb-3">
                    <label class="form-label">Date of Birth *</label>
                    <input type="date" name="dob" class="form-control"
                        value="{{ old('dob', $data['dob'] ?? '') }}" required>
                </div>

                {{-- Phone --}}
                <div class="mb-3">
                    <label class="form-label">Phone *</label>
                    <input type="text" name="phone" class="form-control"
                        value="{{ old('phone', $data['phone'] ?? '') }}" required>
                </div>

                {{-- Address --}}
                <div class="mb-3">
                    <label class="form-label">Address *</label>
                    <textarea name="address" class="form-control" rows="3" required>{{ old('address', $data['address'] ?? '') }}</textarea>
                </div>

                {{-- Submit --}}
                <button class="btn btn-primary btn-sm">
                    <i class="bi bi-send me-1"></i>
                    Submit Enrollment
                </button>

            </form>

        </div>
    </div>

</div>
@endsection
