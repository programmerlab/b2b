<?php

namespace Ribrit\Mars\Database\Models\Menu;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\TextRelationTrait;

class Menu extends Model
{
    use TextRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menu';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'layout_path',
        'row',
        'active'
    ];

    public function links()
    {
        return $this->hasMany(MenuLink::class);
    }
}
