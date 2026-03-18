@extends('layouts.app')

@section('content')
<h2 class="mb-4">My Applications</h2>

<div class="card shadow-sm table-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                <tr>
                    <th>Opportunity</th>
                    <th>Organization</th>
                    <th>Status</th>
                    <th>Message</th>
                </tr>
                </thead>
                <tbody>
                @forelse($applications as $application)
                    <tr>
                        <td>{{ $application->opportunity->title }}</td>
                        <td>{{ $application->opportunity->organization_name }}</td>
                        <td><span class="badge bg-secondary">{{ ucfirst($application->status) }}</span></td>
                        <td>{{ $application->message ?: '—' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center">You have not submitted any applications.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $applications->links() }}
    </div>
</div>
@endsection
