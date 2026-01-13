@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp

<style>
    .sub-hero {
        background:
            radial-gradient(1200px circle at 10% 10%, rgba(13,110,253,.18), transparent 55%),
            radial-gradient(900px circle at 90% 0%, rgba(25,135,84,.18), transparent 60%),
            linear-gradient(180deg, rgba(248,249,250,1), rgba(255,255,255,1));
        border: 1px solid rgba(0,0,0,.06);
    }
    .subject-card{
        border: 1px solid rgba(0,0,0,.06);
        transition: transform .18s ease, box-shadow .18s ease;
        background: rgba(255,255,255,.92);
        backdrop-filter: blur(6px);
    }
    .subject-card:hover{
        transform: translateY(-2px);
        box-shadow: 0 .9rem 2rem rgba(0,0,0,.08);
    }
    .subject-icon{
        width: 46px;height:46px;
        display:grid;place-items:center;
        border-radius: 14px;
        background: rgba(13,110,253,.10);
        border: 1px solid rgba(13,110,253,.18);
        color:#0b5ed7;font-weight:900;
        flex: 0 0 auto;
    }

    /* School animated background */
    .school-animated-bg {
        position: fixed;
        inset: 0;
        z-index: -1;
        pointer-events: none;
        overflow: hidden;
        background-color: #dafcfcff;
    }
    .school-icon {
        position: absolute;
        font-size: 48px;
        opacity: 0.12;
        animation: floatSchool 18s linear infinite;
    }
    @keyframes floatSchool {
        0% { transform: translateY(0) rotate(0deg); opacity: 0.10; }
        50% { transform: translateY(-300px) rotate(20deg); opacity: 0.16; }
        100%{ transform: translateY(-600px) rotate(-20deg); opacity: 0.10; }
    }
    .school-icon:nth-child(1){ left: 5%;  bottom: -100px; animation-duration: 16s; }
    .school-icon:nth-child(2){ left: 20%; bottom: -120px; animation-duration: 22s; }
    .school-icon:nth-child(3){ left: 35%; bottom: -140px; animation-duration: 19s; }
    .school-icon:nth-child(4){ left: 50%; bottom: -110px; animation-duration: 25s; }
    .school-icon:nth-child(5){ left: 65%; bottom: -130px; animation-duration: 20s; }
    .school-icon:nth-child(6){ left: 80%; bottom: -150px; animation-duration: 18s; }
    .school-icon:nth-child(7){ left: 92%; bottom: -160px; animation-duration: 26s; }

    footer.custom-footer{
        background: rgba(182,219,227,.52);
        border-top: 1px solid rgba(30,42,15,1);
    }
    footer.custom-footer a{ color:#0f172a; text-decoration:none; }
    footer.custom-footer a:hover{ color:#0b5ed7; }
</style>

{{-- Animated BG --}}
<div class="school-animated-bg">
    <div class="school-icon">📚</div>
    <div class="school-icon">✏️</div>
    <div class="school-icon">📘</div>
    <div class="school-icon">🧮</div>
    <div class="school-icon">📏</div>
    <div class="school-icon">📝</div>
    <div class="school-icon">⭐</div>
</div>

<div class="container py-4">

    {{-- HERO --}}
    <div class="sub-hero rounded-4 p-4 p-md-5 mb-4">
        <div class="row align-items-center g-3">
            <div class="col-md-7">
                <h1 class="h3 mb-2 fw-bold">Subjects</h1>
                <p class="mb-0 text-secondary">
                    Browse all subjects that are added by Admin.
                </p>
            </div>

            <div class="col-md-5">
                <form method="GET" action="{{ route('subject') }}" class="d-flex gap-2">
                    <input type="text"
                           name="q"
                           class="form-control form-control-lg"
                           placeholder="Search subjects..."
                           value="{{ request('q') }}">
                    <button class="btn btn-primary btn-lg px-4" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>

    {{-- TOP BAR --}}
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 mb-3">
        <div class="text-secondary">
            <span class="fw-semibold text-dark">
                {{ method_exists($subjects, 'total') ? number_format($subjects->total()) : count($subjects) }}
            </span>
            subjects
        </div>

        <div class="d-flex gap-2">
            <a class="btn btn-outline-secondary {{ request('sort') ? '' : 'active' }}"
               href="{{ route('subject') }}">Default</a>

            <a class="btn btn-outline-secondary {{ request('sort')==='az' ? 'active' : '' }}"
               href="{{ route('subject', array_filter(['q'=>request('q'), 'sort'=>'az'])) }}">A–Z</a>

            <a class="btn btn-outline-secondary {{ request('sort')==='za' ? 'active' : '' }}"
               href="{{ route('subject', array_filter(['q'=>request('q'), 'sort'=>'za'])) }}">Z–A</a>
        </div>
    </div>

    {{-- GRID --}}
    <div class="row g-3 g-md-4">
        @forelse($subjects as $subject)
            @php
                $name = $subject->name ?? 'Subject';
                $firstLetter = mb_strtoupper(mb_substr($name, 0, 1));
            @endphp

            <div class="col-12 col-md-6 col-lg-4">
                <div class="card subject-card h-100 rounded-4">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex align-items-start justify-content-between gap-3 mb-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="subject-icon">{{ $firstLetter }}</div>
                                <div>
                                    <h5 class="mb-1 fw-bold">{{ $name }}</h5>
                                    <div class="text-secondary small">
                                        Added: {{ optional($subject->created_at)->format('d M Y') ?? '-' }}
                                    </div>
                                </div>
                            </div>

                            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2">
                                Subject
                            </span>
                        </div>

                        <p class="text-secondary mb-4">
                            {{ Str::of($name)->length() > 0 ? 'Click to explore activities related to this subject.' : '' }}
                        </p>

                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="text-secondary small">
                                Updated: {{ optional($subject->updated_at)->diffForHumans() ?? '-' }}
                            </span>

                            {{-- Optional button (you can change to your real route later) --}}
                            <a href="{{ url('/events?subject=' . urlencode($name)) }}"
                               class="btn btn-outline-primary btn-sm">
                                View Events
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="border rounded-4 p-5 text-center bg-light">
                    <h5 class="fw-bold mb-2">No subjects found</h5>
                    <p class="text-secondary mb-0">Try another keyword or check back later.</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    @if(method_exists($subjects, 'links'))
        <div class="mt-4 d-flex justify-content-center">
            {{ $subjects->withQueryString()->links() }}
        </div>
    @endif

</div>

<!-- {{-- FOOTER --}}
<footer class="custom-footer pt-5 pb-4 mt-4">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6">
                <h5 class="fw-bold mb-2">Pioneer School</h5>
                <p class="text-muted mb-2">No. 123, University Avenue, Yangon</p>
                <p class="text-muted mb-0">
                    Phone: <a href="tel:+95900000000">+95 9 000 000 00</a> ·
                    Email: <a href="mailto:info@pioneerschool.edu">info@pioneerschool.edu</a>
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="#" class="me-3"><i class="bi bi-facebook fs-4"></i></a>
                <a href="#" class="me-3"><i class="bi bi-instagram fs-4"></i></a>
                <a href="#"><i class="bi bi-youtube fs-4"></i></a>
                <div class="text-muted small mt-2">© {{ now()->year }} Pioneer School. All rights reserved.</div>
            </div>
        </div>
    </div>
</footer> -->
@endsection
