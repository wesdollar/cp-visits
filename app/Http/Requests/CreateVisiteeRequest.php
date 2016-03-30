<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateVisiteeRequest extends Request
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
    public function rules() {
        return [
            'first' => 'required',
            'last' => 'required',
            'city' => 'required_with:address',
            'state' => 'max:2|required_with:city,address',
            'zip' => 'required_with_all:address,city,state',
            'email' => 'unique:visitees|email',
        ];
    }
}
