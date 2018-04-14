<?php

namespace App\Database\Models\Product;

use Ribrit\Mars\Database\Models\Model;

class ProductMovement extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'match_id',
		'sth_stok_kod',
		'sth_evraktip',
		'sth_evrakno_seri',
		'sth_evrakno_sira',
		'sth_belge_tarih',
		'sth_cari_cinsi',
		'sth_cari_kodu',
		'sth_miktar',
		'sth_miktar2',
		'sth_giris_depo_no',
		'sth_cikis_depo_no',
		'sth_malkbl_sevk_tarihi',
		'sth_proje_kodu'
	];
}
