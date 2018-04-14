<?php

namespace Ribrit\Tenant\Database\Models\Log;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class Log extends Model
{
    use TenantRelationTrait;
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'log';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'user',
        'path',
        'server',
        'ip_address'
    ];

    public function route()
    {
        return $this->hasOne(LogRoute::class);
    }

    public function process()
    {
        return $this->hasOne(LogProcess::class);
    }
}
