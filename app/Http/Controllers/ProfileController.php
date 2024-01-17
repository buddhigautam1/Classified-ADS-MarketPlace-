<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'image'=>'mimes:png,jpg,jpeg'
        ]);
        $user = User::find(auth()->user()->id);
        $image=$user->avatar;
        if($request->hasFile('image')){
            $image = $request->file('image')->store('public/avatar');
        }
        $user->update([
            'name'=>$request->name,
            'address'=>$request->address,
            'avatar'=>$image
        ]);
      



        return redirect()->back()->with('message','Profile updated');
    }

}
