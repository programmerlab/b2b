<?php

namespace Ribrit\Mars\Database\Models\Menu;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\LangRelationTrait;

class MenuText extends Model
{
    use LangRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menu_text';

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
        'lang_id',
        'title'
    ];
}
