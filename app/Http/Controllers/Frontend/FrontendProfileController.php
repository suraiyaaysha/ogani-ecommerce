<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;



use Illuminate\Validation\ValidationException;

class FrontendProfileController extends Controller
{
    // Controller is protected by auth middleware
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Controller is protected by auth middleware

    public function index()
    {
        return view('frontend/profile/edit');
    }

    public function update(User $user, Request $request)
    {

        // Profile photo
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = $file->hashName();
            $file->move('uploads/profile-img', $filename);

            // Delete previous profile photo
            if ($user->profile_photo) {
                $previousPhotoPath = public_path($user->profile_photo);
                if (file_exists($previousPhotoPath)) {
                    File::delete($previousPhotoPath);
                }
            }

            $user->profile_photo = 'uploads/profile-img/' . $filename; // Set the new profile photo URL
        }
        // Profile photo

            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                // 'profile_photo' => $url,
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

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

}
