<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
// use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Controller is protected by auth middleware
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Controller is protected by auth middleware

    public function index()
    {
        return view('admin/profile/edit');
    }

    public function update(User $user, Request $request)
    {
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'updated_at' => now()
        ]);
        
        return back()->withSuccess('User Updated successfully');

    }

    public function updatePassword(Request $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',

            // 'old_password' =>'required',
            // 'new_password' =>'min:8|required_with:confirm_password|same:confirm_password,',
            // 'confirm_password' =>'min:8|same:new_password',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");

    }

}
