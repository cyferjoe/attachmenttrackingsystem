@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">My Logbook Entries</h2>
    <a href="{{ route('student.logbooks.create') }}" class="btn btn-success">Submit Entry</a>
</div>

<div class="card shadow-sm table-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                <tr>
                    <th>Week</th>
                    <th>Date</th>
                    <th>Opportunity</th>
                    <th>Status</th>
                    <th>Feedback</th>
                </tr>
                </thead>
                <tbody>
                @forelse($entries as $entry)
                    <tr>
                        <td>Week {{ $entry->week_number }}</td>
                        <td>{{ $entry->entry_date->format('d M Y') }}</td>
                        <td>{{ $entry->opportunity->title ?? 'Not linked yet' }}</td>
                        <td><span class="badge bg-secondary">{{ ucfirst($entry->status) }}</span></td>
                        <td>{{ $entry->lecturer_feedback ?: 'Pending review' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">No logbook entries submitted yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $entries->links() }}
    </div>
</div>
@endsection
