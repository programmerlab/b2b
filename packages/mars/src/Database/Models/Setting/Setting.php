<?php

namespace Ribrit\Mars\Database\Models\Setting;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\AccessoryRelationTrait;

class Setting extends Model
{
    use AccessoryRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'setting';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id'
    ];
}