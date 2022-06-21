<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function googleRedirect(){
        return Socialite::driver('google')->redirect();
    }

    public function loginWithGoogle(){
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('email', $googleUser->email)->first(); 
        if(!$user){
            $newUser = new User();
            $newUser->email = $googleUser->email;
            $newUser->name = $googleUser->name;
            $newUser->password = '';
            $newUser->rating = 100;
            $newUser->balance = 1000;
            $newUser->save();
            session(['user' => $newUser]);
        }else{
            session(['user' => $user]);
        }

        return to_route('index');
    }

    public function signIn(Request $request){
        $user = User::where('email', $request->email)->where('password', $request->password)->first(); 
        session(['user' => $user]);
        if($user)
       return $user;
    }
}
