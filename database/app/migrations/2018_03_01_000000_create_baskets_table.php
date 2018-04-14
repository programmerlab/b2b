<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBasketsTable extends Migration
{
	public function up()
	{
		if (Schema::hasTable('baskets')) {
			return false;
		}

		Schema::create('baskets', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('tenant_id');
			$table->unsignedBigInteger('site_id');
			$table->unsignedBigInteger('user_id');
			$table->decimal('total_price');
			$table->timestamps();
		});

		Schema::create('basket_products', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('basket_id');
			$table->unsignedBigInteger('product_id');
			$table->string('image');
			$table->string('sku');
			$table->string('title');
			$table->string('relation_title');
			$table->string('relation_sku');
			$table->integer('quantity');
			$table->decimal('price', 16, 4);
			$table->decimal('total_price', 16, 4);
			$table->timestamps();
		});

		$this->addForeignKey('baskets', 'tenant');
		$this->addForeignKey('basket_products', 'baskets');
	}

	public function down()
	{
		if (!Schema::hasTable('baskets')) {
			return false;
		}

		Schema::drop('basket_products');
		Schema::drop('baskets');
	}
}