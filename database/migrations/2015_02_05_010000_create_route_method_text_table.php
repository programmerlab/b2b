<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRouteMethodTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_method_text', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('route_method_id');
            $table->unsignedBigInteger('lang_id');
            $table->string('name');
            $table->string('title');
            $table->index(['lang_id', 'route_method_id']);
        });

        $this->addForeignKey('route_method_text', 'route_method');
        $this->addForeignKey('route_method_text', 'lang');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('route_method_text');
    }
}
