<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aData = [
            [
                [ 'name' => 'admin', 'type' => 'role', 'desc' => 'admin role', 'priority' => '999' ],
                [ 'name' => 'moderator', 'type' => 'role', 'desc' => 'mod role', 'priority' => '3' ],
                [ 'name' => 'trusted', 'type' => 'role', 'desc' => 'trusted user', 'priority' => '2' ],
                [ 'name' => 'user', 'type' => 'role', 'desc' => 'default', 'priority' => '1' ]
            ],
            [
                [ 'name' => 'log', 'type' => 'activity', 'desc' => 'log activity', 'note' => 'removed after 1 week' ],
                [ 'name' => 'queue', 'type' => 'activity', 'desc' => 'queue event', 'note' => null ],
                [ 'name' => 'auth', 'type' => 'activity', 'desc' => 'authentication', 'note' => null ]
            ],
            [
                [ 'name' => 'image', 'type' => 'source' ],
                [ 'name' => 'document', 'type' => 'source' ],
            ],
            [
                [ 'name' => 'blog', 'type' => 'site' ],
                [ 'name' => 'static', 'type' => 'site' ],
            ],
            [
                [ 'name' => 'content', 'type' => 'post' ],
            ],
            [
                [ 'name' => 'user', 'type' => 'setting' ],
                [ 'name' => 'site', 'type' => 'setting' ],
                [ 'name' => 'general', 'type' => 'setting' ],
                [ 'name' => 'account', 'type' => 'setting' ]
            ]
        ];

        foreach ($aData as $iTypes => $aTypes)
        {
            foreach ($aTypes as $iType => $aType)
            {
                $aData[$iTypes][$iType]['created_at'] = date('Y-m-d H:i:s');
                $aData[$iTypes][$iType]['updated_at'] = date('Y-m-d H:i:s');
            }

            DB::table('types')->insert($aData[$iTypes]);
        }
    }
}
