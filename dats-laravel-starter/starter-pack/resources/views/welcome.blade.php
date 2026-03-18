@extends('layouts.app')

@section('content')
<div class="card hero-card shadow-sm mb-4">
    <div class="card-body p-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-6 fw-bold mb-3">Digital Attachment Tracking System</h1>
                <p class="lead text-muted">
                    A Laravel-based platform for managing student attachment opportunities, applications,
                    weekly logbooks, and lecturer reviews.
                </p>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('register.student') }}" class="btn btn-primary">Student Sign Up</a>
                    <a href="{{ route('register.lecturer') }}" class="btn btn-outline-primary">Lecturer Sign Up</a>
                    <a href="{{ route('login') }}" class="btn btn-dark">Login</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="bg-light rounded-4 p-4 mt-4 mt-lg-0">
                    <h5>Core Features</h5>
                    <ul class="mb-0">
                        <li>Separate student and lecturer accounts</li>
                        <li>Opportunity posting and applications</li>
                        <li>Weekly digital logbooks</li>
                        <li>Lecturer review and feedback</li>
                        <li>API endpoints for Postman testing</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<h3 class="mb-3">Latest Open Opportunities</h3>
<div class="row g-3">
    @forelse($opportunities as $opportunity)
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5>{{ $opportunity->title }}</h5>
                    <p class="mb-1"><strong>Organization:</strong> {{ $opportunity->organization_name }}</p>
                    <p class="mb-1"><strong>Location:</strong> {{ $opportunity->location ?? 'Not specified' }}</p>
                    <p class="small text-muted">{{ \Illuminate\Support\Str::limit($opportunity->description, 100) }}</p>
                    @if($opportunity->application_deadline)
                        <span class="badge bg-warning text-dark">Deadline: {{ $opportunity->application_deadline->format('d M Y') }}</span>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">No opportunities have been posted yet.</div>
        </div>
    @endforelse
</div>
@endsection
