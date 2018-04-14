<?php

namespace App\Database\Models\Bedenler;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class Bedenler extends Model
{
    use TenantRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bedenler';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'match_id',
        'bdn_special1',
        'bdn_special2',
        'bdn_special3',
        'bdn_kodu',
        'bdn_ismi',
        'bdn_kirilim_1',
        'bdn_kirilim_2',
        'bdn_kirilim_3',
        'bdn_kirilim_4',
        'bdn_kirilim_5',
        'bdn_kirilim_6',
        'bdn_kirilim_7',
        'bdn_kirilim_8',
        'bdn_kirilim_9',
        'bdn_kirilim_10',
        'bdn_kirilim_11',
        'bdn_kirilim_12',
        'bdn_kirilim_13',
        'bdn_kirilim_14',
        'bdn_kirilim_15',
        'bdn_kirilim_16',
        'bdn_kirilim_17',
        'bdn_kirilim_18',
        'bdn_kirilim_19',
        'bdn_kirilim_20',
        'bdn_kirilim_21',
        'bdn_kirilim_22',
        'bdn_kirilim_23',
        'bdn_kirilim_24',
        'bdn_kirilim_25',
        'bdn_kirilim_26',
        'bdn_kirilim_27',
        'bdn_kirilim_28',
        'bdn_kirilim_29',
        'bdn_kirilim_30',
        'bdn_kirilim_31',
        'bdn_kirilim_32',
        'bdn_kirilim_33',
        'bdn_kirilim_34',
        'bdn_kirilim_35',
        'bdn_kirilim_36',
        'bdn_kirilim_37',
        'bdn_kirilim_38',
        'bdn_kirilim_39',
        'bdn_kirilim_40',
    ];

    /**
    * The relations to eager load on every query.
    *
    * @var array
    */
    protected $with = [
        //
    ];
}
