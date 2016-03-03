<?php

namespace FriendsPlus\Http\Requests;

use FriendsPlus\Http\Requests\Request;

class SignUpRequest extends Request
{

    /**
    * Redirect route when errors occur.
    *  
    * @var string
    */
   protected $redirectRoute = 'auth.signup';

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
          'full_name' => 'required',
          'email' => 'required|unique:users|email|max:255',
          'username' => 'required|unique:users|alpha_dash|max:15',
          'password' => 'required|min:6',
          'confirm_password' => 'required|same:password',
          'terms' => 'accepted'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'terms.accepted' => 'You must agree with the terms.'
        ];
    }

}
