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
        ];
    }
}
