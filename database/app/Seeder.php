<?php

use Ribrit\Mars\Database\Seeds\Seeder as BaseSeeder;

class Seeder extends BaseSeeder
{
    /**
     * Örnek veri dosyalarının tutuldugu alan
     *
     * @var string
     */
    public $loadPath = 'database/seeds/data/app/';

    /**
     * Tablolar/Dosyalar
     *
     * @var array
     */
    public $dataFiles = [
        // Tablo isimleri
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setFiles();
    }
}
