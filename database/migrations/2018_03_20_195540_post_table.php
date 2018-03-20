<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function ($table) {
            $table->increments('post_id');
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('site_id')->index();
            $table->unsignedInteger('type_id')->index();
            $table->nullableMorphs('parentable');
            $table->string('title', 255)->nullable();
            $table->longText('content')->nullable();
            $table->tinyInteger('is_active')->default(0);
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
        Schema::dropIfExists('posts');
    }
}
