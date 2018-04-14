<?php

namespace Ribrit\Auth\Http\Requests\Login;

use Ribrit\Auth\Http\Requests\AuthRequest;

class LoginCheckRequest extends AuthRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'     => 'required|email|max:96|exists:user,email',
            'password'  => 'required|min:6|max:30'
        ];
    }
}
