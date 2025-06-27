<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
              /** @var Provider $provider */
            $provider = Socialite::driver('google');

            $googleUser = $provider->stateless()->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => bcrypt(uniqid()), // Password random
                ]
            );

            Auth::login($user);

            return redirect()->intended('/home');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login dengan Google gagal, coba lagi.');
        }
    }


}
