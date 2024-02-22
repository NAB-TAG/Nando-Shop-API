<?php

use App\Http\Controllers\API\v1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'redirectToAuth']);
Route::post('/signin', [AuthController::class, 'store']);
Route::get('callback', [AuthController::class, 'handleAuthCallback']);
Route::middleware('auth:sanctum')->get('/user', function(Request $request) {
    return $request->user();
});
