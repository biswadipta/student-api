<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| These routes are stateless and intended for REST API usage.
| They are automatically prefixed with /api when registered.
|--------------------------------------------------------------------------
*/

// Health/Test route
Route::get('/ping', function () {
    return response()->json([
        'message' => 'API is working'
    ], 200);
});

// Student Resource Routes
Route::apiResource('students', StudentController::class);