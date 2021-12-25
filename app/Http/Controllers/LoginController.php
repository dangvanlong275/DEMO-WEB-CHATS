<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }
    public function handleProviderCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }
        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            Auth::login($existingUser, true);
        } else {
            $newUser                    = new User;
            $newUser->name              = $user->getName();
            $newUser->email             = $user->getEmail();
            $newUser->password          = bcrypt("12345678");
            $newUser->avatar            = $user->getAvatar();
            $newUser->save();

            Auth::login($newUser, true);
        }

        return redirect("/index");
    }
}
