<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditUserADRequest extends FormRequest
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
        $userId = $this->route('userid');
        return [
            'first_name' => 'min:3|max:250|string|required',
            'last_name' => 'min:3|max:250|string|required',
            'it' => 'min:2|max:2|alpha|required',
            'nid' => [
                'min:4',
                'integer',
                Rule::unique('users')->ignore($user->id),
                'required'
            ],
            //'nid' => 'min:4|integer|unique:users,nid|required',
            'password' => 'min:8|string',
            'email' => [
                'min:4',
                'max:250',
                Rule::unique('users')->ignore($user->id),
                'email'
            ],
            //'email' => 'min:4|max:250|unique:users,email,'.$userId.'|email',
            'birth_date' => 'date_format:Y-m-d|before:-1 year|required',
            'gender' => 'max:1|alpha|required',
            'phone_number' => 'min:3|alpha_num|required',
            'cellphone_number' => 'min:3|alpha_num',
            'nacionality' => 'max:3|alpha|required',
            'location' => 'min:4|string|required',
            'address' => 'min:4|string|required',
            'photo' => 'mimes:jpeg,jpg,png|max:2048',
            'status' => 'max:20|alpha|required',
            'roles' => 'json'
        ];
    }
}
