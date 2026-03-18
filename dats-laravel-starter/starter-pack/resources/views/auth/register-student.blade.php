@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="mb-3">Student Sign Up</h3>
                <form method="POST" action="{{ route('register.student.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full name</label>
                            <input class="form-control" type="text" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Registration number</label>
                            <input class="form-control" type="text" name="reg_no" value="{{ old('reg_no') }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Department / Course</label>
                        <input class="form-control" type="text" name="department" value="{{ old('department', 'BBIT') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input class="form-control" type="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <input class="form-control" id="student_password" type="password" name="password" required>
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('student_password')">Show</button>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Confirm password</label>
                            <input class="form-control" type="password" name="password_confirmation" required>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100">Create Student Account</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
