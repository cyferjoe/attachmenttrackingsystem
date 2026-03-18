@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Opportunities</h2>
    @auth
        @if(auth()->user()->role === 'lecturer')
            <a href="{{ route('lecturer.opportunities.create') }}" class="btn btn-dark">Create Opportunity</a>
        @endif
    @endauth
</div>

<div class="row g-3">
    @forelse($opportunities as $opportunity)
        <div class="col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h4>{{ $opportunity->title }}</h4>
                    <p class="mb-1"><strong>Organization:</strong> {{ $opportunity->organization_name }}</p>
                    <p class="mb-1"><strong>Location:</strong> {{ $opportunity->location ?? 'Not specified' }}</p>

                    @if(isset($opportunity->applications_count))
                        <p class="mb-1"><strong>Applications:</strong> {{ $opportunity->applications_count }}</p>
                    @else
                        <p class="mb-1"><strong>Lecturer:</strong> {{ $opportunity->lecturer->name ?? 'N/A' }}</p>
                    @endif

                    @if($opportunity->application_deadline)
                        <p class="mb-1"><strong>Deadline:</strong> {{ $opportunity->application_deadline->format('d M Y') }}</p>
                    @endif

                    <p class="text-muted small mt-2">{{ $opportunity->description }}</p>

                    @if($opportunity->requirements)
                        <div class="bg-light rounded p-2 small mb-3">
                            <strong>Requirements:</strong> {{ $opportunity->requirements }}
                        </div>
                    @endif

                    @auth
                        @if(auth()->user()->role === 'student')
                            <form method="POST" action="{{ route('applications.store', $opportunity) }}">
                                @csrf
                                <div class="mb-2">
                                    <textarea class="form-control" name="message" rows="2" placeholder="Optional application message"></textarea>
                                </div>
                                <button class="btn btn-primary">Apply Now</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">No opportunities found.</div>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $opportunities->links() }}
</div>
@endsection
