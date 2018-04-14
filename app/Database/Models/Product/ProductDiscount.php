<?php

namespace App\Database\Models\Product;

use Ribrit\Mars\Database\Models\Model;

class ProductDiscount extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'match_id',
		'isk_stok_kod',
		'isk_cari_kod',
		'isk_isim',
		'isk_isk1_aciklama',
		'isk_isk1_uygulama',
		'isk_isk1_yuzde',
		'isk_isk2_aciklama',
		'isk_isk2_uygulama',
		'isk_isk2_yuzde',
		'isk_isk3_aciklama',
		'isk_isk3_uygulama',
		'isk_isk3_yuzde',
		'isk_isk4_aciklama',
		'isk_isk4_uygulama',
		'isk_isk4_yuzde',
		'isk_isk5_aciklama',
		'isk_isk5_uygulama',
		'isk_isk5_yuzde',
		'isk_isk6_aciklama',
		'isk_isk6_uygulama',
		'isk_isk6_yuzde',
		'isk_mas1_aciklama',
		'isk_mas1_uygulama',
		'isk_mas1_yuzde',
		'isk_mas2_aciklama',
		'isk_mas2_uygulama',
		'isk_mas2_yuzde',
		'isk_mas3_aciklama',
		'isk_mas3_uygulama',
		'isk_mas3_yuzde',
		'isk_mas4_aciklama',
		'isk_mas4_uygulama',
		'isk_mas4_yuzde'
	];
}
