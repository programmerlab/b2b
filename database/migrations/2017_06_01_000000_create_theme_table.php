<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateThemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theme', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('group_id');
            $table->string('group_code');
            $table->string('name');
            $table->string('description');
            $table->string('author');
            $table->string('link');
            $table->string('preview')->nullable();;
            $table->string('directory');
            $table->string('assets');
            $table->enum('active', ['yes', 'no'])->default('yes');
            $table->timestamps();
        });

        $this->addForeignKey('theme', 'tenant');
        $this->addForeignKey('theme', 'group');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('theme');
    }
}
