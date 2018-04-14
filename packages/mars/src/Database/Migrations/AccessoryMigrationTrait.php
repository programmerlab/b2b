<?php

namespace Ribrit\Mars\Database\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

trait AccessoryMigrationTrait
{
    public function addAccessory($name)
    {
        if (Schema::hasTable($name . '_accessory')) {
            return false;
        }

        Schema::create($name . '_accessory', function (Blueprint $table) use ($name) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger($name . '_id');
            $table->string('key');
            $table->longText('value')->nullable();
            $table->index([
                $name . '_id',
                'key'
            ]);
        });

        Schema::table($name . '_accessory', function ($table) use ($name) {
            $table->foreign($name . '_id')->references('id')->on(Str::plural($name))->onDelete('cascade');
        });
    }

    public function removeAccessory($name)
    {
        if (!Schema::hasTable($name . '_accessory')) {
            return false;
        }

        Schema::drop($name . '_accessory');
    }
}
