<?php

namespace Ribrit\Tenant\Database\Models\Log;

use Ribrit\Mars\Database\Models\Model;

class LogProcess extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'log_process';

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
        'event',
        'original_data',
        'change_data'
    ];
}
