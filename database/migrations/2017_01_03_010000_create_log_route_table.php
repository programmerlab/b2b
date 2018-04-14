<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogRouteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_route', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('log_id');
            $table->unsignedBigInteger('route_id');
            $table->string('event');
        });

        $this->addForeignKey('log_route', 'log');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('log_route');
    }
}
