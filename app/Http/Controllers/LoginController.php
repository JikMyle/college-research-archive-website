<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /* 
        Shows login form
    */
    public function index() {
        if(Auth::check()) {
            return redirect('')->with('message', 'Already logged in.');
        }

        return view('auth.login');
    }

    /**
     * Checks if login credentials match a user in the database
     */
    public function authenticate(Request $request) {

        // Retrieves user from database using the input email or username
        $login = $request->input('email');
        $user = User::where('email', $login)->orWhere('username', $login)->first();

        if(!$user) {
            return back()->withErrors([
                'login' => 'Invalid credentials. Please try again.',
            ])->onlyInput('username');
        }

        $credentials = $request->validate([
            'password' => 'required',
        ]);
 
        // Attempts to login using either the username or email
        if (Auth::attempt(['email' => $user->email, 'password' => $request->password]) ||
            Auth::attempt(['username' => $user->username, 'password' => $request->password])) {

            Auth::loginUsingId($user->id);

            // Sets the time the user last logged in to now
            $user->last_login_at = date('Y-m-d H:i:s', time());
            $user->save();

            $request->session()->regenerate();
 
            return redirect()->intended('/admin/users')->with('message', 'Login successful');
        }
 
        return back()->withErrors([
            'login' => 'Invalid credentials. Please try again.',
        ])->onlyInput('username');
    }

    /* 
        Logs out the current user
     */
    public function logout(Request $request) {
        if(Auth::user()) {
            Auth::logout();
 
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect('/login');
    }
}
