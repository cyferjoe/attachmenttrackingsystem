<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Opportunity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OpportunityApiController extends Controller
{
    public function index(): JsonResponse
    {
        $opportunities = Opportunity::query()
            ->with('lecturer:id,name,email')
            ->where('status', 'open')
            ->latest()
            ->get();

        return response()->json($opportunities);
    }

    public function store(Request $request): JsonResponse
    {
        abort_unless($request->user()->isLecturer(), 403, 'Only lecturers can create opportunities.');

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'organization_name' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'requirements' => ['nullable', 'string'],
            'application_deadline' => ['nullable', 'date'],
        ]);

        $opportunity = Opportunity::create([
            'lecturer_id' => $request->user()->id,
            'title' => $validated['title'],
            'organization_name' => $validated['organization_name'],
            'location' => $validated['location'] ?? null,
            'description' => $validated['description'],
            'requirements' => $validated['requirements'] ?? null,
            'application_deadline' => $validated['application_deadline'] ?? null,
            'status' => 'open',
        ]);

        return response()->json([
            'message' => 'Opportunity created successfully.',
            'data' => $opportunity,
        ], 201);
    }

    public function apply(Request $request, Opportunity $opportunity): JsonResponse
    {
        abort_unless($request->user()->isStudent(), 403, 'Only students can apply.');

        if ($opportunity->status !== 'open') {
            return response()->json([
                'message' => 'This opportunity is closed.',
            ], 422);
        }

        $validated = $request->validate([
            'message' => ['nullable', 'string', 'max:2000'],
        ]);

        $application = Application::firstOrCreate(
            [
                'student_id' => $request->user()->id,
                'opportunity_id' => $opportunity->id,
            ],
            [
                'message' => $validated['message'] ?? null,
                'status' => 'pending',
            ]
        );

        return response()->json([
            'message' => 'Application submitted successfully.',
            'data' => $application,
        ], 201);
    }
}
