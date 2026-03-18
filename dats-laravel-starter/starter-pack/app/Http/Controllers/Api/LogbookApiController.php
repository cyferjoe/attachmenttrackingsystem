<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\LogbookEntry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogbookApiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->isStudent()) {
            $entries = LogbookEntry::query()
                ->where('student_id', $user->id)
                ->latest()
                ->get();
        } else {
            $entries = LogbookEntry::query()
                ->where('lecturer_id', $user->id)
                ->latest()
                ->get();
        }

        return response()->json($entries);
    }

    public function store(Request $request): JsonResponse
    {
        abort_unless($request->user()->isStudent(), 403, 'Only students can submit logbooks.');

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
            return response()->json([
                'message' => 'This week number already exists.',
            ], 422);
        }

        $lecturerId = null;

        if (! empty($validated['opportunity_id'])) {
            $application = Application::query()
                ->with('opportunity')
                ->where('student_id', $studentId)
                ->where('opportunity_id', $validated['opportunity_id'])
                ->where('status', 'approved')
                ->first();

            abort_unless($application, 403, 'Use an approved opportunity.');

            $lecturerId = $application->opportunity->lecturer_id;
        }

        $entry = LogbookEntry::create([
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

        return response()->json([
            'message' => 'Logbook submitted successfully.',
            'data' => $entry,
        ], 201);
    }

    public function review(Request $request, LogbookEntry $logbookEntry): JsonResponse
    {
        abort_unless($request->user()->isLecturer(), 403, 'Only lecturers can review logbooks.');
        abort_unless($logbookEntry->lecturer_id === $request->user()->id, 403, 'Not your assigned logbook.');

        $validated = $request->validate([
            'lecturer_feedback' => ['required', 'string'],
            'status' => ['required', 'in:submitted,reviewed'],
        ]);

        $logbookEntry->update($validated);

        return response()->json([
            'message' => 'Logbook reviewed successfully.',
            'data' => $logbookEntry->fresh(),
        ]);
    }
}
