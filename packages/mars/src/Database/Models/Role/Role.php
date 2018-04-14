<?php

namespace Ribrit\Mars\Database\Models\Role;

use Ribrit\Mars\Database\Models\Menu\Menu;
use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\TextRelationTrait;

class Role extends Model
{
    use TextRelationTrait;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'main_menu_id',
        'add_menu_id',
        'row',
        'active'
    ];

    public function mainmenu()
    {
        return $this->belongsTo(Menu::class, 'main_menu_id');
    }

    public function addmenu()
    {
        return $this->belongsTo(Menu::class, 'add_menu_id');
    }

    public function access()
    {
        return $this->hasMany(RoleAccess::class);
    }

    public function accessRoute()
    {
        return $this->hasMany(RoleAccessRoute::class);
    }
}
