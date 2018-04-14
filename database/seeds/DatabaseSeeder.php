<?php

use Ribrit\Mars\Database\Seeds\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MarsTableSeeder::class);
        $this->call(TenantMarsTableSeeder::class);
    }
}
