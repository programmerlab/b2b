<?php

namespace Ribrit\Tenant\Database\Models\Component;

use Ribrit\Mars\Database\Models\Model;

class PluginSiteAccessory extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plugin_site_accessory';

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
