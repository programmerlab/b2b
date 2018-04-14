<?php

use Ribrit\Mars\Database\Migrations\AccessoryMigrationTrait;
use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTenantDefinitionAccessoryTable extends Migration
{
    use AccessoryMigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->addAccessory('tenant_definition');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->removeAccessory('tenant_definition');
    }
}
