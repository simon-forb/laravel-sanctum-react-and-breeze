<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', function (Request $request) {
   $credentials = $request->validate([
       'email' => 'required|email',
       'password' => 'required'
   ]);

   if (Auth::attempt($credentials)) {

       $request->session()->regenerate();

       return new Response([
           'message' => 'success',
       ], 200);
   }

   return new Response([
       'message' => 'failure',
   ], 401);
});

Route::post('/logout', function (Request $request) {

    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return new Response([
        'message' => 'logged out',
    ], 200);
});
