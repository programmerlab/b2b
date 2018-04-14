<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRouteLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_link', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('route_id');
            $table->unsignedBigInteger('route_method_id');
            $table->enum('main', ['yes', 'no'])->default('yes');
            $table->index(['route_method_id', 'route_id']);
        });

        $this->addForeignKey('route_link', 'route_method');
        $this->addForeignKey('route_link', 'route');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('route_link');
    }
}
