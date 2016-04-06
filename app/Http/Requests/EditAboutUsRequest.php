<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditAboutUsRequest extends Request
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
            'bannerImg' => 'mimes:jpeg,png|max:500'
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
            'bannerImg.required' => 'Banner Image is required.',
            'bannerImg.size' => 'Please upload an image under 500 KB.',
            'bannerImg.mimes' => 'Banner Image must be in .jpg, .jpeg or .png formats',
        ];
    }
}
