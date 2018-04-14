<?php

namespace Ribrit\Tenant\Http\Controllers\Admin\Tenant;

use App\Database\Contracts\TenantRole\TenantRoleContract;
use Illuminate\Support\Facades\Request;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;
use Ribrit\Tenant\Database\Contracts\Tenant\TenantContract;
use Ribrit\Tenant\Database\Contracts\Component\ThemeContract;
use Ribrit\Tenant\Http\Requests\Admin\Tenant\Accessory\TenantAccessoryIndexRequest as IndexRequest;
use Ribrit\Tenant\Http\Requests\Admin\Tenant\Accessory\TenantAccessoryUpdateRequest as UpdateRequest;

class TenantAccessoryController extends AdminController
{
	public function __construct(TenantContract $contract)
	{
		parent::__construct();

		$this->contract = $contract;
	}

	public function getIndex(IndexRequest $request, ThemeContract $theme)
	{
		$this->setRouteMethod();

		return $this->layout([
			'roles'       => app(TenantRoleContract::class)->rows(),
			'adminThemes' => $theme->groupRows(config('groups.theme.admin.id')),
			'row'         => $this->contract->row($request->tenant)
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