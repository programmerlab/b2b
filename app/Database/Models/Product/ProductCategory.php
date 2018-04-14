<?php

namespace App\Database\Models\Product;

use Ribrit\Mars\Database\Models\Model;

class ProductCategory extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'category_id'
	];
}
