<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view('register');
    }

    public function register(Request $request){
        if(!User::where('email', $request->email)->first()){
            $newUser = new User();
            $newUser->email = $request->email;
            $newUser->name = $request->name;
            $newUser->password = $request->password;
            $newUser->rating = 100;
            $newUser->balance = 1000;
            $newUser->save();
            session(['user' => $newUser]);
    
            return true;
        }
        else return false;
      
    }
}
