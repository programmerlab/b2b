<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInstantPaymentsTable extends Migration
{
	public function up()
	{
		if (Schema::hasTable('instant_payments')) {
			return false;
		}

		Schema::create('instant_payments', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('tenant_id');
			$table->unsignedBigInteger('site_id');
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('collecting_definition_id');
			$table->decimal('price', 16, 4);
			$table->text('note')
			      ->nullable();
			$table->string('file')
			      ->nullable();
			$table->unsignedBigInteger('status_id');
			$table->timestamps();
		});

		$this->addForeignKey('instant_payments', 'tenant');
	}

	public function down()
	{
		if (!Schema::hasTable('instant_payments')) {
			return false;
		}

		Schema::drop('instant_payments');
	}
}