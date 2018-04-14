<?php

namespace Ribrit\Tenant\Database\Models\Definition;

use Ribrit\Mars\Database\Models\Model;

class TenantDefinitionAccessory extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tenant_definition_accessory';

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
