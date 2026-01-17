@extends('layouts.admin')

@section('content')
    <div class="container">

        {{-- Page Header --}}
        <div class="row py-3">
            <div class="col text-center">
                <h3 class="fw-bold mb-1">
                    Pioneer Private School
                </h3>
                <p class="text-muted mb-0">
                    <i class="bi bi-speedometer2 me-1"></i>
                    Admin Dashboard
                </p>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="row g-4 justify-content-center">

            {{-- Master Data Management --}}
            <div class="col-md-10">
                <div class="card shadow-sm h-100">
                    <div class="card-header fw-semibold">
                        <i class="bi bi-database-fill-gear me-1"></i>
                        Master Data Management
                    </div>
                    <div class="card-body">

                        <div class="d-flex flex-wrap gap-2">

                            <a href="{{ route('admin.teachers.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-buildings me-1"></i>
                                Teachers
                            </a>

                            <a href="{{ route('admin.subjects.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-buildings me-1"></i>
                                Subjects
                            </a>

                             <a href="{{ route('admin.events.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-buildings me-1"></i>
                                Events
                            </a>

                             <a href="{{ route('admin.promotions.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-buildings me-1"></i>
                                Student Promotion
                            </a>

                            <a href="{{ route('admin.exam-results.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-buildings me-1"></i>
                                ExamResult
                            </a>

                              <a href="{{ route('admin.classrooms.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-buildings me-1"></i>
                                Classroom
                            </a>

                              <a href="{{ route('admin.sections.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-buildings me-1"></i>
                                Section
                            </a>

                             <a href="{{ route('admin.students.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-buildings me-1"></i>
                                Student
                            </a>



                            



                        </div>

                    </div>
                </div>
            </div>

        </div>
        
    </div>
@endsection
