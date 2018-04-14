<?php

namespace App\Database\Repositories\Page;

use App\Database\Contracts\Page\PageContract;
use App\Database\Models\Page\Page;
use Ribrit\Mars\Database\Repositories\Repository;

class PageRepository extends Repository implements PageContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        //
    ];

    public function __construct(Page $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }
}