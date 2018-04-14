<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{
    use \Ribrit\Mars\Database\Migrations\AccessoryMigrationTrait;

    public function up()
    {
        if (Schema::hasTable('products')) {
            return false;
        }

        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('match_id')->default(0);

            $table->string('sto_kod')->nullable();
            $table->string('sto_isim')->nullable();
            $table->string('sto_cins')->nullable();
            $table->string('sto_detay_takip')->nullable();
            $table->string('sto_urun_sorkod')->nullable();
            $table->string('sto_altgrup_kod')->nullable();
            $table->string('sto_anagrup_kod')->nullable();
            $table->string('sto_uretici_kodu')->nullable();
            $table->string('sto_sektor_kodu')->nullable();
            $table->string('sto_reyon_kodu')->nullable();
            $table->string('sto_muhgrup_kodu')->nullable();
            $table->string('sto_ambalaj_kodu')->nullable();
            $table->string('sto_marka_kodu')->nullable();
            $table->string('sto_beden_kodu')->nullable();
            $table->string('sto_renk_kodu')->nullable();
            $table->string('sto_model_kodu')->nullable();
            $table->string('sto_sezon_kodu')->nullable();
            $table->string('sto_hammadde_kodu')->nullable();
            $table->string('sto_kalkon_kodu')->nullable();
            $table->string('sto_paket_kodu')->nullable();
            $table->string('sto_otvuygulama')->nullable();

            $table->timestamps();

        });

        Schema::create('product_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->string('title')->nullable();
            $table->string('quantity')->nullable();
            $table->string('no')->nullable();
            $table->timestamps();
        });

        Schema::create('product_movements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('match_id')->default(0);
            $table->string('sth_evraktip')->nullable();
            $table->string('sth_evrakno_seri')->nullable();
            $table->string('sth_evrakno_sira')->nullable();
            $table->timestamp('sth_belge_tarih')->nullable();
            $table->string('sth_stok_kod')->nullable();
            $table->string('sth_cari_cinsi')->nullable();
            $table->string('sth_cari_kodu')->nullable();
            $table->string('sth_miktar')->nullable();
            $table->string('sth_miktar2')->nullable();
            $table->string('sth_giris_depo_no')->nullable();
            $table->string('sth_cikis_depo_no')->nullable();
            $table->timestamp('sth_malkbl_sevk_tarihi')->nullable();
            $table->string('sth_proje_kodu')->nullable();
            $table->timestamps();
        });

        Schema::create('product_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('match_id')->default(0);

            $table->string('sfiyat_stokkod')->nullable();
            $table->string('sfiyat_listesirano')->nullable();
            $table->decimal('sfiyat_fiyati', 16, 4)->default(0);

            $table->timestamps();
        });

        Schema::create('product_discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('match_id')->default(0);

            $table->string('isk_stok_kod')->nullable();
            $table->string('isk_cari_kod')->nullable();
            $table->string('isk_isim')->nullable();

            $table->string('isk_isk1_aciklama')->nullable();
            $table->string('isk_isk1_uygulama')->nullable();
            $table->string('isk_isk1_yuzde')->nullable();

            $table->string('isk_isk2_aciklama')->nullable();
            $table->string('isk_isk2_uygulama')->nullable();
            $table->string('isk_isk2_yuzde')->nullable();

            $table->string('isk_isk3_aciklama')->nullable();
            $table->string('isk_isk3_uygulama')->nullable();
            $table->string('isk_isk3_yuzde')->nullable();

            $table->string('isk_isk4_aciklama')->nullable();
            $table->string('isk_isk4_uygulama')->nullable();
            $table->string('isk_isk4_yuzde')->nullable();

            $table->string('isk_isk5_aciklama')->nullable();
            $table->string('isk_isk5_uygulama')->nullable();
            $table->string('isk_isk5_yuzde')->nullable();

            $table->string('isk_isk6_aciklama')->nullable();
            $table->string('isk_isk6_uygulama')->nullable();
            $table->string('isk_isk6_yuzde')->nullable();

            $table->string('isk_mas1_aciklama')->nullable();
            $table->string('isk_mas1_uygulama')->nullable();
            $table->string('isk_mas1_yuzde')->nullable();

            $table->string('isk_mas2_aciklama')->nullable();
            $table->string('isk_mas2_uygulama')->nullable();
            $table->string('isk_mas2_yuzde')->nullable();

            $table->string('isk_mas3_aciklama')->nullable();
            $table->string('isk_mas3_uygulama')->nullable();
            $table->string('isk_mas3_yuzde')->nullable();

            $table->string('isk_mas4_aciklama')->nullable();
            $table->string('isk_mas4_uygulama')->nullable();
            $table->string('isk_mas4_yuzde')->nullable();

            $table->timestamps();
        });

        $this->addAccessory('product');

        $this->addForeignKey('products', 'tenant');
        $this->addForeignKey('product_movements', 'products');
        $this->addForeignKey('product_prices', 'products');
        $this->addForeignKey('product_discounts', 'products');
    }

    public function down()
    {
        if (!Schema::hasTable('products')) {
            return false;
        }

        Schema::drop('product_discounts');
        Schema::drop('product_prices');
        Schema::drop('product_movements');
        Schema::drop('product_accessory');
        Schema::drop('products');
    }
}