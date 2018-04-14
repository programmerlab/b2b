<?php

use Ribrit\Mars\Database\Seeds\Seeder;
use Illuminate\Support\Facades\DB;

class MarsTableSeeder extends Seeder
{
    /**
     * Tablolar/Dosyalar
     *
     * @var array
     */
    public $dataFiles = [
        'cache',
        'jobs',
        'sessions',
        'lang',
        'currency',
        'group',
        'group_text',
        'setting',
        'setting_accessory',
        'route_method',
        'route_method_text',
        'route',
        'route_text',
        'route_link',
        'route_link_text',
        'zone',
        'zone_text',
        'zone_currency',
        'menu',
        'menu_text',
        'menu_link',
        'menu_link_text',
        'menu_link_accessory',
        'role',
        'role_text',
        'role_access',
        'role_access_route',
        'user',
        'user_accessory',
        'user_address',
        'user_role',
        'user_follow',
        'user_tenant',
        'layout',
        'layout_text',
        'image',
        'image_text',
        'definition',
        'definition_accessory',
        'definition_text',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setFiles();

        DB::table('role_access_route')->where('role_id', 2)->delete();

        foreach (DB::table('route_link')->get() as $routeLink) {
            DB::table('role_access_route')->insert([
                'role_id'       => 2,
                'route_link_id' => $routeLink->id,
                'status'        => 'yes',
            ]);
        }
    }
}