<?php

namespace Ribrit\Mars\Database\Models\Menu;

use Ribrit\Mars\Database\Models\Model;

class MenuLinkAccessory extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menu_link_accessory';

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
