<?php

namespace Ribrit\Mars\Database\Models\User;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Models\Role\Role;
use Ribrit\Mars\Database\Models\Role\RoleAccess;
use Ribrit\Mars\Database\Models\Role\RoleAccessRoute;
use Ribrit\Mars\Database\Models\Role\RoleMenu;
use Ribrit\Mars\Database\Models\Role\RoleText;

class UserRole extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_role';

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
        'main'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
