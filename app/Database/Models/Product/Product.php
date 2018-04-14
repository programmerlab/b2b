<?php

namespace App\Database\Models\Product;

use App\Database\Models\Category\Category;
use Ribrit\Mars\Database\Models\Model;
use Ribrit\Mars\Database\Traits\AccessoryRelationTrait;
use Ribrit\Tenant\Database\Traits\TenantRelationTrait;

class Product extends Model
{
    use TenantRelationTrait, AccessoryRelationTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'match_id',
        'sto_kod',
        'sto_isim',
        'sto_cins',
        'sto_detay_takip',
        'sto_urun_sorkod',
        'sto_altgrup_kod',
        'sto_anagrup_kod',
        'sto_uretici_kodu',
        'sto_sektor_kodu',
        'sto_reyon_kodu',
        'sto_muhgrup_kodu',
        'sto_ambalaj_kodu',
        'sto_marka_kodu',
        'sto_beden_kodu',
        'sto_renk_kodu',
        'sto_model_kodu',
        'sto_sezon_kodu',
        'sto_hammadde_kodu',
        'sto_kalkon_kodu',
        'sto_paket_kodu',
        'sto_otvuygulama',
        'unit'
    ];

    public function getAmountAttribute()
    {
        if ($price = $this->price) {
            return $price->sfiyat_fiyati;
        }

        return 0;
    }

    public function options()
    {
        return $this->hasMany(ProductOption::class);
    }

    public function movements()
    {
        return $this->hasMany(ProductMovement::class);
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function price()
    {
        return $this->hasOne(ProductPrice::class, 'sfiyat_stokkod', 'sto_kod');
    }

    public function discounts()
    {
        return $this->hasMany(ProductDiscount::class);
    }

    public function mcategory()
    {
        return $this->belongsTo(Category::class, 'sto_anagrup_kod', 'code')->where('parent_id', 0);
    }
}
