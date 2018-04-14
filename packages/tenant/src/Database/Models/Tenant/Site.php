<?php

namespace Ribrit\Tenant\Database\Models\Tenant;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\AccessoryRelationTrait;

class Site extends Model
{
    use AccessoryRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'site';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function domain()
    {
        return $this->hasOne(SiteDomain::class);
    }

    public function domains()
    {
        return $this->hasMany(SiteDomain::class);
    }
}
