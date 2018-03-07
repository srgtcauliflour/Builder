<?php

namespace Migrations\Seeders;

use Core\Helper;

class TypeSeeder
{

    public static function up($connection)
    {
        $inserts = [
            ['name' => 'admin', 'value' => '1', 'desc' => 'Highest role'],
            ['name' => 'moderator', 'value' => '2', 'desc' => 'Helps moderating users'],
            ['name' => 'trusted', 'value' => '3', 'desc' => 'Is trusted by the system'],
            ['name' => 'user', 'value' => '4', 'desc' => 'Default role']
        ];

        foreach ($inserts as $key => $insert)
        {
            $inserts[$key]['type'] = 'role';
            $inserts[$key]['created_at'] = Helper::getCurrentDate(true);
            $inserts[$key]['updated_at'] = Helper::getCurrentDate(true);
        }

        $connection->table('types')->insert($inserts);
    }

}
