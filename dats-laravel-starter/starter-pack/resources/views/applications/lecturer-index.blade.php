@extends('layouts.app')

@section('content')
<h2 class="mb-4">Student Applications</h2>

<div class="card shadow-sm table-card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                <tr>
                    <th>Student</th>
                    <th>Opportunity</th>
                    <th>Status</th>
                    <th>Message</th>
                    <th width="220">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($applications as $application)
                    <tr>
                        <td>{{ $application->student->name }}</td>
                        <td>{{ $application->opportunity->title }}</td>
                        <td><span class="badge bg-secondary">{{ ucfirst($application->status) }}</span></td>
                        <td>{{ $application->message ?: '—' }}</td>
                        <td>
                            <form method="POST" action="{{ route('lecturer.applications.update', $application) }}" class="d-flex gap-2" data-confirm="true" data-confirm-message="Update application status?">
                                @csrf
                                @method('PATCH')
                                <select class="form-select form-select-sm" name="status">
                                    <option value="pending" @selected($application->status === 'pending')>Pending</option>
                                    <option value="approved" @selected($application->status === 'approved')>Approved</option>
                                    <option value="rejected" @selected($application->status === 'rejected')>Rejected</option>
                                </select>
                                <button class="btn btn-sm btn-primary">Save</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">No applications found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $applications->links() }}
    </div>
</div>
@endsection
