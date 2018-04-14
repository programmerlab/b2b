<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRouteLinkTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_link_text', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('route_link_id');
            $table->unsignedBigInteger('lang_id');
            $table->string('url');
            $table->index(['lang_id', 'route_link_id']);
        });

        $this->addForeignKey('route_link_text', 'route_link');
        $this->addForeignKey('route_link_text', 'lang');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('route_link_text');
    }
}
