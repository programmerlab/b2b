<?php

namespace Ribrit\Mars\Database\Models\Menu;

use Ribrit\Mars\Database\Models\Definition\Definition;
use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\AccessoryRelationTrait;
use Ribrit\Mars\Database\Traits\TextRelationTrait;

class MenuLink extends Model
{
    use AccessoryRelationTrait, TextRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menu_link';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu_id',
        'parent_id',
        'row',
        'active'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function getIconAttribute()
    {
        return menu_icon($this->icon()->first());
    }

    public function icon()
    {
        return $this->belongsTo(Definition::class, 'icon_definition_id');
    }
}
