@extends('layouts.app')

@section('content')
<h2 class="mb-4">Lecturer Dashboard</h2>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm text-bg-dark">
            <div class="card-body">
                <div class="fs-2 fw-bold">{{ $opportunitiesCount }}</div>
                <div>Posted Opportunities</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm text-bg-primary">
            <div class="card-body">
                <div class="fs-2 fw-bold">{{ $applicationsCount }}</div>
                <div>Student Applications</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm text-bg-warning">
            <div class="card-body">
                <div class="fs-2 fw-bold">{{ $pendingReviewsCount }}</div>
                <div>Pending Reviews</div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex gap-2 flex-wrap mb-4">
    <a href="{{ route('lecturer.opportunities.create') }}" class="btn btn-dark">Post Opportunity</a>
    <a href="{{ route('lecturer.applications.index') }}" class="btn btn-outline-primary">View Applications</a>
    <a href="{{ route('lecturer.reviews.index') }}" class="btn btn-outline-success">Review Logbooks</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <h4 class="mb-3">Recent Applications</h4>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Opportunity</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentApplications as $application)
                        <tr>
                            <td>{{ $application->student->name }}</td>
                            <td>{{ $application->opportunity->title }}</td>
                            <td><span class="badge bg-secondary">{{ ucfirst($application->status) }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="text-center">No applications yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
