@extends('layouts.app')

@section('content')
<h2 class="mb-4">Review Logbook Entry</h2>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4>{{ $logbookEntry->student->name }}</h4>
                <p class="mb-1"><strong>Week:</strong> {{ $logbookEntry->week_number }}</p>
                <p class="mb-1"><strong>Date:</strong> {{ $logbookEntry->entry_date->format('d M Y') }}</p>
                <p class="mb-3"><strong>Opportunity:</strong> {{ $logbookEntry->opportunity->title ?? 'Not linked' }}</p>

                <h5>Tasks Completed</h5>
                <p>{{ $logbookEntry->tasks_completed }}</p>

                <h5>Skills Gained</h5>
                <p>{{ $logbookEntry->skills_gained ?: 'No skills captured.' }}</p>

                <h5>Challenges</h5>
                <p>{{ $logbookEntry->challenges ?: 'No challenges captured.' }}</p>

                <h5>Plan for Next Week</h5>
                <p>{{ $logbookEntry->next_week_plan ?: 'No plan captured.' }}</p>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4>Review Form</h4>
                <form method="POST" action="{{ route('lecturer.reviews.update', $logbookEntry) }}">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" required>
                            <option value="submitted" @selected($logbookEntry->status === 'submitted')>Submitted</option>
                            <option value="reviewed" @selected($logbookEntry->status === 'reviewed')>Reviewed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lecturer feedback</label>
                        <textarea class="form-control" name="lecturer_feedback" rows="6" required>{{ old('lecturer_feedback', $logbookEntry->lecturer_feedback) }}</textarea>
                    </div>
                    <button class="btn btn-success">Save Review</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
