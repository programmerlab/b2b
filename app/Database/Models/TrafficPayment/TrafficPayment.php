<?php

namespace App\Database\Models\TrafficPayment;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class TrafficPayment extends Model
{
	use TenantRelationTrait;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'site_id',
		'type_id',
		'alias',
		'type',
		'price'
	];
}
