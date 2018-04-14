<?php

namespace App\Database\Models\ModelDefinition;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class ModelDefinition extends Model
{
	use TenantRelationTrait;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'match_id',
		'mdl_kodu',
		'mdl_ismi'
	];
}
