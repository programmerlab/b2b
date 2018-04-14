<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeoRedirectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo_redirect', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id');
            $table->string('link');
            $table->string('redirect');
            $table->timestamps();
        });

        $this->addForeignKey('seo_redirect', 'tenant');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('seo_redirect');
    }
}
