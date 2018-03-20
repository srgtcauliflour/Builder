<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function ($table) {
            $table->increments('source_id');
            $table->nullableMorphs('parentable');
            $table->string('name', 255);
            $table->text('desc')->nullable();
            $table->unsignedInteger('size')->nullable();
            $table->string('mime_type', 255);
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
        Schema::dropIfExists('sources');
    }
}
