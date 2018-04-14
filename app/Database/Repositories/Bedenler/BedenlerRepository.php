<?php

namespace App\Database\Repositories\Bedenler;

use App\Database\Contracts\Bedenler\BedenlerContract;
use App\Database\Models\Bedenler\Bedenler;
use Ribrit\Mars\Database\Repositories\Repository;

class BedenlerRepository extends Repository implements BedenlerContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        //
    ];

    public function __construct(Bedenler $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function mikro($items)
    {
        foreach ($items as $data) {

            $data->match_id = $data->bdn_RECno;

            if ($item = $this->model->where('match_id', $data->match_id)->first()) {
                $item->fill((array)$data)->save();
            } else {
                $this->model->create((array)$data);
            }
        }
    }
}