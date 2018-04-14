<?php

namespace App\Http\Controllers\Admin\Tenant\System;

use Illuminate\Support\Facades\Request;
use Ribrit\Mars\Database\Contracts\Role\RoleContract;
use Ribrit\Tenant\Http\Controllers\Admin\User\UserRoleController;

class UserController extends UserRoleController
{
	protected function findRole()
	{
		if (!$role = app(RoleContract::class)->codeFind(Request::segment(5))) {
			return abort(404);
		}

		return $role;
	}
}