<?php

namespace Ribrit\Auth\Http\Requests\Register\Email;

use Ribrit\Auth\Http\Requests\AuthRequest;

class RegisterEmailCheckRequest extends AuthRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|max:96|exists:user,email,active,no'
        ];
    }
}
