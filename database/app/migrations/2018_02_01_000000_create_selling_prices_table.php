<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSellingPricesTable extends Migration
{
	public function up()
	{
		if (Schema::hasTable('selling_prices')) {
			return false;
		}

		Schema::create('selling_prices', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('tenant_id');
			$table->unsignedBigInteger('match_id')->default(0);
			$table->string('sfl_aciklama');
			$table->string('sfl_kdvdahil');
			$table->timestamp('sfl_ilktarih');
			$table->timestamp('sfl_sontarih');
			$table->timestamps();
		});

		$this->addForeignKey('selling_prices', 'tenant');
	}

	public function down()
	{
		if (!Schema::hasTable('selling_prices')) {
			return false;
		}

		Schema::drop('selling_prices');
	}
}