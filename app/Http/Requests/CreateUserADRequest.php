<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserADRequest extends FormRequest
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
            'first_name' => 'min:3|max:250|string|required',
            'last_name' => 'min:3|max:250|string|required',
            'it' => 'min:2|max:2|alpha|required',
            'nid' => 'min:4|integer|unique:users,nid|required',
            'password' => 'min:8|alpha_dash|required',
            'email' => 'min:4|max:250|unique:users,email|email',
            'birth_date' => 'date_format:Y-m-d|before:-1 year|required',
            'gender' => 'max:1|alpha|required',
            'phone_number' => 'min:3|alpha_num|required',
            'cellphone_number' => 'min:3|alpha_num',
            'nacionality' => 'max:3|alpha|required',
            'location' => 'min:4|string|required',
            'address' => 'min:4|string|required',
            'photo' => 'mimes:jpeg,jpg,png|max:1024',
            'status' => 'max:20|alpha|required',
        ];
    }
}
