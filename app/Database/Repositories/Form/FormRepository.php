<?php

namespace App\Database\Repositories\Form;

use App\Database\Contracts\Form\FormContract;
use App\Database\Models\Form\Form;
use Ribrit\Mars\Database\Repositories\Repository;

class FormRepository extends Repository implements FormContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        //
    ];

    public function __construct(Form $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }
}