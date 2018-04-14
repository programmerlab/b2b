<?php

namespace Ribrit\Tenant\Database\Models\Site;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\AccessoryRelationTrait;
use Ribrit\Tenant\Database\Models\Tenant\Tenant;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class Site extends Model
{
	use TenantRelationTrait, AccessoryRelationTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'site';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'code',
		'name',
		'tax_zone',
		'tax_no',
		'zone',
		'total_price',
		'danger_limit',
		'point',
	];

	public function tenant()
	{
		return $this->belongsTo(Tenant::class);
	}

	public function domain()
	{
		return $this->hasOne(SiteDomain::class)->orderBy('created_at', 'asc');
	}

	public function domains()
	{
		return $this->hasMany(SiteDomain::class);
	}
}
