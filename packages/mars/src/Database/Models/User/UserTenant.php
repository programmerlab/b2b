<?php

namespace Ribrit\Mars\Database\Models\User;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Tenant\Database\Models\Tenant\Tenant;

class UserTenant extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_tenant';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'tenant_id'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}