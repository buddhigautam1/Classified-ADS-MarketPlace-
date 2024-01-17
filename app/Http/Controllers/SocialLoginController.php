<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class SocialLoginController extends Controller
{
    public function facebookRedirect()
    {
       return Socialite::driver('facebook')->redirect();
    }
    public function loginWithFacebook()
    
    {
        try{
        $user = Socialite::driver('facebook')->user();
        $isUser = User::where('fb_id',$user->id)->first();
        $avatar = $user->getAvatar();
        if($isUser){
            Auth::login($isUser);
            return redirect('/');

        }else{
            $createUser = User::create([
                'name'=>$user->name,
                'email'=>$user->email,
                'fb_id'=>$user->id,
                'avatar'=>$avatar,
            ]);
            Auth::login($createUser);
            return redirect('/');
        }
    }catch(\Exception $exception){
        dd($exception->getMessage());
    }
    }
}
