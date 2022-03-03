<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AuthenticationProfileRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
            'gender' => 'required',
            'stateId' => 'required',
            'city' => 'required',
            'countrieId' => 'required',
            'hobbies' => 'required'
        ];
    }
    public function messages()
    {
        return [

            'name.required' => ' Name is required!',
            'email.required' => 'Email is required!',
            'gender.required' => 'Gender is required!',
            'stateId.required' => 'state is required!',
            'city.required' => 'city is required!',
            'countrieId.required' => 'countrie is required!',
            'hobbies.required' => 'Select at least one hobbie!',

        ];
    }
}
