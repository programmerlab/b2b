<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDefinitionTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('definition_text', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('definition_id');
            $table->unsignedBigInteger('lang_id');
            $table->string('title', 200)->nullable();
            $table->index(['lang_id', 'definition_id']);
        });

        $this->addForeignKey('definition_text', 'lang');
        $this->addForeignKey('definition_text', 'definition');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('definition_text');
    }
}
