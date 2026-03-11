<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
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
Route::get('/test', function () {
    \Illuminate\Support\Facades\Log::info('Test route was hit!');
    return response()->json(['message' => 'Test route works'], 200);
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


?>