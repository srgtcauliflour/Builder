<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('components', function ($table) {
            $table->increments('component_id');
            $table->unsignedInteger('site_id')->index();
            $table->unsignedInteger('type_id');
            $table->string('name', 255);
            $table->text('desc')->nullable();
            $table->text('tags')->nullable();
            $table->string('repo', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('components');
    }
}
