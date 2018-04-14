<?php

namespace App\Database\Models\YearSeasonDefinition;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class YearSeasonDefinition extends Model
{
	use TenantRelationTrait;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'match_id',
		'ysn_kodu',
		'ysn_ismi'
	];
}
