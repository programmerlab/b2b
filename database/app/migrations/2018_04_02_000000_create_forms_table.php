<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormsTable extends Migration
{
	public function up()
	{
		if (Schema::hasTable('forms')) {
			return false;
		}

		Schema::create('forms', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('tenant_id');
			$table->string('title')
			      ->nullable();
			$table->timestamps();
		});

		$this->addForeignKey('forms', 'tenant');
	}

	public function down()
	{
		if (!Schema::hasTable('forms')) {
			return false;
		}

		Schema::drop('forms');
	}
}