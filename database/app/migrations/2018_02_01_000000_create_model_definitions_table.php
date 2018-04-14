<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModelDefinitionsTable extends Migration
{
	public function up()
	{
		if (Schema::hasTable('model_definitions')) {
			return false;
		}

		Schema::create('model_definitions', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('tenant_id');
			$table->unsignedBigInteger('match_id')->default(0);
			$table->string('mdl_kodu');
			$table->string('mdl_ismi');
			$table->timestamps();
		});

		$this->addForeignKey('model_definitions', 'tenant');
	}

	public function down()
	{
		if (!Schema::hasTable('model_definitions')) {
			return false;
		}

		Schema::drop('model_definitions');
	}
}