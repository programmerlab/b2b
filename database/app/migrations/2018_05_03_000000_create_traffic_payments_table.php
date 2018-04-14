<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrafficPaymentsTable extends Migration
{
	public function up()
	{
		if (Schema::hasTable('traffic_payments')) {
			return false;
		}

		Schema::create('traffic_payments', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('tenant_id');
			$table->unsignedBigInteger('site_id');
			$table->unsignedBigInteger('type_id')->default(0);
			$table->string('alias')->nullable();
			$table->string('type')->nullable();
			$table->decimal('price', 16, 4)->nullable();
			$table->timestamps();
		});

		$this->addForeignKey('traffic_payments', 'tenant');
	}

	public function down()
	{
		if (!Schema::hasTable('traffic_payments')) {
			return false;
		}

		Schema::drop('traffic_payments');
	}
}