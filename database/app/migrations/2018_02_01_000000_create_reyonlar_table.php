<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReyonlarTable extends Migration
{
	public function up()
	{
		if (Schema::hasTable('reyonlar')) {
			return false;
		}

		Schema::create('reyonlar', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('tenant_id');
			$table->unsignedBigInteger('match_id')->default(0);
			$table->string('ryn_kod');
			$table->string('ryn_ismi');
			$table->timestamps();
		});

		$this->addForeignKey('reyonlar', 'tenant');
	}

	public function down()
	{
		if (!Schema::hasTable('reyonlar')) {
			return false;
		}

		Schema::drop('reyonlar');
	}
}