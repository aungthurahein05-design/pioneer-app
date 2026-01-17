@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="mb-0">Student List</h2>

        {{-- Add Student Button --}}
        <a href="{{ route('admin.students.create') }}" class="btn btn-primary">
            <i class="bi bi-person-plus me-1"></i> Add Student
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>StudentCode</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Classroom</th>
                    <th>Section</th>
                    <th>AdmissionYear</th>
                    <th>RollNo</th>
                    <th>Father</th>
                    <th>Mother</th>
                    <th>GuardianPhone</th>
                    <th>Phone</th>
                    <th>Photo</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th width="200">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->student_code }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->gender ? ucfirst($student->gender) : '-' }}</td>
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
                                     alt="{{ $student->name }}"
                                     style="width:40px; height:40px; object-fit:cover; border-radius:50%;">
                            @else
                                -
                            @endif
                        </td>

                        <td>{{ $student->email ?? '-' }}</td>

                        <td>
                            <span class="badge bg-{{ ($student->status ?? 'inactive') === 'active' ? 'success' : 'secondary' }}">
                                {{ ucfirst($student->status ?? 'inactive') }}
                            </span>
                        </td>

                        <td class="text-nowrap">
                            <a href="{{ route('admin.students.show', $student->id) }}"
                               class="btn btn-sm btn-info text-white">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('admin.students.edit', $student->id) }}"
                               class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('admin.students.destroy', $student->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="17" class="text-center">
                            No students found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
