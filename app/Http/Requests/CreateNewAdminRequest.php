<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateNewAdminRequest extends Request
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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'An Email address is required',
            'email.email' => 'This Email address is not in a valid format',
            'email.max' => 'This Email address exceeds the maximum length allowed for an email',
            'email.unique'=>'This Email address is already in use',
            'password.required'  => 'A Password is required',
            'password.min' => 'A password must contain atleast 6 characters',
            'password.confirmed' => 'Password and Password Confirmation fields do not match'
        ];
    }
}
