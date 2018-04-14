<?php

namespace Ribrit\Auth\Http\Requests\Register\Email;

use Ribrit\Auth\Http\Requests\AuthRequest;

class RegisterEmailIndexRequest extends AuthRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => 'required'
        ];
    }
}
