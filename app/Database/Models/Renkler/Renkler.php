<?php

namespace App\Database\Models\Renkler;

use Ribrit\Mars\Database\Models\Model;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class Renkler extends Model
{
    use TenantRelationTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'renkler';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'match_id',
        'rnk_special1',
        'rnk_special2',
        'rnk_special3',
        'rnk_kodu',
        'rnk_ismi',
        'rnk_kirilim_1',
        'rnk_kirilim_2',
        'rnk_kirilim_3',
        'rnk_kirilim_4',
        'rnk_kirilim_5',
        'rnk_kirilim_6',
        'rnk_kirilim_7',
        'rnk_kirilim_8',
        'rnk_kirilim_9',
        'rnk_kirilim_10',
        'rnk_kirilim_11',
        'rnk_kirilim_12',
        'rnk_kirilim_13',
        'rnk_kirilim_14',
        'rnk_kirilim_15',
        'rnk_kirilim_16',
        'rnk_kirilim_17',
        'rnk_kirilim_18',
        'rnk_kirilim_19',
        'rnk_kirilim_20',
        'rnk_kirilim_21',
        'rnk_kirilim_22',
        'rnk_kirilim_23',
        'rnk_kirilim_24',
        'rnk_kirilim_25',
        'rnk_kirilim_26',
        'rnk_kirilim_27',
        'rnk_kirilim_28',
        'rnk_kirilim_29',
        'rnk_kirilim_30',
        'rnk_kirilim_31',
        'rnk_kirilim_32',
        'rnk_kirilim_33',
        'rnk_kirilim_34',
        'rnk_kirilim_35',
        'rnk_kirilim_36',
        'rnk_kirilim_37',
        'rnk_kirilim_38',
        'rnk_kirilim_39',
        'rnk_kirilim_40',
        'rnk_kirilim_41',
        'rnk_kirilim_42',
        'rnk_kirilim_43',
        'rnk_kirilim_44',
        'rnk_kirilim_45',
        'rnk_kirilim_46',
        'rnk_kirilim_47',
        'rnk_kirilim_48',
        'rnk_kirilim_49',
        'rnk_kirilim_50',
        'rnk_kirilim_51',
        'rnk_kirilim_52',
        'rnk_kirilim_53',
        'rnk_kirilim_54',
        'rnk_kirilim_55',
        'rnk_kirilim_56',
        'rnk_kirilim_57',
        'rnk_kirilim_58',
        'rnk_kirilim_59',
        'rnk_kirilim_60',
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
