@extends('layouts.app') <!-- သင့် layout ပေါ်မူတည်ပြီး -->
@section('content')

<div class="container">
    <h2 class="mb-4">Your Results</h2>

    <!-- Semester Selection -->
    <div class="mb-3">
        <label for="semester">Select Semester:</label>
        <select id="semester" class="form-control" onchange="loadResults()">
            <option value="First">First Semester</option>
            <option value="Second">Second Semester</option>
            <option value="Final">Final</option>
        </select>
    </div>

    <!-- Result Display Area -->
    <div id="results-area">
        <p>Please select a semester to view results.</p>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function loadResults() {
        const semester = document.getElementById('semester').value;

        fetch(`/results/fetch?semester=${semester}`)
            .then(response => response.json())
            .then(data => {
                const area = document.getElementById('results-area');

                if (data.length === 0) {
                    area.innerHTML = "<p>No results found for this semester.</p>";
                    return;
                }

                let html = "<table class='table table-bordered'><thead><tr><th>Subject</th><th>Marks</th><th>Grade</th></tr></thead><tbody>";
                data.forEach(result => {
                    html += `<tr>
                                <td>${result.subject}</td>
                                <td>${result.marks}</td>
                                <td>${result.grade}</td>
                             </tr>`;
                });
                html += "</tbody></table>";

                area.innerHTML = html;
            });
    }
</script>
@endsection
