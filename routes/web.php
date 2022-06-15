<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index', ['user' => session('user')]);
});



Route::get('auth/google',[AuthController::class, 'googleRedirect'])->name('auth.google');
Route::get('auth/google/callback',[AuthController::class, 'loginWithGoogle']);
Route::post('auth/signIn',[AuthController::class, 'signIn'])->name('signIn');

Route::get('registerIndex',[RegisterController::class, 'index'])->name('registerIndex');
Route::post('register',[RegisterController::class, 'register'])->name('register');