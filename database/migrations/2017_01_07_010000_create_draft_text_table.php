<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDraftTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draft_text', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('draft_id');
            $table->unsignedBigInteger('lang_id');
            $table->string('subject');
            $table->longText('content');
            $table->index(['lang_id', 'draft_id']);
        });

        $this->addForeignKey('draft_text', 'draft');
        $this->addForeignKey('draft_text', 'lang');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('draft_text');
    }
}
