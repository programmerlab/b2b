<?php

namespace Ribrit\Tenant\Database\Repositories\Site;

use Ribrit\Mars\Database\Repositories\Repository;
use Ribrit\Tenant\Database\Contracts\Site\SiteAccessoryContract;
use Ribrit\Tenant\Database\Models\Site\SiteAccessory;

class SiteAccessoryRepository extends Repository implements SiteAccessoryContract
{
    public function __construct(SiteAccessory $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }
}