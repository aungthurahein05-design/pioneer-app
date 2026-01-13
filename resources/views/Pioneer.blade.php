@extends('layouts.app')

@section('content')
<style>
    /* ===== Animated Shapes BG ===== */
    .animated-bg {
        position: fixed;
        inset: 0;
        z-index: -1;
        overflow: hidden;
    }
    .shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(4px);
        animation: floatUp 12s infinite ease-in-out;
    }
    .shape:nth-child(1) { width: 140px; height: 140px; left: 10%; bottom: -150px; animation-duration: 12s; }
    .shape:nth-child(2) { width: 90px; height: 90px; left: 70%; bottom: -120px; animation-duration: 10s; }
    .shape:nth-child(3) { width: 160px; height: 160px; left: 40%; bottom: -180px; animation-duration: 15s; }
    .shape:nth-child(4) { width: 110px; height: 110px; left: 85%; bottom: -160px; animation-duration: 18s; }
    .shape:nth-child(5) { width: 70px; height: 70px; left: 25%; bottom: -150px; animation-duration: 14s; }

    @keyframes floatUp {
        0%   { transform: translateY(0) scale(1); opacity: .6; }
        50%  { transform: translateY(-400px) scale(1.15); opacity: 1; }
        100% { transform: translateY(-800px) scale(.9); opacity: 0; }
    }

    .blob {
        position: absolute;
        filter: blur(100px);
        opacity: 0.7;
        animation: blobMove 20s infinite ease-in-out;
    }
    .blob:nth-child(6) { width: 400px; height: 400px; background: #ff6bcb; left: -10%; top: 20%; }
    .blob:nth-child(7) { width: 350px; height: 350px; background: #42a5f5; right: -10%; top: 30%; }
    .blob:nth-child(8) { width: 300px; height: 300px; background: #00e5ff; left: 40%; top: -10%; }

    @keyframes blobMove {
        0%   { transform: translate(0,0) scale(1); }
        50%  { transform: translate(60px,-80px) scale(1.2); }
        100% { transform: translate(0,0) scale(1); }
    }

    /* ===== Page Look ===== */
    .pioneer-page {
        font-family: 'Poppins', sans-serif;
        color: #eaf5b2;
        overflow-x: hidden;
    }

    /* Hero */
    .hero {
        height: 100vh;
        background-image: url('{{ asset('images/Pioneer1.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        background-color: rgba(190, 232, 134, 0.3);
        background-blend-mode: overlay;
    }
    .hero h1 {
        font-size: 3.5rem;
        font-weight: 600;
        text-shadow: 0 4px 10px rgba(151, 203, 232, 0.67);
        animation: fadeDown 2s ease;
    }
    .hero p {
        font-size: 1.2rem;
        margin-top: 10px;
        animation: fadeUp 2s ease;
    }
    @keyframes fadeDown {
        from { transform: translateY(-30px); opacity: 0; }
        to   { transform: translateY(0); opacity: 1; }
    }
    @keyframes fadeUp {
        from { transform: translateY(30px); opacity: 0; }
        to   { transform: translateY(0); opacity: 1; }
    }

    /* Cards */
    .glass-card {
        border: none;
        border-radius: 25px;
        background: rgba(255, 255, 255, 0.14);
        backdrop-filter: blur(10px);
        color: #e8f7ff;
        transition: transform 0.3s, box-shadow 0.3s, background 0.3s;
        box-shadow: 0 10px 25px rgba(0,0,0,0.25);
        overflow: hidden;
    }
    .glass-card:hover {
        transform: translateY(-5px);
        background-color: rgba(156, 228, 241, 0.25);
        box-shadow: 0 16px 35px rgba(0,0,0,0.35);
    }
    .glass-card img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        background-color: rgba(158, 236, 240, 0.36);
    }

    /* Gallery bg-light override */
    #gallery.bg-light {
        background: rgba(255,255,255,0.10) !important;
        backdrop-filter: blur(8px);
    }

    /* Auth links (if you really want overlay links) */
    .auth-links {
        position: fixed;
        top: 75px; /* because navbar fixed-top */
        right: 12px;
        z-index: 9999;
    }

    @media (max-width: 767.98px){
        .hero h1{ font-size: 2.4rem; }
    }
</style>

<div class="pioneer-page">

    {{-- Animated BG --}}
    <div class="animated-bg">
        <div class="shape"></div><div class="shape"></div><div class="shape"></div><div class="shape"></div><div class="shape"></div>
        <div class="blob"></div><div class="blob"></div><div class="blob"></div>
    </div>

    <!-- {{-- Optional Auth Links --}}
    @if (Route::has('login'))
        <div class="auth-links">
            @auth
                <a href="{{ url('/home') }}" class="text-white fw-semibold me-3 text-decoration-none">Home</a>
            @else
                <a href="{{ route('login') }}" class="text-white fw-semibold me-3 text-decoration-none">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-white fw-semibold text-decoration-none">Register</a>
                @endif
            @endauth
        </div>
    @endif -->

    {{-- Hero --}}
    <section class="hero">
        <div class="container">
            <h1>🎓 Pioneer Private School</h1>
            <p>Shaping the Future with Knowledge & Kindness</p>
        </div>
    </section>

    {{-- About --}}
    <section id="about" class="py-5">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="glass-card p-4 h-100">
                        <h4>Quality Education</h4>
                        <img src="{{ asset('images/pioneer6.jpg') }}" alt="school" class="mb-3">
                        <p>Providing world-class curriculum with experienced teachers.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-card p-4 h-100">
                        <h4>Modern Facilities</h4>
                        <img src="{{ asset('images/pioneer6.jpg') }}" alt="school" class="mb-3">
                        <p>Smart classrooms, science labs, and a creative learning environment.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-card p-4 h-100">
                        <h4>Student Care</h4>
                        <img src="{{ asset('images/pioneer6.jpg') }}" alt="school" class="mb-3">
                        <p>Building confidence and character with personalized guidance.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery --}}
    <section id="gallery" class="py-5 bg-light text-dark">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">📸 School Gallery & 🎥 Video Highlights</h2>

            <div class="row g-4">
                @php
                    $photos = [
                        ['pioneer3.jpg','Science Fair','Our students showcasing their innovation and creativity.'],
                        ['pioneer4.jpg','Smart Classroom','Modern teaching tools help students learn better.'],
                        ['pioneer5.jpg','Sports Day','A day filled with energy and friendly competition.'],
                        ['pioneer6.jpg','Science Fair','Our students showcasing their innovation and creativity.'],
                        ['pioneer7.jpg','Smart Classroom','Modern teaching tools help students learn better.'],
                        ['pioneer8.jpg','Sports Day','A day filled with energy and friendly competition.'],
                        ['pioneer9.jpg','Science Fair','Our students showcasing their innovation and creativity.'],
                        ['pioneer21.jpg','Smart Classroom','Modern teaching tools help students learn better.'],
                        ['pioneer16.jpg','Sports Day','A day filled with energy and friendly competition.'],
                        ['pioneer17.jpg','Science Fair','Our students showcasing their innovation and creativity.'],
                        ['pioneer22.jpg','Smart Classroom','Modern teaching tools help students learn better.'],
                        ['pioneer18.jpg','Sports Day','A day filled with energy and friendly competition.'],
                    ];
                @endphp

                @foreach($photos as $item)
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset('images/'.$item[0]) }}" class="card-img-top" alt="{{ $item[1] }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item[1] }}</h5>
                                <p class="card-text">{{ $item[2] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

</div>
@endsection
