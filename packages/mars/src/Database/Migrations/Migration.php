<?php

namespace Ribrit\Mars\Database\Migrations;

use Illuminate\Database\Migrations\Migration as BaseMigration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

abstract class Migration extends BaseMigration
{
	protected function addForeignKey($table, $tableFk, $tableFkName = null)
	{
		Schema::table($table, function ($query) use ($tableFk, $tableFkName) {
			$query->foreign(Str::singular($tableFk) . '_id', $tableFkName)
			      ->references('id')
			      ->on($tableFk)
			      ->onDelete('cascade');
		});
	}
}
