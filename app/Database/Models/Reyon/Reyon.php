<?php

namespace App\Database\Models\Reyon;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class Reyon extends Model
{
	use TenantRelationTrait;

	protected $table = 'reyonlar';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'match_id',
		'ryn_kod',
		'ryn_ismi',
	];
}
