<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->is_admin == 1) {
            return redirect()->route('admin.route');
        } else {
            // Check if there's a previous URL in the request
            if ($request->has('previous_url')) {
                // Retrieve the previous URL and redirect the user to it
                $previousUrl = $request->input('previous_url');
                return redirect()->to($previousUrl);
            } else {
                // Redirect the user to a default page after login (e.g., home)
                return redirect()->route('home');
            }
        }
    }

    public function showAdminLoginForm()
    {
        return view('auth.admin-login', ['url' => route('admin-login'), 'title' => 'Admin']);
    }
}
