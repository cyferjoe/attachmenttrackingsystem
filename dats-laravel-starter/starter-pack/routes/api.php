<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LogbookApiController;
use App\Http\Controllers\Api\OpportunityApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (): void {
    Route::post('/register/student', [AuthController::class, 'registerStudent']);
    Route::post('/register/lecturer', [AuthController::class, 'registerLecturer']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('api.token')->group(function (): void {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::get('/opportunities', [OpportunityApiController::class, 'index']);
        Route::post('/opportunities', [OpportunityApiController::class, 'store']);
        Route::post('/opportunities/{opportunity}/apply', [OpportunityApiController::class, 'apply']);

        Route::get('/logbooks', [LogbookApiController::class, 'index']);
        Route::post('/logbooks', [LogbookApiController::class, 'store']);
        Route::patch('/logbooks/{logbookEntry}/review', [LogbookApiController::class, 'review']);
    });
});
