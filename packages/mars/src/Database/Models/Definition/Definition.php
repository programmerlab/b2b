<?php

namespace Ribrit\Mars\Database\Models\Definition;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\AccessoryRelationTrait;
use Ribrit\Mars\Database\Traits\GroupRelationTrait;
use Ribrit\Mars\Database\Traits\TextRelationTrait;

class Definition extends Model
{
    use AccessoryRelationTrait, GroupRelationTrait, TextRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'definition';

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
