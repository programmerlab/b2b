<?php

namespace Ribrit\Tenant\Database\Models\Component;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\AccessoryRelationTrait;

class PluginSite extends Model
{
    use AccessoryRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plugin_site';

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
        'site_id',
        'active'
    ];

    public function plugin()
    {
        return $this->belongsTo(Plugin::class);
    }
}