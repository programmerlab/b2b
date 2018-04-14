<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePluginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plugin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('group_id');
            $table->string('group_code');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('author');
            $table->string('link');
            $table->string('preview')->nullable();
            $table->string('directory');
            $table->string('assets');
            $table->timestamps();
        });

        $this->addForeignKey('plugin', 'tenant');
        $this->addForeignKey('plugin', 'group');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('plugin');
    }
}
