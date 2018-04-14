<?php

namespace App\Services;

use App\Database\Contracts\Bedenler\BedenlerContract;
use App\Database\Contracts\ModelDefinition\ModelDefinitionContract;
use App\Database\Contracts\Renkler\RenklerContract;
use App\Database\Contracts\Reyon\ReyonContract;
use App\Database\Contracts\Brand\BrandContract;
use App\Database\Contracts\Category\CategoryContract;
use App\Database\Contracts\Product\ProductContract;
use App\Database\Contracts\SellingPrice\SellingPriceContract;
use App\Database\Contracts\YearSeasonDefinition\YearSeasonDefinitionContract;
use Ribrit\Tenant\Database\Contracts\Site\SiteContract;

class MikroService
{
    protected $langId = 1;

    public function handle($results)
    {
        if (!$results) {
            return false;
        }

        foreach ($results as $method => $data) {
            $this->{$method}($data);
        }
    }

    protected function CariHesaplar($results)
    {
         //app(SiteContract::class)->mikro($results);
    }

    protected function CariHesapAdresler($items)
    {
        //return app(SiteContract::class)->mikroAddress($items);
    }

    protected function CariHesapHareketleri($items)
    {
        //return app(SiteContract::class)->mikroHareketler($items);
    }

    protected function StokAnaGruplari($items)
    {
        //return app(CategoryContract::class)->mikro($items);
    }

    protected function StokAltGruplari($items)
    {
        //return app(CategoryContract::class)->mikroParent($items);
    }

    protected function StokMarkalari($items)
    {
        //return app(BrandContract::class)->mikro($items);
    }

    protected function StokReyonlari($items)
    {
        //return app(ReyonContract::class)->mikro($items);
    }

    protected function StokSatisFiyatListeTanimlari($items)
    {
        //return app(SellingPriceContract::class)->mikro($items);
    }

    protected function StokYilSezonTanimlari($items)
    {
        //return app(YearSeasonDefinitionContract::class)->mikro($items);
    }

    protected function StokModelTanimlari($items)
    {
        //return app(ModelDefinitionContract::class)->mikro($items);
    }

    protected function StokBedenTanimlari($items)
    {
        //return app(BedenlerContract::class)->mikro($items);
    }

    protected function StokRenkTanimlari($items)
    {
        //return app(RenklerContract::class)->mikro($items);
    }

    protected function Stoklar($items)
    {
        app(ProductContract::class)->mikro($items);
    }

    protected function StokHareketleri($items)
    {
        app(ProductContract::class)->mikroMovements($items);
    }

    protected function StokSatisFiyatListeleri($items)
    {
        app(ProductContract::class)->mikroPrices($items);
    }

    protected function StokCariIskontoTanimlari($items)
    {
        app(ProductContract::class)->mikroDiscounts($items);
    }

    protected function Siparisler($items)
    {

    }
}