<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBrandsTable extends Migration
{
	public function up()
	{
		if (Schema::hasTable('brands')) {
			return false;
		}

		Schema::create('brands', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('tenant_id');
			$table->unsignedBigInteger('match_id')->default(0);
			$table->string('code');
			$table->string('title');
			$table->timestamps();
		});

		$this->addForeignKey('brands', 'tenant');
	}

	public function down()
	{
		if (!Schema::hasTable('brands')) {
			return false;
		}

		Schema::drop('brands');
	}
}