<?php

namespace Ribrit\Tenant\Database\Models\Tenant;

use Ribrit\Mars\Database\Models\Model;

class TenantDomain extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'tenant_domain';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'tenant_id',
		'url'
	];
}
