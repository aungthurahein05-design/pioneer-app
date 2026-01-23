@extends('layouts.admin')


@section('content')

<div class="school-bg">
<div class="school-content">
    <div class="container">
        <div class="enroll-box">

            <h2 class="mb-4">Student Enroll Form</h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('enroll.form') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">NRC Number</label>
                    <input type="text" name="nrc" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Male/Female</label>
                    <select name="gender" class="form-control" required>
                        <option value="">select</option>
                        <option value="male">male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Father Name</label>
                    <input type="text" name="father_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mother Name</label>
                    <input type="text" name="mother_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Birthday</label>
                    <input type="date" name="dob" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" name="phone" class="form-control" required pattern="[0-9]{7,15}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Enroll</button>
            </form>

        </div>
    </div>
</div>
</div>



@endsection
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

