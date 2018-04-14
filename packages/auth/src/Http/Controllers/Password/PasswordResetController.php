<?php

namespace Ribrit\Auth\Http\Controllers\Password;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Ribrit\Auth\Http\Controllers\AuthController;
use Ribrit\Auth\Http\Requests\Password\Reset\PasswordResetCheckRequest as CheckRequest;
use Ribrit\Auth\Http\Requests\Password\Reset\PasswordResetIndexRequest as IndexRequest;
use Ribrit\Mars\Database\Contracts\User\UserContract;

class PasswordResetController extends AuthController
{
    use ResetsPasswords;

    public function __construct(UserContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;
    }

    public function getIndex(IndexRequest $request)
    {
        return $this->layout([
            //
        ]);
    }

    public function postCheck(CheckRequest $request)
    {
        $credentials = $this->getResetCredentials($request);
        $broker      = $this->getBroker();
        $response    = Password::broker($broker)->reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                $this->createFormData([
                    'success'  => $this->getLangValue('success.password'),
                    'redirect' => [
                        'url'     => route_name('homeGetIndex'),
                        'message' => $this->getLangValue('success.password'),
                    ]
                ]);

                return $this->responseFormData(200);
            default:
                $this->createFormData([
                    'error' => $this->getLangValue('error.password')
                ]);

                return $this->responseFormData(400);
        }

        return $this->responseFormData(500);
    }
}