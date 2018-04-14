<?php

namespace App\Http\Controllers\Admin\Tenant\User;

use App\Database\Contracts\TenantRole\TenantRoleContract;
use App\Http\Requests\Admin\Tenant\User\TenantRole\TenantRoleAddRequest as AddRequest;
use App\Http\Requests\Admin\Tenant\User\TenantRole\TenantRoleDestroyRequest as DestroyRequest;
use App\Http\Requests\Admin\Tenant\User\TenantRole\TenantRoleUpdateRequest as UpdateRequest;
use Ribrit\Mars\Database\Contracts\Route\RouteContract;
use Ribrit\Mars\Http\Controllers\Admin\AdminController;

class TenantRoleController extends AdminController
{
	public function __construct(TenantRoleContract $contract)
	{
		parent::__construct();

		$this->contract = $contract;
	}

	public function getIndex()
	{
		return $this->layout([
			'rows' => $this->contract->paginate()
		]);
	}

	public function getCreate()
	{
		return $this->layout([
			'accessRoute'     => $this->groupGetRouteAccess(),
			'roleAccessRoute' => []
		]);
	}

	public function getEdit($id)
	{
		if (!$row = $this->contract->row($id)) {
			return error(404);
		}

		return $this->layout([
			'accessRoute'     => $this->groupGetRouteAccess(),
			'roleAccessRoute' => array_el_to_el($row->routes, 'route_link_id'),
			'row'             => $row
		]);
	}

	public function postAdd(AddRequest $request)
	{
		$row = $this->contract->add($request);

		return $this->crudMessage($request, ['id' => $row->id]);
	}

	public function postUpdate(UpdateRequest $request)
	{
		$this->contract->update($request);

		return $this->crudMessage($request);
	}

	public function postDestroy(DestroyRequest $request)
	{
		$this->contract->destroy($request);

		return $this->crudMessage($request);
	}

	protected function groupGetRouteAccess()
	{
		$rows = [];

		foreach (app(RouteContract::class)->roleGroupRows(config('groups.route.merkezPanel.id')) as $row) {
			$rows[$row->group_id][] = $row;
		}

		return $rows;
	}
}