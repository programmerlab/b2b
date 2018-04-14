<?php

namespace App\Database\Models\SellingPrice;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class SellingPrice extends Model
{
	use TenantRelationTrait;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'match_id',
		'sfl_aciklama',
		'sfl_kdvdahil',
		'sfl_ilktarih',
		'sfl_sontarih',
	];
}
