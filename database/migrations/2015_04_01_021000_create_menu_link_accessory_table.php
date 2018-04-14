<?php

use Ribrit\Mars\Database\Migrations\AccessoryMigrationTrait;
use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuLinkAccessoryTable extends Migration
{
    use AccessoryMigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->addAccessory('menu_link');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->removeAccessory('menu_link');
    }
}
