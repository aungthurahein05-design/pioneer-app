@extends('layouts.app')

@section('content')
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

  .section-pad{ padding:80px 0; }
  .muted{ color:var(--muted); }

  .chip{
    display:inline-flex;align-items:center;gap:6px;
    font-size:.85rem;border-radius:999px;padding:4px 12px;
    background:#e0edff;color:#1d4ed8;font-weight:600;
  }

  .teachers-title{ font-size:2.4rem; font-weight:800; }

  /* Grid */
  .teacher-grid{
    display:grid;
    grid-template-columns:repeat(4,minmax(0,1fr));
    gap:22px;
  }
  @media (max-width:1199.98px){ .teacher-grid{ grid-template-columns:repeat(3,1fr);} }
  @media (max-width:991.98px){ .teacher-grid{ grid-template-columns:repeat(2,1fr);} }
  @media (max-width:575.98px){ .teacher-grid{ grid-template-columns:1fr;} }

  .teacher-card{
    background:var(--card-bg);
    border-radius:22px;
    border:1px solid var(--border-soft);
    box-shadow:0 12px 32px rgba(15,23,42,0.06);
    overflow:hidden;
    display:flex;
    flex-direction:column;
    transition:.28s ease;
  }
  .teacher-card:hover{
    transform:translateY(-5px);
    box-shadow:0 18px 45px rgba(15,23,42,0.09);
    border-color:rgba(37,99,235,0.35);
  }

  .teacher-photo{ position:relative; overflow:hidden; }
  .teacher-photo img{
    width:100%;
    height:220px;
    object-fit:cover;
    transition:transform .6s ease, opacity .6s ease;
  }
  .teacher-card:hover .teacher-photo img{ transform:scale(1.05); opacity:.97; }

  .teacher-badge{
    position:absolute; left:12px; top:12px;
    font-size:.75rem; padding:3px 9px; border-radius:999px;
    background:rgba(15,23,42,0.75); color:#f9fafb;
    backdrop-filter:blur(10px);
  }

  .teacher-body{ padding:14px 16px 14px; }
  .teacher-name{ font-size:1.05rem; font-weight:700; margin-bottom:2px; }
  .teacher-role{ font-size:.9rem; color:var(--muted); margin-bottom:8px; }
  .teacher-meta{ font-size:.85rem; color:var(--muted); }

  .tag-list{ display:flex; flex-wrap:wrap; gap:6px; margin-top:10px; }
  .tag-pill{
    font-size:.75rem; padding:3px 8px; border-radius:999px;
    background:#e0f2fe; color:#0369a1; font-weight:600;
  }

  .teacher-footer{
    border-top:1px solid #e5e7eb;
    padding:10px 14px;
    display:flex; justify-content:space-between; align-items:center;
    font-size:.82rem; color:var(--muted);
  }

  /* Footer */
  footer{ background:#b6dbe385; border-top:1px solid rgba(30,42,15,1); }
  footer a{ color: var(--ink); }
  footer a:hover{ color: var(--pri); }

  /* Animated BG */
  .school-animated-bg {
    position: fixed; inset: 0; z-index: -1;
    pointer-events: none; overflow: hidden;
    background-color: #dafcfcff;
  }
  .school-icon {
    position: absolute; font-size: 48px;
    opacity: 0.12; animation: floatSchool 18s linear infinite;
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

<section class="section-pad">
  <div class="container">

    {{-- Header --}}
    <div class="row mb-4 align-items-end">
      <div class="col-lg-8" data-aos="fade-right">
        <span class="chip mb-2">👩‍🏫 Our Teachers</span>

       
        <h1 class="teachers-title mb-2">Dedicated &amp; caring teachers</h1>
        <p class="muted mb-0">
          Meet our professional teachers who guide students with care and discipline.
        </p>
      </div>
      <div class="col-lg-4 text-lg-end mt-3 mt-lg-0" data-aos="fade-left">
        <span class="muted small">
          Academic Year 2025–2026 • Full-time &amp; part-time teachers
        </span>
      </div>
    </div>

    {{-- Grid --}}
    <div class="teacher-grid">
      
      @forelse($teachers as $teacher)
        @php
          $photo = $teacher->photo
              ? asset('uploads/teachers/'.$teacher->photo)
              : asset('images/default-teacher.png'); // create default image or change path

          $name = $teacher->name ?? 'Teacher';
          $edu  = $teacher->education ?? '—';
          $phone = $teacher->phone ?? null;
          $position = $teacher->position ?? null; // if you have this column
        @endphp

        <div class="teacher-card" data-aos="zoom-in">
          <div class="teacher-photo">
            <img src="{{ $photo }}" alt="{{ $name }}">
            <span class="teacher-badge">{{ $position ?? 'Teacher' }}</span>
          </div>

          <div class="teacher-body">
            <div class="teacher-name">{{ $name }}</div>
            <div class="teacher-role">{{ $edu }}</div>

            <div class="teacher-meta">
              @if($phone)
                📞 {{ $phone }}
              @else
                📞 Not provided
              @endif
            </div>

            <div class="tag-list">
              <span class="tag-pill">Friendly</span>
              <span class="tag-pill">Experienced</span>
              <span class="tag-pill">Supportive</span>
            </div>
          </div>

          <div class="teacher-footer">
            <span>Available</span>
            <span class="text-primary fw-semibold">View</span>
          </div>
        </div>
      @empty
        <div class="w-100">
          <div class="border rounded-4 p-5 text-center bg-white">
            <h5 class="fw-bold mb-2">No teachers found</h5>
            <p class="muted mb-0">Please check back later.</p>
          </div>
        </div>
      @endforelse
    </div>

    

  </div>
</section>



@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 800, once: true, offset: 80 });
  </script>
@endpush

