<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('process_id');
            $table->unsignedBigInteger('user_id');
            $table->string('path_title');
            $table->string('path');
            $table->string('author');
            $table->text('content');
            $table->softDeletes();
            $table->timestamps();
        });

        $this->addForeignKey('note', 'group');
        $this->addForeignKey('note', 'tenant');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('note');
    }
}