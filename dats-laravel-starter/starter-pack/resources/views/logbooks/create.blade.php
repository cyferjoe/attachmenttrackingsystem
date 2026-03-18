@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="mb-3">Submit Weekly Logbook</h3>
                <form method="POST" action="{{ route('student.logbooks.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Approved opportunity</label>
                            <select class="form-select" name="opportunity_id">
                                <option value="">Select opportunity</option>
                                @foreach($approvedApplications as $application)
                                    <option value="{{ $application->opportunity->id }}">
                                        {{ $application->opportunity->title }} - {{ $application->opportunity->organization_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-text">Only approved applications can link to a lecturer for review.</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Week number</label>
                            <input class="form-control" type="number" name="week_number" min="1" max="52" value="{{ old('week_number') }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Entry date</label>
                            <input class="form-control" type="date" name="entry_date" value="{{ old('entry_date') }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tasks completed</label>
                        <textarea class="form-control" name="tasks_completed" rows="4" required>{{ old('tasks_completed') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Skills gained</label>
                        <textarea class="form-control" name="skills_gained" rows="3">{{ old('skills_gained') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Challenges faced</label>
                        <textarea class="form-control" name="challenges" rows="3">{{ old('challenges') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Plan for next week</label>
                        <textarea class="form-control" name="next_week_plan" rows="3">{{ old('next_week_plan') }}</textarea>
                    </div>
                    <button class="btn btn-success">Submit Logbook</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
