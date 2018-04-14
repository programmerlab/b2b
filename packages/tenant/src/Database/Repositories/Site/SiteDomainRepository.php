<?php

namespace Ribrit\Tenant\Database\Repositories\Site;

use Ribrit\Mars\Database\Repositories\Repository;
use Ribrit\Tenant\Database\Contracts\Site\SiteDomainContract;
use Ribrit\Tenant\Database\Models\Site\SiteDomain;

class SiteDomainRepository extends Repository implements SiteDomainContract
{
    public function __construct(SiteDomain $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }
}