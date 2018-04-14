<?php

namespace Ribrit\Mars\Database\Models\User;

use Ribrit\Mars\Database\Models\Model;

class UserAddress extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_address';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'name_tag',
        'name',
        'surname',
        'gsm',
        'phone',
        'fax',
        'email',
        'country_zone_id',
        'city_zone_id',
        'town_zone_id',
        'locality_zone_id',
        'pk',
        'address_1',
        'address_2',
        'geo_location',
        'default'
    ];
}
