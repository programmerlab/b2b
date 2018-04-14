<?php

namespace Ribrit\Mars\Database\Models\Currency;

use Ribrit\Mars\Database\Models\Model;

class Currency extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'currency';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'iso_code',
        'iso_code_num',
        'symbol',
        'format',
        'step',
        'decimal',
        'thousand',
        'conversion_rate',
        'row',
        'active'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'small_iso_code',
        'icon_text'
    ];

    public function getSmallIsoCodeAttribute()
    {
        return strtolower($this->iso_code);
    }

    public function getIconTextAttribute()
    {
        return strtolower($this->iso_code) . ' icon';
    }
}
