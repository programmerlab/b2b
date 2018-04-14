<?php

namespace App\Database\Models\Form;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class Form extends Model
{
	use TenantRelationTrait;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title'
	];
}
