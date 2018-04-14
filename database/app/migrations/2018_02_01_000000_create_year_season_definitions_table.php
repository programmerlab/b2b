<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateYearSeasonDefinitionsTable extends Migration
{
	public function up()
	{
		if (Schema::hasTable('year_season_definitions')) {
			return false;
		}

		Schema::create('year_season_definitions', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('tenant_id');
			$table->unsignedBigInteger('match_id')->default(0);
			$table->string('ysn_kodu');
			$table->string('ysn_ismi');
			$table->timestamps();
		});

		$this->addForeignKey('year_season_definitions', 'tenant');
	}

	public function down()
	{
		if (!Schema::hasTable('year_season_definitions')) {
			return false;
		}

		Schema::drop('year_season_definitions');
	}
}