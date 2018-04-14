<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 120)->nullable();
            $table->string('slug', 120)->unique();
            $table->string('email')->unique();
            $table->string('name');
            $table->string('password', 60);
            $table->enum('active', ['yes', 'no'])->default('no');
            $table->timestamp('last_activity');
            $table->rememberToken();
            $table->timestamps();
            $table->index(['active']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user');
    }
}
