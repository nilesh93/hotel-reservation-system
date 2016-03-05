<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateProfileRequest extends Request
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
            'name' => 'required|max:255',
            'ID' => 'required',
            'telephone' => 'required|min:10|max:15',
            'address_line1' => 'required',
            'city' => 'required',
            'province' => 'required',
            'zipCode' => 'required',
            'country' => 'required'
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
            'name.required' => 'Your name is required',
            'name.max' => 'The name you entered is too long (maximum length is 255 characters)',
            'ID.required' => 'Your NIC/ Passport Number is required',
            'telephone.required' => 'Your telephone number is required',
            'telephone.min' => 'Your telephone number should have between 10 and 15 numbers.',
            'telephone.max' => 'Your telephone number should have between 10 and 15 numbers.',
            'address_line1.required' => 'Address Line 1 is required',
            'city.required' => "City is required",
            'province.required' => "Your province/ State is required",
            'zipCode.required' => "Zip Code is required",
            'country.required' => "Your Country is required"
        ];
    }
}
