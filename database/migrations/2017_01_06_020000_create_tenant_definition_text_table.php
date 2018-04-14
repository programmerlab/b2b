<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTenantDefinitionTextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_definition_text', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_definition_id');
            $table->unsignedBigInteger('lang_id');
            $table->string('title', 200);
            $table->index(['lang_id', 'tenant_definition_id']);
        });

        $this->addForeignKey('tenant_definition_text', 'lang');
        $this->addForeignKey('tenant_definition_text', 'tenant_definition');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tenant_definition_text');
    }
}
