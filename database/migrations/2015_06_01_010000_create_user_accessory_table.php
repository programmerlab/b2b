<?php

use Ribrit\Mars\Database\Migrations\AccessoryMigrationTrait;
use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserAccessoryTable extends Migration
{
    use AccessoryMigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->addAccessory('user');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->removeAccessory('user');
    }
}
