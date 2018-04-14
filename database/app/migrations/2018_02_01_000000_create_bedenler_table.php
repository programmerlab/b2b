<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBedenlerTable extends Migration
{
	public function up()
	{
		if (Schema::hasTable('bedenler')) {
			return false;
		}

		Schema::create('bedenler', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('tenant_id');
			$table->unsignedBigInteger('match_id')->default(0);
			$table->string('bdn_special1')->nullable();
			$table->string('bdn_special2')->nullable();
			$table->string('bdn_special3')->nullable();
			$table->string('bdn_kodu')->nullable();
			$table->string('bdn_ismi')->nullable();
			$table->string('bdn_kirilim_1')->nullable();
			$table->string('bdn_kirilim_2')->nullable();
			$table->string('bdn_kirilim_3')->nullable();
			$table->string('bdn_kirilim_4')->nullable();
			$table->string('bdn_kirilim_5')->nullable();
			$table->string('bdn_kirilim_6')->nullable();
			$table->string('bdn_kirilim_7')->nullable();
			$table->string('bdn_kirilim_8')->nullable();
			$table->string('bdn_kirilim_9')->nullable();
			$table->string('bdn_kirilim_10')->nullable();
			$table->string('bdn_kirilim_11')->nullable();
			$table->string('bdn_kirilim_12')->nullable();
			$table->string('bdn_kirilim_13')->nullable();
			$table->string('bdn_kirilim_14')->nullable();
			$table->string('bdn_kirilim_15')->nullable();
			$table->string('bdn_kirilim_16')->nullable();
			$table->string('bdn_kirilim_17')->nullable();
			$table->string('bdn_kirilim_18')->nullable();
			$table->string('bdn_kirilim_19')->nullable();
			$table->string('bdn_kirilim_20')->nullable();
			$table->string('bdn_kirilim_21')->nullable();
			$table->string('bdn_kirilim_22')->nullable();
			$table->string('bdn_kirilim_23')->nullable();
			$table->string('bdn_kirilim_24')->nullable();
			$table->string('bdn_kirilim_25')->nullable();
			$table->string('bdn_kirilim_26')->nullable();
			$table->string('bdn_kirilim_27')->nullable();
			$table->string('bdn_kirilim_28')->nullable();
			$table->string('bdn_kirilim_29')->nullable();
			$table->string('bdn_kirilim_30')->nullable();
			$table->string('bdn_kirilim_31')->nullable();
			$table->string('bdn_kirilim_32')->nullable();
			$table->string('bdn_kirilim_33')->nullable();
			$table->string('bdn_kirilim_34')->nullable();
			$table->string('bdn_kirilim_35')->nullable();
			$table->string('bdn_kirilim_36')->nullable();
			$table->string('bdn_kirilim_37')->nullable();
			$table->string('bdn_kirilim_38')->nullable();
			$table->string('bdn_kirilim_39')->nullable();
			$table->string('bdn_kirilim_40')->nullable();
			$table->timestamps();
		});

		$this->addForeignKey('bedenler', 'tenant');
	}

	public function down()
	{
		if (!Schema::hasTable('bedenler')) {
			return false;
		}

		Schema::drop('bedenler');
	}
}