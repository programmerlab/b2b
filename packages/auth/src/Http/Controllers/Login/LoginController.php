<?php

namespace Ribrit\Auth\Http\Controllers\Login;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Ribrit\Auth\Http\Controllers\AuthController;
use Ribrit\Auth\Http\Requests\Login\LoginCheckRequest as CheckRequest;

class LoginController extends AuthController
{
    public function getIndex()
    {
        $this->metaData['title'] = $this->getLangValue('title');

        return $this->layout();
    }

    public function postCheck(CheckRequest $request)
    {
        if ($attempt = $this->validAttempt($request)) {
            return $attempt;
        }

        $user = Auth::user();

        Session::forget('tenant_id');
        Session::set('tenant_id', $user->tenant->tenant_id);

        if (strpos($request->server('HTTP_REFERER'), url('/')) === false) {
            $redirect = $user->role_redirect;
        } else {
            $redirect = $request->server('HTTP_REFERER');
        }

        $this->createFormData([
            'redirect' => [
                'url'     => $redirect,
                'message' => $this->getLangValue('success.default')
            ],
            'trigger' => [
                '.close'
            ]
        ]);

        return $this->responseFormData(200);
    }

    protected function validAttempt($request)
    {
        if (!Auth::attempt([
            'email'    => $request->email,
            'password' => $request->password
        ])) {
            $this->createFormData([
                'error' => $this->getLangValue('error.login')
            ]);

            return $this->responseFormData();
        }
    }
}