<?php

namespace Ribrit\Mars\Database\Models\Route;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\TextRelationTrait;

class RouteMethod extends Model
{
    use TextRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'route_method';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'method',
        'code',
        'row',
        'active'
    ];
}
