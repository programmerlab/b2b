<?php

namespace App\Database\Repositories\Brand;

use App\Database\Contracts\Brand\BrandContract;
use App\Database\Models\Brand\Brand;
use Ribrit\Mars\Database\Repositories\Repository;

class BrandRepository extends Repository implements BrandContract
{
	public function __construct(Brand $model)
	{
		parent::__construct();

		$this->model = $model;
		$this->model->setPerPage($this->perPage);
	}

	public function mikro($items)
	{
		foreach ($items as $data) {

			$item = $this->model->where('match_id', $data->mrk_RECno)->first();

			if ($item) {
				$this->mikroUpdate($item, $data);
			} else {
				$this->mikroStore($data);
			}
		}
	}

	protected function mikroStore($data)
	{
		$item = $this->model->create([
			'match_id' => $data->mrk_RECno,
			'code'     => $data->mrk_kod,
			'title'    => $data->mrk_ismi,
		]);

		return $item;
	}

	protected function mikroUpdate($item, $data)
	{
		$item->code  = $data->mrk_kod;
		$item->title = $data->mrk_ismi;
		$item->save();

		return $item;
	}
}