<?php

namespace App\Database\Repositories\Reyon;

use App\Database\Contracts\Reyon\ReyonContract;
use App\Database\Models\Reyon\Reyon;
use Ribrit\Mars\Database\Repositories\Repository;

class ReyonRepository extends Repository implements ReyonContract
{
    public function __construct(Reyon $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function mikro($items)
    {
        foreach ($items as $data) {

            $data->match_id = $data->ryn_RECno;

            if ($item = $this->model->where('match_id', $data->match_id)->first()) {
                $item->fill((array)$data)->save();
            } else {
                $this->model->create((array)$data);
            }
        }
    }
}