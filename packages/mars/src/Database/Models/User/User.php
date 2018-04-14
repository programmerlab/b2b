<?php

namespace Ribrit\Mars\Database\Models\User;

use Ribrit\Mars\Database\Traits\AccessoryRelationTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use AccessoryRelationTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'site_id',
		'tenant_role_id',
		'name',
		'email',
		'password',
		'active'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token'
	];

	public function getTitleAttribute()
	{
		return $this->name;
	}

	public function getRoleRedirectAttribute()
	{
		return $this->role->role->text->redirect;
	}

	public function scopeCurrenttenant($query)
	{
		return $query->whereHas('tenant', function ($query) {
			$query->where('tenant_id', tenant('id'));
		});
	}

	public function role()
	{
		return $this->hasOne(UserRole::class)
		            ->whereMain('yes');
	}

	public function roles()
	{
		return $this->hasMany(UserRole::class);
	}

	public function site()
	{
		return $this->hasOne(UserSite::class);
	}

	public function tenant()
	{
		return $this->hasOne(UserTenant::class);
	}

	public function tenants()
	{
		return $this->hasMany(UserTenant::class);
	}

	public function activation()
	{
		return $this->hasOne(UserActivation::class);
	}

	public function activations()
	{
		return $this->hasMany(UserActivation::class);
	}
}
