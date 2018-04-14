<?php

use Ribrit\Mars\Database\Migrations\AccessoryMigrationTrait;
use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoleTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_text', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('lang_id');
            $table->string('title');
            $table->string('redirect');
        });

        $this->addForeignKey('role_text', 'role');
        $this->addForeignKey('role_text', 'lang');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('role_text');
    }
}