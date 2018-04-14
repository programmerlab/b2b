<?php

namespace Ribrit\Mars\Http\Controllers\Admin\Account;

use Ribrit\Mars\Database\Contracts\User\UserContract;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class AccountController extends AdminController
{
    public function __construct(UserContract $contract)
    {
        parent::__construct();

        $this->contract = $contract;
    }

    public function getIndex()
    {
        return $this->layout();
    }
}