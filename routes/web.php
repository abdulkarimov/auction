<?php

use App\Models\Item;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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
    return view('index', ['items' => Item::all()]);
})->name('index');



Route::get('auth/google',[AuthController::class, 'googleRedirect'])->name('auth.google');
Route::get('auth/google/callback',[AuthController::class, 'loginWithGoogle']);

Route::prefix('facebook')->name('facebook.')->group( function(){
    Route::get('auth', [AuthController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [AuthController::class, 'callbackFromFacebook'])->name('callback');
});

Route::post('auth/signIn',[AuthController::class, 'signIn'])->name('signIn');

Route::get('registerIndex',[RegisterController::class, 'index'])->name('registerIndex');
Route::post('register',[RegisterController::class, 'register'])->name('register');


Route::get('addItem',[UserController::class, 'addItem'])->name('addItem');
Route::post('itemStore',[UserController::class, 'itemStore'])->name('itemStore');

Route::get('bid/{id}',[UserController::class, 'bid'])->name('bid');
Route::get('buy/{id}',[UserController::class, 'buy'])->name('buy');
Route::get('showItems',[UserController::class, 'showItems'])->name('showItems');
Route::get('delete/{id}',[UserController::class, 'deleteItem'])->name('delete');

Route::get('myBuyLots',[UserController::class, 'myBuyLots'])->name('myBuyLots');

Route::get('good/{id}',[UserController::class, 'good'])->name('good');
Route::get('bad/{id}',[UserController::class, 'bad'])->name('bad');

Route::get('/searchItem',  [UserController::class, 'searchItem']);