<?php

namespace Ribrit\Mars\Database\Traits;

use Ribrit\Mars\Database\Models\Group\Group;

trait GroupRelationTrait
{
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
