<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'DATS') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8fafc; }
        .navbar-brand { font-weight: 700; }
        .hero-card { border: 0; border-radius: 1rem; }
        .card { border-radius: 1rem; }
        .table-card { overflow: hidden; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">DATS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('opportunities.index') }}">Opportunities</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('manual') }}">Manual</a></li>
                @auth
                    @if(auth()->user()->role === 'student')
                        <li class="nav-item"><a class="nav-link" href="{{ route('student.applications.index') }}">My Applications</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('student.logbooks.index') }}">My Logbooks</a></li>
                    @endif
                    @if(auth()->user()->role === 'lecturer')
                        <li class="nav-item"><a class="nav-link" href="{{ route('lecturer.applications.index') }}">Applications</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('lecturer.reviews.index') }}">Reviews</a></li>
                    @endif
                @endauth
            </ul>

            <ul class="navbar-nav align-items-center">
                @auth
                    <li class="nav-item me-2 text-white small">
                        {{ auth()->user()->name }} ({{ ucfirst(auth()->user()->role) }})
                    </li>
                    <li class="nav-item me-2">
                        <a class="btn btn-light btn-sm" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-light btn-sm">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item me-2"><a class="btn btn-light btn-sm" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item me-2"><a class="btn btn-outline-light btn-sm" href="{{ route('register.student') }}">Student Sign Up</a></li>
                    <li class="nav-item"><a class="btn btn-outline-light btn-sm" href="{{ route('register.lecturer') }}">Lecturer Sign Up</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<main class="py-4">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Please fix the following:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    document.addEventListener('submit', function (event) {
        const form = event.target;
        if (form.dataset.confirm === 'true') {
            const message = form.dataset.confirmMessage || 'Are you sure?';
            if (!window.confirm(message)) {
                event.preventDefault();
            }
        }
    });
</script>
</body>
</html>
