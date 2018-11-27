<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOptionRequest extends FormRequest
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
            'site_name' => 'min:3|max:250|string|required',
            'site_description' => 'min:4|string|required',
            'admin_email' => 'email|required',
            'items_per_page' => 'integer|min:1|max:70|required',
            'google_analytics_id' => 'max:30|alpha_dash',
            'site_logo' => 'mimes:jpeg,jpg,png|max:2048',
            'site_style' => 'min:1|max:40|string|required',
            'twitter_account' => 'max:16|alpha_dash',
            'facebook_url' => 'url',
            'google_url' => 'url',
            'instagram_account' => 'max:30|alpha_dash',
            'youtube_url' => 'url',
            'nit' => 'min:3|max:30|string',
            'telephone' => 'min:7|max:12|string',
            'state' => 'min:3|max:80|string|required',
            'city' => 'min:3|max:80|string|required',
            'principal' => 'min:4|max:150|string',
            'secretary' => 'min:4|max:150|string',
            'min_qualification' => 'integer|min:1|max:100|required',
            'max_qualification' => 'integer|min:1|max:100|required',
            'min_qualification_pass' => 'numeric|min:1|max:100|required',
            'decimal_positions' => 'numeric|min:0|max:5|required',
        ];
    }
}
