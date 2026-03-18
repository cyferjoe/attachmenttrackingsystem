@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body p-4">
        <h2 class="mb-3">System Manual</h2>
        <p class="text-muted">
            This manual explains how to use the Digital Attachment Tracking System starter project.
        </p>

        <h4>1. Student workflow</h4>
        <ol>
            <li>Create an account from the Student Sign Up page.</li>
            <li>Login and open the Opportunities page.</li>
            <li>Apply for a posted opportunity.</li>
            <li>Wait for lecturer approval.</li>
            <li>Submit weekly logbook entries after approval.</li>
            <li>Check lecturer feedback from the logbook page.</li>
        </ol>

        <h4>2. Lecturer workflow</h4>
        <ol>
            <li>Create an account from the Lecturer Sign Up page.</li>
            <li>Login and create one or more opportunities.</li>
            <li>Open the Applications page and approve or reject applications.</li>
            <li>Open the Review Center to review student logbooks.</li>
            <li>Add comments and change the status to reviewed.</li>
        </ol>

        <h4>3. API testing with Postman</h4>
        <ol>
            <li>Import the Postman collection from the project folder.</li>
            <li>Login using `/api/v1/login` to get the token.</li>
            <li>Add `Authorization: Bearer YOUR_TOKEN` to protected requests.</li>
            <li>Test opportunity creation, application, and logbook review endpoints.</li>
        </ol>

        <h4>4. Recommended improvements</h4>
        <ul>
            <li>Add file upload for CVs and attachment letters.</li>
            <li>Add email notifications.</li>
            <li>Add company registration and verification.</li>
            <li>Add analytics dashboard and PDF report generation.</li>
        </ul>
    </div>
</div>
@endsection
