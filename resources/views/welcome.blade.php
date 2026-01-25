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
.shape:nth-child(2){ width:90px; height:90px; left:70%; bottom:-130px; animation-duration:10s; }
.shape:nth-child(3){ width:160px; height:160px; left:40%; bottom:-190px; animation-duration:15s; }
.shape:nth-child(4){ width:110px; height:110px; left:85%; bottom:-170px; animation-duration:18s; }
.shape:nth-child(5){ width:70px; height:70px; left:25%; bottom:-160px; animation-duration:14s; }

@keyframes floatUp{
    0%{ transform: translateY(0); opacity:.4; }
    50%{ transform: translateY(-420px); opacity:.9; }
    100%{ transform: translateY(-820px); opacity:0; }
}

/* ========= HERO ========= */
.hero{
    min-height: 100vh;
    background:
        linear-gradient(180deg, rgba(0,0,0,.45), rgba(0,0,0,.25)),
        url('{{ asset('images/Pioneer1.jpg') }}');
    background-size: cover;
    background-position: center;
    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;
    padding: 80px 16px;
}

.hero h1{
    color:#fff;
    font-size: clamp(2.2rem,4vw,3.8rem);
    font-weight:700;
}
.hero p{
    color:rgba(255,255,255,.9);
    font-size:1.15rem;
}

/* ========= About / Cards ========= */
#about{ padding:70px 0; }

.glass-card{
    border-radius:22px;
    background:rgba(255,255,255,.13);
    backdrop-filter:blur(12px);
    border:1px solid rgba(255,255,255,.14);
    color:#e8f7ff;
    box-shadow:0 12px 30px rgba(0,0,0,.25);
    transition:.25s;
}
.glass-card:hover{
    transform:translateY(-6px);
}

/* ✅ FIXED IMAGE */
.glass-card img{
    width:100%;
    height:260px;                 /* ⬅ bigger */
    object-fit:contain;           /* ⬅ NO crop */
    background:rgba(255,255,255,.08);
    border-radius:14px;
    padding:6px;
    margin-bottom:14px;
}

.glass-card h4{ color:#fff; font-weight:700; }

/* ========= Gallery ========= */
#gallery{
    background:rgba(255,255,255,.10);
    backdrop-filter:blur(10px);
    padding:70px 0;
}

#gallery h2{ color:#fff; }

#gallery .card{
    border-radius:18px;
    overflow:hidden;
    background:#fff;
    transition:.2s;
}
#gallery .card:hover{
    transform:translateY(-5px);
    box-shadow:0 18px 40px rgba(0,0,0,.25);
}

/* ✅ FIXED IMAGE */
#gallery .card-img-top{
    width:100%;
    height:260px;                 /* ⬅ bigger */
    object-fit:contain;           /* ⬅ NO crop */
    background:#fff;
    padding:6px;
}

#gallery .card-title{ font-weight:700; }
#gallery .card-text{ color:#334155; }

/* ========= Mobile ========= */
@media(max-width:767px){
    .glass-card img{ height:230px; }
    #gallery .card-img-top{ height:230px; }
}
</style>

<div class="pioneer-page">

    {{-- Hero --}}
    <section class="hero">
        <div>
            <h1>🎓 Pioneer Private School</h1>
            <p>Shaping the Future with Knowledge & Kindness</p>
        </div>
    </section>

    {{-- About --}}
    <section id="about">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="glass-card p-4 h-100">
                        <h4>Quality Education</h4>
                        <img src="{{ asset('images/pioneer6.jpg') }}">
                        <p>World-class curriculum with experienced teachers.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-card p-4 h-100">
                        <h4>Modern Facilities</h4>
                        <img src="{{ asset('images/pioneer4.jpg') }}">
                        <p>Smart classrooms and modern labs.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-card p-4 h-100">
                        <h4>Student Care</h4>
                        <img src="{{ asset('images/pioneer5.jpg') }}">
                        <p>Personal guidance for every student.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery --}}
    <section id="gallery">
        <div class="container">
            <h2 class="text-center mb-5">📸 School Gallery</h2>
            <div class="row g-4">
                @foreach([
                    'pioneer3.jpg','pioneer4.jpg','pioneer5.jpg','pioneer6.jpg',
                    'pioneer7.jpg','pioneer8.jpg','pioneer9.jpg'
                ] as $img)
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="{{ asset('images/'.$img) }}" class="card-img-top">
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

</div>
@endsection
