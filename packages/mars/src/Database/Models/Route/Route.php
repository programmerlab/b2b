<?php

namespace Ribrit\Mars\Database\Models\Route;

use Ribrit\Mars\Database\Models\Layout\Layout;
use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\GroupRelationTrait;
use Ribrit\Mars\Database\Traits\TextRelationTrait;

class Route extends Model
{
    use TextRelationTrait, GroupRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'route';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id',
        'parent_id',
        'layout_id',
        'name',
        'controller',
        'lang_path',
        'layout_path',
        'row',
        'active'
    ];

    public function childs()
    {
        return $this->hasMany(Route::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->hasOne(Route::class, 'id', 'parent_id');
    }

    public function parents()
    {
        return $this->hasMany(Route::class, 'id', 'parent_id');
    }

    public function link()
    {
        return $this->hasOne(RouteLink::class);
    }

    public function mainLink()
    {
        return $this->hasOne(RouteLink::class)->whereMain('yes');
    }

    public function links()
    {
        return $this->hasMany(RouteLink::class);
    }

    public function layout()
    {
        return $this->belongsTo(Layout::class, 'layout_id');
    }
}
