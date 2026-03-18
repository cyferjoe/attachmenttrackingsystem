@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="mb-3">Login</h3>
                <form method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input class="form-control" id="password" type="password" name="password" required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">Show</button>
                        </div>
                    </div>
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <button class="btn btn-primary w-100">Login</button>
                </form>
                <hr>
                <div class="d-grid gap-2">
                    <a href="{{ route('register.student') }}" class="btn btn-outline-primary">Create Student Account</a>
                    <a href="{{ route('register.lecturer') }}" class="btn btn-outline-dark">Create Lecturer Account</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
