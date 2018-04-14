<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration
{
	public function up()
	{
		if (Schema::hasTable('products')) {
			return false;
		}

		Schema::create('products', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('tenant_id');
			$table->unsignedBigInteger('brand_id')
			      ->default(0);
			$table->string('sku')
			      ->nullable();
			$table->string('image')
			      ->nullable();
			$table->string('title')
			      ->nullable();
			$table->integer('quantity')
			      ->default(0)
			      ->nullable();
			$table->decimal('price', 16, 8)
			      ->default(0);
			$table->integer('row')
			      ->default(100);
			$table->enum('active', [
				'yes',
				'no'
			])
			      ->default('yes');
			$table->timestamps();
			$table->index([
				'row',
				'active'
			]);
		});

		Schema::create('product_relations', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('product_id');
			$table->string('sku');
			$table->string('title');
			$table->integer('quantity');
			$table->decimal('price', 16, 4);
			$table->timestamps();
		});

		Schema::create('product_categories', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('product_id');
			$table->unsignedBigInteger('category_id');
			$table->timestamps();
		});

		$this->addForeignKey('products', 'tenant');
		$this->addForeignKey('product_relations', 'products');
		$this->addForeignKey('product_categories', 'products');
	}

	public function down()
	{
		if (!Schema::hasTable('products')) {
			return false;
		}

		Schema::drop('product_relations');
		Schema::drop('products');
	}
}