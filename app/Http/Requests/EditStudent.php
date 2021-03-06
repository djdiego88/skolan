<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
//use Waavi\Sanitizer\Laravel\SanitizesInput;

class EditStudent extends FormRequest
{
    //use SanitizesInput;
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
                'string',
                Rule::unique('users')->ignore($userId),
                'required'
            ],
            'password' => 'min:8|string',
            'email' => [
                'min:4',
                'max:250',
                Rule::unique('users')->ignore($userId),
                'email'
            ],
            'birth_date' => 'date_format:Y-m-d|required',
            'gender' => 'max:1|alpha|required',
            'phone_number' => 'min:3|alpha_num|required',
            'cellphone_number' => 'min:3|alpha_num',
            'nacionality' => 'max:3|alpha|required',
            'location' => 'min:4|string|required',
            'address' => 'min:4|string|required',
            'photo' => 'mimes:jpeg,jpg,png|max:2048',
            'status' => 'max:20|alpha|required',
            'roles' => 'json',
            'neighborhood' => 'min:3|string',
            'commune' => 'min:3|string',
            'socioeconomic_level' => '',
            'health_care' => 'min:3|string|required',
            'blood_type' => 'min:2|string|required',
            'allergies' => 'min:5|string',
            'diseases' => 'min:5|string'
        ];
    }

    /**
     *  Filters to be applied to the input.
     *  https://github.com/Waavi/Sanitizer#available-filters
     *
     * @return array
     */
    /*public function filters()
    {
        return [
            'first_name' => 'trim|capitalize|escape',
            'last_name' => 'trim|capitalize|escape',
            'it' => 'trim',
            'nid' => 'trim',
            'email' => 'trim|lowercase',
            'birth_date' => 'trim',
            'gender' => 'trim',
            'phone_number' => 'trim|escape',
            'cellphone_number' => 'trim|escape',
            'nacionality' => 'trim',
            'location' => 'trim|escape',
            'address' => 'trim|escape',
            'status' => 'trim|escape',
            'neighborhood' => 'trim|escape',
            'commune' => 'trim|escape',
            'health_care' => 'trim|escape',
            'blood_type' => 'trim|escape',
            'allergies' => 'trim',
            'diseases' => 'trim'
        ];
    }*/
}
