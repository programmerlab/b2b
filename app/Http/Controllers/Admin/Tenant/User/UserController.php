<?php

namespace App\Http\Controllers\Admin\Tenant\User;

use App\Database\Contracts\TenantRole\TenantRoleContract;
use App\Database\Contracts\User\UserContract;
use Ribrit\Mars\Database\Contracts\Role\RoleContract;
use Ribrit\Tenant\Http\Controllers\Admin\User\UserRoleController;

class UserController extends UserRoleController
{
	public function __construct(UserContract $contract)
	{
		parent::__construct($contract);

		$this->data['roles'] = app(TenantRoleContract::class)->rows();
	}

	public function getIndex()
	{
		return $this->layout([
			'rows' => $this->contract->getTenantRoleRequestPaginate(request(), $this->role->code)
		]);
	}

	protected function findRole()
	{
		if (!$role = app(RoleContract::class)->codeFind('tenant')) {
			return abort(404);
		}

		return $role;
	}
}