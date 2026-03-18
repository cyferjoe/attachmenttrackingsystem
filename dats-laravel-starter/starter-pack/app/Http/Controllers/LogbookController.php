<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\LogbookEntry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LogbookController extends Controller
{
    public function index(Request $request): View
    {
        $entries = LogbookEntry::query()
            ->with(['lecturer', 'opportunity'])
            ->where('student_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return view('logbooks.index', compact('entries'));
    }

    public function create(Request $request): View
    {
        $approvedApplications = Application::query()
            ->with('opportunity')
            ->where('student_id', $request->user()->id)
            ->where('status', 'approved')
            ->get();

        return view('logbooks.create', compact('approvedApplications'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'opportunity_id' => ['nullable', 'exists:opportunities,id'],
            'week_number' => ['required', 'integer', 'min:1', 'max:52'],
            'entry_date' => ['required', 'date'],
            'tasks_completed' => ['required', 'string'],
            'skills_gained' => ['nullable', 'string'],
            'challenges' => ['nullable', 'string'],
            'next_week_plan' => ['nullable', 'string'],
        ]);

        $studentId = $request->user()->id;

        $exists = LogbookEntry::query()
            ->where('student_id', $studentId)
            ->where('week_number', $validated['week_number'])
            ->exists();

        if ($exists) {
            return back()
                ->withErrors(['week_number' => 'You already submitted this week number.'])
                ->withInput();
        }

        $lecturerId = null;

        if (! empty($validated['opportunity_id'])) {
            $application = Application::query()
                ->with('opportunity')
                ->where('student_id', $studentId)
                ->where('opportunity_id', $validated['opportunity_id'])
                ->where('status', 'approved')
                ->first();

            abort_unless($application, 403, 'You can only log against an approved opportunity.');

            $lecturerId = $application->opportunity->lecturer_id;
        }

        LogbookEntry::create([
            'student_id' => $studentId,
            'lecturer_id' => $lecturerId,
            'opportunity_id' => $validated['opportunity_id'] ?? null,
            'week_number' => $validated['week_number'],
            'entry_date' => $validated['entry_date'],
            'tasks_completed' => $validated['tasks_completed'],
            'skills_gained' => $validated['skills_gained'] ?? null,
            'challenges' => $validated['challenges'] ?? null,
            'next_week_plan' => $validated['next_week_plan'] ?? null,
            'status' => 'submitted',
        ]);

        return redirect()->route('student.logbooks.index')
            ->with('success', 'Logbook entry submitted.');
    }
}
