<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        /* Clean Navbar Background */
        .clean-navbar {
            background-color: #ace1f9c8;
            border-bottom: 1px solid #48b6ed97;
            transition: all 0.3s ease-in-out;
        }

        .navbar-nav .nav-link {
            color: #333;
            font-weight: 500;
            padding: 8px 14px;
            border-radius: 6px;
            transition: background-color 0.25s ease;
        }

        .navbar-nav .nav-link:hover {
            background-color: #f3f3f3;
            color: #007bff;
        }

        /* CTA (Enroll Now) */
        .navbar-nav .enroll-btn {
            background-color: #007bff;
            color: #fff !important;
            font-weight: 600;
            border-radius: 20px;
            padding: 8px 20px;
            transition: background-color 0.3s;
        }

        .navbar-nav .enroll-btn:hover {
            background-color: #0056b3;
            color: #ffffff9e !important;
        }

        /* Space under fixed navbar */
        body {
            padding-top: 70px;
        }
    </style>
</head>

<body>
<div id="app">

<nav class="navbar navbar-expand-md navbar-light clean-navbar shadow-sm fixed-top">
    <div class="container">

        <!-- Logo -->
        <a href="{{ url('/pioneer') }}">
            <img src="{{ asset('images/pioneer17.png') }}" alt="Logo" width="70">
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Center -->
            <ul class="navbar-nav mx-auto">
               
                <li class="nav-item"><a class="nav-link" href="{{ url('/home') }}">Home</a></li>
                 <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}"> Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/founder') }}"> Founder</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/teachers') }}">Teacher</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/events') }}"> Events & Activities</a></li>

                {{-- ✅ FIXED --}}
               

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/subject') }}">Subjects</a>
                </li>

                @auth
                   @if(Auth::user()->name === 'Admin')

                        {{-- Teaching Assignment Dropdown --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"
                            href="#"
                            id="teachingAssignmentDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                                Teaching Assignment
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="teachingAssignmentDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.teachers.index') }}">
                                        Teachers
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.subjects.index') }}">
                                        Subjects
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.events.index') }}">
                                        Events
                                    </a>
                                </li>

                                <li><hr class="dropdown-divider"></li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.classrooms.index') }}">
                                        Classrooms
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.sections.index') }}">
                                        Sections
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- Keep Exam Result as separate (your existing link) --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/admin/exam-results/create') }}">
                                Exam Result
                            </a>
                        </li>

                    @endif

                @endauth

                <li class="nav-item">
                    <a class="nav-link enroll-btn" href="{{ route('enroll.form') }}">Enroll Now</a>
                </li>
            </ul>

            <!-- Right -->
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>

        </div>
    </div>
</nav>

<main class="py-4">
    @yield('content')
</main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
