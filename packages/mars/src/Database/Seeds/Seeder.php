<?php

namespace Ribrit\Mars\Database\Seeds;

use Illuminate\Database\Seeder as BaseSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

abstract class Seeder extends BaseSeeder
{
    /**
     * Verinin tutulduğu dizin
     *
     * @var string
     */
    public $loadPath = 'database/seeds/data/mars/';

    /**
     * Tablolar/Dosyalar
     *
     * @var array
     */
    public $dataFiles = [
        //
    ];

    /**
     * Verileri yaz
     *
     * @return void
     */
    protected function setFiles()
    {
        foreach ($this->dataFiles as $name) {
            $records = $this->records($name);

            foreach ($records as $record) {
                DB::table($name)->insert($record);
            }
        }
    }

    /**
     * Veri kontrolü yap
     *
     * @param $name
     * @return array
     */
    protected function records($name)
    {
        $rows = $this->loadData($name);

        if (empty($rows['RECORDS'])) {
            return [];
        }

        return $rows['RECORDS'];
    }

    /**
     * Dizi tipine çevir
     *
     * @param $name
     * @return mixed
     */
    protected function loadData($name)
    {
        return json_decode($this->loadFile($name), true);
    }

    /**
     * Json dosyasını getir
     *
     * @param $name
     * @return mixed
     */
    protected function loadFile($name)
    {
        return File::get(base_path($this->loadPath.$name.'.json'));
    }
}