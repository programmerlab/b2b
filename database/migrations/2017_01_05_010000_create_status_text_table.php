<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatusTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_text', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('lang_id');
            $table->string('title', 200);
            $table->text('description', 200);
            $table->string('target_link');
            $table->index(['lang_id', 'status_id']);
        });

        $this->addForeignKey('status_text', 'lang');
        $this->addForeignKey('status_text', 'status');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('status_text');
    }
}
