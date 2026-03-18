<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OpportunityController extends Controller
{
    public function welcome(): View
    {
        $opportunities = Opportunity::query()
            ->with('lecturer')
            ->where('status', 'open')
            ->latest()
            ->take(6)
            ->get();

        return view('welcome', compact('opportunities'));
    }

    public function index(Request $request): View
    {
        $user = $request->user();

        if ($user && $user->isLecturer()) {
            $opportunities = Opportunity::query()
                ->withCount('applications')
                ->where('lecturer_id', $user->id)
                ->latest()
                ->paginate(10);
        } else {
            $opportunities = Opportunity::query()
                ->with('lecturer')
                ->where('status', 'open')
                ->latest()
                ->paginate(10);
        }

        return view('opportunities.index', compact('opportunities'));
    }

    public function create(): View
    {
        return view('opportunities.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'organization_name' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'requirements' => ['nullable', 'string'],
            'application_deadline' => ['nullable', 'date'],
        ]);

        Opportunity::create([
            'lecturer_id' => $request->user()->id,
            'title' => $validated['title'],
            'organization_name' => $validated['organization_name'],
            'location' => $validated['location'] ?? null,
            'description' => $validated['description'],
            'requirements' => $validated['requirements'] ?? null,
            'application_deadline' => $validated['application_deadline'] ?? null,
            'status' => 'open',
        ]);

        return redirect()->route('opportunities.index')
            ->with('success', 'Opportunity posted successfully.');
    }
}
