<?php

use Ribrit\Mars\Database\Migrations\AccessoryMigrationTrait;
use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMenuLinkTextTable extends Migration
{
    use AccessoryMigrationTrait;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_link_text', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('menu_link_id');
            $table->unsignedBigInteger('lang_id');
            $table->string('title');
            $table->string('url')->nullable();
            $table->index(['lang_id', 'menu_link_id']);
        });

        $this->addForeignKey('menu_link_text', 'lang');
        $this->addForeignKey('menu_link_text', 'menu_link');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menu_link_text');
    }
}
