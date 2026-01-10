@extends('layouts.app')

@section('content')

<style>
:root{
  --pri:#0d6efd;
  --acc:#00c2a8;
  --ink:#1f2937;
  --bg:#f5f7fb;
  --card:#ffffff;
}

/* Background Animation */
.contact-bg {
  width: 100%;
  min-height: 100vh;
  background: linear-gradient(120deg, var(--pri), var(--acc), #f5f7fb);
  background-size: 300% 300%;
  animation: contactGradient 10s ease infinite;
  padding-top: 70px;
  padding-bottom: 70px;
  position: relative;
  overflow: hidden;
}

@keyframes contactGradient {
  0%   { background-position: 0% 50%; }
  50%  { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

/* Optional school pattern background */
.contact-bg::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image: url('images/pioneer18.png');
  background-size: 240px;
  background-repeat: repeat;
  opacity: 0.14;
  z-index: 1;
}

.contact-content {
  position: relative;
  z-index: 5;
}

/* Contact Form Box */
.contact-box {
  max-width: 600px;
  margin: 0 auto;
  background: rgba(255,255,255,0.88);
  padding: 30px;
  border-radius: 14px;
  backdrop-filter: blur(6px);
  box-shadow: 0 8px 28px rgba(0,0,0,0.1);
}

.contact-box h2 {
  text-align: center;
  margin-bottom: 25px;
  color: var(--ink);
}

/* Default Inputs */
label {
  font-weight: bold;
  margin-bottom: 5px;
  color: var(--ink);
}

input[type="text"],
input[type="email"],
textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 6px;
}

textarea {
  height: 120px;
}

button[type="submit"] {
  width: 100%;
  padding: 12px;
  background-color: var(--pri);
  color: white;
  border: none;
  border-radius: 6px;
  transition: 0.3s;
}

button[type="submit"]:hover {
  background-color: #0056b3;
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
</style>

<div class="contact-bg">
    <div class="contact-content">
        <div class="contact-box">

            <h2>Contact Us</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}">
                @csrf

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <div class="mb-3">
                    <label>Message</label>
                    <textarea name="message" class="form-control">{{ old('message') }}</textarea>
                    @error('message')<small class="text-danger">{{ $message }}</small>@enderror
                </div>

                <button type="submit" class="btn btn-primary">Send</button>
            </form>

        </div>
    </div>
</div>

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
