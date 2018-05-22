<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Image;
use View;
use DB;
use Validator;

use Illuminate\Http\Request;
use Illuminate\Http\Redirect;
use App\Http\Models\User;

class UserController extends Controller
{

    public function updateAvatar(Request $request)
    {
        // Let's validate to make sure it's actually an image, of maximum 2MB
        request()->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('avatar')) {

            $avatar = $request->file('avatar');
            $filename = time() . "." . $avatar->getClientOriginalExtension();

            Image::make($avatar)->resize(300, 300)->save(public_path('/img/avatars/' . $filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();

            return redirect('/')->with('message', 'Your avatar has now been updated!');
        }


    }

    public function deleteAccount($userId)
    {
        if (Auth::check()) {
            if (Auth::user()->id == $userId) {
                DB::table('ledger_watch_lists')->where('user_id', $userId)->delete();
                DB::table('users')->where('id', $userId)->delete();

                return redirect('/')->with('message', 'Your account has been deleted!');
            }
            // TODO: handle message (you have to be signed in)
        } else {
            // TODO: handle
            // Not your account. (Need to be admin.)
        }
    }

    public function updateEmail(Request $request)
    {
        $userId = Auth::user()->id;
        // TODO: Make sure the old email is correct before saving the new on (good practice)
        // Optionally: Force the user to input password to make this change
        if (Auth::check()) {
            if (Auth::user()->id == $userId) {
                $user = User::find(Auth::user()->id);
                $user->email = $request->input('new-email');
                $user->save();

                return redirect('/')->with('message', 'Your email has been updated!');
            }
        }
    }

    public function updatePassword(Request $request)
    {
        $currentPassword = $request->input('current-password');
        $newPassword = $request->input('new-password');

        $validator = Validator::make($request->all(), [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return redirect('/')
                        ->withErrors($validator)
                        ->withInput();
        }

        if (!(Hash::check($currentPassword, Auth::user()->password))) {
            return redirect()->back()->with('error', 'Your current password does not match with the password you provided. Please try again.');
        }

        if ($currentPassword === $newPassword) {
            return redirect('/')->with('error', 'You are trying to change to the same password. Don\'t');
        }

        $user = Auth::user();
        $user->password = bcrypt($newPassword);
        $user->save();

        return redirect('/')->with('message', 'Yey, you changed your password');
    }
    public function getAllUsers() {
        $users = User::all();
        // foreach ($users as $key => $user) {
        //     var_dump($user['name']);
        // }

        $view = view('pages.manage-users')->with('users', $users);

        return $view;
    }
}
