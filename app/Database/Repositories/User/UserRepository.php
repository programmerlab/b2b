<?php

namespace App\Database\Repositories\User;

use App\Database\Contracts\User\UserContract;
use App\Database\Models\User\User;
use Ribrit\Tenant\Database\Repositories\User\UserRepository as Repository;

class UserRepository extends Repository implements UserContract
{
	public function __construct(User $model)
	{
		parent::__construct($model);
	}

	public function getTenantRoleRequestPaginate($request, $code)
	{
		return $this->model->currenttenant()->whereHas('roles.role', function ($query) use ($code) {
			$query->whereCode($code);
		})->where(function ($query) use ($request) {
			$query->where('site_id', 0);

			if ($request->tenant_role_id) {
				$query->where('tenant_role_id', $request->tenant_role_id);
			}
		})->with($this->with)->orderBy('created_at', 'desc')->paginate($this->perPage);
	}

	public function getTenantRoleAll($role)
	{
		return $this->model->where(function ($query) use ($role) {
			$query->whereHas('roles.role', function ($query) {
				$query->whereCode('tenant');
			});

			$query->where('tenant_role_id', $role);
		})->get();
	}
}