<?php

namespace App\Database\Repositories\Renkler;

use App\Database\Contracts\Renkler\RenklerContract;
use App\Database\Models\Renkler\Renkler;
use Ribrit\Mars\Database\Repositories\Repository;

class RenklerRepository extends Repository implements RenklerContract
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    public $with = [
        //
    ];

    public function __construct(Renkler $model)
    {
        parent::__construct();

        $this->model = $model;
        $this->model->setPerPage($this->perPage);
    }

    public function mikro($items)
    {
        foreach ($items as $data) {

            $data->match_id = $data->rnk_RECno;

            if ($item = $this->model->where('match_id', $data->match_id)->first()) {
                $item->fill((array)$data)->save();
            } else {
                $this->model->create((array)$data);
            }
        }
    }
}