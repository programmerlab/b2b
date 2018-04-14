<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTenantDefinitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenant_definition', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('group_id');
            $table->integer('row')->default(100);
            $table->enum('active', ['yes', 'no'])->default('yes');
            $table->timestamps();
            $table->index(['row', 'active']);
        });

        $this->addForeignKey('tenant_definition', 'tenant');
        $this->addForeignKey('tenant_definition', 'group');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tenant_definition');
    }
}
