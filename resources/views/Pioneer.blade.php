<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        /* ===== Global + Animated Shapes BG ===== */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 50%, #38f9d7 100%);
            color: #fff;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

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

        /* content always above shapes */
        section, footer { position: relative; z-index: 2; }

        /* ===== Hero ===== */
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
            text-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
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

        /* ===== Glass Cards ===== */
        .card {
            border: none;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.14);
            backdrop-filter: blur(10px);
            color: #e8f7ff;
            transition: transform 0.3s, box-shadow 0.3s, background 0.3s;
            box-shadow: 0 10px 25px rgba(0,0,0,0.25);
        }

        .card:hover {
            transform: translateY(-5px);
            background-color: rgba(179, 241, 156, 0.81);
            box-shadow: 0 16px 35px rgba(0,0,0,0.35);
        }

        footer {
            background: hsla(126, 53%, 80%, 0.69);
            padding: 20px;
            text-align: center;
            color: #14a3d7d7;
            border-top: 1px solid rgba(200, 245, 192, 0.2);
        }

        footer:hover {
            color: #ffffff;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 1rem;
            border-radius: 10px;
            background-color: rgba(158, 236, 240, 0.36);
        }

        /* Gallery bg-light override (to blend with animated bg) */
        #gallery.bg-light {
            background: rgba(255,255,255,0.10) !important;
            backdrop-filter: blur(8px);
        }
        #gallery .card-body {
            color: #0b2239;
        }

        @media (max-width: 767.98px){
            .hero h1{ font-size: 2.4rem; }
        }
        /* Fix Auth Links Hidden Issue */
.auth-links {
    position: absolute;
    top: 0;
    right: 0;
    padding: 16px;
    z-index: 99999 !important;
}

    </style>
</head>
<body>

    {{-- Animated Shapes Layer --}}
    <div class="animated-bg">
        <!-- floating circles -->
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <!-- blobs -->
        <div class="blob"></div>
        <div class="blob"></div>
        <div class="blob"></div>
    </div>

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
@endif
    

    {{-- Hero Section --}}
    <section class="hero">
        <div class="container">
            <h1>🎓 Pioneer Private School</h1>
            <p>Shaping the Future with Knowledge & Kindness</p>
        </div>
    </section>

    {{-- About / Features Section --}}
    <section id="about" class="py-5">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-md-4">
                    <div class="card p-4 h-100">
                        <h4>Quality Education</h4>
                        <img src="{{ asset('images/pioneer6.jpg') }}" alt="school">
                        <p>Providing world-class curriculum with experienced teachers.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 h-100">
                        <h4>Modern Facilities</h4>
                        <img src="{{ asset('images/pioneer6.jpg') }}" alt="school">
                        <p>Smart classrooms, science labs, and a creative learning environment.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 h-100">
                        <h4>Student Care</h4>
                        <img src="{{ asset('images/pioneer6.jpg') }}" alt="school">
                        <p>Building confidence and character with personalized guidance.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery & Video Section --}}
    <section id="gallery" class="py-5 bg-light text-dark">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">📸 School Gallery & 🎥 Video Highlights</h2>

            {{-- Row 1 --}}
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/pioneer3.jpg') }}" class="card-img-top" alt="Student Activity">
                        <div class="card-body">
                            <h5 class="card-title">Science Fair</h5>
                            <p class="card-text">Our students showcasing their innovation and creativity during the annual science fair.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/pioneer4.jpg') }}" class="card-img-top" alt="Classroom">
                        <div class="card-body">
                            <h5 class="card-title">Smart Classroom</h5>
                            <p class="card-text">Modern teaching tools help students learn better and interactively.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <img src="{{ asset('images/pioneer5.jpg') }}" class="card-img-top" alt="Sports Day">
                        <div class="card-body">
                            <h5 class="card-title">Sports Day</h5>
                            <p class="card-text">Our students enjoying a day filled with energy and friendly competition.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Row 2 --}}
            <div class="container mt-4">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset('images/pioneer6.jpg') }}" class="card-img-top" alt="Student Activity">
                            <div class="card-body">
                                <h5 class="card-title">Science Fair</h5>
                                <p class="card-text">Our students showcasing their innovation and creativity during the annual science fair.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset('images/pioneer7.jpg') }}" class="card-img-top" alt="Classroom">
                            <div class="card-body">
                                <h5 class="card-title">Smart Classroom</h5>
                                <p class="card-text">Modern teaching tools help students learn better and interactively.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset('images/pioneer8.jpg') }}" class="card-img-top" alt="Sports Day">
                            <div class="card-body">
                                <h5 class="card-title">Sports Day</h5>
                                <p class="card-text">Our students enjoying a day filled with energy and friendly competition.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Row 3 --}}
            <div class="container mt-4">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset('images/pioneer9.jpg') }}" class="card-img-top" alt="Student Activity">
                            <div class="card-body">
                                <h5 class="card-title">Science Fair</h5>
                                <p class="card-text">Our students showcasing their innovation and creativity during the annual science fair.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset('images/pioneer21.jpg') }}" class="card-img-top" alt="Classroom">
                            <div class="card-body">
                                <h5 class="card-title">Smart Classroom</h5>
                                <p class="card-text">Modern teaching tools help students learn better and interactively.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset('images/pioneer16.jpg') }}" class="card-img-top" alt="Sports Day">
                            <div class="card-body">
                                <h5 class="card-title">Sports Day</h5>
                                <p class="card-text">Our students enjoying a day filled with energy and friendly competition.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Row 4 --}}
            <div class="container mt-4">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset('images/pioneer17.jpg') }}" class="card-img-top" alt="Student Activity">
                            <div class="card-body">
                                <h5 class="card-title">Science Fair</h5>
                                <p class="card-text">Our students showcasing their innovation and creativity during the annual science fair.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset('images/pioneer22.jpg') }}" class="card-img-top" alt="Classroom">
                            <div class="card-body">
                                <h5 class="card-title">Smart Classroom</h5>
                                <p class="card-text">Modern teaching tools help students learn better and interactively.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset('images/pioneer17.jpg') }}" class="card-img-top" alt="Sports Day">
                            <div class="card-body">
                                <h5 class="card-title">Sports Day</h5>
                                <p class="card-text">Our students enjoying a day filled with energy and friendly competition.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Row 5 --}}
            <div class="container mt-4">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset('images/pioneer2.jpg') }}" class="card-img-top" alt="Student Activity">
                            <div class="card-body">
                                <h5 class="card-title">Science Fair</h5>
                                <p class="card-text">Our students showcasing their innovation and creativity during the annual science fair.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset('images/pioneer19.jpg') }}" class="card-img-top" alt="Classroom">
                            <div class="card-body">
                                <h5 class="card-title">Smart Classroom</h5>
                                <p class="card-text">Modern teaching tools help students learn better and interactively.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <img src="{{ asset('images/pioneer18.jpg') }}" class="card-img-top" alt="Sports Day">
                            <div class="card-body">
                                <h5 class="card-title">Sports Day</h5>
                                <p class="card-text">Our students enjoying a day filled with energy and friendly competition.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video section (commented) -->
            <!--
            <div class="row mt-5 justify-content-center">
                <div class="col-lg-8">
                    <div class="ratio ratio-16x9 shadow rounded">
                        <iframe src="https://www.youtube.com/embed/YOUR_VIDEO_ID" title="School Highlight Video" allowfullscreen></iframe>
                    </div>
                    <p class="text-center mt-3">🎬 A glimpse into life at Pioneer Private School</p>
                </div>
            </div>
            -->
        </div>
    </section>

  {{-- FOOTER --}}
  <footer class="section-pad pt-5 pb-4">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-6">
          <h5 class="fw-bold">Pioneer School</h5>
          <p class="text-muted mb-2">No. 123, University Avenue, Yangon</p>
          <p class="text-muted mb-0">Phone: <a href="tel:+95900000000">+95 9 000 000 00</a> · Email: <a href="mailto:info@pioneerschool.edu">info@pioneerschool.edu</a></p>
        </div>
        <div class="col-md-6 text-md-end">
          <a href="#" class="me-3"><i class="bi bi-facebook fs-4"></i></a>
          <a href="#" class="me-3"><i class="bi bi-instagram fs-4"></i></a>
          <a href="#"><i class="bi bi-youtube fs-4"></i></a>
          <div class="text-muted small mt-2">© {{ now()->year }} Pioneer School. All rights reserved.</div>
        </div>
      </div>
    </div>
  </footer>

</body>
</html>
