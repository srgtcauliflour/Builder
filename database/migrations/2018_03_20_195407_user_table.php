<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function ($table) {
            $table->increments('user_id');
            $table->unsignedInteger('type_id')->default(4);
            $table->string('email')->unique();
            $table->string('token', 32)->unique();
            $table->tinyInteger('is_active')->default(1);
            $table->string('country', 2)->default('nl');
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
        Schema::dropIfExists('users');
    }
}
