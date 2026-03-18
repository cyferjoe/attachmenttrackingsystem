<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LecturerReviewController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\OpportunityController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OpportunityController::class, 'welcome'])->name('home');
Route::get('/manual', [ManualController::class, 'index'])->name('manual');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');

    Route::get('/register/student', [RegisteredUserController::class, 'createStudent'])->name('register.student');
    Route::post('/register/student', [RegisteredUserController::class, 'storeStudent'])->name('register.student.store');

    Route::get('/register/lecturer', [RegisteredUserController::class, 'createLecturer'])->name('register.lecturer');
    Route::post('/register/lecturer', [RegisteredUserController::class, 'storeLecturer'])->name('register.lecturer.store');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::get('/opportunities', [OpportunityController::class, 'index'])->name('opportunities.index');

Route::middleware(['auth', 'role:student'])->group(function (): void {
    Route::post('/opportunities/{opportunity}/apply', [ApplicationController::class, 'store'])->name('applications.store');
    Route::get('/student/applications', [ApplicationController::class, 'index'])->name('student.applications.index');

    Route::get('/student/logbooks', [LogbookController::class, 'index'])->name('student.logbooks.index');
    Route::get('/student/logbooks/create', [LogbookController::class, 'create'])->name('student.logbooks.create');
    Route::post('/student/logbooks', [LogbookController::class, 'store'])->name('student.logbooks.store');
});

Route::middleware(['auth', 'role:lecturer'])->group(function (): void {
    Route::get('/lecturer/opportunities/create', [OpportunityController::class, 'create'])->name('lecturer.opportunities.create');
    Route::post('/lecturer/opportunities', [OpportunityController::class, 'store'])->name('lecturer.opportunities.store');

    Route::get('/lecturer/applications', [ApplicationController::class, 'lecturerIndex'])->name('lecturer.applications.index');
    Route::patch('/lecturer/applications/{application}', [ApplicationController::class, 'updateStatus'])->name('lecturer.applications.update');

    Route::get('/lecturer/reviews', [LecturerReviewController::class, 'index'])->name('lecturer.reviews.index');
    Route::get('/lecturer/reviews/{logbookEntry}', [LecturerReviewController::class, 'show'])->name('lecturer.reviews.show');
    Route::patch('/lecturer/reviews/{logbookEntry}', [LecturerReviewController::class, 'update'])->name('lecturer.reviews.update');
});
