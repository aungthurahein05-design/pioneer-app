@php
    $r = $examResult;
@endphp

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">Student</label>
        <select name="student_id" class="form-control" required>
            <option value="">Choose</option>
            @foreach($students as $st)
                <option value="{{ $st->id }}" @selected(old('student_id', $r->student_id ?? '') == $st->id)>
                    {{ $st->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Classroom</label>
        <select name="classroom_id" class="form-control" required>
            <option value="">Choose</option>
            @foreach($classrooms as $c)
                <option value="{{ $c->id }}" @selected(old('classroom_id', $r->classroom_id ?? '') == $c->id)>
                    {{ $c->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Section</label>
        <select name="section_id" class="form-control" required>
            <option value="">Choose</option>
            @foreach($sections as $s)
                <option value="{{ $s->id }}" @selected(old('section_id', $r->section_id ?? '') == $s->id)>
                    {{ $s->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Subject</label>
        <select name="subject_id" class="form-control" required>
            <option value="">Choose</option>
            @foreach($subjects as $sub)
                <option value="{{ $sub->id }}" @selected(old('subject_id', $r->subject_id ?? '') == $sub->id)>
                    {{ $sub->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label class="form-label">Exam Type</label>
        <input name="exam_type" class="form-control" required
               value="{{ old('exam_type', $r->exam_type ?? '') }}" placeholder="Monthly / Midterm / Final">
    </div>

    <div class="col-md-4">
        <label class="form-label">Result Date</label>
        <input type="date" name="result_date" class="form-control" required
               value="{{ old('result_date', optional($r->result_date ?? null)->format('Y-m-d')) }}">
    </div>

    <div class="col-md-4">
        <label class="form-label">Academic Year</label>
        <input name="academic_year" class="form-control"
               value="{{ old('academic_year', $r->academic_year ?? '') }}" placeholder="2025-2026">
    </div>

    <div class="col-md-4">
        <label class="form-label">Term</label>
        <input name="term" class="form-control"
               value="{{ old('term', $r->term ?? '') }}" placeholder="Term 1">
    </div>

    <div class="col-md-4">
        <label class="form-label">Exam Name (optional)</label>
        <input name="exam_name" class="form-control"
               value="{{ old('exam_name', $r->exam_name ?? '') }}" placeholder="Final Exam 2026">
    </div>

    <div class="col-md-3">
        <label class="form-label">Score</label>
        <input type="number" step="0.01" name="score" class="form-control"
               value="{{ old('score', $r->score ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label">Max Score</label>
        <input type="number" step="0.01" name="max_score" class="form-control"
               value="{{ old('max_score', $r->max_score ?? '') }}">
    </div>

    <div class="col-md-3">
        <label class="form-label">Grade Letter</label>
        <input name="grade_letter" class="form-control"
               value="{{ old('grade_letter', $r->grade_letter ?? '') }}" placeholder="A/B/C">
    </div>

    <div class="col-md-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-control" required>
            @foreach(['draft','published','locked'] as $st)
                <option value="{{ $st }}" @selected(old('status', $r->status ?? 'draft') == $st)>
                    {{ ucfirst($st) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-12">
        <label class="form-label">Remarks</label>
        <textarea name="remarks" class="form-control" rows="3">{{ old('remarks', $r->remarks ?? '') }}</textarea>
    </div>
</div>
