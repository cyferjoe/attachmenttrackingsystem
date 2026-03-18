<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\LogbookEntry;
use App\Models\Opportunity;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        if ($user->isStudent()) {
            return view('dashboards.student', [
                'applicationsCount' => Application::query()
                    ->where('student_id', $user->id)
                    ->count(),
                'logbooksCount' => LogbookEntry::query()
                    ->where('student_id', $user->id)
                    ->count(),
                'recentOpportunities' => Opportunity::query()
                    ->where('status', 'open')
                    ->latest()
                    ->take(5)
                    ->get(),
            ]);
        }

        return view('dashboards.lecturer', [
            'opportunitiesCount' => Opportunity::query()
                ->where('lecturer_id', $user->id)
                ->count(),
            'applicationsCount' => Application::query()
                ->whereHas('opportunity', fn ($query) => $query->where('lecturer_id', $user->id))
                ->count(),
            'pendingReviewsCount' => LogbookEntry::query()
                ->where('lecturer_id', $user->id)
                ->where('status', 'submitted')
                ->count(),
            'recentApplications' => Application::query()
                ->with(['student', 'opportunity'])
                ->whereHas('opportunity', fn ($query) => $query->where('lecturer_id', $user->id))
                ->latest()
                ->take(5)
                ->get(),
        ]);
    }
}
