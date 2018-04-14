<?php

namespace Ribrit\Mars\Database\Traits;

use Ribrit\Mars\Database\Models\Lang\Lang;

trait LangRelationTrait
{
    public function lang()
    {
        return $this->belongsTo(Lang::class);
    }
}
