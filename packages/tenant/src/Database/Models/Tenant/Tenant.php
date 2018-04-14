<?php

namespace Ribrit\Tenant\Database\Models\Tenant;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\AccessoryRelationTrait;

class Tenant extends Model
{
    use AccessoryRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tenant';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'storage_path',
        'public_key',
        'private_key'
    ];

    public function site()
    {
        return $this->hasOne(Site::class);
    }

    public function sites()
    {
        return $this->hasMany(Site::class);
    }

	public function domain()
	{
		return $this->hasOne(TenantDomain::class)->orderBy('created_at', 'asc');
	}

	public function domains()
	{
		return $this->hasMany(TenantDomain::class);
	}
}
