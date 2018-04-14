<?php

namespace Ribrit\Mars\Database\Models\Role;

use Ribrit\Mars\Database\Models\Model;

class RoleAccessRoute extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role_access_route';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 
        'route_link_id', 
        'status'
    ];
}
