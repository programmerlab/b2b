<?php

namespace App\Database\Models\Basket;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Models\User\User;
use Ribrit\Tenant\Database\Models\Site\Site;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class Basket extends Model
{
	use TenantRelationTrait;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'site_id',
		'user_id',
		'total_price',
	];

	/**
	 * The relations to eager load on every query.
	 *
	 * @var array
	 */
	protected $with = [
		'products'
	];

	public function products()
	{
		return $this->hasMany(BasketProduct::class);
	}

	public function site()
	{
		return $this->belongsTo(Site::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
