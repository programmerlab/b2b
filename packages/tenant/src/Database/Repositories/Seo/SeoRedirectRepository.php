<?php

namespace Ribrit\Tenant\Database\Repositories\Seo;

use Ribrit\Mars\Database\Repositories\Repository;
use Ribrit\Tenant\Database\Contracts\Seo\SeoRedirectContract;
use Ribrit\Tenant\Database\Models\Seo\SeoRedirect;

class SeoRedirectRepository extends Repository implements SeoRedirectContract
{
    public function __construct(SeoRedirect $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function findLink($link)
    {
        return $this->model->whereLink($link)->first();
    }
}