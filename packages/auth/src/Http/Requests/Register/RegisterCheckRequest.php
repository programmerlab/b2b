<?php

namespace Ribrit\Auth\Http\Requests\Register;

use Ribrit\Auth\Http\Requests\AuthRequest;

class RegisterCheckRequest extends AuthRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required|max:50|unique:user',
            'email'    => 'required|max:95|email|unique:user',
            'password' => 'required|min:6|max:30|confirmed',
            'terms'    => 'accepted'
        ];
    }
}
