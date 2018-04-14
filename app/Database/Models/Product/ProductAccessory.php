<?php

namespace App\Database\Models\Product;

use Ribrit\Mars\Database\Models\Model;

class ProductAccessory extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'product_accessory';

	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'key',
		'value'
	];
}
