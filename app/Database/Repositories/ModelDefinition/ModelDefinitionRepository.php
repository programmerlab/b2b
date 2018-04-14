<?php

namespace App\Database\Repositories\ModelDefinition;

use App\Database\Contracts\ModelDefinition\ModelDefinitionContract;
use App\Database\Models\ModelDefinition\ModelDefinition;
use Ribrit\Mars\Database\Repositories\Repository;

class ModelDefinitionRepository extends Repository implements ModelDefinitionContract
{
    public function __construct(ModelDefinition $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function mikro($items)
    {
        foreach ($items as $data) {

            $data->match_id = $data->mdl_RECno;

            if ($item = $this->model->where('match_id', $data->match_id)->first()) {
                $item->fill((array)$data)->save();
            } else {
                $this->model->create((array)$data);
            }
        }
    }
}