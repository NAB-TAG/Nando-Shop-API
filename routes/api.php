<?php

use Illuminate\Support\Facades\Route;


Route::prefix('auth')->group(
	base_path('routes/api/v1/auth.php'),
);











// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

