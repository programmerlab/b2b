<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOnlinePaymentsTable extends Migration
{
	public function up()
	{
		if (Schema::hasTable('online_payments')) {
			return false;
		}

		Schema::create('online_payments', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('tenant_id');
			$table->unsignedBigInteger('site_id');
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('bank_definition_id');
			$table->decimal('total_price', 16, 4);
			$table->string('card_name')
			      ->nullable();
			$table->string('card_no')
			      ->nullable();
			$table->string('payment_way')
			      ->nullable();
			$table->text('note')
			      ->nullable();
			$table->unsignedBigInteger('status_id');
			$table->timestamps();
		});

		$this->addForeignKey('online_payments', 'tenant');
	}

	public function down()
	{
		if (!Schema::hasTable('online_payments')) {
			return false;
		}

		Schema::drop('online_payments');
	}
}