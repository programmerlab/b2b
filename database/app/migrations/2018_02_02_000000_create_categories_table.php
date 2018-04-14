<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration
{
	public function up()
	{
		if (Schema::hasTable('categories')) {
			return false;
		}

		Schema::create('categories', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('tenant_id');
			$table->unsignedBigInteger('parent_id')->default(0);
			$table->unsignedBigInteger('match_id')->default(0);
			$table->string('code');
			$table->string('title');
			$table->integer('row')->default(100);
			$table->enum('active', [
				'yes',
				'no'
			])->default('yes');
			$table->timestamps();
			$table->index([
				'row',
				'active'
			]);
		});

		$this->addForeignKey('categories', 'tenant');
	}

	public function down()
	{
		if (!Schema::hasTable('categories')) {
			return false;
		}

		Schema::drop('categories');
	}
}