<?php

namespace App\Database\Repositories\Order;

use App\Database\Contracts\Order\OrderContract;
use App\Database\Models\Order\Order;
use Ribrit\Mars\Database\Repositories\Repository;

class OrderRepository extends Repository implements OrderContract
{
	/**
	 * The relations to eager load on every query.
	 *
	 * @var array
	 */
	public $with = [
		'products'
	];

	public function __construct(Order $model)
	{
		parent::__construct();

		$this->model = $model;
		$this->model->setPerPage($this->perPage);
	}

	public function add($request)
	{
		$row = parent::add($request);

		foreach ($request->products as $product) {
			$row->products()
			    ->create($product);
		}

		return $row;
	}
}