<?php

namespace Migrations;

class UserTable
{
    public static $table = 'users';

    public static function up ($connection)
    {
        $connection::schema()->create('users', function ($tbl) {
            $tbl->increments('id');
        });
    }

    public static function down ($connection)
    {
        
    }

}
