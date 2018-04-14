<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRouteTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_text', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('route_id');
            $table->unsignedBigInteger('lang_id');
            $table->string('title');
            $table->string('url');
            $table->index(['lang_id', 'route_id']);
        });

        $this->addForeignKey('route_text', 'route');
        $this->addForeignKey('route_text', 'lang');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('route_text');
    }
}
