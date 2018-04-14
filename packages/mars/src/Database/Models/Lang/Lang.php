<?php

namespace Ribrit\Mars\Database\Models\Lang;

use Ribrit\Mars\Database\Models\Model;

class Lang extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lang';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'iso_code',
        'language_code',
        'date_format_lite',
        'date_format_full',
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
        return strtolower($this->iso_code) . ' flag';
    }
}
