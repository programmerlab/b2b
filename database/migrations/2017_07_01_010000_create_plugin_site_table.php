<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePluginSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plugin_site', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('plugin_id');
            $table->unsignedBigInteger('site_id');
            $table->enum('active', ['yes', 'no'])->default('yes')->nullable();
        });

        $this->addForeignKey('plugin_site', 'plugin');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('plugin_site');
    }
}
