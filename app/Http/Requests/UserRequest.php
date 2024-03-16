<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    protected $errorBag = 'userInfo';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->is_admin || $this->user() == Auth::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Default rules when registering user
        $rules = [
            'username' => 'required|unique:users|max:24',
            'password' => ['required', 'confirmed', Password::min(8)],
            // 'email' => 'required|email|unique:users',
            // 'access_level' => 'required',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
        ];

        // Rules for when user updates their account info
        if(isset($this->btnUpdateInfo)) {

            $rules['username'] = [
                'required',
                Rule::unique('users')->ignore($this->user()->id),    // Ignores user's own model when checking if unique
                'max:24'
            ];

            $rules['password'] = '';

            $rules['email'] = [
                'required',
                Rule::unique('users')->ignore($this->user()->id),    // Ignores user's own model when checking if unique
                'email'
            ];

            $rules['access_level'] = '';
        }

        // Rules for when user updates their password
        if(isset($this->btnUpdatePassword)) {
            $this->errorBag = 'userPassword';

            $rules = [
                'password' => ['required'],
                'new_password' => ['required', 'confirmed', Password::min(8)],
            ];
        }

        return $rules;
    }
}
