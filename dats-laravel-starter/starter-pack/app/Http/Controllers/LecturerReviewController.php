<?php

namespace App\Http\Controllers;

use App\Models\LogbookEntry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LecturerReviewController extends Controller
{
    public function index(Request $request): View
    {
        $entries = LogbookEntry::query()
            ->with(['student', 'opportunity'])
            ->where('lecturer_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return view('lecturer.reviews.index', compact('entries'));
    }

    public function show(Request $request, LogbookEntry $logbookEntry): View
    {
        abort_unless($logbookEntry->lecturer_id === $request->user()->id, 403);

        $logbookEntry->load(['student', 'opportunity']);

        return view('lecturer.reviews.show', compact('logbookEntry'));
    }

    public function update(Request $request, LogbookEntry $logbookEntry): RedirectResponse
    {
        abort_unless($logbookEntry->lecturer_id === $request->user()->id, 403);

        $validated = $request->validate([
            'lecturer_feedback' => ['required', 'string'],
            'status' => ['required', 'in:submitted,reviewed'],
        ]);

        $logbookEntry->update($validated);

        return redirect()->route('lecturer.reviews.show', $logbookEntry)
            ->with('success', 'Review saved successfully.');
    }
}
