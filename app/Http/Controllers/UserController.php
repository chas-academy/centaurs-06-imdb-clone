<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Image;

class UserController extends Controller
{
    
    public function profile()
    {
        return view('pages.profile', array('user' => Auth::user()));
    }

    public function updateAvatar(Request $request)
    {

        if($request->hasFile('avatar'))
        {
            $avatar = $request->file('avatar');
            $filename = time() . "." . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/img/avatars/' . $filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }

        return view('pages.profile', array('user' => Auth::user()));

    }

}
