@extends('layouts.app')

@section('content')

<style>
:root{
  --pri:#0d6efd;
  --acc:#F5DEB3;
  --ink:#1f2937;
  --bg:#FFEFD5;
  --card:#ffffff;
}

/* Background Animation */
.contact-bg{
  width: 100%;
  min-height: 100vh;
  background: linear-gradient(120deg, var(--pri), var(--acc), #f5f7fb);
  background-size: 300% 300%;
  animation: contactGradient 10s ease infinite;
  padding-top: 80px;
  padding-bottom: 80px;
  position: relative;
  overflow: hidden;
}

@keyframes contactGradient{
  0%   { background-position: 0% 50%; }
  50%  { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

/* pattern overlay */
.contact-bg::before{
  content:"";
  position:absolute;
  inset:0;
  background-image: url('{{ asset('images/pioneer18.png') }}');
  background-size: 240px;
  background-repeat: repeat;
  opacity: .12;
  z-index: 1;
}

.contact-content{
  position: relative;
  z-index: 5;
}

/* Main Card */
.contact-card{
  max-width: 900px;
  margin: 0 auto;
  background: rgba(255,255,255,0.90);
  border: 1px solid rgba(255,255,255,0.35);
  backdrop-filter: blur(10px);
  border-radius: 18px;
  box-shadow: 0 12px 40px rgba(0,0,0,0.18);
  overflow: hidden;
}

.contact-header{
  padding: 26px 26px 18px;
  text-align: center;
}

.contact-header h2{
  margin: 0;
  color: var(--ink);
  font-weight: 800;
  letter-spacing: .2px;
}

.contact-header p{
  margin: 10px 0 0;
  color: rgba(31,41,55,.75);
}

/* Info grid */
.info-grid{
  padding: 22px 26px 28px;
  display: grid;
  grid-template-columns: repeat(3, minmax(0,1fr));
  gap: 16px;
}

.info-box{
  background: rgba(255,255,255,0.82);
  border: 1px solid rgba(15,23,42,0.08);
  border-radius: 16px;
  padding: 16px;
  transition: transform .18s ease, box-shadow .18s ease;
}

.info-box:hover{
  transform: translateY(-4px);
  box-shadow: 0 14px 32px rgba(0,0,0,0.14);
}

.info-title{
  display:flex;
  align-items:center;
  gap:10px;
  margin-bottom: 8px;
  font-weight: 800;
  color: var(--ink);
}

.badge-icon{
  width: 38px;
  height: 38px;
  border-radius: 12px;
  display:flex;
  align-items:center;
  justify-content:center;
  background: rgba(13,110,253,.12);
  color: var(--pri);
  font-size: 18px;
}

.info-text{
  margin: 0;
  color: rgba(31,41,55,.80);
  line-height: 1.6;
  font-size: 0.98rem;
}

.link-list{
  margin-top: 10px;
  display:flex;
  flex-direction: column;
  gap: 8px;
}

.smart-link{
  display:flex;
  align-items:center;
  justify-content: space-between;
  gap: 10px;
  padding: 10px 12px;
  border-radius: 12px;
  text-decoration: none;
  color: var(--ink);
  background: rgba(13,110,253,.06);
  border: 1px solid rgba(13,110,253,.10);
  transition: .2s ease;
}

.smart-link:hover{
  background: rgba(13,110,253,.12);
  border-color: rgba(13,110,253,.18);
}

.smart-link span{
  font-weight: 700;
}

.smart-link small{
  color: rgba(31,41,55,.65);
  font-weight: 600;
}

/* bottom note */
.contact-note{
  padding: 0 26px 26px;
  color: rgba(31,41,55,.78);
  text-align:center;
}

@media (max-width: 991.98px){
  .info-grid{ grid-template-columns: 1fr; }
}

/* Footer (optional) */
footer{
  background: #b6dbe385;
  border-top: 1px solid rgba(30, 42, 15, 1);
}
footer a{ color: var(--ink); }
footer a:hover{ color: var(--pri); }
</style>

<div class="contact-bg">
  <div class="contact-content container">

    <div class="contact-card">
      <div class="contact-header">
        <h2>Contact & Inquiries</h2>
        <p>For admissions, fees, and school information — reach us via phone, email, or social media.</p>
      </div>

      <div class="info-grid">

        {{-- Phone --}}
        <div class="info-box">
          <div class="info-title">
            <div class="badge-icon">📞</div>
            Phone
          </div>
          <p class="info-text">Call us during office hours for quick inquiries.</p>

          <div class="link-list">
            <a class="smart-link" href="tel:+959123456789">
              <span>+95 9 123 456 789</span>
              <small>Tap to call</small>
            </a>
            <a class="smart-link" href="https://wa.me/959123456789" target="_blank" rel="noopener">
              <span>WhatsApp Chat</span>
              <small>Open</small>
            </a>
          </div>
        </div>

        {{-- Email --}}
        <div class="info-box">
          <div class="info-title">
            <div class="badge-icon">✉️</div>
            Email
          </div>
          <p class="info-text">Send us your questions and we’ll reply as soon as possible.</p>

          <div class="link-list">
            <a class="smart-link" href="mailto:info@pioneerschool.com?subject=Inquiry%20from%20Website">
              <span>info@pioneerschool.com</span>
              <small>Send email</small>
            </a>
            <a class="smart-link" href="mailto:admissions@pioneerschool.com?subject=Admissions%20Inquiry">
              <span>admissions@pioneerschool.com</span>
              <small>Admissions</small>
            </a>
          </div>
        </div>

        {{-- Social --}}
        <div class="info-box">
          <div class="info-title">
            <div class="badge-icon">🌐</div>
            Social Media
          </div>
          <p class="info-text">Follow updates, events, and announcements.</p>

          <div class="link-list">
            <a class="smart-link" href="https://www.facebook.com/" target="_blank" rel="noopener">
              <span>Facebook Page</span>
              <small>Open</small>
            </a>
            <a class="smart-link" href="https://www.messenger.com/" target="_blank" rel="noopener">
              <span>Messenger</span>
              <small>Chat</small>
            </a>
            <a class="smart-link" href="https://t.me/thura6667" target="_blank" rel="noopener">
              <span>Telegram</span>
              <small>Open</small>
            </a>
          </div>
        </div>

      </div>

      <div class="contact-note">
        <strong>Office Hours:</strong> Mon–Fri (8:00 AM – 4:30 PM) • <strong>Location:</strong> Add your school address here.
      </div>
    </div>

  </div>
</div>

@endsection
