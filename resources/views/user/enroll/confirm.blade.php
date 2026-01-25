@extends('layouts.app')

@section('content')
    <div class="container py-3">

        <h4 class="fw-bold mb-3">
            <i class="bi bi-check-circle me-1"></i>
            Confirm Enrollment Information
        </h4>

        {{-- Info message --}}
        <div class="alert alert-info">
            Please check your information carefully before submitting.
        </div>

        <div class="card">
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Name</th>
                        <td>{{ $data['name'] }}</td>
                    </tr>
                    <tr>
                        <th>NRC</th>
                        <td>{{ $data['nrc'] }}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>{{ ucfirst($data['gender']) }}</td>
                    </tr>
                    <tr>
                        <th>Father Name</th>
                        <td>{{ $data['father_name'] }}</td>
                    </tr>
                    <tr>
                        <th>Mother Name</th>
                        <td>{{ $data['mother_name'] }}</td>
                    </tr>
                    <tr>
                        <th>Date of Birth</th>
                        <td>{{ $data['dob'] }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $data['phone'] }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $data['address'] }}</td>
                    </tr>
                </table>

                {{-- Final Submit --}}
                <form method="POST" action="{{ route('enroll.store') }}">
                    @csrf

                    {{-- pass all data as hidden inputs --}}
                    @foreach ($data as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach

                    <div class="d-flex gap-2">
                        <a href="{{ route('enroll.form', $data) }}" class="btn btn-outline-secondary btn-sm">
                            ← Edit
                        </a>

                        <button class="btn btn-primary btn-sm">
                            ✅ Confirm & Submit
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
