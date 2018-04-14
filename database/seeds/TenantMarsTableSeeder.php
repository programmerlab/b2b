<?php

use Ribrit\Mars\Database\Seeds\Seeder;

class TenantMarsTableSeeder extends Seeder
{
    /**
     * Örnek veri dosyalarının tutuldugu alan
     *
     * @var string
     */
    public $loadPath = 'database/seeds/data/tenant/';

    /**
     * Tablolar/Dosyalar
     *
     * @var array
     */
    public $dataFiles = [
        'tenant',
        'tenant_accessory',
        'tenant_menu',
        'tenant_menu_text',
        'tenant_menu_link',
        'tenant_menu_link_text',
        'tenant_menu_link_accessory',
        'status',
        'status_text',
        'tenant_definition',
        'tenant_definition_accessory',
        'tenant_definition_text',
        'draft',
        'draft_text',
        'site',
        'site_accessory',
        'site_domain',
        'plugin',
        'plugin_block',
        'plugin_block_accessory',
        'plugin_site',
        'plugin_site_accessory',
        'theme',
        'theme_accessory',
        'theme_site',
        'theme_site_accessory',
        'theme_site_layout',
        'theme_site_layout_container',
        'theme_site_layout_container_grid',
        'theme_site_layout_container_grid_block',
        'conversation',
        'conversation_message',
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