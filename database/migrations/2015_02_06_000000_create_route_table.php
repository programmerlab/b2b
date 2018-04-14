<?php

use Ribrit\Mars\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRouteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('layout_id')->default(0);
            $table->string('name')->unique();
            $table->string('controller'); // Ribrit\Mars\Http\Controllers\Site\Home\HomeController
            $table->string('lang_path')->nullable();
            $table->string('layout_path')->nullable();
            $table->integer('row')->default(100);
            $table->enum('active', ['yes', 'no'])->default('yes');
            $table->timestamps();
            $table->index(['row', 'active']);
        });

        $this->addForeignKey('route', 'group');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('route');
    }
}
