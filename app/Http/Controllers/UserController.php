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

    /*
        Updates the user's information
     */
    public function updateAccount(UserRequest $request)
    {
        $updated = ['updated' => 'info'];
        $message = ['error' => 'Could not update account information.'];

        $user = $request->user();

        $validated = $request->validated();

        if(isset($request->btnUpdateInfo)) {
            $message = $this->updateAccountInfo($user, $validated);
        }

        elseif(isset($request->btnUpdatePassword)) {
            $message = $this->updatePassword($user, $validated);
            $updated['updated'] = 'password';
        }

        $user->save();

        if(key($message) == 'error') {
            return back()->withErrors([$message])->with($updated);
        }

        return redirect()->route('account')->with($message)->with($updated);
    }

    private function updatePassword($user, $validated) {

        if(!Hash::check($validated['password'], $user->password)) {
            $updated['updated'] = 'password';
            return ['error' => 'Password field must match current password.'];
        }

        $user->password = $validated['new_password'];
        return ['success' => 'Password successfully updated'];
    }

    private function updateAccountInfo($user, $validated) {
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

        return ['success' => 'Account information successfully updated.'];
    }
}
