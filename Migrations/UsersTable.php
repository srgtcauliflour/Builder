<?php

namespace Migrations;

class UsersTable
{
    public static $table = 'users';

    public static function up ($schema)
    {
        $schema->create('users', function ($table) {
            $table->increments('user_id');
            $table->integer('type_id')->unsigned();
            $table->string('email', 255);
            $table->string('password', 255);
            $table->tinyInteger('is_active');
            $table->timestamps();
        });
    }

    public static function down ($schema)
    {
        $schema->dropIfExists('users');
    }

}
