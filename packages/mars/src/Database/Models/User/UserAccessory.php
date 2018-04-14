<?php

namespace Ribrit\Mars\Database\Models\User;

use Ribrit\Mars\Database\Models\Model;

class UserAccessory extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_accessory';

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
        'key', 
        'value'
    ];
}
