<?php

namespace App\Http\Controllers\Admin\Tenant\System;

use App\Database\Contracts\TenantRole\TenantRoleContract;
use Illuminate\Support\Facades\Request;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Tenant\Database\Contracts\Tenant\TenantContract;
use Ribrit\Tenant\Http\Requests\Admin\Tenant\Accessory\TenantAccessoryUpdateRequest as UpdateRequest;

class SettingController extends AdminController
{
	public function __construct(TenantContract $contract)
	{
		parent::__construct();

		$this->contract = $contract;
	}

	public function getIndex()
	{
		$this->setRouteMethod();

		return $this->layout([
			'roles' => app(TenantRoleContract::class)->rows(),
			'row'   => $this->contract->row(request('tenant_id'))
		]);
	}

	public function postUpdate(UpdateRequest $request)
	{
		$this->contract->updateAccessories($request);

		return $this->crudMessage($request);
	}

	protected function setRouteMethod()
	{
		$current                  = $this->appRouter->current;
		$current['code']          = 'edit';
		$this->appRouter->current = $current;
		Request::setRouter($this->appRouter);
	}
}