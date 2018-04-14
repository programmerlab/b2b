<?php

namespace Ribrit\Mars\Http\Controllers\Admin\Account;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class LogoutController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getIndex()
    {
        Auth::user()->unsetAccessories();
        Auth::logout();
        Session::forget('tenant_id');
        Session::flush();

        return redirect('/');
    }
}
