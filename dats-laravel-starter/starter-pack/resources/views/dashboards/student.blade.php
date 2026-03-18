@extends('layouts.app')

@section('content')
<h2 class="mb-4">Student Dashboard</h2>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm text-bg-primary">
            <div class="card-body">
                <div class="fs-2 fw-bold">{{ $applicationsCount }}</div>
                <div>Applications</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm text-bg-success">
            <div class="card-body">
                <div class="fs-2 fw-bold">{{ $logbooksCount }}</div>
                <div>Logbook Entries</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm text-bg-dark">
            <div class="card-body">
                <div class="fs-2 fw-bold">{{ $recentOpportunities->count() }}</div>
                <div>Recent Opportunities</div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex gap-2 flex-wrap mb-4">
    <a href="{{ route('opportunities.index') }}" class="btn btn-primary">Browse Opportunities</a>
    <a href="{{ route('student.applications.index') }}" class="btn btn-outline-primary">My Applications</a>
    <a href="{{ route('student.logbooks.create') }}" class="btn btn-success">Submit Weekly Logbook</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <h4 class="mb-3">Latest Open Opportunities</h4>
        <div class="row g-3">
            @forelse($recentOpportunities as $opportunity)
                <div class="col-md-6">
                    <div class="border rounded p-3 h-100">
                        <h5>{{ $opportunity->title }}</h5>
                        <p class="mb-1"><strong>Organization:</strong> {{ $opportunity->organization_name }}</p>
                        <p class="mb-2"><strong>Location:</strong> {{ $opportunity->location ?? 'Not specified' }}</p>
                        <p class="text-muted small">{{ \Illuminate\Support\Str::limit($opportunity->description, 120) }}</p>
                    </div>
                </div>
            @empty
                <p class="text-muted">No opportunities available yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
