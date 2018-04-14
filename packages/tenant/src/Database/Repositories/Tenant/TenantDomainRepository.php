<?php

namespace Ribrit\Tenant\Database\Repositories\Tenant;

use Ribrit\Mars\Database\Repositories\Repository;
use Ribrit\Tenant\Database\Contracts\Tenant\TenantDomainContract;
use Ribrit\Tenant\Database\Models\Tenant\TenantDomain;

class TenantDomainRepository extends Repository implements TenantDomainContract
{
	public function __construct(TenantDomain $model)
	{
		parent::__construct();

		$this->model = $model;
		$this->model->setPerPage($this->perPage);
	}

	public function add($request)
	{
		$request->offsetSet('tenant_id', $request->fake_tenant_id);

		return parent::add($request);
	}

	public function update($request)
	{
		$request->offsetSet('tenant_id', $request->fake_tenant_id);

		return parent::update($request);
	}
}