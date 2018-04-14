<?php

namespace App\Database\Models\OnlinePayment;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Models\User\User;
use Ribrit\Tenant\Database\Models\Site\Site;
use Ribrit\Tenant\Database\Models\Status\Status;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class OnlinePayment extends Model
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
		'bank_definition_id',
		'total_price',
		'card_name',
		'card_no',
		'payment_way',
		'note',
		'status_id',
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
}
