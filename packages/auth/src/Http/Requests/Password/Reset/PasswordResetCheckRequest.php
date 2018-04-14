<?php

namespace Ribrit\Auth\Http\Requests\Password\Reset;

use Ribrit\Auth\Http\Requests\AuthRequest;

class PasswordResetCheckRequest extends AuthRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token'    => 'required|exists:user_password_reset,token',
            'email'    => 'required|email|exists:user_password_reset,email',
            'password' => 'required|min:6|max:30|confirmed'
        ];
    }
}
