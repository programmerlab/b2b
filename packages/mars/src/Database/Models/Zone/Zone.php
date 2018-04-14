<?php

namespace Ribrit\Mars\Database\Models\Zone;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\GroupRelationTrait;
use Ribrit\Mars\Database\Traits\TextRelationTrait;
use Ribrit\Tenant\Database\Models\Status\Status;

class Zone extends Model
{
    use GroupRelationTrait, TextRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'zone';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group_id',
        'parent_id',
        'iso_code',
        'call_prefix',
        'zip_code_format',
        'row',
        'active',
        'coupon_status_id',
        'coupon_info',
        'coupon_url'
    ];

    public function currency()
    {
        return $this->hasOne(ZoneCurrency::class);
    }

    public function parent()
    {
        return $this->belongsTo(Zone::class, 'parent_id');
    }

    public function childs()
    {
        return $this->hasMany(Zone::class, 'parent_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'coupon_status_id');
    }
}
