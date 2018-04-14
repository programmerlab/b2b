<?php

namespace Ribrit\Tenant\Database\Models\Component;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\GroupRelationTrait;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class Plugin extends Model
{
    use TenantRelationTrait, GroupRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plugin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id',
        'group_code',
        'name',
        'description',
        'author',
        'link',
        'preview',
        'directory',
        'assets'
    ];

    /**
     * Gruplara bağlı olarak temaların bulunduğu dizinler
     *
     * @var array
     */
    public $locations = [
        'application' => 'plugins/',
        'api'         => 'plugins/',
        'payment'     => 'plugins/',
        'shipping'    => 'plugins/',
        'module'      => 'plugins/'
    ];

    public function site()
    {
        return $this->hasOne(PluginSite::class);
    }

    public function sites()
    {
        return $this->hasMany(PluginSite::class);
    }
}