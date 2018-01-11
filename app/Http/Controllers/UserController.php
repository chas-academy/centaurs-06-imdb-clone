<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Redirect;
use Auth;
use App\User;
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
            // TODO: handle message
        } else {
            // TODO: handle
        }
        
    }

    public function updateEmail(Request $request)
    {
        // TODO: Make sure the old email is correct before saving the new on (good practice)
        // Optionally: Force the user to input password to make this change
        if (Auth::check()) {
            if (Auth::user()->id == $userId)
            {
                $user = User::find(Auth::user()->id);
                $user->email = $request->input('new-email');
                $user->save();
                // TODO: Nice message and redirect, maybe?
                return redirect('/')->with('global', 'Your account has been deleted!');
            }
        }
    }

}
