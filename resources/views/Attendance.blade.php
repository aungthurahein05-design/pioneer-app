<form method="POST" action="{{ route('attendance.store') }}">
@csrf

<input type="date" name="date" class="form-control mb-3" required>

<table class="table table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Student Name</th>
            <th>Present</th>
            <th>Absent</th>
            <th>Late</th>
            <th>Leave</th>
            <th>Remark</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $key => $student)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $student->name }}</td>

            @foreach(['Present','Absent','Late','Leave'] as $status)
            <td>
                <input type="radio"
                       name="attendance[{{ $student->id }}]"
                       value="{{ $status }}" required>
            </td>
            @endforeach

            <td>
                <input type="text"
                       name="remark[{{ $student->id }}]"
                       class="form-control">
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<button class="btn btn-success">Save Attendance</button>
</form>
