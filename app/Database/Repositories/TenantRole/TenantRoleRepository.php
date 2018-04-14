<?php

namespace App\Database\Repositories\TenantRole;

use App\Database\Contracts\TenantRole\TenantRoleContract;
use App\Database\Models\TenantRole\TenantRole;
use Ribrit\Mars\Database\Repositories\Repository;

class TenantRoleRepository extends Repository implements TenantRoleContract
{
	/**
	 * The relations to eager load on every query.
	 *
	 * @var array
	 */
	public $with = [
		'routes'
	];

	public function __construct(TenantRole $model)
	{
		parent::__construct();

		$this->model = $model;
		$this->model->setPerPage($this->perPage);
	}

	public function add($request)
	{
		$row = parent::add($request);

		$this->addRoutes($row, $request->routeAccess);

		return $row;
	}

	public function addRoutes($row, $access)
	{
		foreach (explode(',', $access) as $id) {

			if (!$id) {
				continue;
			}

			$row->routes()
			    ->create([
				    'route_link_id' => $id,
				    'status'        => 'yes'
			    ]);
		}
	}

	public function update($request)
	{
		$row = parent::update($request);
		$row->routes()->delete();

		$this->addRoutes($row, $request->routeAccess);

		return $row;
	}
}