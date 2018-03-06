<?php

namespace Migrations;

class UsersTable
{
    public static $table = 'users';

    public static function up ($schema)
    {
        $schema->create('users', function ($table) {
            $table->increments('user_id');
            $table->integer('type_id')->unsigned()->default(3);
            $table->string('email', 255)->nullable();
            $table->string('token', 255);
            $table->string('reset_token', 255)->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
        });
    }

    public static function down ($schema)
    {
        $schema->dropIfExists('users');
    }

}
