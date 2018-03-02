<?php

namespace Migrations;

class UserTable
{
    public static $table = 'users';

    public static function up ($schema)
    {
        $schema->create('users', function ($tbl) {
            $tbl->increments('id');
        });
    }

    public static function down ($schema)
    {
        $schema->drop('users');
    }

}
