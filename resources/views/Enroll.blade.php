@extends('layouts.app')

@section('content')

<style>
:root{
  --pri:#0d6efd;
  --acc:#33ff20;
  --ink:#1f2937;
  --bg:#f5f7fb;
  --card:#ffffff;
}

/* Main Animated Background */
.school-bg {
  width: 100%;
  min-height: 100vh;
  background: linear-gradient(120deg, var(--pri), var(--acc), #f5f7fb);
  background-size: 300% 300%;
  animation: schoolGradient 10s ease infinite;
  padding-top: 60px;
  padding-bottom: 60px;
  position: relative;
  overflow: hidden;
}

@keyframes schoolGradient {
  0%   { background-position: 0% 50%; }
  50%  { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

/* School Pattern Overlay */
.school-bg::before {
  content: "";
  position: absolute;
  inset: 0;
  background-image: url('images/pioneer18.png'); /* PNG path */
  background-size: 280px;
  background-repeat: repeat;
  opacity: 0.15; /* faint so text readable */
  z-index: 1;
}

/* Make form appear above pattern */
.school-content {
  position: relative;
  z-index: 5;
}

/* Form Box */
.enroll-box {
  background: rgba(255, 255, 255, 0.85); 
  backdrop-filter: blur(6px);
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.1);
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

<div class="school-bg">
<div class="school-content">
    <div class="container">
        <div class="enroll-box">

            <h2 class="mb-4">Student Enroll Form</h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('enroll.form') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">NRC Number</label>
                    <input type="text" name="nrc" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Male/Female</label>
                    <select name="gender" class="form-control" required>
                        <option value="">select</option>
                        <option value="male">male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Father Name</label>
                    <input type="text" name="father_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mother Name</label>
                    <input type="text" name="mother_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Birthday</label>
                    <input type="date" name="dob" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" name="phone" class="form-control" required pattern="[0-9]{7,15}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Enroll</button>
            </form>

        </div>
    </div>
</div>
</div>



@endsection
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

