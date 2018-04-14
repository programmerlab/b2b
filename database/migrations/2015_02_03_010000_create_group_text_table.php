<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_text', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('lang_id');
            $table->string('slug')->nullable();
            $table->string('title', 200);
            $table->index(['lang_id', 'group_id']);
        });

        $this->addForeignKey('group_text', 'group');
        $this->addForeignKey('group_text', 'lang');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('group_text');
    }
}
