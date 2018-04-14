<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration
{
	public function up()
	{
		if (Schema::hasTable('pages')) {
			return false;
		}

		Schema::create('pages', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('tenant_id');
			$table->string('title')
			      ->nullable();
			$table->longText('content')
			      ->nullable();
			$table->timestamps();
		});

		$this->addForeignKey('pages', 'tenant');
	}

	public function down()
	{
		if (!Schema::hasTable('pages')) {
			return false;
		}

		Schema::drop('pages');
	}
}