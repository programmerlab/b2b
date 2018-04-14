<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTenantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('storage_path');
            $table->string('public_key');
            $table->string('private_key');
            $table->enum('active', ['yes', 'no'])->default('yes');
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
        Schema::drop('tenant');
    }
}
