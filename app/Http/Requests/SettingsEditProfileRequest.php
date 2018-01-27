<?php

namespace FriendsPlus\Http\Requests;

use FriendsPlus\Http\Requests\Request;
use Auth;

class SettingsEditProfileRequest extends Request
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
            'name' => 'required',
            'username' => 'required|alpha_dash|max:15|unique:users,username,' . Auth::user()->id,
            'location' => 'max:30',
            'website' => 'url',
            'gender' => 'numeric|between:0,3'
        ];
    }
}
