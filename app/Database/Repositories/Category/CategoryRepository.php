<?php

namespace App\Database\Repositories\Category;

use App\Database\Contracts\Category\CategoryContract;
use App\Database\Models\Category\Category;
use Ribrit\Mars\Database\Repositories\Repository;
use Ribrit\Mars\Helpers\TreeMenuHelper;

class CategoryRepository extends Repository implements CategoryContract
{
	public function __construct(Category $model)
	{
		parent::__construct();

		$this->model = $model;
		$this->model->setPerPage($this->perPage);
	}

	public function mains()
    {
        return $this->model->where('parent_id', 0)->get();
    }

    public function childs()
    {
        return $this->model->where('parent_id', 1)->get();
    }

	public function mikro($items)
	{
		foreach ($items as $data) {
			$item = $this->model->where('match_id', $data->san_RECno)->first();

			if ($item) {
				$item = $this->mikroUpdate($item, $data);
			} else {
				$item = $this->mikroStore($data);
			}
		}
	}

	protected function mikroStore($data, $parentId = 0)
	{
		$item = $this->model->create([
			'parent_id' => $parentId,
			'match_id'  => $data->san_RECno,
			'code'      => $data->san_kod,
			'title'     => $data->san_isim,
		]);

		return $item;
	}

	protected function mikroUpdate($item, $data, $parentId = 0)
	{
		$item->parent_id = $parentId;
		$item->code      = $data->san_kod;
		$item->title     = $data->san_isim;
		$item->save();

		return $item;
	}

	public function mikroParent($items)
	{
		foreach ($items as $data) {

			$item = $this->model->where('parent_id', 1)->where('match_id', $data->sta_RECno)->first();

			if ($item) {
				$item = $this->mikroParentUpdate($item, $data, 1);
			} else {
				$item = $this->mikroParentStore($data, 1);
			}
		}
	}

	protected function mikroParentStore($data, $parentId = 0)
	{
		$item = $this->model->create([
			'parent_id' => $parentId,
			'match_id'  => $data->sta_RECno,
			'code'      => $data->sta_kod,
			'title'     => $data->sta_isim,
		]);

		return $item;
	}

	protected function mikroParentUpdate($item, $data, $parentId = 0)
	{
		$item->parent_id = $parentId;
		$item->code      = $data->sta_kod;
		$item->title     = $data->sta_isim;
		$item->save();

		return $item;
	}
}