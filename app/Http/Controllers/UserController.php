<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Redirect;
use Auth;
use Image;
use View;
use DB;

class UserController extends Controller
{
    
    public function profile()
    {
        return Auth::user();
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

        return array('user' => Auth::user());

    }

    public function deleteAccount($userId)
    {
        if (Auth::check()) {
            if (Auth::user()->id == $userId)
            {
                DB::table('users')->where('id', $userId)->delete();
                
                return redirect('/')->with('global', 'Your account has been deleted!');
            }
            dd("You are not allowed to remove this user");
        } else {
            var_dump('You need to be logged in');
        }
        
    }

}
