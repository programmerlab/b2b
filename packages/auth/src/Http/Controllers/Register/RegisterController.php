<?php

namespace Ribrit\Auth\Http\Controllers\Register;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Ribrit\Auth\Http\Controllers\AuthController;
use Ribrit\Auth\Http\Requests\Register\RegisterCheckRequest as CheckRequest;
use Ribrit\Tenant\Database\Contracts\User\UserContract;

class RegisterController extends AuthController
{
    public function getIndex()
    {
        return $this->layout([
            //
        ]);
    }

    public function postCheck(CheckRequest $request, UserContract $userContract)
    {
        $request->offsetSet('password', bcrypt($request->password));
        $request->offsetSet('main_role', setting('user.user_role'));
        $request->offsetSet('active', 'yes');
        $request->offsetSet('token', $this->getToken());

        $user = $userContract->activation($request, $userContract->add($request));

        /*
        $this->active(
            $userContract->activation(
                $request,
                $userContract->add($request)
            ),
            $request
        );
        */

        $this->createFormData([
            'success'  => $this->getLangValue('success.default'),
            'redirect' => [
                'url'     => route_name('homeGetIndex'),
                'message' => $this->getLangValue('success.default')
            ]
        ]);

        Auth::login($user);

        Session::flash('success', [
            $this->getLangValue('success.check')
        ]);

        return $this->responseFormData(200);
    }

    protected function active($user, $request)
    {
        $this->draftMail([
            'to'      => ['email' => $user->email, 'name' => $user->name],
            'draft'   => tenant_site('email_user_valid_message'),
            'replace' => [
                $user['namesurname'],
                $user['name'],
                $user['email'],
                $user['phone'],
                $this->getLangValue('valid_email_subject'),
                null,
                '<a href="' . url(route_name('authRegisterEmailGetIndex')) . '?token=' . $request->token . '">' . $request->token . '</a>'
            ],
        ]);
    }
}