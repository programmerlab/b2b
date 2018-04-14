<?php

namespace App\Database\Models\Product;

use Ribrit\Mars\Database\Models\Model;

class ProductPrice extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'match_id',
		'sfiyat_stokkod',
		'sfiyat_listesirano',
		'sfiyat_fiyati'
	];
}
