@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h3 class="mb-3">Create Opportunity</h3>
                <form method="POST" action="{{ route('lecturer.opportunities.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Opportunity title</label>
                            <input class="form-control" type="text" name="title" value="{{ old('title') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Organization name</label>
                            <input class="form-control" type="text" name="organization_name" value="{{ old('organization_name') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Location</label>
                            <input class="form-control" type="text" name="location" value="{{ old('location') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Application deadline</label>
                            <input class="form-control" type="date" name="application_deadline" value="{{ old('application_deadline') }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4" required>{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Requirements</label>
                        <textarea class="form-control" name="requirements" rows="3">{{ old('requirements') }}</textarea>
                    </div>
                    <button class="btn btn-dark">Publish Opportunity</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
