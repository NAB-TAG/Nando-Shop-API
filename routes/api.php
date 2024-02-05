<?php

use App\Http\Controllers\API\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/prueba', function () {
    return ["Probando el deploy"];
});
// Route::get('/login/google', function (){
//     return Socialite::driver('google')->stateless()->redirect();
// });
// Route::get('/login/google/callback', function () {
//     $user_google = Socialite::driver('google')->stateless()->user();
    
//     $user = new User();
//     $user->google_id = $user_google->id;
//     $user->name = $user_google->name;
//     $user->email = $user_google->email;

//     if($user->save()){
//         return ["perfecto"];
//     }
//     return ["no tan perfecto"];
// });


Route::get('auth', [AuthController::class, 'redirectToAuth']);
Route::get('auth/callback', [AuthController::class, 'handleAuthCallback']);
// Route::group(['middleware' => 'cors'], function () {
// });
Route::get('cookie', [AuthController::class, 'verificarCookie']);
Route::get('user', [AuthController::class, 'user']);