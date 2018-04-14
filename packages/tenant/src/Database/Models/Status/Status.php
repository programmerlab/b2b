<?php

namespace Ribrit\Tenant\Database\Models\Status;

use Ribrit\Mars\Database\Models\Definition\Definition;
use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\GroupRelationTrait;
use Ribrit\Mars\Database\Traits\TextRelationTrait;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class Status extends Model
{
    use TenantRelationTrait, TextRelationTrait, GroupRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id',
        'icon_definition_id',
        'text_color',
        'bg_color',
        'row',
        'active'
    ];

    public function icon()
    {
        return $this->belongsTo(Definition::class, 'icon_definition_id');
    }
}
