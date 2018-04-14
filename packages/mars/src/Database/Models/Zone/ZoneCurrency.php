<?php

namespace Ribrit\Mars\Database\Models\Zone;

use Ribrit\Mars\Database\Models\Currency\Currency;
use Ribrit\Mars\Database\Models\Model;

class ZoneCurrency extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'zone_currency';

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
        'currency_id'
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
