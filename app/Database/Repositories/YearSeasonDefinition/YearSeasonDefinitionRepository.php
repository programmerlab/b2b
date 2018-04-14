<?php

namespace App\Database\Repositories\YearSeasonDefinition;

use App\Database\Contracts\YearSeasonDefinition\YearSeasonDefinitionContract;
use App\Database\Models\YearSeasonDefinition\YearSeasonDefinition;
use Ribrit\Mars\Database\Repositories\Repository;

class YearSeasonDefinitionRepository extends Repository implements YearSeasonDefinitionContract
{
	public function __construct(YearSeasonDefinition $model)
	{
		parent::__construct();

		$this->model = $model;
		$this->model->setPerPage($this->perPage);
	}

    public function mikro($items)
    {
        foreach ($items as $data) {

            $data->match_id = $data->ysn_RECno;

            if ($item = $this->model->where('match_id', $data->match_id)->first()) {
                $item->fill((array)$data)->save();
            } else {
                $this->model->create((array)$data);
            }
        }
    }
}