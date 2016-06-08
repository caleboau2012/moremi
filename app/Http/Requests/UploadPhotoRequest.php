<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class UploadPhotoRequest extends Request
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
                'profile_id' => 'required|numeric',
                'photo' => 'required|mimes:jpeg,bmp,png|max:5000',
            ];

    }

    public function messages()
    {
        return [
            'profile_id.required' => 'Your user Id is required!',
            'photo.required'  => 'Your photo is required',
            'photo.mimes'  => 'Only jpeg,bmp and png files are allowed',
            'photo.size'  => 'Photo size must not be more than 5MB',


        ];
    }
}
