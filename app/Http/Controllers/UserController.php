<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{

    public function showAccountSettings()
    {
        return view('account-settings', ['user' => Auth::user()]);
    }

    public function showAccountSecurity() {
        return view('account-security', ['user' => Auth::user()]);
    }

    /*
        Updates the user's information
     */
    public function updateInfo(UserRequest $request)
    {
        $updated = ['updated' => 'info'];
        $message = ['error' => 'Could not update account information.'];
        $errorBagName = 'userInfo';

        $user = $request->user();

        $validated = $request->validated();

        $oldEmail = $user->email;
        $newEmail = $validated['email'];

        $user->username = $validated['username'];
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->email = $newEmail;

        if($oldEmail != $newEmail) {
            event(new Registered($user));   // Sends verification email to new user's email
            $user->email_verified_at = null;
        }

        $message = ['success' => 'Account information successfully updated.'];

        if(key($message) == 'error') {
            return back()->withErrors([$message], $errorBagName)->with($updated);
        }

        $user->save();

        return redirect()->route('account')->with($message)->with($updated);
    }

    public function updatePassword(UserRequest $request) {
        $updated = ['updated' => 'password'];
        $message = ['error' => 'Could not update account information.'];
        $errorBagName = 'userPassword';

        $user = $request->user();

        $validated = $request->validated();

        if(!Hash::check($validated['password'], $user->password)) {
            $message = ['error' => 'Password field must match current password.'];
        }

        $user->password = $validated['new_password'];
        $message = ['success' => 'Password successfully updated'];

        if(key($message) == 'error') {
            return back()->withErrors([$message], $errorBagName)->with($updated);
        }

        $user->save();

        return redirect()->route('account-security')->with($message)->with($updated);
    }
}
