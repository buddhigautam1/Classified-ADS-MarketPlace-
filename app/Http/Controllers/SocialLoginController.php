<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('fb_id', $user->id)->first();
            $avatar = $user->getAvatar();
            if ($isUser) {
                Auth::login($isUser);

                return redirect('/');
            } else {
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'fb_id' => $user->id,
                    'avatar' => $avatar,
                ]);
                Auth::login($createUser);

                return redirect('/');
            }
        } catch (\Exception $exception) {
            report($exception);

            return redirect()->route('login')->withErrors([
                'facebook' => 'Unable to login with Facebook. Please try again.',
            ]);
        }
    }
}
