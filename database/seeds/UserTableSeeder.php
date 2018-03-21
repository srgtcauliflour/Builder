<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aData = [
            [ 'email' => 'dev.kobus@gmail.com', 'type_id' => '1', 'token' => '123456789', 'country' => 'nl' ],
            [ 'email' => 'me@morphable.eu', 'type_id' => '2', 'token' => '12345678', 'country' => 'pt' ],
            [ 'email' => 'you@morphable.eu', 'type_id' => '3', 'token' => '1234567', 'country' => 'us' ],
            [ 'email' => 'us@morphable.eu', 'type_id' => '4', 'token' => '123456', 'country' => 'de' ],
        ];

        foreach ($aData as $key => $value)
        {
            $aData[$key]['created_at'] = date('Y-m-d H:i:s');
            $aData[$key]['updated_at'] = date('Y-m-d H:i:s');
        }

        DB::table('users')->insert($aData);
    }
}
