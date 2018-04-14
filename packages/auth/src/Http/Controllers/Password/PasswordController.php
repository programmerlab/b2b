<?php

namespace Ribrit\Auth\Http\Controllers\Password;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Ribrit\Auth\Http\Controllers\AuthController;
use Ribrit\Auth\Http\Requests\Password\PasswordCheckRequest as CheckRequest;

class PasswordController extends AuthController
{
    use ResetsPasswords;

    public function getIndex()
    {
        return $this->layout([
            //
        ]);
    }

    public function postCheck(CheckRequest $request)
    {
        Password::broker($this->getBroker())->sendResetLink(
            $request->only('email'), $this->resetEmailBuilder()
        );

        $this->createFormData([
            'success'  => $this->getLangValue('success.send'),
            'trigger' => [
                '#pageLoadModal .close'
            ]
        ]);

        return $this->responseFormData(200);
    }
}