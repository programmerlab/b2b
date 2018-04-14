<?php

namespace Ribrit\Tenant\Database\Models\Log;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Models\Route\Route;

class LogRoute extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'log_route';

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
        'log_id',
        'route_id',
        'event'
    ];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
