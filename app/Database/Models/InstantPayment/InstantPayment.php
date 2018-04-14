<?php

namespace App\Database\Models\InstantPayment;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Models\User\User;
use Ribrit\Tenant\Database\Models\Definition\TenantDefinition;
use Ribrit\Tenant\Database\Models\Site\Site;
use Ribrit\Tenant\Database\Models\Status\Status;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class InstantPayment extends Model
{
	use TenantRelationTrait;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'site_id',
		'user_id',
		'collecting_definition_id',
		'price',
		'note',
		'file',
		'status_id'
	];

	/**
	 * The relations to eager load on every query.
	 *
	 * @var array
	 */
	protected $with = [//
	];

	public function site()
	{
		return $this->belongsTo(Site::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function status()
	{
		return $this->belongsTo(Status::class);
	}

	public function collecting()
	{
		return $this->belongsTo(TenantDefinition::class, 'collecting_definition_id');
	}
}
