<?php

namespace Ribrit\Auth\Http\Requests\Password;

use Ribrit\Auth\Http\Requests\AuthRequest;

class PasswordCheckRequest extends AuthRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:96||exists:user,email'
        ];
    }
}
