<?php

namespace App\Database\Models\Brand;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class Brand extends Model
{
	use TenantRelationTrait;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'match_id',
		'code',
		'title'
	];
}
