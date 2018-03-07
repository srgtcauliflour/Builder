<?php

namespace Migrations\Seeders;

use Core\Helper;
use App\Service\Auth;

class UserSeeder
{

    public static function up($connection)
    {

        $auth = new Auth();

        $inserts = [
            ['email' => 'dev.kobus@gmail.com', 'type_id' => '1'],
            ['email' => 'mod@unknown.nu', 'type_id' => '2'],
            ['email' => 'truted@unknown.nu', 'type_id' => '3'],
            ['email' => 'user@unknown.nu', 'type_id' => '4']
        ];

        foreach ($inserts as $key => $insert)
        {
            $inserts[$key]['token'] = $auth->generateToken();
            $inserts[$key]['created_at'] = Helper::getCurrentDate(true);
            $inserts[$key]['updated_at'] = Helper::getCurrentDate(true);
        }

        $connection->table('users')->insert($inserts);

    }

}
