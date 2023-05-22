<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class LoginWithGoogleController extends Controller
{
     public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
       
            $findUser = User::where('email', $user->email)->first();

            $findUserGoogle = User::where('google_id', $user->id)->first();
       
            if($findUserGoogle){
       
                Auth::login($findUserGoogle);
      
                return redirect()->intended('empresa.list');
       
            } else if ($findUser) {
                
                $findUser->google_id = $user->id;
                $findUser->save();

                Auth::login($findUser);

                return redirect()->intended('empresa.list');
            } else {
                return redirect(url('google/error'));
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}