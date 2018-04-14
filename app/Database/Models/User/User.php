<?php

namespace App\Database\Models\User;

use App\Database\Models\TenantRole\TenantRole;
use Ribrit\Mars\Database\Models\User\User as Model;

class User extends Model
{
	public function tenantrole()
	{
		return $this->belongsTo(TenantRole::class, 'tenant_role_id');
	}
}
