<?php

namespace Ribrit\Tenant\Database\Models\Definition;

use Ribrit\Mars\Database\Models\Definition\Definition;
use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\AccessoryRelationTrait;
use Ribrit\Mars\Database\Traits\GroupRelationTrait;
use Ribrit\Mars\Database\Traits\TextRelationTrait;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class TenantDefinition extends Model
{
    use TenantRelationTrait, AccessoryRelationTrait, GroupRelationTrait, TextRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tenant_definition';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id',
        'row',
        'active'
    ];

    public function getIconAttribute()
    {
        return $this->icon()->first();
    }

    public function icon()
    {
        return $this->belongsTo(Definition::class, 'icon_definition_id');
    }
}
