<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Opportunity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function index(Request $request): View
    {
        $applications = Application::query()
            ->with('opportunity')
            ->where('student_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return view('applications.index', compact('applications'));
    }

    public function lecturerIndex(Request $request): View
    {
        $applications = Application::query()
            ->with(['student', 'opportunity'])
            ->whereHas('opportunity', fn ($query) => $query->where('lecturer_id', $request->user()->id))
            ->latest()
            ->paginate(10);

        return view('applications.lecturer-index', compact('applications'));
    }

    public function store(Request $request, Opportunity $opportunity): RedirectResponse
    {
        if ($opportunity->status !== 'open') {
            return back()->withErrors(['opportunity' => 'This opportunity is closed.']);
        }

        $request->validate([
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        Application::firstOrCreate(
            [
                'student_id' => $request->user()->id,
                'opportunity_id' => $opportunity->id,
            ],
            [
                'message' => $request->input('message'),
                'status' => 'pending',
            ]
        );

        return redirect()->route('student.applications.index')
            ->with('success', 'Application submitted successfully.');
    }

    public function updateStatus(Request $request, Application $application): RedirectResponse
    {
        abort_unless($application->opportunity->lecturer_id === $request->user()->id, 403);

        $validated = $request->validate([
            'status' => ['required', 'in:approved,rejected,pending'],
        ]);

        $application->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Application status updated.');
    }
}
