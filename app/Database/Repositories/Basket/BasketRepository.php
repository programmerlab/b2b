<?php

namespace App\Database\Repositories\Basket;

use App\Database\Contracts\Basket\BasketContract;
use App\Database\Models\Basket\Basket;
use Ribrit\Mars\Database\Repositories\Repository;

class BasketRepository extends Repository implements BasketContract
{
	/**
	 * The relations to eager load on every query.
	 *
	 * @var array
	 */
	public $with = [
		'products'
	];

	public function __construct(Basket $model)
	{
		parent::__construct();

		$this->model = $model;
		$this->model->setPerPage($this->perPage);
	}

	public function findUser($userId)
	{
		return $this->model->with($this->with)
		                   ->where('user_id', $userId)
		                   ->first();
	}

	public function add($request)
	{
		if (!$item = $this->findUser($request->user_id)) {
			$item = parent::add($request);
		}

		foreach ($request->childs as $childId => $requestChild) {
			if (!$requestChild['quantity']) {
				continue;
			}

			$childProduct = ProductRelation::where('product_id', $request->product_id)
			                                   ->find($childId);

			if (!$childProduct) {
				continue;
			}

			$data = [
				'product_id'       => $request->product_id,
				'image'            => $request->image,
				'sku'              => $request->sku,
				'title'            => $request->title,
				'relation_title'   => $childProduct->title,
				'relation_sku'     => $childProduct->sku,
				'quantity'         => $requestChild['quantity'],
				'price'            => $childProduct->price,
				'total_price'      => $requestChild['quantity'] * $childProduct->price,
			];

			$child = $item->products()
			              ->where('sku', $childProduct->sku)
			              ->first();

			if ($child) {
				$child->fill($data)
				      ->save();
			} else {
				$item->products()
				     ->create($data);
			}
		}

		$item->total_price = $item->products()
		                          ->sum('total_price');
		$item->save();

		return $item;
	}

	public function destroyProduct($request)
	{
		return $this->row($request->basket_id)
		            ->products()
		            ->where('id', $request->id)
		            ->delete();
	}
}