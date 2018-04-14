<?php

namespace Ribrit\Tenant\Database\Models\Status;

use Ribrit\Mars\Database\Traits\LangRelationTrait;
use Ribrit\Mars\Database\Models\Model;

class StatusText extends Model
{
    use LangRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'status_text';

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
        'title',
        'description',
        'target_link'
    ];
}
