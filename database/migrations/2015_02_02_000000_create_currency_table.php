<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->char('iso_code', 3);
            $table->char('iso_code_num', 3);
            $table->string('symbol', 100);
            $table->string('format', 100);
            $table->tinyInteger('step');
            $table->char('decimal', 3);
            $table->char('thousand', 3);
            $table->decimal('conversion_rate', 20, 6);
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
        Schema::drop('currency');
    }
}
