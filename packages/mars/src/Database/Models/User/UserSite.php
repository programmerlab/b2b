<?php

namespace Ribrit\Mars\Database\Models\User;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Tenant\Database\Models\Site\Site;

class UserSite extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_site';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'site_id'
	];

	public function site()
	{
		return $this->belongsTo(Site::class);
	}
}