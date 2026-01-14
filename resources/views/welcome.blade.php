@extends('layouts.app')

@section('content')
<style>
/* ========= Base ========= */
.pioneer-page{
    font-family: 'Poppins', sans-serif;
    color: #eaf5b2;
    overflow-x: hidden;
}

/* ========= Animated BG ========= */
.animated-bg{
    position: fixed;
    inset: 0;
    z-index: -1;
    overflow: hidden;
    pointer-events: none;
}

/* floating shapes */
.shape{
    position: absolute;
    border-radius: 50%;
    background: rgba(255,255,255,0.18);
    backdrop-filter: blur(6px);
    animation: floatUp 12s infinite ease-in-out;
}
.shape:nth-child(1){ width:140px; height:140px; left:10%; bottom:-160px; animation-duration:12s; }
.shape:nth-child(2){ width:90px;  height:90px;  left:70%; bottom:-130px; animation-duration:10s; }
.shape:nth-child(3){ width:160px; height:160px; left:40%; bottom:-190px; animation-duration:15s; }
.shape:nth-child(4){ width:110px; height:110px; left:85%; bottom:-170px; animation-duration:18s; }
.shape:nth-child(5){ width:70px;  height:70px;  left:25%; bottom:-160px; animation-duration:14s; }

@keyframes floatUp{
    0%   { transform: translateY(0) scale(1); opacity:.45; }
    50%  { transform: translateY(-420px) scale(1.12); opacity:.9; }
    100% { transform: translateY(-820px) scale(.92); opacity:0; }
}

/* blobs */
.blob{
    position: absolute;
    filter: blur(110px);
    opacity: 0.65;
    animation: blobMove 20s infinite ease-in-out;
}
.blob:nth-child(6){ width:420px; height:420px; background:#ff6bcb; left:-12%; top:20%; }
.blob:nth-child(7){ width:380px; height:380px; background:#42a5f5; right:-12%; top:30%; }
.blob:nth-child(8){ width:320px; height:320px; background:#00e5ff; left:40%; top:-10%; }

@keyframes blobMove{
    0%   { transform: translate(0,0) scale(1); }
    50%  { transform: translate(70px,-90px) scale(1.15); }
    100% { transform: translate(0,0) scale(1); }
}

/* ========= HERO (more pro) ========= */
.hero{
    min-height: 100vh;
    background-image:
        linear-gradient(180deg, rgba(0,0,0,0.45), rgba(0,0,0,0.25)),
        url('{{ asset('images/Pioneer1.jpg') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;

    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;

    padding: 80px 16px;
}

.hero .container{
    max-width: 860px;
}

.hero h1{
    color:#fff;
    font-size: clamp(2.1rem, 4vw, 3.8rem);
    font-weight: 700;
    letter-spacing: .4px;
    text-shadow: 0 10px 30px rgba(0,0,0,.55);
    animation: fadeDown .9s ease both;
}

.hero p{
    color: rgba(255,255,255,.92);
    font-size: clamp(1rem, 1.4vw, 1.25rem);
    margin-top: 12px;
    line-height: 1.6;
    text-shadow: 0 10px 25px rgba(0,0,0,.35);
    animation: fadeUp .9s ease .1s both;
}

/* optional: small badge under hero text */
.hero .hero-badge{
    display:inline-flex;
    gap:10px;
    align-items:center;
    margin-top: 16px;
    padding: 10px 16px;
    border-radius: 999px;
    background: rgba(255,255,255,.14);
    border: 1px solid rgba(255,255,255,.18);
    backdrop-filter: blur(10px);
    color: #fff;
    font-weight: 600;
}

/* animations */
@keyframes fadeDown{
    from { transform: translateY(-18px); opacity: 0; }
    to   { transform: translateY(0); opacity: 1; }
}
@keyframes fadeUp{
    from { transform: translateY(18px); opacity: 0; }
    to   { transform: translateY(0); opacity: 1; }
}

/* ========= About / Cards ========= */
#about{
    padding-top: 70px !important;
    padding-bottom: 70px !important;
}

.glass-card{
    border-radius: 22px;
    background: rgba(255,255,255,0.13);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.14);
    color: #e8f7ff;

    transition: transform .25s ease, box-shadow .25s ease, background .25s ease;
    box-shadow: 0 12px 30px rgba(0,0,0,0.25);
    overflow: hidden;
}

.glass-card:hover{
    transform: translateY(-6px);
    background: rgba(255,255,255,0.18);
    box-shadow: 0 20px 45px rgba(0,0,0,0.35);
}

.glass-card h4{
    color:#fff;
    font-weight:700;
    margin-bottom: 14px;
    letter-spacing: .3px;
}

.glass-card p{
    color: rgba(232,247,255,.92);
    line-height: 1.7;
    margin: 0;
}

.glass-card img{
    width: 100%;
    height: 220px;          /* ✅ same height for all */
    object-fit: cover;      /* ✅ crop nicely */
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.12);
    margin-bottom: 14px;
}

/* ========= Gallery ========= */
#gallery.bg-light{
    background: rgba(255,255,255,0.10) !important;
    backdrop-filter: blur(10px);
    padding-top: 70px !important;
    padding-bottom: 70px !important;
}

#gallery h2{
    color:#fff !important;
    text-shadow: 0 10px 25px rgba(0,0,0,.30);
}

#gallery .card{
    border-radius: 18px;
    overflow: hidden;
    background: rgba(255,255,255,.92);
    transition: transform .22s ease, box-shadow .22s ease;
}

#gallery .card:hover{
    transform: translateY(-5px);
    box-shadow: 0 18px 40px rgba(0,0,0,.25);
}

#gallery .card-img-top{
    height: 220px;
    object-fit: cover;
}

#gallery .card-title{
    font-weight: 700;
    margin-bottom: 8px;
}

#gallery .card-text{
    color: #334155;
    line-height: 1.6;
}

/* ========= Auth links ========= */
.auth-links{
    position: fixed;
    top: 75px;
    right: 12px;
    z-index: 9999;
}
.auth-links a{
    padding: 8px 14px;
    border-radius: 999px;
    background: rgba(0,0,0,.25);
    border: 1px solid rgba(255,255,255,.18);
    backdrop-filter: blur(8px);
    transition: .2s;
}
.auth-links a:hover{
    background: rgba(0,0,0,.35);
}

/* ========= Mobile ========= */
@media (max-width: 767.98px){
    .hero{ min-height: 92vh; }
    .glass-card img{ height: 200px; }
    #gallery .card-img-top{ height: 200px; }
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
