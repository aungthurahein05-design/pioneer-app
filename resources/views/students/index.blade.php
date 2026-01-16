@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Student List</h2>

    {{-- Add Student Button --}}
    <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">
        + Add Student
    </a>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Student Code</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Classroom</th>
                    <th>Section</th>
                    <th>Admission Year</th>
                    <th>Roll No</th>
                    <th>Father</th>
                    <th>Mother</th>
                    <th>Guardian Phone</th>
                    <th>Phone</th>
                    <th>Photo</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th width="180">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->student_code }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ ucfirst($student->gender ?? '-') }}</td>
                        <td>{{ $student->date_of_birth ?? '-' }}</td>
                        <td>{{ $student->classroom->name ?? '-' }}</td>
                        <td>{{ $student->section->name ?? '-' }}</td>
                        <td>{{ $student->admission_year ?? '-' }}</td>
                        <td>{{ $student->roll_number ?? '-' }}</td>
                        <td>{{ $student->father_name ?? '-' }}</td>
                        <td>{{ $student->mother_name ?? '-' }}</td>
                        <td>{{ $student->guardian_phone ?? '-' }}</td>
                        <td>{{ $student->phone ?? '-' }}</td>
                        <td>
                            @if($student->photo)
                                <img src="{{ asset('storage/' . $student->photo) }}"
                                    style="width:40px; height:40px; object-fit:cover; border-radius:50%;">
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $student->email ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $student->status === 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($student->status) }}
                            </span>
                        </td>
                        <td>
                            
                            <a href="{{ route('students.edit', $student->id) }}"
                               class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('students.destroy', $student->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="16" class="text-center">
                            No students found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
