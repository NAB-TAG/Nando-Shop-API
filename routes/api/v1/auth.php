<?php

use App\Http\Controllers\API\v1\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'redirectToAuth']);
Route::post('/register', [AuthController::class, 'store']);
Route::get('callback', [AuthController::class, 'handleAuthCallback']);