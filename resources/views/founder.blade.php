@extends('layouts.app')

@section('content')
<style>
   /* ===== Founder section style ===== */
.founder-wrap{
  background: linear-gradient(135deg, rgba(13,110,253,.08), rgba(0,194,168,.06));
  border-radius: 1.5rem;
  padding: 32px 32px;
  border: 1px solid rgba(15,23,42,.08);
}

.founder-photo{
  border-radius: 1.25rem;
  overflow: hidden;
  box-shadow: 0 16px 40px rgba(15,23,42,.18);
}

.founder-photo img{
  width: 100%;
  height: 320px;
  object-fit: cover;
  transition: transform .45s ease, filter .45s ease;
}

.founder-photo:hover img{
  transform: scale(1.04);
  filter: saturate(1.05);
}

.founder-chip{
  display:inline-flex;
  align-items:center;
  gap:.35rem;
  padding:4px 12px;
  font-size:.8rem;
  border-radius:999px;
  background: rgba(255,255,255,.75);
  color: var(--pri);
  box-shadow: 0 8px 20px rgba(15,23,42,.10);
}

.founder-name{
  font-size:1.4rem;
  font-weight:700;
}

.founder-role{
  font-size:.9rem;
  color:#6b7280;
}

.founder-quote{
  font-size:1.02rem;
  line-height:1.7;
  border-left:3px solid var(--pri);
  padding-left:14px;
  margin:14px 0;
}

.founder-meta{
  font-size:.9rem;
  color:#6b7280;
}

.founder-sign{
  height:60px;
  opacity:.9;
}

.founder-social a{
  font-size:1.25rem;
  margin-right:10px;
  color:#6b7280;
}
.founder-social a:hover{
  color:var(--pri);
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

{{-- FOUNDER --}}
<section class="section-pad" id="founder">
  <div class="container">
    <div class="text-center mb-4" data-aos="fade-up">
      <h2 class="fw-bold">Founder’s Message</h2>
      <p class="text-muted mb-0">
        Our vision & commitment for quality education at Pioneer School.
      </p>
    </div>

    <div class="founder-wrap shadow-soft" data-aos="fade-up" data-aos-delay="80">
      <div class="row g-4 align-items-center">
        {{-- Photo --}}
        <div class="col-lg-4">
          <div class="founder-photo">
            <img src="{{ asset('images/pioneer11.jpg') }}" alt="Founder of Pioneer School">
          </div>
        </div>

        {{-- Text --}}
        <div class="col-lg-8">
          <div class="d-flex align-items-center justify-content-between mb-2">
            <div>
              <div class="founder-name">U Aung Min</div>
              <div class="founder-role">Founder &amp; Chairman, Pioneer School</div>
            </div>
            <span class="founder-chip">
              <i class="bi bi-lightbulb-fill"></i> Since 2010
            </span>
          </div>

          <p class="founder-quote mb-2">
            “Education should inspire curiosity, confidence and compassion.
            At Pioneer School, we aim to nurture future leaders who are ready
            for both local and global challenges.”
          </p>

          <p class="founder-meta mb-3">
            With over 20 years in the education field, our founder continues to guide
            the school’s vision, teacher development and student support programmes.
          </p>

          {{-- Signature + Social --}}
          <div class="d-flex flex-wrap align-items-center gap-3 mt-2">
            <img src="{{ asset('images/signature.png') }}" alt="Signature" class="founder-sign">
            <div class="founder-social ms-lg-auto">
              <a href="#"><i class="bi bi-facebook"></i></a>
              <a href="#"><i class="bi bi-linkedin"></i></a>
              <a href="mailto:info@pioneerschool.edu"><i class="bi bi-envelope-fill"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

  <!-- {{-- FOOTER --}}
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
  </footer> -->

@endsection