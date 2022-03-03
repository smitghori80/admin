<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthenticationRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'name' => 'required',
            'email' =>  'required|email|unique:users',
            'password' =>  [
                'required',
                'max:20',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&.]/',
                'confirmed',
            ],
        ];
    }
    public function messages()
    {
        return [

            'name.required' => 'Last name is required!',
            'email.required' => 'Email is required!',
            'password.required' => 'Password is required!',
            'password.regex' => 'Password field in at least one uppercase, lowercase, special character and number required!',

        ];
    }
}
