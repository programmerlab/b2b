<?php

namespace Ribrit\Mars\Database\Models\Route;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Models\Role\RoleAccessRoute;
use Ribrit\Mars\Database\Traits\TextRelationTrait;

class RouteLink extends Model
{
    use TextRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'route_link';

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
        'route_method_id',
        'main'
    ];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function method()
    {
        return $this->hasOne(RouteMethod::class, 'id', 'route_method_id');
    }

    public function access()
    {
        return $this->hasOne(RoleAccessRoute::class, 'route_link_id', 'id');
    }
}