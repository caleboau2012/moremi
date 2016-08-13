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
                'photo' => 'required|mimes:jpeg,bmp,png|max:10000',
            ];

    }

    public function messages()
    {
        return [
            'photo.required'  => 'Your photo is required',
            'photo.mimes'  => 'Only jpeg,bmp and png files are allowed',
            'photo.size'  => 'Photo size must not be more than 5MB',


        ];
    }
}
