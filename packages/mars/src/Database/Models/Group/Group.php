<?php

namespace Ribrit\Mars\Database\Models\Group;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\TextRelationTrait;

class Group extends Model
{
    use TextRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'group';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'code',
        'row',
        'active'
    ];

    public function getUcCodeAttribute()
    {
        return ucfirst($this->code);
    }

    public function parent()
    {
        return $this->hasOne(Group::class, 'id', 'parent_id');
    }

    public function parents()
    {
        return $this->hasMany(Group::class, 'id', 'parent_id');
    }
}
