<?php

namespace App\Database\Models\TenantRole;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class TenantRole extends Model
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

	public function routes()
	{
		return $this->hasMany(TenantRoleRoute::class);
	}
}
