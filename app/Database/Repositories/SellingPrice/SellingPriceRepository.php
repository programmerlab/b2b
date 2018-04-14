<?php

namespace App\Database\Repositories\SellingPrice;

use App\Database\Contracts\SellingPrice\SellingPriceContract;
use App\Database\Models\SellingPrice\SellingPrice;
use Ribrit\Mars\Database\Repositories\Repository;

class SellingPriceRepository extends Repository implements SellingPriceContract
{
	public function __construct(SellingPrice $model)
	{
		parent::__construct();

		$this->model = $model;
		$this->model->setPerPage($this->perPage);
	}

    public function mikro($items)
    {
        foreach ($items as $data) {

            $data->match_id = $data->sfl_RECno;

            if ($item = $this->model->where('match_id', $data->match_id)->first()) {
                $item->fill((array)$data)->save();
            } else {
                $this->model->create((array)$data);
            }
        }
    }
}