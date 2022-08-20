<?php

use App\Models\Item;
use App\Models\User;
use App\Models\Category;
use App\Events\ChatEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function (Request $request) {
    if(isset($request->category_id))
        return view('index', ['items' => Item::where('category_id', '=', $request->category_id)->get(), 'categories' => Category::all()]);

    return view('index', ['items' => Item::all(), 'categories' => Category::all()]);
})->name('index');

Route::prefix('facebook')->name('facebook.')->group( function(){
    Route::get('auth', [AuthController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [AuthController::class, 'callbackFromFacebook'])->name('callback');
});

Route::get('auth/google',[AuthController::class, 'googleRedirect'])->name('auth.google');
Route::get('auth/google/callback',[AuthController::class, 'loginWithGoogle']);
Route::post('auth/signIn',[AuthController::class, 'signIn'])->name('signIn');

Route::post('send',[UserController::class, 'send']);
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

Route::get('/admin', function (Request $request) {
    // dd(User::where('id', 1)->update(['is_admin' => 1]));
    if(session('user'))
        if(session('user')->is_admin == 1)
            return view('admin', ['users' => User::get()]);

    return view('welcome');
});


Route::post('userDelete', function (Request $request){
    return User::find($request->user_id)->delete();
});

Route::get('delete', function (Request $request){
    if(session('user'))
        if(session('user')->is_admin == 1){
            $i = item::where('id', $request->item_id)->update(['status' => 'удален Админом']);
            
        }
            return redirect('index');
});


