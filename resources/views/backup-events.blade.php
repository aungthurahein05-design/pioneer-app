@extends('layouts.app')


<style>
  :root{
    --bg:#f3f6fb;
    --ink:#111827;
    --muted:#6b7280;
    --pri:#2563eb;
    --accent:#0ea5e9;
    --card-bg:#ffffff;
    --border-soft:#e5e7eb;
  }

  body{
    background:var(--bg);
    color:var(--ink);
    font-family:system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;
  }

  .section-pad{ padding:80px 0; }

  .events-hero{
    padding-bottom:40px;
  }

  .chip{
    display:inline-flex;
    align-items:center;
    gap:6px;
    font-size:.85rem;
    border-radius:999px;
    padding:4px 12px;
    background:#e0edff;
    color:#1d4ed8;
    font-weight:500;
  }

  .events-title{
    font-size:2.3rem;
    font-weight:700;
  }

  .muted{ color:var(--muted); }

  .event-grid{
    display:grid;
    grid-template-columns:2fr 1.4fr;
    gap:24px;
  }
  @media (max-width:991.98px){
    .event-grid{
      grid-template-columns:1fr;
    }
  }

  .event-card{
    background:var(--card-bg);
    border-radius:22px;
    overflow:hidden;
    border:1px solid var(--border-soft);
    box-shadow:0 16px 40px rgba(15,23,42,0.08);
    position:relative;
    display:flex;
    flex-direction:column;
    height:100%;
  }

  .event-thumb{
    position:relative;
    overflow:hidden;
  }

  .event-thumb img{
    width:100%;
    height:260px;
    object-fit:cover;
    transition:transform .6s ease, opacity .6s ease;
  }

  .event-card:hover .event-thumb img{
    transform:scale(1.06);
    opacity:.96;
  }

  .event-body{
    padding:18px 20px 16px;
  }

  .event-tag{
    font-size:.78rem;
    padding:3px 10px;
    border-radius:999px;
    background:rgba(15,23,42,.05);
    display:inline-block;
    margin-bottom:6px;
  }

  .event-title{
    font-size:1.1rem;
    font-weight:600;
    margin-bottom:4px;
  }

  .event-meta{
    font-size:.83rem;
    color:var(--muted);
  }

  .play-pill{
    position:absolute;
    left:16px;
    bottom:16px;
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:6px 14px;
    border-radius:999px;
    background:rgba(15,23,42,0.72);
    color:#f9fafb;
    font-size:.85rem;
    backdrop-filter:blur(12px);
  }

  .play-pill i{
    font-size:.95rem;
  }

  .event-list{
    display:grid;
    grid-template-columns:1fr;
    gap:16px;
  }

  .event-mini{
    display:flex;
    gap:12px;
    background:var(--card-bg);
    border-radius:18px;
    padding:10px 10px;
    border:1px solid var(--border-soft);
    transition:.25s ease;
  }

  .event-mini:hover{
    transform:translateY(-3px);
    box-shadow:0 12px 30px rgba(15,23,42,0.08);
  }

  .event-mini-thumb{
    flex:0 0 110px;
    border-radius:14px;
    overflow:hidden;
  }

  .event-mini-thumb img{
    width:100%;
    height:80px;
    object-fit:cover;
    transition:transform .5s ease;
  }

  .event-mini:hover img{
    transform:scale(1.05);
  }

  .event-mini h6{
    margin-bottom:2px;
    font-size:.95rem;
  }

  .event-badge{
    font-size:.75rem;
    padding:2px 8px;
    border-radius:999px;
    background:#e0f2fe;
    color:#0369a1;
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

<section class="section-pad events-hero">
  <div class="container">
    <div class="row g-4 align-items-end">
      <div class="col-lg-7" data-aos="fade-right">
        <span class="chip mb-3">
         
        </span>
        <h1 class="events-title mb-2">Events, festivals &amp; campus life</h1>
        <p class="muted mb-0">
     
        </p>
      </div>
      <div class="col-lg-5 text-lg-end" data-aos="fade-left">
        <span class="event-badge">
          Academic Year 2025–2026
        </span>
      </div>
    </div>
  </div>
</section> 

<section class="section-pad pt-0">
  <div class="container">
    <div class="event-grid">

      {{-- Left : Main highlight video --}}
      <a href="https://www.youtube.com/watch?v=XXXXXXXX" target="_blank"
         class="text-decoration-none text-reset" data-aos="fade-up">
        <div class="event-card">
          <div class="event-thumb">
            <img src="/images/events/open-day-hero.jpg" alt="Open Day highlight">
            <span class="play-pill">
              <i class="bi bi-play-circle-fill"></i> Watch highlight video
            </span>
          </div>
          <div class="event-body">
            <div class="event-tag">Open Day 2025</div>
            <div class="event-title">Pioneer School Open Day &amp; Student Showcase</div>
            <div class="event-meta">
              March 15, 2025 • Campus tour • Student performances • Parent info session
            </div>
          </div>
        </div>
      </a>

      {{-- Right : list of smaller videos / photo events --}}
      <div class="event-list" data-aos="fade-up" data-aos-delay="80">

        <a href="https://www.youtube.com/watch?v=YYYYYYYY" target="_blank"
           class="text-decoration-none text-reset">
          <div class="event-mini">
            <div class="event-mini-thumb">
              <img src="/images/events/sports-day.jpg" alt="Sports Day">
            </div>
            <div class="flex-grow-1">
              <h6>Sports Day Highlights</h6>
              <div class="event-meta">
                Track &amp; field • Team games • House cheering
              </div>
            </div>
          </div>
        </a>

        <a href="/images/events/thadingyut-gallery-1.jpg"
           class="text-decoration-none text-reset">
          <div class="event-mini">
            <div class="event-mini-thumb">
              <img src="/images/events/thadingyut.jpg" alt="Festival">
            </div>
            <div class="flex-grow-1">
              <h6>Thadingyut Festival Night</h6>
              <div class="event-meta">
                Lanterns • Traditional dance • Student performances
              </div>
            </div>
          </div>
        </a>

        <a href="https://www.youtube.com/watch?v=ZZZZZZZZ" target="_blank"
           class="text-decoration-none text-reset">
          <div class="event-mini">
            <div class="event-mini-thumb">
              <img src="/images/events/stem-expo.jpg" alt="STEM Expo">
            </div>
            <div class="flex-grow-1">
              <h6>STEM Expo &amp; Project Fair</h6>
              <div class="event-meta">
                Robotics • Science experiments • Coding projects
              </div>
            </div>
          </div>
        </a>

        <a href="/images/events/graduation-2025.jpg"
           class="text-decoration-none text-reset">
          <div class="event-mini">
            <div class="event-mini-thumb">
              <img src="/images/events/graduation.jpg" alt="Graduation">
            </div>
            <div class="flex-grow-1">
              <h6>Graduation Ceremony 2025</h6>
              <div class="event-meta">
                Certificates • Awards • Class of 2025 memories
              </div>
            </div>
          </div>
        </a>

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
  {{-- AOS already used on home page ဖြစ်ရင် init တစ်ခါပဲလုံလောက်တယ် --}}
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({
      duration:800,
      once:true,
      offset:80
    });
  </script>
@endpush










