<?php

namespace Ribrit\Tenant\Database\Models\Draft;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\GroupRelationTrait;
use Ribrit\Mars\Database\Traits\TextRelationTrait;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class Draft extends Model
{
    use TenantRelationTrait, TextRelationTrait, GroupRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'draft';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id',
        'name'
    ];
}
