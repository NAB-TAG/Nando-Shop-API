<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/login/google/callback', function (){
//     $user = Socialite::driver('google')->stateless()->user();
//     // return $user;
//     dd($user);
// });
// Route::get('/redirect', function () {
//     return Socialite::driver('google')->stateless()->redirect();
// });
