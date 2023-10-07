<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function callback()
    {
        $user = Socialite::driver('facebook')->user();
        
        // $user = User::create([
        //     'name' => $user->getName(),
        //     'email' => $user->getEmail(),
        // ]);

        $user=User::firstOrCreate([
            'email'=>$user->getEmail()
        ],[
            'name'=>$user->getName(),
        ]);

        auth()->login($user);

        return redirect()->to('/dashboard');
    }
}
