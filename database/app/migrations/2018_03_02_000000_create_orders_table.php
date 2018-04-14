<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration
{
	public function up()
	{
		if (Schema::hasTable('orders')) {
			return false;
		}

		Schema::create('orders', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('tenant_id');
			$table->unsignedBigInteger('site_id');
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('payment_id');
			$table->unsignedBigInteger('shipping_id');
			$table->string('payment_way')->nullable();
			$table->date('delivery_date');
			$table->integer('quantity');
			$table->decimal('total_price', 16, 4);
			$table->text('note')->nullable();
			$table->unsignedBigInteger('status_id')->default(36);
			$table->timestamps();
		});

		Schema::create('order_products', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('order_id');
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

		$this->addForeignKey('orders', 'tenant');
		$this->addForeignKey('order_products', 'orders');
	}

	public function down()
	{
		if (!Schema::hasTable('orders')) {
			return false;
		}

		Schema::drop('order_products');
		Schema::drop('orders');
	}
}