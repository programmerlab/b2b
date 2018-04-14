<?php

namespace Ribrit\Tenant\Database\Models\Site;

use Ribrit\Mars\Database\Models\Model;

class SiteDomain extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'site_domain';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'site_id',
        'url'
    ];
}
