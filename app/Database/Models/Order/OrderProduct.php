<?php

namespace App\Database\Models\Order;

use App\Database\Models\Product\Product;
use Ribrit\Mars\Database\Models\Model;

class OrderProduct extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
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
