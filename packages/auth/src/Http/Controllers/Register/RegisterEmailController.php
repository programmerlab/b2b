<?php

namespace Ribrit\Auth\Http\Controllers\Register;

use Illuminate\Support\Facades\Auth;
use Ribrit\Auth\Http\Controllers\AuthController;
use Ribrit\Auth\Http\Requests\Register\Email\RegisterEmailCheckRequest as CheckRequest;
use Ribrit\Auth\Http\Requests\Register\Email\RegisterEmailIndexRequest as IndexRequest;
use Ribrit\Mars\Database\Models\User\UserActivation;
use Ribrit\Mars\Helpers\DateHelper;
use Ribrit\Tenant\Database\Contracts\User\UserContract;

class RegisterEmailController extends AuthController
{
    public function getIndex(IndexRequest $request)
    {
        if ($this->validToken($request->token)) {
            $this->layoutCode = 'success';
        } else {
            $this->layoutCode = 'fail';
        }

        return $this->layout([
            //
        ]);
    }

    protected function validToken($token)
    {
        $row = UserActivation::whereToken($token)
            ->where('created_at', '>=', DateHelper::yesterday())
            ->orderBy('created_at', 'desc')
            ->first();

        if ($row) {

            $row->user->active = 'yes';
            $row->user->save();

            Auth::login($row->user, true);

            $row->delete();
        }

        return $row;
    }

    public function postCheck(CheckRequest $request, UserContract $userContract)
    {
        $request->offsetSet('token', $this->getToken());
        $userContract->activation($request, $userContract->email($request->email));

        $this->createFormData([
            'success'  => $this->getLangValue('success.new_token'),
            'redirect' => [
                'url'     => route_name('homeGetIndex'),
                'message' => $this->getLangValue('success.new_token')
            ]
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