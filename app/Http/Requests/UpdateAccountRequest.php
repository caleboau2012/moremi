<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateAccountRequest extends Request
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
            'first_name'    => 'required',
            'last_name'     => 'required',
            'phone'         => 'required',
            'email'         => 'required|email',
            'card_no'       => 'required|digits:16',
            'expiry_month'  => 'required|digits_between:1,2',
            'expiry_year'   => 'required|digits:4',
            'cvv'           => 'required|digits:3'
        ];
    }
}
