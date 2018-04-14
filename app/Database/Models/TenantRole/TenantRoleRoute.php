<?php

namespace App\Database\Models\TenantRole;

use Ribrit\Mars\Database\Models\Model;

class TenantRoleRoute extends Model
{
	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'tenant_role_id',
		'route_link_id',
		'status'
	];
}
