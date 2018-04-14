<?php

namespace App\Database\Models\Basket;

use App\Database\Models\Product\Product;
use Ribrit\Mars\Database\Models\Model;

class BasketProduct extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'product_id',
		'image',
		'sku',
		'title',
		'relation_title',
		'relation_sku',
		'quantity',
		'price',
		'total_price',
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
