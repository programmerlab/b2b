<?php

namespace App\Database\Models\Page;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class Page extends Model
{
	use TenantRelationTrait;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'title',
		'content'
	];
}
