<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AIController;

/*
|--------------------------------------------------------------------------
| Public routes (NO AUTH)
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Protected routes (AUTH REQUIRED)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // simple DB + auth test
    Route::get('/me', function () {
        return response()->json([
            'user' => request()->user()
        ]);
    });


    // AI endpoint
    
});
