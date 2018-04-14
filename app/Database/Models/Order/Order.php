<?php

namespace App\Database\Models\Order;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Models\User\User;
use Ribrit\Tenant\Database\Models\Definition\TenantDefinition;
use Ribrit\Tenant\Database\Models\Site\Site;
use Ribrit\Tenant\Database\Models\Status\Status;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class Order extends Model
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
		'payment_id',
		'payment_way',
		'shipping_id',
		'delivery_date',
		'quantity',
		'total_price',
		'note',
		'status_id',
	];

	/**
	 * The relations to eager load on every query.
	 *
	 * @var array
	 */
	protected $with = [];

	public function products()
	{
		return $this->hasMany(OrderProduct::class);
	}

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

	public function payment()
	{
		return $this->belongsTo(TenantDefinition::class, 'payment_id');
	}

	public function delivery()
	{
		return $this->belongsTo(TenantDefinition::class, 'shipping_id');
	}
}
