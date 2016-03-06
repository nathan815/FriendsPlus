<?php

namespace FriendsPlus\Http\Requests;

use FriendsPlus\Http\Requests\Request;

class NewStatusRequest extends Request
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
            'body' => 'required|max:1000'
        ];
    }
}
