<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTenantRolesTable extends Migration
{
	public function up()
	{
		if (Schema::hasTable('tenant_roles')) {
			return false;
		}

		Schema::create('tenant_roles', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('tenant_id');
			$table->string('title')
			      ->nullable();
			$table->timestamps();
		});

		Schema::create('tenant_role_routes', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('tenant_role_id');
			$table->unsignedBigInteger('route_link_id');
			$table->enum('status', ['yes', 'no'])->default('no');
			$table->index(['route_link_id', 'tenant_role_id']);
		});

		$this->addForeignKey('tenant_roles', 'tenant');
		$this->addForeignKey('tenant_role_routes', 'tenant_roles');
	}

	public function down()
	{
		if (!Schema::hasTable('tenant_roles')) {
			return false;
		}

		Schema::drop('tenant_roles');
	}
}