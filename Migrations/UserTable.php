<?php

namespace Migrations;

class UserTable
{
    public static $table = 'users';

    public static function up ($schema)
    {
        $schema->create('users', function ($table) {
            $table->increments('user_id');
            $table->unsignedInteger('type_id');
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
