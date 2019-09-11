<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//use Waavi\Sanitizer\Laravel\SanitizesInput;

class StoreTeacher extends FormRequest
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
        return [
            'first_name' => 'min:3|max:250|string|required',
            'last_name' => 'min:3|max:250|string|required',
            'it' => 'min:2|max:2|alpha|required',
            'nid' => 'min:4|string|unique:users,nid|required',
            'password' => 'min:8|string|required',
            'email' => 'min:4|max:250|unique:users,email|email',
            'birth_date' => 'date_format:Y-m-d|before:-17 year|required',
            'gender' => 'max:1|alpha|required',
            'phone_number' => 'min:3|alpha_num|required',
            'cellphone_number' => 'min:3|alpha_num',
            'nacionality' => 'max:3|alpha|required',
            'location' => 'min:4|string|required',
            'address' => 'min:4|string|required',
            'photo' => 'mimes:jpeg,jpg,png|max:2048',
            'status' => 'max:20|alpha|required',
            'area' => 'json|required',
            'acronym' => 'min:3|max:8|string|required',
            'experience' => 'min:5|string',
            'applied_studies' => 'min:5|string',
            'scale' => 'max:60|string',
            'resolution' => 'max:60|string',
            'profession' => 'min:4|string|required'
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
            'acronym' => 'trim|escape',
            'experience' => 'trim',
            'applied_studies' => 'trim',
            'scale' => 'trim|escape',
            'resolution' => 'trim|escape',
            'profession' => 'trim|escape'
        ];
    }*/
}
