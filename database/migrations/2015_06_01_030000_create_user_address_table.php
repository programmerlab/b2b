<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_address', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->enum('name_tag', ['Mrs', 'Mr'])->default('Mrs');
            $table->string('name');
            $table->string('surname');
            $table->string('gsm');
            $table->string('phone');
            $table->string('fax');
            $table->string('email');
            $table->unsignedBigInteger('country_zone_id');
            $table->unsignedBigInteger('city_zone_id');
            $table->unsignedBigInteger('town_zone_id');
            $table->unsignedBigInteger('locality_zone_id');
            $table->string('pk');
            $table->string('address_1');
            $table->string('address_2');
            $table->string('geo_location');
            $table->enum('default', ['yes', 'no'])->default('no');

            $table->timestamps();
        });

        $this->addForeignKey('user_address', 'user');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_address');
    }
}