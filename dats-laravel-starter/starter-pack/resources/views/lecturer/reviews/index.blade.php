@extends('layouts.app')

@section('content')
<h2 class="mb-4">Lecturer Review Center</h2>

<div class="card shadow-sm table-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                <tr>
                    <th>Student</th>
                    <th>Week</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Opportunity</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($entries as $entry)
                    <tr>
                        <td>{{ $entry->student->name }}</td>
                        <td>Week {{ $entry->week_number }}</td>
                        <td>{{ $entry->entry_date->format('d M Y') }}</td>
                        <td><span class="badge bg-secondary">{{ ucfirst($entry->status) }}</span></td>
                        <td>{{ $entry->opportunity->title ?? 'Not linked' }}</td>
                        <td><a href="{{ route('lecturer.reviews.show', $entry) }}" class="btn btn-sm btn-primary">Open Review</a></td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">No logbook entries assigned to you yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $entries->links() }}
    </div>
</div>
@endsection
