<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->char('iso_code', 2);
            $table->char('language_code', 5);
            $table->char('date_format_lite', 32)->default('Y-m-d');
            $table->char('date_format_full', 32)->default('Y-m-d H:i:s');
            $table->integer('row')->default(100);
            $table->enum('active', ['yes', 'no'])->default('yes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lang');
    }
}
