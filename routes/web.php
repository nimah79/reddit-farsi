<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'home']);
Route::get('/signup', [App\Http\Controllers\AuthController::class, 'signup']);
Route::post('/signup', [App\Http\Controllers\AuthController::class, 'attemptSignup']);
Route::get('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'attemptLogin']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
