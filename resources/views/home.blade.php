@extends('layouts.app')

  <style>
    
  <!-- Bootstrap 5 / Icons / AOS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">


    :root{
      --pri:#0d6efd;
      --acc:#00c2a8;
      --ink:#1f2937;
      --bg:#00FF00;
      --card:#ffffff;
    }

 

    body{
      background: var(--ink);
      color: var(--pri);
    }

    /* ===== Layout helpers ===== */
    .section-pad{
      padding: 72px 0;
    }

    .rounded-2xl{
      border-radius: 1.25rem;
    }

    .shadow-soft{
      box-shadow: 0 10px 30px rgba(15,23,42,.08);
    }

    .card-hover{
      transition: transform .22s ease, box-shadow .22s ease;
    }
    .card-hover:hover{
      transform: translateY(-6px);
      box-shadow: 0 18px 40px rgba(15,23,42,.16);
    }

    /* ===== Hero / Heading ===== */
    .hero{
      background: linear-gradient(to bottom, #6ba3d899, var(--bg));
    }

    .brand-grad{
      background: linear-gradient(135deg, var(--pri), var(--acc));
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }

    .hero .display-4{
      line-height: 1.1;
    }

    /* ===== Chip (small pills) ===== */
    .chip{
      font-size: .85rem;
      padding: 4px 12px;
      border-radius: 999px;
      background: rgba(127, 213, 237, 0.7);
      border: 1px solid rgba(140, 208, 240, 0.84);
      color: var(--pri);
      display: inline-flex;
      align-items: center;
      gap: .25rem;
      white-space: nowrap;
    }

    /* ===== Smart UL (list-plain) ===== */
    .list-plain{
      list-style: none;
      padding: 0;
      margin: 0;
    }
    .list-plain li{
      display: flex;
      align-items: flex-start;
      gap: 12px;
      padding: 10px 0;
      border-bottom: 1px dashed rgba(15, 42, 27, 0.62);
    }
    .list-plain li:last-child{
      border-bottom: none;
    }

    .list-plain .icon{
      flex-shrink: 0;
      width: 36px;
      height: 36px;
      border-radius: 999px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: rgba(13,110,253,.06);
      color: var(--pri);
      box-shadow: 0 6px 15px rgba(13,110,253,.18);
      transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
    }

    .list-plain li:hover .icon{
      transform: translateY(-2px) scale(1.05);
      background: rgba(138, 233, 121, 0.54);
      box-shadow: 0 10px 25px rgba(172, 245, 165, 0.83);
    }

    .list-plain li strong{
      font-weight: 600;
    }
    .list-plain li span,
    .list-plain li div span{
      font-size: .9rem;
      color: #6b7280;
    }

    /* ===== Gallery images ===== */
    .gallery img{
      display: block;
      border-radius: 1rem;
      transition: transform .25s ease, box-shadow .25s ease, filter .25s ease;
    }
    .gallery a:hover img{
      transform: scale(1.04) translateY(-3px);
      box-shadow: 0 18px 40px rgba(15,23,42,.30);
      filter: saturate(1.05);
    }

    /* ===== Video ratio ===== */
    .ratio-16x9{
      position: relative;
      padding-top: 56.25%;
      border-radius: 1.25rem;
      overflow: hidden;
      background: #000;
    }
    .ratio-16x9 iframe{
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      border: 0;
    }

    /* ===== Footer ===== */
    footer{
      background: #b6dbe385;
      border-top: 1px solid rgba(30, 42, 15, 1);
    }
    footer a{
      color: var(--ink);
    }
    footer a:hover{
      color: var(--pri);
    }

    /* ===== Responsive tweaks ===== */
    @media (max-width: 767.98px){
      .section-pad{
        padding: 48px 0;
      }
      .hero{
        text-align: center;
      }
      .hero .mt-4 .btn{
        width: 100%;
        justify-content: center;
      }
    }

    /* ===============================
       SCHOOL THEME ANIMATED BACKGROUND
       =============================== */
      
 

    .school-animated-bg {
      position: fixed;
      inset: 0;
      z-index: -1;
      pointer-events: none;
      overflow: hidden;
         background-color: #dafcfcff;
    color: #ffffff;   /* text မျက်နှာမပျောက်အောင် စာရောင်လည်း ဖြူစေလိုက် */

    }

    .school-icon {
      position: absolute;
      font-size: 48px;
      opacity: 0.12;
      animation: floatSchool 18s linear infinite;
    }

    @keyframes floatSchool {
      0% {
        transform: translateY(0) rotate(0deg);
        opacity: 0.10;
      }
      50% {
        transform: translateY(-300px) rotate(20deg);
        opacity: 0.16;
      }
      100% {
        transform: translateY(-600px) rotate(-20deg);
        opacity: 0.10;
      }
    }

    .school-icon:nth-child(1) { left: 5%;  bottom: -100px; animation-duration: 16s; }
    .school-icon:nth-child(2) { left: 20%; bottom: -120px; animation-duration: 22s; }
    .school-icon:nth-child(3) { left: 35%; bottom: -140px; animation-duration: 19s; }
    .school-icon:nth-child(4) { left: 50%; bottom: -110px; animation-duration: 25s; }
    .school-icon:nth-child(5) { left: 65%; bottom: -130px; animation-duration: 20s; }
    .school-icon:nth-child(6) { left: 80%; bottom: -150px; animation-duration: 18s; }
    .school-icon:nth-child(7) { left: 92%; bottom: -160px; animation-duration: 26s; }

  </style>



@section('content')

  {{-- SCHOOL THEME ANIMATED BACKGROUND (ONLY BG, CONTENT ကို မထိပါ) --}}
  <div class="school-animated-bg">
    <div class="school-icon">📚</div>
    <div class="school-icon">✏️</div>
    <div class="school-icon">📘</div>
    <div class="school-icon">🧮</div>
    <div class="school-icon">📏</div>
    <div class="school-icon">📝</div>
    <div class="school-icon">⭐</div>
  </div>

  {{-- HERO --}}
  <header class="hero section-pad">
   
 
      <div class="row align-items-center g-4">
        <div class="col-lg-7" data-aos="fade-right">
       
            
          <h2> Welcome to Pioneer School</h2> 
        
          <h1 class="display-4 fw-bold lh-tight">
            Quality for Future Leaders <span class="brand-grad">Education</span> 
          </h1>

          {{-- Smart UL (Key Highlights) --}}
          <ul class="list-plain mt-4">
            <li>
              <span class="icon"><i class="bi bi-mortarboard-fill"></i></span>
              <div><strong>Cambridge-aligned Curriculum</strong><br><span>STEM • Languages • Arts • Sports</span></div>
            </li>
            <li>
              <span class="icon"><i class="bi bi-people-fill"></i></span>
              <div><strong>Small Class Size</strong><br><span>Student-centered learning & mentorship</span></div>
            </li>
            <li>
              <span class="icon"><i class="bi bi-shield-check"></i></span>
              <div><strong>Safe Campus</strong><br><span>CCTV • Access Control • Fire Safety</span></div>
            </li>

               
          </ul>

        </div>

        <div class="col-lg-5" data-aos="fade-left">
          <div class="bg-white rounded-2xl shadow-soft p-3 card-hover">
            <img src="{{ asset('images/Pioneer5.jpg') }}" class="w-100 rounded-2" alt="Students">
          </div>
        </div>
      </div>
    </div>
  </header>

  {{-- ANNOUNCEMENTS --}}
  <section class="section-pad">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-7" data-aos="fade-up">
          <div class="bg-white rounded-2xl shadow-soft p-4">
            <div class="d-flex align-items-center mb-3">
              <i class="bi bi-megaphone-fill me-2 fs-4 text-primary"></i>
              <h2 class="h4 m-0">Latest Announcements</h2>
            </div>

            {{-- Use the same smart list style (no big black dots) --}}
            <ul class="list-plain">
              <li>
                <span class="icon"><i class="bi bi-calendar-event"></i></span>
                <div>
                  <strong>Entrance Exam (2026 Intake)</strong>
                  <div class="text-muted small">December 12, 2025 · 9:00 AM</div>
                </div>
              </li>
              <li>
                <span class="icon"><i class="bi bi-people"></i></span>
                <div>
                  <strong>Parent-Teacher Meeting</strong>
                  <div class="text-muted small">November 15, 2025 · Auditorium</div>
                </div>
              </li>
              <li>
                <span class="icon"><i class="bi bi-cpu-fill"></i></span>
                <div>
                  <strong>STEM Week Projects Showcase</strong>
                  <div class="text-muted small">November 30, 2025 · Hall B</div>
                </div>
              </li>
            </ul>
          </div>
        </div>

        {{-- PROGRAMS --}}
        <div class="col-lg-5" data-aos="fade-up" data-aos-delay="100">
          <div class="bg-white rounded-2xl shadow-soft p-4 h-100">
            <div class="d-flex align-items-center mb-3">
              <i class="bi bi-journal-code me-2 fs-4 text-primary"></i>
              <h2 class="h4 m-0">Programs</h2>
            </div>
            <ul class="list-plain">
              <li><span class="icon"><i class="bi bi-rocket-takeoff-fill"></i></span><div><strong>Early Years (Pre-K–K)</strong><br><span>Play-based learning</span></div></li>
              <li><span class="icon"><i class="bi bi-diagram-3-fill"></i></span><div><strong>Primary (G1–G6)</strong><br><span>STEAM & Project-based</span></div></li>
              <li><span class="icon"><i class="bi bi-cpu-fill"></i></span><div><strong>Secondary (G7–G11)</strong><br><span>IGCSE pathways & Clubs</span></div></li>
            </ul>
            <hr>
            <div class="d-flex align-items-center gap-2">
              <span class="chip"><i class="bi bi-wifi me-1" ></i> <a class="nav-link" href="{{ url('/exam-results')  }}">Exam Results</a></span>
              <!-- <span class="chip"><i class="bi bi-translate me-1"></i> Eng/MM</span>
              <span class="chip"><i class="bi bi-emoji-smile me-1"></i> Well-being</span> -->
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  

  {{-- FACILITIES --}}
  <section class="section-pad">
    <div class="container">
      <div class="text-center mb-5" data-aos="zoom-in">
        <h2 class="fw-bold">Campus Facilities</h2>
        <p class="text-muted m-0">သင့်ကလေးတွေအတွက် လုံခြုံစိတ်ချရပြီး အပြည့်အစုံ ထောက်ပံ့ပေးပါတယ်</p>
      </div>

             

      <div class="row g-4">
        @php
          $facilities = [
            ['icon'=>'bi-building-check','title'=>'Modern Classrooms','items'=>['Interactive panel','Airy & bright','Comfort seating']],
            ['icon'=>'bi-flower1','title'=>'Green Spaces','items'=>['Playground','Edible garden','Shaded walkways']],
            ['icon'=>'bi-camera-video','title'=>'Security','items'=>['CCTV 24/7','Access control','Fire safety']],
          ];
        @endphp

        @foreach($facilities as $box)
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index*100 }}">
            <div class="bg-white rounded-2xl shadow-soft p-4 h-100 card-hover">
              <div class="d-flex align-items-center mb-2">
                <i class="bi {{ $box['icon'] }} fs-3 text-primary me-2"></i>
                <h3 class="h5 m-0">{{ $box['title'] }}</h3>
              </div>
              <ul class="list-plain mt-3">
                @foreach($box['items'] as $it)
                  <li><span class="icon"><i class="bi bi-check2"></i></span><span>{{ $it }}</span></li>
                @endforeach
              </ul>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- PHOTO GALLERY --}}
  <section class="section-pad">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="h4 fw-bold m-0">Photo Gallery</h2>
      </div>

      <div class="row g-3 gallery">
        @php
          $photos = [
            asset('images/pioneer8.jpg'),
            asset('images/pioneer8.jpg'),
            asset('images/pioneer9.jpg'),
            asset('images/pioneer11.jpg'),
            asset('images/pioneer12.jpg'),
            asset('images/pioneer13.jpg'),
            asset('images/pioneer14.jpg'),
            asset('images/pioneer14.jpg'),
            asset('images/pioneer14.jpg'),
            asset('images/pioneer14.jpg'),
            asset('images/pioneer14.jpg'),
            asset('images/pioneer14.jpg'),
            asset('images/pioneer14.jpg'),
            asset('images/pioneer14.jpg'),
            asset('images/pioneer14.jpg'),
          ];
        @endphp

        @foreach($photos as $src)
          <div class="col-6 col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index*50 }}">
            <a href="#" data-bs-toggle="modal" data-bs-target="#photoModal" data-src="{{ $src }}" class="card-hover">
              <img src="{{ $src }}" class="w-100 rounded-2 shadow-soft" alt="">
            </a>
          </div>
        @endforeach
      </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="photoModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4">
          <img id="photoModalImg" src="" class="w-100 rounded-4" alt="Preview">
        </div>
      </div>
    </div>
  </section>

  {{-- VIDEO --}}
  <section id="video" class="section-pad">
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-lg-6" data-aos="fade-right">
          <h2 class="fw-bold">Campus Tour</h2>
          <p class="text-muted">School life & activities ကို တစ်ကြိတ်တည်း တွေ့မြင်နိုင်ဖို့ campus tour video ကို ပြန်လည်ခံစားပါ။</p>
          <ul class="list-plain">
            <li><span class="icon"><i class="bi bi-film"></i></span><div><strong>Clubs & Houses</strong><br><span>Music • Robotics • Sports</span></div></li>
            <li><span class="icon"><i class="bi bi-brush"></i></span><div><strong>Arts & Culture</strong><br><span>Exhibitions • Performances</span></div></li>
            <li><span class="icon"><i class="bi bi-award"></i></span><div><strong>Achievements</strong><br><span>Competitions • Certificates</span></div></li>
          </ul>
        </div>
        <div class="col-lg-6" data-aos="fade-left">
          <div class="ratio-16x9 shadow-soft">
            <iframe src="https://www.youtube.com/embed/ScMzIvxBSi4" allowfullscreen></iframe>
          </div>
        </div>
      </div>
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

@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.min.js"></script>
  <script>
    AOS.init({ duration: 700, once: true });

    // Gallery modal preview
    const photoModal = document.getElementById('photoModal');
    if(photoModal){
      photoModal.addEventListener('show.bs.modal', (e)=>{
        const src = e.relatedTarget?.getAttribute('data-src');
        photoModal.querySelector('#photoModalImg').src = src || '';
      });
      photoModal.addEventListener('hidden.bs.modal', ()=>{
        photoModal.querySelector('#photoModalImg').src = '';
      });
    }
  </script>
@endpush
