<?php

namespace Migrations;

class SettingTable
{
    public static $table = 'settings';

    public static function up($schema)
    {
        $schema->create('settings', function ($table) {
            $table->increments('setting_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('type_id');
            $table->string('name', 255);
            $table->text('value');
            $table->timestamps();
        });
    }

    public static function down($schema)
    {
        $schema->dropIfExists('settings');
    }
}
