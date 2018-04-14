<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRenklerTable extends Migration
{
	public function up()
	{
		if (Schema::hasTable('renkler')) {
			return false;
		}

		Schema::create('renkler', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('tenant_id');
			$table->unsignedBigInteger('match_id')->default(0);
			$table->string('rnk_special1')->nullable();
			$table->string('rnk_special2')->nullable();
			$table->string('rnk_special3')->nullable();
			$table->string('rnk_kodu')->nullable();
			$table->string('rnk_ismi')->nullable();
			$table->string('rnk_kirilim_1')->nullable();
			$table->string('rnk_kirilim_2')->nullable();
			$table->string('rnk_kirilim_3')->nullable();
			$table->string('rnk_kirilim_4')->nullable();
			$table->string('rnk_kirilim_5')->nullable();
			$table->string('rnk_kirilim_6')->nullable();
			$table->string('rnk_kirilim_7')->nullable();
			$table->string('rnk_kirilim_8')->nullable();
			$table->string('rnk_kirilim_9')->nullable();
			$table->string('rnk_kirilim_10')->nullable();
			$table->string('rnk_kirilim_11')->nullable();
			$table->string('rnk_kirilim_12')->nullable();
			$table->string('rnk_kirilim_13')->nullable();
			$table->string('rnk_kirilim_14')->nullable();
			$table->string('rnk_kirilim_15')->nullable();
			$table->string('rnk_kirilim_16')->nullable();
			$table->string('rnk_kirilim_17')->nullable();
			$table->string('rnk_kirilim_18')->nullable();
			$table->string('rnk_kirilim_19')->nullable();
			$table->string('rnk_kirilim_20')->nullable();
			$table->string('rnk_kirilim_21')->nullable();
			$table->string('rnk_kirilim_22')->nullable();
			$table->string('rnk_kirilim_23')->nullable();
			$table->string('rnk_kirilim_24')->nullable();
			$table->string('rnk_kirilim_25')->nullable();
			$table->string('rnk_kirilim_26')->nullable();
			$table->string('rnk_kirilim_27')->nullable();
			$table->string('rnk_kirilim_28')->nullable();
			$table->string('rnk_kirilim_29')->nullable();
			$table->string('rnk_kirilim_30')->nullable();
            $table->string('rnk_kirilim_31')->nullable();
            $table->string('rnk_kirilim_32')->nullable();
            $table->string('rnk_kirilim_33')->nullable();
            $table->string('rnk_kirilim_34')->nullable();
            $table->string('rnk_kirilim_35')->nullable();
            $table->string('rnk_kirilim_36')->nullable();
            $table->string('rnk_kirilim_37')->nullable();
            $table->string('rnk_kirilim_38')->nullable();
            $table->string('rnk_kirilim_39')->nullable();
            $table->string('rnk_kirilim_40')->nullable();
            $table->string('rnk_kirilim_41')->nullable();
            $table->string('rnk_kirilim_42')->nullable();
            $table->string('rnk_kirilim_43')->nullable();
            $table->string('rnk_kirilim_44')->nullable();
            $table->string('rnk_kirilim_45')->nullable();
            $table->string('rnk_kirilim_46')->nullable();
            $table->string('rnk_kirilim_47')->nullable();
            $table->string('rnk_kirilim_48')->nullable();
            $table->string('rnk_kirilim_49')->nullable();
            $table->string('rnk_kirilim_50')->nullable();
            $table->string('rnk_kirilim_51')->nullable();
            $table->string('rnk_kirilim_52')->nullable();
            $table->string('rnk_kirilim_53')->nullable();
            $table->string('rnk_kirilim_54')->nullable();
            $table->string('rnk_kirilim_55')->nullable();
            $table->string('rnk_kirilim_56')->nullable();
            $table->string('rnk_kirilim_57')->nullable();
            $table->string('rnk_kirilim_58')->nullable();
            $table->string('rnk_kirilim_59')->nullable();
            $table->string('rnk_kirilim_60')->nullable();
			$table->timestamps();
		});


		$this->addForeignKey('renkler', 'tenant');
	}

	public function down()
	{
		if (!Schema::hasTable('renkler')) {
			return false;
		}

		Schema::drop('renkler');
	}
}