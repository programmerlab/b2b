<?php

use Illuminate\Database\Schema\Blueprint;
use Ribrit\Mars\Database\Migrations\Migration;

class CreateUserActivationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_activation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('token')->index();
            $table->timestamps();
        });

        $this->addForeignKey('user_activation', 'user');
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_activation');
    }
}