<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LoginRequest extends Request
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
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'phone' => 'max:16',
            'facebook_id' => 'required|numeric',
            'email' => 'sometimes|email',
        ];

    }

    public function messages()
    {
        return [
            'first_name.required' => 'Your first name is required!',
            'last_name.required' => 'Your last name is required!',
            'photo.required'  => 'Your photo is required',
            'photo.max'  => 'Phone number is not valid',
            'facebook_id.required'  => 'Facebook ID is required',
            'email.required'  => 'Email is required',

        ];
    }
}
