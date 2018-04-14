<?php

namespace Ribrit\Mars\Http\Controllers\Admin\Account;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Ribrit\Mars\Database\Contracts\User\UserContract;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class ApplicationController extends AdminController
{
    public function __construct(UserContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;
    }

    public function getIndex()
    {
        if (request('select') && $this->contract->validTenant(request('select'))) {
            return $this->createSession();
        }

        return $this->layout();
    }

    protected function createSession()
    {
        Session::set('tenant_id', request('select'));

        return redirect(Auth::user()->role_redirect);
    }
}